<?php
namespace App\Controller;

use App\CustomFeatures\ActivitiesManager;
use App\Entity\Account;
use App\Entity\Classe;
use App\Entity\File;
use App\Repository\ClasseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Asset\Packages;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Twig\Environment;

class AjaxInformationController extends AbstractController
{
    private $activities_manager;

    public function __construct(Environment $env, Packages $assets)
    {
        $this->activities_manager = new ActivitiesManager($env, $assets);
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
                "image" => $this->readImage($class->getThumbnail())
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

        $RAW_QUERY.= ' ORDER BY `name`, `surname`;';

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
    public function create_new_class(#[CurrentUser] ?Account $user, EntityManagerInterface $entityManager, Request $request): Response
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

        $class = new Classe();
        $class->setName($name);
        $class->setDescription($description);
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

            $activity = $this->activities_manager->getActivity($file->getType());

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

}

