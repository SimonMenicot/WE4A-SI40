<?php

namespace App\Controller\Activity;

use App\CustomFeatures\Activity;
use App\CustomFeatures\ActivityEnvironment;
use App\Entity\Account;

/*

    Cette activité est l'activité de clic affiché dans le cours "". 
    Cette activité est un simple exemple de ce qu'on peut faire avec les activités. 

    On n'a cependant pas encore utilisé la possibilité de trier les comptes et de gérer le fichier d'activité. 

*/
class ClickMeActivity extends Activity
{
    public function __construct(ActivityEnvironment $environment)
    {
        parent::__contruct($environment, "click-me-activity");
    }
    
    public function getAdditionalText(): string
    {
        return "some additional text";
    }

    public function getHtmlContent(string $file_content, ?Account $user): string
    {
        return $this->getEnvironment()->render("activities/click-me-activity/index.html.twig", [
            'button_text' => "!Cliquez-moi!"
        ]);
    }

    public function getEditableHtmlContent(string $file_content, ?Account $user): string
    {
        return $this->getEnvironment()->render("activities/click-me-activity/index-edit.html.twig", [
            'button_text' => "!Cliquez-moi!"
        ]);
        
    }

    public function getJsonArguments(string $file_content, ?Account $user): array
    {
        return [
            "text_url" => $this->getActivityResourceUrl('test')
        ];
    }

    public function getJavascript(string $file_content, ?Account $user): string
    {
        
        return '
class Activity
{
    constructor(id, args)
    {
        console.log("loading activity");
        this._text_url = args.text_url
    }

    onRender(div)
    {
        div.querySelector("button").addEventListener("click", async () => {
            alert(await this.getDisplayedText());
        })
    }

    async getDisplayedText()
    {
        data = await fetch(this._text_url);
        return await data.text();
    }
}';
    
    }

    public function getEditableJavascript(string $file_content, ?Account $user): string
    {
        return '
class Activity
{
    constructor(id, args)
    {
        console.log("loading editable activity");
        this._text_url = args.text_url
    }

    onRender(div)
    {
        div.querySelector("button").addEventListener("click", async () => {
            alert(await this.getDisplayedText());
        })
    }

    async getDisplayedText()
    {
        data = await fetch(this._text_url);
        return await data.text();
    }
}';
    
    }

    public function getCssStyleSheet(string $file_content, ?Account $user): string
    {
        return "";
    }

}

?>