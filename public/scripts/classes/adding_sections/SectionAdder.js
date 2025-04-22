export class SectionAdder
{
    constructor(types_map)
    {
        this._types_map = types_map;
    }

    get types_map()
    {
        return this._types_map;
    }

    /*

        Returns the exporter to be used to create a new section. 

    */
    async promptNewSection()
    {
        let {
            div, 
            sections_list, 
            cancel_button
        } = createAddingSectionPrompt();

        try {
            return await new Promise((resolve, reject) => {
                cancel_button.addEventListener("click", () => {
                    resolve(null);
                });

                for (let section_type of this._types_map.getExporterTypes())
                {
                    let exporter = this._types_map.getTypeExporterByType(section_type);
                    sections_list.appendChild(this.createThumbnailForExporter(exporter)).addEventListener('click', async () => {
                        resolve(exporter);
                    });
                }
            });
        } finally {
            document.body.removeChild(div);
        }
    }

    createThumbnailForExporter(exporter)
    {
        let button = document.createElement("button")
        button.classList.add("clickable-thumbnail");

        button.appendChild(document.createElement("img")).src = "/images/sections/" + exporter.type + ".png";
        button.appendChild(document.createElement("span")).innerText = exporter.name;
        
        return button;
    }
}

function createAddingSectionPrompt()
{
    let div = document.createElement("div");
    div.classList.add("fullscreen-prompt");
    div.innerHTML = `
<div class="fullscreen-widget">
    <div class="widget-title">
        <h1> Ajouter une section... </h1>
    </div>

    <div id="sections-list" class="thumbnails-list widget-content">
    </div>

    <div class="widget-buttons-list">
        <button class="main-button" id="cancel-button">Annuler</button>
    </div>
</div>
`;

    let sections_list = div.querySelector("#sections-list");
    let cancel_button = div.querySelector("button#cancel-button");

    document.body.appendChild(div);

    return {
        div,
        sections_list,
        cancel_button
    };
}

