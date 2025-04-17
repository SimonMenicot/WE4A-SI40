import { Section } from "./Section.js";

export class ActivitySection extends Section
{
    constructor(data)
    {
        super("activity", data);
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

    get extra_data()
    {
        return this.data.extras;
    }

    set extra_data(value)
    {
        let data = this.data;
        data.value = value;
        this.data = data;
    }

    render()
    {
        let div = document.createElement("div");
        div.innerHTML = this.html;

        let style = div.appendChild(document.createElement("style"));
        style.innerHTML = this.css;

        const DIV = div;
        eval(this.javascript);

        return div;
    }

    renderEditable()
    {
        let div = document.createElement("div");
        div.innerHTML = this.edit_html;

        let style = div.appendChild(document.createElement("style"));
        style.innerHTML = this.css;

        const DIV = div;
        eval(this.javascript);

        return div;
    }

    exportToJsonData()
    {
        return {
            html: this.html,
            javascript: this.javascript,
            css: this.css,
            edit_html: this.edit_html,
            edit_javascript: this.edit_javascript,
            extra_data: this.extra_data
        };
    }
}

