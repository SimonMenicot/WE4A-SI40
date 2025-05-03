import { SectionExporter } from "./SectionExporter.js";
import { RichTextSection } from "../sections/RichTextSection.js"

/*

    Les exportateurs de sections d'activités permettent de créer une section de texte riche à partir de ses données JSON

*/
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


