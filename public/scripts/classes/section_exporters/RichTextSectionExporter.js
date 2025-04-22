import { SectionExporter } from "./SectionExporter.js";
import { RichTextSection } from "../sections/RichTextSection.js"

export class RichTextSectionExporter extends SectionExporter
{
    constructor()
    {
        super("rich-text", "Texte riche");
    }

    exportDataToSection(data, section_types_map)
    {
        return new RichTextSection(data);
    }

    async createNew()
    {
        return new RichTextSection("");
    }
}


