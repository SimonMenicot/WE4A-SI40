<?php

namespace App\CustomFeatures;

use App\Entity\Account;
use Symfony\Component\Asset\Packages;
use Twig\Environment;

/*

    Une activité est comme un plug-in intégré à Nooble contenu dans une section de cours. 

    La documentation a précédemment été effectuée en anglais. Pour des raisons de temps, nous les avons laissé tels quels. 

*/
abstract class Activity
{
    private string $name;
    private ActivityEnvironment $environment;

    public function __contruct(ActivityEnvironment $environment, string $name)
    {
        $this->name = $name;
        $this->environment = $environment;
    }

    /*

        This method must return the html content of the activity. 

    */
    abstract public function getHtmlContent(string $file_content, ?Account $user): string;

    /*

        This method must return the editable html content of the activity. 

    */
    abstract public function getEditableHtmlContent(string $file_content, ?Account $user): string;

    /*

        This method must return the javascript script of the activity. 

        A javascript script must contain a class activity following this format: 

class Activity // the Activity name is mandatory
{
    constructor(id, args) // id is the id of the activity, and args the json args given to the activity
    {
        // construction of the actvitiy
    }

    onRender(div)
    {
        // what to do when rendering the div
    }
}

    */
    abstract public function getJavascript(string $file_content, ?Account $user): string;

    /*

        This method must return the editable javascript script of the activity. 

        A javascript script must contain a class activity following this format: 

class Activity // the Activity name is mandatory
{
    constructor(id, args) // id is the id of the activity, and args the json args given to the activity
    {
        // construction of the actvitiy
    }

    onRender(div)
    {
        // what to do when rendering the div
    }
}

    */
    abstract public function getEditableJavascript(string $file_content, ?Account $user): string;

    /*

        This method must return the css stylesheet of the activity. 
        This stylesheet will then be adapted to the context.

    */
    abstract public function getCssStyleSheet(string $file_content, ?Account $user): string;

    /*

        This method must return the json arguments that would be given to the activity. 

    */
    abstract public function getJsonArguments(string $file_content, ?Account $user): array;

    public function getName(): string
    {
        return $this->name;
    }

    public function getActivityResourceUrl(string $name): string
    {
        return $this->environment->getAssets()->getUrl("activity-resources/".$this->name."/".$name);
    }

    public function getEnvironment(): Environment
    {
        return $this->environment->getEnvironment();
    }
}

?>