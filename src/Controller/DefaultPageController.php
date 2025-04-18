<?php
namespace App\Controller;

use App\CustomFeatures\ActivitiesManager;
use App\Entity\Account;
use App\Entity\Classe;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Asset\Package;
use Symfony\Component\Asset\Packages;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Twig\Environment;

use const App\CustomFeatures\MAIN_ACTIVITIES_MANAGER;

class DefaultPageController extends AbstractController
{
    private $activities_manager;

    public function __construct(Environment $env, Packages $assets)
    {
        $this->activities_manager = new ActivitiesManager($env, $assets);
    }

    #[Route('/', 'home')]
    public function render_home_base(#[CurrentUser] ?Account $user): Response
    {
        if ($user === null)
        {
            return $this->redirectToRoute("login-page");
        }

        return $this->redirectToRoute("select ue");
    }
    
    #[Route('/class/{id}/read', 'ue-read')]
    public function render_ue_read(#[CurrentUser] ?Account $user, int $id): Response
    {
        if ($user === null)
        {
            return $this->redirectToRoute("login-page");
        }

        return $this->render('pages/ue-read.html.twig', [
            "base_config" => [
                "displayAdminCheckboxInHeader" => false,
                "current_user" => $user,
                "current_user_image" => base64_encode(stream_get_contents($user->getImage()))
            ],
            "ue_id" => $id
        ]);
    }
    
    #[Route('/ue-edit', 'ue-edit')]
    public function render_ue_edit(#[CurrentUser] ?Account $user): Response
    {
        if ($user === null)
        {
            return $this->redirectToRoute("login-page");
        }

        return $this->render('pages/ue-edit.html.twig', [
            "displayAdminCheckboxInHeader" => false,
            "base_config" => [
                "current_user" => $user,
                "current_user_image" => base64_encode(stream_get_contents($user->getImage()))
            ],
            "ue_id" => 1
        ]);
    }
    
    #[Route('/ue-select', 'select ue')]
    public function render_ue_select(#[CurrentUser] ?Account $user): Response
    {
        if ($user === null)
        {
            return $this->redirectToRoute("login-page");
        }

        return $this->render('pages/ue-select.html.twig', [
            "base_config" => [
                "displayAdminCheckboxInHeader" => false,
                "current_user" => $user,
                "current_user_image" => base64_encode(stream_get_contents($user->getImage()))
            ]
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

}

