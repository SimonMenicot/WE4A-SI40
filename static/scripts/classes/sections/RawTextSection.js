import { Section } from "./Section.js";

export class RawTextSection extends Section
{
    constructor(data)
    {
        super("raw-text", data);
    }

    get text()
    {
        return this.data;
    }

    set text(value)
    {
        this.data = value;
    }

    render()
    {
        let p = document.createElement("p");
        p.innerText = this.text;
        return p;
    }

    renderEditable()
    {
        let div = document.createElement("div");

        div.contentEditable = true;
        div.innerText = this.text;

        return div;
    }

    exportToJsonData()
    {
        return this.text;
    }
}

