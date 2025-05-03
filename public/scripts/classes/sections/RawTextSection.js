import { Section } from "./Section.js";

/*

    Les sections de texte brut permettent d'afficher un texte brut dans le cours.
    
    Le mode édition n'est pas encore implémenté. 

*/
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

        this.notifyEvents("modified", {
            new_text: value
        }, false);
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

        div.addEventListener("input", () => {
            let text = div.innerText;

            while (text.endsWith("\n")) text = text.substring(0, text.length - 1)

            this.text = text;
        });

        return div;
    }

    exportToJsonData()
    {
        return this.text;
    }
}

