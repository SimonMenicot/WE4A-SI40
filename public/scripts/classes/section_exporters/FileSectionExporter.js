import { SectionExporter } from "./SectionExporter.js";
import { FileSection } from "../sections/FileSection.js"
import {RichTextSection} from "../sections/RichTextSection.js";

/*

    Les exportateurs de sections d'activités permettent de créer une section de fichiers à partir de ses données JSON

*/
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

    async createNew()
    {
        return new FileSection({src:null, description : "", filename:""});
    }
}

