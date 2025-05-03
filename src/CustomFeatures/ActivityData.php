<?php

namespace App\CustomFeatures;

use App\Annotation\ActivityContentController;
use ReflectionClass;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Asset\Packages;

/*

    Les données d'activité permettent d'ajuter un AbstractController à une activité. 

    Les données d'activités doivent impérativement ajouter l'annotation de controle de contenu d'activité. 
    Voir src/Annotation/ActivityContentController.php. 

*/
abstract class ActivityData extends AbstractController
{
    private Packages $assets;

    public function __construct(Packages $assets)
    {
        $this->assets = $assets;
    }

    /*

        Cette méthode retourne l'URL correspondant à la source de l'activité. 

    */
    public function getActivityResourceUrl(string $path): string 
    {
        $reflectionClass = new ReflectionClass($this);
        $attributes = $reflectionClass->getAttributes(ActivityContentController::class);

        $activityRoute = $attributes[0]->newInstance();

        return $this->assets->getUrl($activityRoute->getPath()."/".$path);
    }

    public function getActivity()
    {
        $reflectionClass = new ReflectionClass($this);
        $attributes = $reflectionClass->getAttributes(ActivityContentController::class);

        $activityRoute = $attributes[0]->newInstance();

        return $this->container->get(ActivitiesManager::class)->getActivity($activityRoute->getName());
    }
}
