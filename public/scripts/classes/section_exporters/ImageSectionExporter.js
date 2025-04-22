import { SectionExporter } from "./SectionExporter.js";
import { ImageSection } from "../sections/ImageSection.js"

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

