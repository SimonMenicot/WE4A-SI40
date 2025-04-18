<?php
namespace App\Controller;

use App\CustomFeatures\ActivitiesManager;
use App\Entity\Account;
use App\Entity\Classe;
use App\Entity\File;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Asset\Packages;
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
    public function render_class_content(Classe $class, EntityManagerInterface $entityManager): Response
    {
        $content = $class->getContent();

        return new Response(
            json_encode([
                "name" => $class->getName(),
                "content" => [
                    "type" => $content["type"],
                    "data" => $this->cleanContentData($content, $entityManager)
                ],
            ], true),
            200,
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
                "status" => 'success'
            ]));
        }
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
}

