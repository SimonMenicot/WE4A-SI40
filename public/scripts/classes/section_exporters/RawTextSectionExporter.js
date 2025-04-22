import { SectionExporter } from "./SectionExporter.js";
import { RawTextSection } from "../sections/RawTextSection.js"

export class RawTextSectionExporter extends SectionExporter
{
    constructor()
    {
        super("raw-text");
    }

    exportDataToSection(data, section_types_map)
    {
        return new RawTextSection(data);
    }
}

