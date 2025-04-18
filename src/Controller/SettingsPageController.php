<?php

namespace App\Controller;

use App\Entity\Account;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

class SettingsPageController extends AbstractController
{
    #[Route("/settings/", "settings-home")]
    public function render_settings_home(#[CurrentUser] Account $user)
    {
        $user_image = $user->getImage();
        fseek($user_image, 0);
        $user_image_base64 = base64_encode(stream_get_contents($user_image));

        return $this->render("settings/home.html.twig", [
            "base_config" => [
                "displayAdminCheckboxInHeader" => false,
                "current_user" => $user,
                "current_user_image" => $user_image_base64
            ],
            
        ]);
    }
}


