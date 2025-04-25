<?php

namespace App\CustomFeatures;

use Symfony\Component\Asset\Packages;
use Twig\Environment;

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