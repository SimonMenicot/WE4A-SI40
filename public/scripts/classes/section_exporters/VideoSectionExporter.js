import { SectionExporter } from "./SectionExporter.js";
import { VideoSection } from "../sections/VideoSection.js"

/*

    Les exportateurs de sections d'activités permettent de créer une section vidéo à partir de ses données JSON

*/
export class VideoSectionExporter extends SectionExporter
{
    constructor()
    {
        super("video", "Vidéo");
    }

    exportDataToSection(data, section_types_map)
    {
        return new VideoSection(data);
    }
}

