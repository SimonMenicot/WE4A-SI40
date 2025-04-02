import { Section } from "./Section.js";

export class FileSection extends Section
{
    constructor(data)
    {
        super("file", data);
    }

    get description()
    {
        return this.data.description;
    }

    set description(value)
    {
        let data = this.data;
        data.description = value;
        this.data = data;
    }

    get src()
    {
        return this.data.src;
    }

    set src(value)
    {
        let data = this.data;
        data.src = value;
        this.data = data;
    }

    get filename()
    {
        return this.data.filename;
    }

    set filename(value)
    {
        let data = this.data;
        data.filename = value;
        this.data = data;
    }

    render()
    {
        let div = document.createElement("div");
        let description = div.appendChild(document.createElement("p"));
        description.classList.add("file-description");
        description.innerText = this.description;

        let link = div.appendChild(document.createElement("a"));
        link.classList.add("file-button");
        link.href = this.src;
        link.target = "_blank";

        link.appendChild(document.createElement("img")).src = NOOBLE_CONFIG["PATH_NAME"] + "/static/images/icons/download.png"
        let name = document.createElement("span")
        link.append(name)
        name.classList.add("file-extension");
        name.textContent = this.filename;
        return div;
    }

    renderEditable()
    {
        let div = document.createElement("div");
        let description = div.appendChild(document.createElement("input"));
        description.type = "text"
        description.classList.add("file-description");
        description.value = this.description;

        let upload_button = div.appendChild(document.createElement("button"));
        upload_button.classList.add("file-button");

        upload_button.appendChild(document.createElement("img")).src = NOOBLE_CONFIG["PATH_NAME"] + "/static/images/icons/upload.png"
        let name = document.createElement("span")
        upload_button.append(name)
        name.classList.add("file-extension");
        name.textContent = this.filename;
        return div;
    }

    exportToJsonData()
    {
        return {
            filename: this.filename,
            description: this.description,
            src: this.src
        };
    }
}

