<?php

namespace App\Controller\ActivityData;

use App\Annotation\ActivityContentController;
use App\CustomFeatures\ActivityData;
use Symfony\Component\Config\Resource\FileResource;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[ActivityContentController('click-me-activity')]
class ClickMeActivityData extends ActivityData
{
    #[Route('/test')] // affiché dans /activity-resources/click-me-activity/test
    public function display(): Response
    {
        return new Response("Ce texte est généré depuis l'activité");
    }

    #[Route('/raw-html')] // affiché dans /activity-resources/click-me-activity/raw-html
    public function rawhtml(): Response
    {
        return new Response($this->getActivity()->getHtmlContent(new FileResource(""), null));
    }

    public function getAdditionalText(): string
    {
        return "some additional text";
    }

}

?>