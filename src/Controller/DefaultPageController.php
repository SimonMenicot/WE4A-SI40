<?php
namespace App\Controller;

use App\CustomFeatures\ActivitiesManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Asset\Package;
use Symfony\Component\Asset\Packages;
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
    public function render_home_base(): Response
    {
        return $this->redirectToRoute("login-page");
    }

    #[Route('/ue-read', 'ue-read')]
    public function render_ue_read(): Response
    {
        return $this->render('pages/ue-read.html.twig', [
            "base_config" => [
                "displayAdminCheckboxInHeader" => false
            ],
            "ue_id" => 1
        ]);
    }

    #[Route('/ue-edit', 'ue-edit')]
    public function render_ue_edit(): Response
    {
        return $this->render('pages/ue-edit.html.twig', [
            "base_config" => [
                "displayAdminCheckboxInHeader" => false
            ],
            "ue_id" => 1
        ]);
    }

    #[Route('/ue-select', 'select ue')]
    public function render_ue_select(): Response
    {
        $base_class1 = [
            "title" => "WE4A",
            "description" => "Introduction au design Web"
        ];

        $base_class2 = [
            "title" => "WE4B",
            "description" => "Angular Tah les fous"
        ];

        $classes = [];

        for ($i=0; $i < 8; ++$i)
        {
            $classes[] = $base_class1;
            $classes[] = $base_class2;
        }

        return $this->render('pages/ue-select.html.twig', [
            "base_config" => [
                "displayAdminCheckboxInHeader" => false
            ],
            "classes" => $classes
        ]);
    }

    #[Route('/login', "login-page")]
    public function render_login(): Response
    {
        return $this->render('pages/login.html.twig', [
        ]);
    }

}

