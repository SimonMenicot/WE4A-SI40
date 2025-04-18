import { CssParser } from "../../css-integration/CssParser.js";
import { Section } from "./Section.js";

export class ActivitySection extends Section
{
    constructor(data)
    {
        super("activity", data);

        let activity;

        eval(data.javascript + '\n\nactivity = new Activity(data.id, data.arguments)');
        
        this._activity = activity;

        eval(data.edit_javascript + '\n\nactivity = new Activity(data.id, data.arguments)');
        
        this._edit_activity = activity;
    }

    get id()
    {
        return this.data.id;
    }

    get activity_type()
    {
        return this.data.type;
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

        let parser = new CssParser();

        let style = div.appendChild(document.createElement("style"));
        style.innerHTML = parser.parse("#" + div.id, this.css);

        this._activity.onRender(div);

        return div;
    }

    renderEditable()
    {
        let div = document.createElement("div");
        div.id = "activity-integration-" + this.id;
        div.innerHTML = this.edit_html;

        let parser = new CssParser();

        let style = div.appendChild(document.createElement("style"));
        style.innerHTML = parser.parse("#" + div.id, this.css);

        this._edit_activity.onRender(div);

        return div;
    }

    exportToJsonData()
    {
        return {
            id: this.id,
            type: this.activity_type
        };
    }
}

