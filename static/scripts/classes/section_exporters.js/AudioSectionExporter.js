import { SectionExporter } from "./SectionExporter.js";
import { AudioSection } from "../sections/AudioSection.js"

export class AudioSectionExporter extends SectionExporter
{
    constructor()
    {
        super("audio");
    }

    exportDataToSection(data, section_types_map)
    {
        return new AudioSection(data);
    }
}

