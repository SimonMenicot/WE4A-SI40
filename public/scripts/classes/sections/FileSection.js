import { Section } from "./Section.js";
import { FileSelector } from "../../elements/FileSelector.js";

export class FileSection extends Section
{
    constructor(data)
    {
        super("file", data);
        this._changed_src = false;
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
        this.notifyEvents("modified", {
            reason: "inner-modification",
            modification: "descritption",
            description:value
        }, false);
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
        this._changed_src = true;
        this.notifyEvents("modified", {
            reason: "inner-modification",
            modification: "src",
            src: value
        }, false);

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
        this.notifyEvents("modified", {
            reason: "inner-modification",
            modification: "filename",
            src: value
        }, false);
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

        link.appendChild(document.createElement("img")).src = "/images/icons/download.png"
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

        upload_button.appendChild(document.createElement("img")).src = "/images/icons/upload.png"
        let name = document.createElement("span")
        upload_button.append(name)
        name.classList.add("file-extension");
        name.textContent = this.filename;

        description.addEventListener("input", ()=>{
            this.description = description.value;
        })


        let file_selector = new FileSelector(upload_button, (files)=>{
            this.filename = files[0].name;
            this.src = URL.createObjectURL(files[0]);
            this._file = files[0]
            name.textContent = this.filename;
        }, "")


        return div;
    }

    async onSave() {
        if (this._changed_src){
            let data = await fetch("/file/new/"+this.filename,{
                method: "POST",
                body:this._file
            });
            if (data.status === 202) {
                let json_data = await data.json();
                this.src = "/file/" + json_data.file_id;
            }else{
                throw new Error(data.status);
            }
        }
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

