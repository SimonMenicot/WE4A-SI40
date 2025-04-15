<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultPageController extends AbstractController
{
    #[Route('/', 'home')]
    public function render_home_base(): Response
    {
        return $this->redirectToRoute("login-page");
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

    #[Route('/profile', "profile-page")]
    public function render_profile(): Response
    {
        return $this->render('pages/profile.html.twig', [
            "base_config" => [
                "displayAdminCheckboxInHeader" => false
            ]
        ]);
    }

    #[Route('/ue-edit', "ue-edit")]
    public function render_ue_edit(): Response
    {
        return $this->render('pages/ue-edit.html.twig', [
            "base_config" => [
                "displayAdminCheckboxInHeader" => false
            ]
        ]);
    }

}

