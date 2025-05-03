<?php

namespace App\CustomFeatures;

use App\Controller\Activity\ClickMeActivity;
use App\CustomFeatures\Activity;
use ContainerOaYQZMV\getActivityService;
use Symfony\Component\Asset\Packages;
use Twig\Environment;

/*

    Le gestionnaire d'activités permet de stocker les différentes activités. 

*/
class ActivitiesManager
{
    private array $activities = []; 

    public function __construct(Environment $environment, Packages $assets)
    {
        $this->activities = [];

        $env = new ActivityEnvironment($environment, $assets);


        $this->addActivity(new ClickMeActivity($env));
    }

    public function getActivity(string $name): Activity
    {
        return $this->activities[$name];
    }

    public function addActivity(Activity $activity): void
    {
        $this->activities[$activity->getName()] = $activity;
    }
}


