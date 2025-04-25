<?php

namespace App\CustomFeatures;

use App\Annotation\ActivityContentController;
use ReflectionClass;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Asset\Packages;

abstract class ActivityData extends AbstractController
{
    private Packages $assets;

    public function __construct(Packages $assets)
    {
        $this->assets = $assets;
    }

    /*

        This method returns the url of the given path, corresponding to the activity. 

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
