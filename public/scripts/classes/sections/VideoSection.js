import { Section } from "./Section.js";

/*

    Les sections de vidéo permettent d'afficher un contenu vidéo. 
    
    Le mode édition n'est pas encore implémenté. 

*/
export class VideoSection extends Section
{
    constructor(data)
    {
        super("video", data);
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
        let video = document.createElement("video");
        video.src = this.src;
        video.controls = true;

        video.appendChild(document.createElement("span")).innerText = "Your browser is not compatible...";
        video.appendChild(document.createElement("br"));
        video.appendChild(document.createElement("span")).innerText = "Downlaod the video";

        let video_link = video.appendChild(document.createElement("a"));
        video_link.innerText = "here";
        video_link.href = this.src;

        return video;
    }

    renderEditable()
    {
        let div = document.createElement("div");

        let video = div.appendChild(document.createElement("video"));
        video.src = this.src;
        video.controls = true;

        video.appendChild(document.createElement("span")).innerText = "Your browser is not compatible...";
        video.appendChild(document.createElement("br"));
        video.appendChild(document.createElement("span")).innerText = "Downlaod the video";

        let video_link = video.appendChild(document.createElement("a"));
        video_link.innerText = "here";
        video_link.href = this.src;

        let change_button = div.appendChild(document.createElement("button"));
        change_button.appendChild(document.createElement("img")).src = "/images/icons/upload.png";

        return div;
    }

    exportToJsonData()
    {
        return this.src;
    }
}

