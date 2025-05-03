<?php

namespace App\CustomFeatures;

use Symfony\Component\Asset\Packages;
use Twig\Environment;

/*

    L'environnement d'activité donne accès à l'environnement Twig et aux assets pour toutes les activités. 

*/
class ActivityEnvironment
{
    private Environment $environment;
    private Packages $assets;

    public function __construct(Environment $environment, Packages $assets)
    {
        $this->environment = $environment;
        $this->assets = $assets;
    }

    public function getEnvironment(): Environment
    {
        return $this->environment;
    }

    public function getAssets(): Packages
    {
        return $this->assets;
    }
}