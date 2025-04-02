import { SectionExporter } from "./SectionExporter.js";
import { RichTextSection } from "../sections/RichTextSection.js"

export class RichTextSectionExporter extends SectionExporter
{
    constructor()
    {
        super("rich-text");
    }

    exportDataToSection(data, section_types_map)
    {
        return new RichTextSection(data);
    }
}


