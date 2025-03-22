<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultPageController extends AbstractController
{
    #[Route('/login', "login-page")]
    public function render_login(): Response
    {
        return $this->render('pages/login.html.twig', [
        ]);
    }

    #[Route('/')]
    public function render_home_base(): Response
    {
        return $this->redirectToRoute("login-page");
    }
}

