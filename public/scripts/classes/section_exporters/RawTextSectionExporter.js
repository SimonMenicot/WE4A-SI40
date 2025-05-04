import { SectionExporter } from "./SectionExporter.js";
import { RawTextSection } from "../sections/RawTextSection.js"

/*

    Les exportateurs de sections d'activités permettent de créer une section de texte brut à partir de ses données JSON

*/
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

