import { Section } from "./Section.js";

export class ImageSection extends Section
{
    constructor(data)
    {
        super("image", data);
    }

    get src()
    {
        return this.data;
    }

    set src(value)
    {
        this.data = value;
    }

    render()
    {
        let img = document.createElement("img");
        img.src = this.src;
        return img;
    }

    renderEditable()
    {
        let div = document.createElement("div");

        div.appendChild(document.createElement("img")).src = this.src;
        let change_button = div.appendChild(document.createElement("button"));
        change_button.classList.add("icon-button");
        change_button.appendChild(document.createElement("img")).src = NOOBLE_CONFIG["PATH_NAME"] + "/static/images/icons/upload.png";

        return div;
    }

    exportToJsonData()
    {
        return this.src;
    }
}

