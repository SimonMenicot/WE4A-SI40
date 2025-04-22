<?php
namespace App\Controller;

use App\CustomFeatures\ActivitiesManager;
use App\Entity\Account;
use App\Entity\Classe;
use App\Entity\File;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Asset\Packages;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Symfony\Component\Security\Http\Controller\SecurityTokenValueResolver;
use Twig\Environment;
use Twig\Sandbox\SecurityPolicyInterface;

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

