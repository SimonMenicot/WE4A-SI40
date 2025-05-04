import { CssParser } from "../../css-integration/CssParser.js";
import { Section } from "./Section.js";

/*

    Les sections d'activité permettent d'envoyer du contenu intéractif dans le cours. 

    Côté serveur, elles peuvent définir leur propre controller, et indiquent également un
    contenu HTML, Javascript et CSS à inclure dans le cours. 

    Côte client, on peut définir les activités comme un simple contenu intégré dans le cours, mais
    de la même manière qu'un "sous-site". 

*/

export class ActivitySection extends Section
{
    constructor(data)
    {
        super("activity", data);

        let activity;

        // préparation du code javascript en mode lecture (voir Activity::getJavascript dans src/CustomeFeatures/Activity.php)
        eval(data.javascript + '\n\nactivity = new Activity(data.id, data.arguments)');
        
        this._activity = activity;

        // préparation du code javascript en mode lecture (voir Activity::getEditableJavascript dans src/CustomeFeatures/Activity.php)
        eval(data.edit_javascript + '\n\nactivity = new Activity(data.id, data.arguments)');
        
        this._edit_activity = activity;
    }

    get id()
    {
        return this.data.id;
    }

    get html()
    {
        return this.data.html;
    }

    get css()
    {
        return this.data.css;
    }

    get javascript()
    {
        return this.data.javascript;
    }

    get edit_html()
    {
        return this.data.edit_html;
    }

    get edit_javascript()
    {
        return this.data.edit_javascript;
    }

    render()
    {
        let div = document.createElement("div");
        div.id = "activity-integration-" + this.id;
        div.innerHTML = this.html;

        let parser = new CssParser(); // permet d'encapsuler le CSS

        let style = div.appendChild(document.createElement("style"));
        style.innerHTML = parser.parse("#" + div.id, this.css); // permet d'encapsuler le CSS

        this._activity.onRender(div);

        return div;
    }

    renderEditable()
    {
        let div = document.createElement("div");
        div.id = "activity-integration-" + this.id;
        div.innerHTML = this.edit_html;

        let parser = new CssParser(); // permet d'encapsuler le CSS

        let style = div.appendChild(document.createElement("style"));
        style.innerHTML = parser.parse("#" + div.id, this.css); // permet d'encapsuler le CSS

        this._edit_activity.onRender(div);

        return div;
    }

    /*

        On NE DOIT PAS exporter le contenu HTML, Javascript et CSS, bien qu'ils soient indiqués en entrée. 
        En effet, ils sont directement définis par le serveur au moment de l'envoi. 
        On n'a besoin que de l'identifiant du cours. 

    */
    exportToJsonData()
    {
        return {
            id: this.id
        };
    }
}

