import { Section } from "./Section.js";

export class RichTextSection extends Section
{
    constructor(data)
    {
        super("rich-text", data);
    }

    get content()
    {
        return this.data;
    }

    set content(value)
    {
        this.data = value;
    }

    render()
    {
        let div = document.createElement("p");
        div.innerHTML = this.content;
        return div;
    }

    renderEditable()
    {
        let div = document.createElement("div");

        let edit_line_div = div.appendChild(document.createElement("div"));
        let edit_div = div.appendChild(document.createElement("div"));

        edit_line_div.classList.add("rich-text-section-edit-line")

        let add_button = (name, func) => {
            let action_button = edit_line_div.appendChild(document.createElement("button"));
            action_button.classList.add("icon-button");
            action_button.appendChild(document.createElement("img")).src = NOOBLE_CONFIG["PATH_NAME"] + "/static/images/icons/" + name + ".png";

            action_button.addEventListener("click", func);
        }

        add_button("bold", () => {
            const selection = window.getSelection();
            if(edit_div.contains(selection.anchorNode)){
                for (let  i = 0; i < selection.rangeCount; i++){
                    let selected = selection.getRangeAt(i).extractContents();
                    console.log(selected)
                    let bold = document.createElement("strong");
                    bold.innerText = selected.textContent;
                    selection.getRangeAt(i).insertNode(bold);
                }
            }
        })


//        for (let icon_name of ["bold", "italic", "underlined", "preformat", "list", "enumeration", "link"])
//        {
//        }

        //let edit_div = div.appendChild(document.createElement("div"));
        edit_div.classList.add("rich-text-section-content");
        edit_div.contentEditable = true;

        edit_div.innerHTML = this.content;

        return div;
    }

    exportToJsonData()
    {
        return this.content;
    }
}

