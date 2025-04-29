<?php
namespace App\Controller;

use App\CustomFeatures\ActivitiesManager;
use App\CustomFeatures\Emailer;
use App\Entity\Account;
use App\Entity\Classe;
use App\Entity\File;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Asset\Packages;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Twig\Environment;

class AjaxInformationController extends AbstractController
{
    private ActivitiesManager $activities_manager;
    private Emailer $emailer;

    public function __construct(Environment $env, Packages $assets, MessageBusInterface $bus)
    {
        $this->activities_manager = new ActivitiesManager($env, $assets);
        $this->emailer = new Emailer($bus);
    }

    #[Route('/classes/{id}/get-content', "get class content")]
    public function get_class_content(#[CurrentUser] ?Account $user, Classe $class, EntityManagerInterface $entityManager): Response
    {
        if ($user === null) 
        {
            return new Response(json_encode([
                "error" => "bad user or password"
            ]), Response::HTTP_UNAUTHORIZED,
                [
                    "Content-Type" => "text/json"
                ]
            );
        } else if (!(in_array("ROLE_ADMIN", $user->getRoles()) || $user->getClasses()->contains($class)))
        {
            return new Response(json_encode([
                "error" => "you are not subscribed to this class"
            ]), Response::HTTP_FORBIDDEN,
                [
                    "Content-Type" => "text/json"
                ]
            );
        }

        $content = $class->getContent();

        return new Response(
            json_encode([
                "name" => $class->getName(),
                "description" => $class->getDescription(),
                "content" => [
                    "type" => $content["type"],
                    "data" => $this->cleanContentData($content, $entityManager)
                ],
                "thumbnail" => $this->readImage($class->getThumbnail())
            ], true),
            Response::HTTP_ACCEPTED,
            [
                "Content-Type" => "text/json"
            ]
        );
    }

    #[Route('/classes/{id}/set-content', "set class content", methods:["POST"])]
    public function set_class_content(#[CurrentUser] ?Account $user, Classe $class, EntityManagerInterface $entityManager, Request $request): Response
    {
        if ($user === null) 
        {
            return new Response(json_encode([
                "error" => "bad user or password"
            ]), Response::HTTP_UNAUTHORIZED,
                [
                    "Content-Type" => "text/json"
                ]
            );
        } else if (!(in_array("ROLE_ADMIN", $user->getRoles()) || ($user->getClasses()->contains($class) && in_array("ROLE_TEACHER", $user->getRoles()))))
        {
            return new Response(json_encode([
                "error" => "You don't have the permission to modify this class"
            ]), Response::HTTP_FORBIDDEN,
                [
                    "Content-Type" => "text/json"
                ]
            );
        }

        if (!$class->getAccounts()->contains($user))
        {

            foreach ($class->getAccounts() as $account)
            {
                if (in_array("ROLE_TEACHER", $account->getRoles()))
                {
                    $this->emailer->send_email(
                        $account,
                        "Modifications opérées sur le cours ".$class->getName(),
                        "/mails/class-modification-notification.html.twig", [
                            "class" => $class,
                            "account" => $account,
                            "operator" => $user
                        ]
                    );
                }
            }

        }

        $content = $request->getPayload()->get("content");

        if (gettype($content) != "string" || $content === "")
        {
            return new Response(json_encode([
                "error" => "Invalid arguments type or content"
            ]), Response::HTTP_BAD_REQUEST,
                [
                    "Content-Type" => "text/json"
                ]
            );
        }

        try {
            $parsed_json = json_decode($content, true);
        } catch (Exception $exc) {
            return new Response(json_encode([
                "error" => "content is not valid"
            ]), Response::HTTP_BAD_REQUEST,
                [
                    "Content-Type" => "text/json"
                ]
            );
        }

        $class->setContent($parsed_json);
        $entityManager->flush();

        return new Response(
            json_encode([
                "status" => "success"
            ], true),
            Response::HTTP_ACCEPTED,
            [
                "Content-Type" => "text/json"
            ]
        );
    }

    #[Route('/authenticate', name: "authentication-page", methods: ["POST"])]
    public function authenticate(#[CurrentUser] ?Account $user): Response
    {
        if ($user === null) 
        {
            return new Response(json_encode([
                "error" => 'bad user or password'
            ]), Response::HTTP_UNAUTHORIZED);
        } else {
            return new Response(json_encode([
                "status" => 'success',
                "name" => $user->getName(),
                'surname' => $user->getSurname()
            ]));
        }
    }

    #[Route('/new-password', name: "reset-password", methods: ["POST"])]
    public function reset_user_password(#[CurrentUser] ?Account $user, Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $userPasswordHasher): Response
    {
        if ($user !== null) 
        {
            return new Response(status:Response::HTTP_NOT_ACCEPTABLE);
        } 

        $mail = $request->getPayload()->get("username");

        if (gettype($mail) !== "string")
        {
            return new Response(status:Response::HTTP_BAD_REQUEST);
        }

        $passwd_user = $entityManager->getRepository(Account::class)->findOneBy([
            "email" => $mail
        ]);

        if ($passwd_user === null)
        {
            return new Response(status:Response::HTTP_NOT_FOUND);
        } 

        $passwd_user->setPassword($this->createNewPasswordFor($passwd_user, $userPasswordHasher));
        $entityManager->flush();

        return new Response(json_encode([
            "status" => "success",
            "name" => $passwd_user->getName(),
            "surname" => $passwd_user->getSurname()
        ]), Response::HTTP_ACCEPTED);
    }

    #[Route('/logout', name: "logout")]
    public function logout(#[CurrentUser] ?Account $user, TokenStorageInterface $tokenStorage): Response
    {
        if ($user === null)
        {
            return new Response(json_encode([
                "status" => "error",
                "error" => 'cannot logout disconnected client'
            ]), Response::HTTP_FORBIDDEN);
        } else {
            $tokenStorage->setToken(null);
            
            return new Response(json_encode([
                "status" => 'success'
            ]), Response::HTTP_ACCEPTED);
        }
    }

    #[Route('/users/list', name: "list-users", methods:["GET"])]
    public function list_users(#[CurrentUser] ?Account $user, EntityManagerInterface $entityManager, Request $request): Response
    {
        if ($user === null)
        {
            return new Response(json_encode([
                "status" => "error",
                "error" => 'you cannot do this request without being connected'
            ]), Response::HTTP_FORBIDDEN);
        }

        if (!in_array("ROLE_ADMIN", $user->getRoles()))
        {
            return new Response(json_encode([
                "status" => "error",
                "error" => 'you must be admin to perform this action'
            ]), Response::HTTP_UNAUTHORIZED);
        }

        $max_count = intval($request->get("max-count"));

        if (gettype($max_count) !== "integer" || is_nan($max_count))
        {
            return new Response(json_encode([
                "status" => "error",
                "error" => 'max count is required'
            ]), Response::HTTP_BAD_REQUEST);
        }

        $contains = $request->get("contains");

        if (gettype($contains) !== "string" && gettype($contains) !== "NULL")
        {
            return new Response(json_encode([
                "status" => "error",
                "error" => 'invalid contains given'
            ]), Response::HTTP_BAD_REQUEST);
        }

        $ids = $request->get("ids");

        if (gettype($ids) !== "string" && gettype($ids) !== "NULL")
        {
            return new Response(json_encode([
                "status" => "error",
                "error" => 'invalid ids given, '.gettype($ids)
            ]), Response::HTTP_BAD_REQUEST);
        }

        if (gettype($ids) === "string" && gettype($contains) !== "NULL")
        {
            return new Response(json_encode([
                "status" => "error",
                "error" => 'cannot use contains and ids at the same time'
            ]), Response::HTTP_BAD_REQUEST);
        }

        if (gettype($ids) === "string")
        {

            $ids_list = [];
            foreach (explode(",", $ids) as $id)
            {
                $id_int = intval($id);
                $ids_list[] = $id_int;
    
                if ($id_int === NAN)
                {
                    return new Response(json_encode([
                        "status" => "error",
                        "error" => 'invalid ids given'
                    ]), Response::HTTP_BAD_REQUEST);
                }
            }
        }

        /* Demandé pour le cours de SI40 */
        $RAW_QUERY = 'SELECT * FROM account';
        if ($contains === null || str_replace(" ", '', $contains) === "")
        {
            if (gettype($ids) === "string")
            {
                $RAW_QUERY.= ' WHERE ';

                $i = false;
                foreach ($ids_list as $id)
                {
                    if ($i)
                    {
                        $RAW_QUERY.= ' OR ';
                    } else {
                        $i = true;
                    }

                    $RAW_QUERY.= '`id`=' . $id; // $id is an integer (and not a NAN), so there is not problem by adding it
                }
            }
        } else {
            $keywords = explode(" ", $contains);

            $RAW_QUERY.= ' WHERE ';

            $i = false;
            foreach ($keywords as $keyword)
            {
                if ($i) {
                    $RAW_QUERY .= " OR ";
                } else {
                    $i = true;
                }

                $quotted_kw = $entityManager->getConnection()->quote("%" . $keyword . "%");

                $j = false;
                foreach (["name", "surname", "description", "roles"] as $fieldname)
                {
                    if ($j)
                    {
                        $RAW_QUERY .= " OR ";
                    } else {
                        $j = true;
                    }

                    $RAW_QUERY.= "`{$fieldname}` LIKE {$quotted_kw}";
                }

            }

        }

        $RAW_QUERY.= ' ORDER BY `name`, `surname` LIMIT '.$max_count.";";

        $connection = $entityManager->getConnection();

        /* Demandé pour le cours de SI40 */
        $statement = $connection->prepare($RAW_QUERY);
        $result = $statement->execute(); /* Demandé pour le cours de SI40 */

        $result_content = $result->fetchAll(); /* Demandé pour le cours de SI40 */

        $users = [];

        foreach ($result_content as $user)
        {
            $users[] = [
                "name" => $user['name'],
                "surname" => $user['surname'],
                "description" => $user['description'],
                "image" => base64_encode($user['image']),
                "id" => $user['id'],
                "roles" => json_decode($user['roles'], true)
            ];
        }

        return new Response(json_encode($users), Response::HTTP_ACCEPTED);
    }

    #[Route('/users/{id}/set-classes', name: "users-set-classes", methods: ["POST"])]
    public function set_user_classes(#[CurrentUser] ?Account $user, Account $modified_user, Request $request, EntityManagerInterface $entityManager): Response
    {
        if ($user === null) 
        {
            return new Response(json_encode([
                "error" => 'bad user or password'
            ]), Response::HTTP_UNAUTHORIZED);
        }

        if (!in_array("ROLE_ADMIN", $user->getRoles()))
        {
            return new Response(json_encode([
                "status" => "error",
                "error" => 'You must be admin to perform this action'
            ]), Response::HTTP_FORBIDDEN);
        }

        $classes = $entityManager->getRepository(Classe::class);

        $ids = json_decode($request->getContent(), true)['ids'];

        $classes_ids = [];
        $user_classes = $modified_user->getClasses();

        foreach ($user_classes as $class)
        {
            $classes_ids[] = $class->getId();
        }

        foreach ($ids as $newly_present_id)
        {
            if (!in_array($newly_present_id, $classes_ids))
            {
                $modified_user->addClass($classes->findOneBy([
                    "id" => $newly_present_id
                ]));
            }
        }

        foreach ($classes_ids as $lastly_present_id)
        {
            if (!in_array($lastly_present_id, $ids))
            {
                $modified_user->removeClass($classes->findOneBy([
                    "id" => $lastly_present_id
                ]));
            }
        }

        $entityManager->flush();

        return new Response(json_encode([
            "status" => "success",
        ]), Response::HTTP_ACCEPTED);
    }

    #[Route('/classes/list', name: "list-classes", methods:["GET"])]
    public function list_classes(#[CurrentUser] ?Account $user, EntityManagerInterface $entityManager, Request $request): Response
    {
        if ($user === null)
        {
            return new Response(json_encode([
                "status" => "error",
                "error" => 'you cannot do this request without being connected'
            ]), Response::HTTP_FORBIDDEN);
        }

        if (!in_array("ROLE_ADMIN", $user->getRoles()))
        {
            return new Response(json_encode([
                "status" => "error",
                "error" => 'you must be admin to perform this action'
            ]), Response::HTTP_UNAUTHORIZED);
        }

        $max_count = intval($request->get("max-count"));

        if (gettype($max_count) !== "integer" || is_nan($max_count))
        {
            return new Response(json_encode([
                "status" => "error",
                "error" => 'max count is required'
            ]), Response::HTTP_BAD_REQUEST);
        }

        $contains = $request->get("contains");

        if (gettype($contains) !== "string" && gettype($contains) !== "NULL")
        {
            return new Response(json_encode([
                "status" => "error",
                "error" => 'invalid contains given'
            ]), Response::HTTP_BAD_REQUEST);
        }

        $ids = $request->get("ids");

        if (gettype($ids) !== "string" && gettype($ids) !== "NULL")
        {
            return new Response(json_encode([
                "status" => "error",
                "error" => 'invalid ids given, '.gettype($ids)
            ]), Response::HTTP_BAD_REQUEST);
        }

        if (gettype($ids) === "string" && gettype($contains) !== "NULL")
        {
            return new Response(json_encode([
                "status" => "error",
                "error" => 'cannot use contains and ids at the same time'
            ]), Response::HTTP_BAD_REQUEST);
        }

        if (gettype($ids) === "string")
        {

            $ids_list = [];
            foreach (explode(",", $ids) as $id)
            {
                $id_int = intval($id);
                $ids_list[] = $id_int;
    
                if ($id_int === NAN)
                {
                    return new Response(json_encode([
                        "status" => "error",
                        "error" => 'invalid ids given'
                    ]), Response::HTTP_BAD_REQUEST);
                }
            }
        }

        /* Demandé pour le cours de SI40 */
        $RAW_QUERY = 'SELECT * FROM classe';
        if ($contains === null || str_replace(" ", '', $contains) === "")
        {
            if (gettype($ids) === "string")
            {
                $RAW_QUERY.= ' WHERE ';

                $i = false;
                foreach ($ids_list as $id)
                {
                    if ($i)
                    {
                        $RAW_QUERY.= ' OR ';
                    } else {
                        $i = true;
                    }

                    $RAW_QUERY.= '`id`=' . $id; // $id is an integer (and not a NAN), so there is not problem by adding it
                }
            }
        } else {
            $keywords = explode(" ", $contains);

            $RAW_QUERY.= ' WHERE ';

            $i = false;
            foreach ($keywords as $keyword)
            {
                if ($i) {
                    $RAW_QUERY .= " OR ";
                } else {
                    $i = true;
                }

                $quotted_kw = $entityManager->getConnection()->quote("%" . $keyword . "%");

                $j = false;
                foreach (["name", "description"] as $fieldname)
                {
                    if ($j)
                    {
                        $RAW_QUERY .= " OR ";
                    } else {
                        $j = true;
                    }

                    $RAW_QUERY.= "`{$fieldname}` LIKE {$quotted_kw}";
                }

            }

        }

        $RAW_QUERY.= ' ORDER BY `name`, `description` LIMIT '.$max_count.";"; // $max_count is an integer

        $connection = $entityManager->getConnection();

        /* Demandé pour le cours de SI40 */
        $statement = $connection->prepare($RAW_QUERY);
        $result = $statement->execute(); /* Demandé pour le cours de SI40 */

        $result_content = $result->fetchAll(); /* Demandé pour le cours de SI40 */

        $classes = [];

        foreach ($result_content as $class)
        {
            $classes[] = [
                "name" => $class['name'],
                "description" => $class['description'],
                "thumbnail" => base64_encode($class['thumbnail']),
                "id" => $class['id']
            ];
        }

        return new Response(json_encode($classes), Response::HTTP_ACCEPTED);
    }

    #[Route('/classes/{id}/set-users', name: "classes-set-users", methods: ["POST"])]
    public function set_classes_users(#[CurrentUser] ?Account $user, Classe $class, Request $request, EntityManagerInterface $entityManager): Response
    {
        if ($user === null) 
        {
            return new Response(json_encode([
                "error" => 'bad user or password'
            ]), Response::HTTP_UNAUTHORIZED);
        }

        if (!in_array("ROLE_ADMIN", $user->getRoles()))
        {
            return new Response(json_encode([
                "status" => "error",
                "error" => 'You must be admin to perform this action'
            ]), Response::HTTP_FORBIDDEN);
        }

        $users = $entityManager->getRepository(Account::class);

        $ids = json_decode($request->getContent(), true)['ids'];

        $class_ids = [];
        $class_users = $class->getAccounts();

        foreach ($class_users as $account)
        {
            $class_ids[] = $account->getId();
        }

        foreach ($ids as $newly_present_id)
        {
            if (!in_array($newly_present_id, $class_ids))
            {
                $class->addAccount($users->findOneBy([
                    "id" => $newly_present_id
                ]));
            }
        }

        foreach ($class_ids as $lastly_present_id)
        {
            if (!in_array($lastly_present_id, $ids))
            {
                $class->removeAccount($users->findOneBy([
                    "id" => $lastly_present_id
                ]));
            }
        }

        $entityManager->flush();

        return new Response(json_encode([
            "status" => "success",
        ]), Response::HTTP_ACCEPTED);
    }

    #[Route('/classes/{id}/set-info', name: "classes-set-info", methods: ["POST"])]
    public function set_class_info(#[CurrentUser] ?Account $user, Classe $class, Request $request, EntityManagerInterface $entityManager): Response
    {
        if ($user === null) 
        {
            return new Response(json_encode([
                "error" => 'bad user or password'
            ]), Response::HTTP_UNAUTHORIZED);
        }

        if (!in_array("ROLE_ADMIN", $user->getRoles()))
        {
            return new Response(json_encode([
                "status" => "error",
                "error" => 'You must be admin to perform this action'
            ]), Response::HTTP_FORBIDDEN);
        }

        $name = $request->getPayload()->get("name");
        $description = $request->getPayload()->get("description");
        $thumbnail = $request->getPayload()->get("thumbnail");

        if (!is_null($name)) $class->setName($name);
        if (!is_null($description)) $class->setDescription($description);
        if (!is_null($thumbnail)) $class->setThumbnail(base64_decode($thumbnail));

        $entityManager->flush();

        return new Response(json_encode([
            "status" => "success",
        ]), Response::HTTP_ACCEPTED);
    }

    #[Route('/classes/{id}/delete', name: "delete-class", methods: ["POST"])]
    public function delete_class(#[CurrentUser] ?Account $user, Classe $class, EntityManagerInterface $entityManager): Response
    {
        if ($user === null) 
        {
            return new Response(json_encode([
                "error" => 'bad user or password'
            ]), Response::HTTP_UNAUTHORIZED);
        }

        if (!in_array("ROLE_ADMIN", $user->getRoles()))
        {
            return new Response(json_encode([
                "status" => "error",
                "error" => 'You must be admin to perform this action'
            ]), Response::HTTP_FORBIDDEN);
        }

        $entityManager->remove($class);
        $entityManager->flush();

        return new Response(json_encode([
            "status" => "success",
        ]), Response::HTTP_ACCEPTED);
    }

    #[Route('/classes/new', name: "create class", methods:["POST"])]
    public function create_new_class(#[CurrentUser] ?Account $user, EntityManagerInterface $entityManager, Request $request, KernelInterface $kernel): Response
    {
        if ($user === null)
        {
            return new Response(json_encode([
                "status" => "error",
                "error" => 'please log in!'
            ]), Response::HTTP_UNAUTHORIZED);
        }

        if (!in_array("ROLE_ADMIN", $user->getRoles()))
        {
            return new Response(json_encode([
                "status" => "error",
                "error" => 'You must be admin to perform this action'
            ]), Response::HTTP_FORBIDDEN);
        }

        $name = $request->getPayload()->get("name");
        $description = $request->getPayload()->get("description");

        if (gettype($name) !== "string" || gettype($description) !== "string")
        {
            return new Response(json_encode([
                "status" => "error",
                "error" => 'invalid request'
            ]), Response::HTTP_BAD_REQUEST);
        }

        $default_image = fopen($kernel->getProjectDir() . "/templates/resources/default_class_image.png", "rb");
        $default_image_data = $this->readImage($default_image);

        $class = new Classe();
        $class->setName($name);
        $class->setDescription($description);
        $class->setThumbnail(base64_decode($default_image_data));
        $class->setContent([
            "type" => "container",
            "data" => [
                "is_horizontal" => false,
                "is_wrapping" => false,
                "children" => []
            ]
        ]);
        $entityManager->persist($class);
        $entityManager->flush();

        return new Response(json_encode([
            "status" => "success",
            "class-id" => $class->getId()
        ]), Response::HTTP_ACCEPTED);
    }

    public function cleanContentData(array $class_content, EntityManagerInterface $entityManager)
    {
        if ($class_content["type"] == "container")
        {
            $children = [];

            foreach ($class_content["data"]["children"] as $child)
            {
                $child["data"] = $this->cleanContentData($child, $entityManager);
                $children[] = $child;
            }

            $class_content["data"]["children"] = $children;

            return $class_content["data"];
        } else if ($class_content["type"] == "activity") {
            $id = $class_content["data"]["id"];

            $file = $entityManager->getRepository(File::class)->find($id);
            $file_content = stream_get_contents($file->getContent());

            $activity = $this->activities_manager->getActivity($file->getFileName());

            return [
                "id" => $class_content["data"]["id"],
                "html" => $activity->getHtmlContent($file_content, null),
                "edit_html" => $activity->getEditableHtmlContent($file_content, null),
                "javascript" => $activity->getJavascript($file_content, null),
                "edit_javascript" => $activity->getEditableJavascript($file_content, null),
                "css" => $activity->getCssStyleSheet($file_content, null),
                "arguments" => $activity->getJsonArguments($file_content, null)
            ];
        } else {
            return $class_content["data"];
        }
    }

    public function readImage($image)
    {
        if (is_null($image)) return "";
        fseek($image, 0);
        return base64_encode(stream_get_contents($image));
    }

    #[Route("/user/{id}/set-profile", methods:"POST")]
    public function update_profile(#[CurrentUser] ?Account $user, Account $profile_user, Request $request, EntityManagerInterface $entityManager): Response
    {
        if ($user === null)
        {
            return new Response(json_encode(
                [
                    "status" => "error",
                    "error" => "you must be logged in to update your account"
                ]
            ),
            status: Response::HTTP_FORBIDDEN);
        }

        if (!in_array("ROLE_ADMIN", $user->getRoles()))
        {
            return new Response(json_encode([
                "status" => "error",
                "error" => 'You must be admin to perform this action'
            ]), Response::HTTP_FORBIDDEN);
        }

        $payload = $request->getPayload();

        $name = $payload->get('name');
        $surname = $payload->get('surname');
        $description = $payload->get('description');
        $image = $payload->get('image');

        if (gettype($name) != 'string'
         || gettype($surname) != 'string'
         || gettype($description) != 'string'
         || gettype($image) != 'string')
        {
            return new Response(json_encode(
                [
                    "status" => "error",
                    "error" => "bad arguments names or type provided"
                ]
            ),
            status: Response::HTTP_BAD_REQUEST);
        }

        if ($user->getId() !== $profile_user->getId())
        {

            $this->emailer->send_email(
                $profile_user,
                "Profil modifié",
                "/mails/profile-modified-notification.html.twig", [
                    "user" => $profile_user,
                    "operator" => $user
                ]
            );
    
        }
        
        $profile_user->setName($name);
        $profile_user->setSurname($surname);
        $profile_user->setDescription($description);
        $profile_user->setImage(base64_decode($image));
        $entityManager->flush();

        return new Response(json_encode(
            [
                "status" => "success"
            ]
        ),
        status: Response::HTTP_ACCEPTED);

    }

    #[Route("/user/{id}/set-mail", methods:"POST")]
    public function set_user_mail(#[CurrentUser] ?Account $user, Account $modified_user, Request $request, EntityManagerInterface $entityManager): Response
    {
        if ($user === null)
        {
            return new Response(json_encode(
                [
                    "status" => "error",
                    "error" => "you must be logged in to update your account"
                ]
            ),
            status: Response::HTTP_FORBIDDEN);
        }

        if (!in_array("ROLE_ADMIN", $user->getRoles()))
        {
            return new Response(json_encode([
                "status" => "error",
                "error" => 'You must be admin to perform this action'
            ]), Response::HTTP_FORBIDDEN);
        }

        $payload = $request->getPayload();

        $mail = $payload->get("mail");
        $last_email = $modified_user->getEmail();
        $modified_user->setEmail($mail);
        $entityManager->flush();

        $this->emailer->send_email(
            $modified_user,
            "Adresse mail modifiée",
            "/mails/email-changed-notification.html.twig", [
                "last" => $last_email,
                "user" => $modified_user,
                "operator" => $user
            ]
        );

        return new Response(json_encode(
            [
                "status" => "success"
            ]
        ),
        status: Response::HTTP_ACCEPTED);
    }

    #[Route("/user/{id}/set-roles", methods:"POST")]
    public function set_user_roles(#[CurrentUser] ?Account $user, Account $modified_user, Request $request, EntityManagerInterface $entityManager): Response
    {
        if ($user === null)
        {
            return new Response(json_encode(
                [
                    "status" => "error",
                    "error" => "you must be logged in to update your account"
                ]
            ),
            status: Response::HTTP_FORBIDDEN);
        }

        if ($user === $modified_user)
        {
            return new Response(json_encode([
                "status" => "error",
                "error" => 'You cannot grant your own account'
            ]), Response::HTTP_LOCKED);
        }

        if (!in_array("ROLE_ADMIN", $user->getRoles()))
        {
            return new Response(json_encode([
                "status" => "error",
                "error" => 'You must be admin to perform this action'
            ]), Response::HTTP_FORBIDDEN);
        }

        $payload = $request->getPayload();

        $student_active = $payload->get("student");

        if ($student_active === true)
        {
            $modified_user->setRoles(["ROLE_STUDENT"]);
        } else {
            $teacher_active = $payload->get("teacher");
            $admin_active = $payload->get("admin");
            
            $roles = [];

            if ($teacher_active) $roles[] = "ROLE_TEACHER";
            if ($admin_active) $roles[] = "ROLE_ADMIN";

            $modified_user->setRoles($roles);
        }

        $entityManager->flush();

        $this->emailer->send_email(
            $modified_user,
            "Rôles modifiés",
            "/mails/roles-changed-notification.html.twig", [
                "user" => $modified_user,
                "operator" => $user
            ]
        );
        
        return new Response(json_encode(
            [
                "status" => "success"
            ]
        ),
        status: Response::HTTP_ACCEPTED);
    }

    #[Route("/user/{id}/delete", methods:"POST")]
    public function delete_profile(#[CurrentUser] ?Account $user, Account $profile_user, EntityManagerInterface $entityManager): Response
    {
        if ($user === null)
        {
            return new Response(json_encode(
                [
                    "status" => "error",
                    "error" => "you must be logged in to update your account"
                ]
            ),
            status: Response::HTTP_FORBIDDEN);
        }

        if ((!in_array("ROLE_ADMIN", $user->getRoles())) || ( $user->getId() === $profile_user->getId() ))
        {
            return new Response(json_encode([
                "status" => "error",
                "error" => 'You must be admin to perform this action'
            ]), Response::HTTP_UNAUTHORIZED);
        }

        if ($user === $profile_user)
        {
            return new Response(json_encode([
                "status" => "error",
                "error" => 'You cannot delete your own account'
            ]), Response::HTTP_LOCKED);
        }

        $entityManager->remove($profile_user);
        $entityManager->flush();

        return new Response(json_encode(
            [
                "status" => "success"
            ]
        ),
        status: Response::HTTP_ACCEPTED);

    }

    #[Route('/user/new', name: "create user", methods:["POST"])]
    public function create_new_user(#[CurrentUser] ?Account $user, EntityManagerInterface $entityManager, Request $request, UserPasswordHasherInterface $userPasswordHasher, KernelInterface $kernel): Response
    {
        if ($user === null)
        {
            return new Response(json_encode([
                "status" => "error",
                "error" => 'please log in!'
            ]), Response::HTTP_UNAUTHORIZED);
        }

        if (!in_array("ROLE_ADMIN", $user->getRoles()))
        {
            return new Response(json_encode([
                "status" => "error",
                "error" => 'You must be admin to perform this action'
            ]), Response::HTTP_FORBIDDEN);
        }

        $name = $request->getPayload()->get("name");
        $surname = $request->getPayload()->get("surname");
        $mail = $request->getPayload()->get("mail");

        if (gettype($name) !== "string" || gettype($surname) !== "string" || gettype($mail) !== "string")
        {
            return new Response(json_encode([
                "status" => "error",
                "error" => 'invalid request'
            ]), Response::HTTP_BAD_REQUEST);
        }

        $default_image = fopen($kernel->getProjectDir() . "/templates/resources/default_user_image.png", "rb");
        $default_image_data = $this->readImage($default_image);

        $new_user = new Account();
        $new_user->setName($name);
        $new_user->setSurname($surname);
        $new_user->setEmail($mail);
        $new_user->setRoles(["ROLE_USER", "ROLE_STUDENT"]);
        $new_user->setImage(base64_decode($default_image_data));

        // password must be defined after, because of emails sending needing name and email

        $new_user->setPassword($this->createNewPasswordFor($new_user, $userPasswordHasher));
        $entityManager->persist($new_user);

        $entityManager->flush();

        return new Response(json_encode([
            "status" => "success",
            "user-id" => $new_user->getId()
        ]), Response::HTTP_ACCEPTED);
    }

    public function createNewPasswordFor(Account $user, $userPasswordHasher)
    {
        $passwd = "";

        $chars = str_split(
            'abcdefghijklmnopqrstuvwxyz'
            .'ABCDEFGHIJKLMNOPQRSTUVWXYZ'
            .'0123456789'
        );
        
        foreach (array_rand($chars, 8) as $i)
        {
            $passwd.= $chars[$i];
        }

        $this->emailer->send_email(
            $user,
            "Nouveau mot de passe",
            "/mails/password-modificated-notification.html.twig", [
                "user" => $user,
                "password" => $passwd
            ]
        );

        return $userPasswordHasher->hashPassword($user, $passwd);
    }

    #[Route("/file/new/{fileName}", name: "add file", methods:"POST")]
    public function addNewFile(#[CurrentUser] ?Account $user, EntityManagerInterface $entityManager, Request $request, string $fileName): Response{
        if ($user === null)
        {
            return new Response(json_encode([
                "status" => "error",
                "error" => 'please log in!'
            ]), Response::HTTP_UNAUTHORIZED);
        }
        $newFile = new File();
        $newFile->setContent($request->getContent());
        $newFile->setFileName($fileName);
        $newFile->setOwner($user->getId());
        $entityManager->persist($newFile);
        $entityManager->flush();

        return new Response(json_encode([
            "status" => "success",
            "file_id" => $newFile->getId()
        ]), Response::HTTP_ACCEPTED);
    }

}

