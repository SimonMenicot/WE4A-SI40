import { SectionExporter } from "./SectionExporter.js";
import { RawTextSection } from "../sections/RawTextSection.js"

export class RawTextSectionExporter extends SectionExporter
{
    constructor()
    {
        super("raw-text", "Texte brut");
    }

    exportDataToSection(data, section_types_map)
    {
        return new RawTextSection(data);
    }

    async createNew()
    {
        return new RawTextSection("");
    }
}

