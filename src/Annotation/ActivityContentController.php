<?php

namespace App\Annotation;

use App\Controller\ActivitiesManager;
use Attribute;
use Symfony\Component\Routing\Annotation\Route;

/*

This annotation allows
 - to move every activity paths to /activity-resources/{activity-name}, to ensure that they are enclosde
 - to register the activity for the activities manager. 

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
