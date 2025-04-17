<?php
namespace App\Controller;

use App\Entity\Classe;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AjaxInformationController extends AbstractController
{
    #[Route('/classes/{id}/get-content', "get class content")]
    public function render_login(Classe $class): Response
    {
        return new Response(
            json_encode([
                "name" => $class->getName(),
                "content" => $class->getContent(),
            ], true),
            200,
            [
                "Content-Type" => "text/json"
            ]
        );
    }
}

