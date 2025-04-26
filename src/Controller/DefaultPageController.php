<?php
namespace App\Controller;

use App\CustomFeatures\ActivitiesManager;
use App\Entity\Account;
use App\Entity\Classe;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Asset\Package;
use Symfony\Component\Asset\Packages;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Twig\Environment;

use const App\CustomFeatures\MAIN_ACTIVITIES_MANAGER;

class DefaultPageController extends AbstractController
{
    #[Route('/', 'home')]
    public function render_home_base(#[CurrentUser] ?Account $user, Request $request, EntityManagerInterface $entityManager): Response
    {
        if ($user === null)
        {
            return $this->redirectToRoute("login-page");
        }

        $ROLES = [
            "ROLE_ADMIN" => in_array("ROLE_ADMIN", $user->getRoles()),
            "ROLE_STUDENT" => in_array("ROLE_STUDENT", $user->getRoles()),
            "ROLE_TEACHER" => in_array("ROLE_TEACHER", $user->getRoles())
        ];

        if ($ROLES["ROLE_ADMIN"] && $ROLES["ROLE_TEACHER"])
        {
            $admin_mode_enabled = $request->cookies->get("admin_enabled", "false") === "true";
        } else {
            $admin_mode_enabled = false;
        }

        if ($ROLES["ROLE_STUDENT"])
        {
            return $this->render_student_home($user, $entityManager);
        }

        if (($ROLES["ROLE_ADMIN"] && $ROLES["ROLE_TEACHER"] && !$admin_mode_enabled) || (!$ROLES["ROLE_ADMIN"] && $ROLES["ROLE_TEACHER"]))
        {
            return $this->render_teacher_home($user, $entityManager);
        }

        if (($ROLES["ROLE_ADMIN"] && $ROLES["ROLE_TEACHER"] && $admin_mode_enabled) || ($ROLES["ROLE_ADMIN"] && !$ROLES["ROLE_TEACHER"]))
        {
            return $this->render_admin_home($user, $entityManager);
        }

        return new Response(status:Response::HTTP_NOT_IMPLEMENTED);
    }

    public function get_current_user_role(Account $user, Request $request): string
    {
        $ROLES = [
            "ROLE_ADMIN" => in_array("ROLE_ADMIN", $user->getRoles()),
            "ROLE_STUDENT" => in_array("ROLE_STUDENT", $user->getRoles()),
            "ROLE_TEACHER" => in_array("ROLE_TEACHER", $user->getRoles())
        ];

        if ($ROLES["ROLE_ADMIN"] && $ROLES["ROLE_TEACHER"])
        {
            $admin_mode_enabled = $request->cookies->get("admin_enabled", "false") === "true";
            return $admin_mode_enabled?"ROLE_ADMIN":"ROLE_TEACHER";
        } else {
            if ($ROLES["ROLE_ADMIN"]) return "ROLE_ADMIN";
            else if ($ROLES["ROLE_TEACHER"]) return "ROLE_TEACHER";
            else return "ROLE_STUDENT";
        }

    }

    public function render_student_home(#[CurrentUser] ?Account $user, EntityManagerInterface $entityManager): Response
    {
        if ($user === null)
        {
            return $this->redirectToRoute("login-page");
        }

        $classes = [];

        foreach ($user->getClasses() as $class)
        {
            $classes[] = [
                "id" => $class->getId(),
                "name" => $class->getName(),
                "description" => $class->getDescription(),
                "thumbnail" => $this->readImage($class->getThumbnail()),
            ];
        }

        return $this->render('pages/ue-select.html.twig', [
            "base_config" => [
                "current_user" => $user,
                "current_user_image" => $this->readImage($user->getImage()),
                "user_role" => "ROLE_STUDENT"
            ],
            "classes" => $classes
        ]);
    }
    
    public function render_teacher_home(#[CurrentUser] ?Account $user, EntityManagerInterface $entityManager): Response
    {
        if ($user === null)
        {
            return $this->redirectToRoute("login-page");
        }

        $classes = [];

        foreach ($entityManager->getRepository(Classe::class)->findAll() as $class)
        {
            $classes[] = [
                "id" => $class->getId(),
                "name" => $class->getName(),
                "description" => $class->getDescription(),
                "thumbnail" => $this->readImage($class->getThumbnail()),
            ];
        }

        return $this->render('pages/ue-select.html.twig', [
            "base_config" => [
                "current_user" => $user,
                "current_user_image" => $this->readImage($user->getImage()),
                "user_role" => "ROLE_TEACHER"
            ],
            "classes" => $classes
        ]);
    }
    
    public function render_admin_home(#[CurrentUser] ?Account $user, EntityManagerInterface $entityManager): Response
    {
        if ($user === null)
        {
            return $this->redirectToRoute("login-page");
        }

        $accounts = [];

        foreach ($entityManager->getRepository(Account::class)->findAll() as $account)
        {
            $accounts[] = [
                "name" => $account->getName(),
                "surname" => $account->getSurname(),
                "image" => $this->readImage($account->getImage()),
                "description" => $account->getDescription(),
                "roles" => $account->getRoles(),
                "id" => $account->getId()
            ];
        }

        $classes = [];

        foreach ($entityManager->getRepository(Classe::class)->findAll() as $class)
        {
            $classes[] = [
                "id" => $class->getId(),
                "name" => $class->getName(),
                "description" => $class->getDescription(),
                "thumbnail" => $this->readImage($class->getThumbnail()),
            ];
        }

        $user_classes = [];

        foreach ($user->getClasses() as $class)
        {
            $user_classes[] = [
                "id" => $class->getId(),
                "name" => $class->getName(),
                "description" => $class->getDescription(),
                "thumbnail" => $this->readImage($class->getThumbnail()),
            ];
        }

        return $this->render('pages/admin-homepage.html.twig', [
            "base_config" => [
                "current_user" => $user,
                "current_user_image" => $this->readImage($user->getImage()),
                "user_role" => "ROLE_ADMIN"
            ],
            "classes" => $classes,
            "accounts" => $accounts,
            "user_classes" => $user_classes
        ]);
    }
    
    #[Route('/profile', 'self-profile')]
    public function render_self_profile(#[CurrentUser] ?Account $user, Request $request): Response
    {
        if ($user === null)
        {
            return $this->redirectToRoute("login-page");
        }

        return $this->render_user_profile($user, $user, $request);
    }

    #[Route('/profile/{id}', 'profile')]
    public function render_user_profile(#[CurrentUser] ?Account $user, Account $displayed_user, Request $request): Response
    {
        return $this->render('pages/profile.html.twig', [
            "base_config" => [
                "current_user" => $user,
                "current_user_image" => $this->readImage($user->getImage()),
                "user_role" => $this->get_current_user_role($user, $request)
            ],
            "account" => $displayed_user,
            "user_image" => $this->readImage($displayed_user->getImage())
        ]);
    }
    
    #[Route('/profile/{id}/edit', 'profile-edit')]
    public function render_profile_edit(#[CurrentUser] ?Account $user, Account $displayed_user, Request $request): Response
    {
        if ($user === null)
        {
            return $this->redirectToRoute("login-page");
        }

        if ($this->get_current_user_role($user, $request) !== "ROLE_ADMIN")
        {
            return new Response(status:Response::HTTP_FORBIDDEN);
        }

        $classes = [];

        foreach ($displayed_user->getClasses() as $class)
        {
            $classes[] = [
                "id" => $class->getId(),
                "name" => $class->getName(),
                "description" => $class->getDescription(),
                "thumbnail" => $this->readImage($class->getThumbnail()),
            ];
        }

        return $this->render("pages/admin-user-edit.html.twig", [
            "base_config" => [
                "current_user" => $user,
                "current_user_image" => $this->readImage($user->getImage()),
                "user_role" => $this->get_current_user_role($user, $request)
            ],
            "account" => $displayed_user,
            "user_image" => $this->readImage($displayed_user->getImage()),
            "user_classes" => $classes
        ]);
    }
    
    #[Route('/class/{id}/users', 'ue-users')]
    public function render_ue_users(#[CurrentUser] ?Account $user, Classe $class, Request $request, EntityManagerInterface $entityManager): Response
    {
        if ($user === null)
        {
            return $this->redirectToRoute("login-page");
        }

        $accounts = [];

        foreach ($class->getAccounts() as $account)
        {
            $accounts[] = [
                "name" => $account->getName(),
                "surname" => $account->getSurname(),
                "image" => $this->readImage($account->getImage()),
                "description" => $account->getDescription(),
                "roles" => $account->getRoles(),
                "id" => $account->getId()
            ];
        }

        $class_export = [
            "id" => $class->getId(),
            "name" => $class->getName(),
            "description" => $class->getDescription(),
            "thumbnail" => $this->readImage($class->getThumbnail()),
        ];

        return $this->render('pages/class-accounts.html.twig', [
            "base_config" => [
                "current_user" => $user,
                "current_user_image" => $this->readImage($user->getImage()),
                "user_role" => $this->get_current_user_role($user, $request)
            ],
            "accounts" => $accounts,
            "class" => $class_export,
            "ue_id" => $class->getId()
        ]);
    }

    #[Route('/class/{id}', 'ue-preview')]
    public function render_ue_preview(#[CurrentUser] ?Account $user, int $id, ?Classe $class, Request $request): Response
    {
        if ($user === null)
        {
            return $this->redirectToRoute("login-page");
        }

        if ($this->get_current_user_role($user, $request) === "ROLE_STUDENT")
        {
            return $this->render_ue_read($user, $id, $request);
        } else {
            return $this->render_ue_edit($user, $id, $class, $request);
        }
    }
    
    public function render_ue_read(#[CurrentUser] ?Account $user, int $id, Request $request): Response
    {
        if ($user === null)
        {
            return $this->redirectToRoute("login-page");
        }

        return $this->render('pages/ue-read.html.twig', [
            "base_config" => [
                "current_user" => $user,
                "current_user_image" => $this->readImage($user->getImage()),
                "user_role" => $this->get_current_user_role($user, $request)
            ],
            "ue_id" => $id
        ]);
    }
    
    public function render_ue_edit(#[CurrentUser] ?Account $user, int $id, ?Classe $class, Request $request): Response
    {
        if ($user === null)
        {
            return $this->redirectToRoute("login-page");
        }

        if ($class === null)
        {
            $accounts = [];
        } else {
            $accounts = $class->getAccounts();
        }

        $users = [];

        foreach ($accounts as $account)
        {
            $users[] = [
                "name" => $account->getName(),
                "surname" => $account->getSurname(),
                "image" => $this->readImage($account->getImage()),
                "description" => $account->getDescription(),
                "roles" => $account->getRoles(),
                "id" => $account->getId()
            ];
        }

        return $this->render('pages/ue-edit.html.twig', [
            "base_config" => [
                "current_user" => $user,
                "current_user_image" => $this->readImage($user->getImage()),
                "user_role" => $this->get_current_user_role($user, $request)
            ],
            "ue_id" => $id,
            "users" => $users
        ]);
    }
    
    #[Route('/login', "login-page")]
    public function render_login(#[CurrentUser] ?Account $user): Response
    {
        if ($user !== null)
        {
            return $this->redirectToRoute("home");
        }

        return $this->render('pages/login.html.twig', [
        ]);
    }

    #[Route('/reset-passwd', "reset-passwd")]
    public function render_reset_passwd(#[CurrentUser] ?Account $user): Response
    {
        if ($user !== null)
        {
            return $this->redirectToRoute("home");
        }

        return $this->render('pages/password-forgotten.html.twig', [
        ]);
    }

    public function readImage($image)
    {
        if (is_null($image)) return "";
        fseek($image, 0);
        return base64_encode(stream_get_contents($image));
    }

}

