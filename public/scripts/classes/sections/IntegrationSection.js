import { Section } from "./Section.js";


/*

    Les sections d'intégration permettent d'intégrer une page via son URL d'intégration. 
    
    Le mode édition n'est pas encore implémenté. 

*/
export class IntegrationSection extends Section
{
    constructor(data)
    {
        super("integration", data);
    }

    get width()
    {
        return this.data.width;
    }

    get height()
    {
        return this.data.height;
    }

    get src()
    {
        return this.data.src;
    }

    get permissions()
    {
        return this.data.permissions;
    }

    render()
    {
        let frame = document.createElement("iframe");
        frame.width = this.width;
        frame.height = this.height;
        frame.src = this.src

        let permissions = ""
        for (let permission of this.permissions)
        {
            if (permission === "fullscreen")
            {
                frame.allowFullscreen = true;
            } else {
                if (permissions !== "")
                {
                    permissions += "; "
                }
    
                permissions += permission;
            }
        }

        frame.allow = permissions;
        frame.setAttribute("frameBorder", "0");
        frame.loading = "lazy";

        return frame;
    }

    exportToJsonData()
    {
        return {
            width: this.width,
            height: this.height,
            src: this.src,
            permissions: this.permissions
        };
    }
}

