import { SectionExporter } from "./SectionExporter.js";
import { AudioSection } from "../sections/AudioSection.js"

/*

    Les exportateurs de sections d'activités permettent de créer une section audio à partir de ses données JSON

*/
export class AudioSectionExporter extends SectionExporter
{
    constructor()
    {
        super("audio", "Audio");
    }

    exportDataToSection(data, section_types_map)
    {
        return new AudioSection(data);
    }
}

