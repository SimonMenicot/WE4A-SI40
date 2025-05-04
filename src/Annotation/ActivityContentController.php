<?php

namespace App\Annotation;

use App\Controller\ActivitiesManager;
use Attribute;
use Symfony\Component\Routing\Annotation\Route;

/*

    Cette annotation permet de déplacer tous les chemins d'activité vers /activity-resources/{activity-name}, afin de garantir qu'ils sont inclus
    Elle doit être incluse devant toutes les classes héritant de ActivityData (src/CustomFeatures/ActivityData.php). 

*/

/**
 * @Annotation
 * @Target("METHOD")
 */
#[Attribute(Attribute::TARGET_CLASS)]
class ActivityContentController extends Route
{
    private string $activityPath;
    private string $name;

    public function __construct(string $activityName)
    {
        $path = "/activity-resources/".$activityName;

        parent::__construct($path);
        $this->activityPath = $path;
        $this->name = $activityName;
    }

    public function getPath(): string
    {
        return $this->activityPath;
    }

    public function getName(): string
    {
        return $this->name;
    }

}
