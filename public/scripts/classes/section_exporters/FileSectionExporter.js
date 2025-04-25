import { SectionExporter } from "./SectionExporter.js";
import { FileSection } from "../sections/FileSection.js"

export class FileSectionExporter extends SectionExporter
{
    constructor()
    {
        super("file", "Fichier");
    }

    exportDataToSection(data, section_types_map)
    {
        return new FileSection(data);
    }
}

