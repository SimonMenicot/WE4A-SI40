import { SectionExporter } from "./SectionExporter.js";
import { ImageSection } from "../sections/ImageSection.js"

/*

    Les exportateurs de sections d'activités permettent de créer une section d'images à partir de ses données JSON

*/
export class ImageSectionExporter extends SectionExporter
{
    constructor()
    {
        super("image", "Image");
    }

    exportDataToSection(data, section_types_map)
    {
        return new ImageSection(data);
    }
}

