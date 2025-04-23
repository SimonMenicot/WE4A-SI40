<?php

namespace App\Controller;

use App\Entity\Account;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactoryInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\PasswordHasher\PasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

class SettingsPageController extends AbstractController
{
    #[Route("/settings/", "settings-home")]
    public function render_settings_home(#[CurrentUser] ?Account $user): Response
    {
        if ($user === null)
        {
            return $this->redirectToRoute("login-page");
        }

        $user_image = $user->getImage();
        fseek($user_image, 0);
        $user_image_base64 = base64_encode(stream_get_contents($user_image));

        return $this->render("settings/home.html.twig", [
            "base_config" => [
                "admin_enabled" => false,
                "current_user" => $user,
                "current_user_image" => $user_image_base64
            ]
            
        ]);
    }

    #[Route("/settings/account/profile", "settings-profile")]
    public function render_settings_profile(#[CurrentUser] ?Account $user): Response
    {
        if ($user === null)
        {
            return $this->redirectToRoute("login-page");
        }

        $user_image = $user->getImage();
        fseek($user_image, 0);
        $user_image_base64 = base64_encode(stream_get_contents($user_image));

        return $this->render("settings/account/profile.html.twig", [
            "base_config" => [
                "admin_enabled" => false,
                "current_user" => $user,
                "current_user_image" => $user_image_base64
            ],
            "user_profile_image" => $user_image_base64,
        ]);
    }

    #[Route("/settings-api/account/update-profile", methods:"POST")]
    public function update_profile(#[CurrentUser] ?Account $user, Request $request, EntityManagerInterface $entityManager): Response
    {
        if ($user === null)
        {
            return new Response(json_encode(
                [
                    "status" => "error",
                    "error" => "you must be logged in to update your account"
                ]
            ),
            status: Response::HTTP_UNAUTHORIZED);
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

        $user->setName($name);
        $user->setSurname($surname);
        $user->setDescription($description);
        $user->setImage(base64_decode($image));
        $entityManager->flush();

        return new Response(json_encode(
            [
                "status" => "success"
            ]
        ),
        status: Response::HTTP_ACCEPTED);

    }

    #[Route("/settings-api/account/change-password", methods:"POST")]
    public function modify_password(#[CurrentUser] ?Account $user, Request $request, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager): Response
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

        $payload = $request->getPayload();

        $last_password = $payload->get('last_password');
        $new_password = $payload->get('new_password');

        if (gettype($last_password) != 'string'
         || gettype($new_password) != 'string'
         || $last_password === ''
         || $new_password === ''
        ) {
            return new Response(json_encode(
                [
                    "status" => "error",
                    "error" => "bad arguments names or type provided"
                ]
            ),
            status: Response::HTTP_BAD_REQUEST);
        }

        if (!$passwordHasher->isPasswordValid($user, $last_password)) {
            return new Response(json_encode(
                [
                    "status" => "error",
                    "error" => "bad arguments names or type provided"
                ]
            ),
            status: Response::HTTP_UNAUTHORIZED);
        }

        $user->setPassword($passwordHasher->hashPassword($user, $new_password));
        $entityManager->flush();

        return new Response(json_encode(
            [
                "status" => "success"
            ]
        ),
        status: Response::HTTP_ACCEPTED);

    }

    #[Route("/settings/account/infos", "settings-profile-infos")]
    public function render_settings_profile_infos(#[CurrentUser] ?Account $user)
    {
        if ($user === null)
        {
            return $this->redirectToRoute("login-page");
        }

        $user_image = $user->getImage();
        fseek($user_image, 0);
        $user_image_base64 = base64_encode(stream_get_contents($user_image));

        return $this->render("settings/account/profile-info.html.twig", [
            "base_config" => [
                "admin_enabled" => false,
                "current_user" => $user,
                "current_user_image" => $user_image_base64
            ],
            "user_profile_image" => $user_image_base64,
        ]);
    }

    #[Route("/settings/account/password", "settings-account-password")]
    public function render_settings_password_infos(#[CurrentUser] ?Account $user)
    {
        if ($user === null)
        {
            return $this->redirectToRoute("login-page");
        }

        $user_image = $user->getImage();
        fseek($user_image, 0);
        $user_image_base64 = base64_encode(stream_get_contents($user_image));

        return $this->render("settings/account/password.html.twig", [
            "base_config" => [
                "admin_enabled" => false,
                "current_user" => $user,
                "current_user_image" => $user_image_base64
            ],
            "user_profile_image" => $user_image_base64,
        ]);
    }
}


