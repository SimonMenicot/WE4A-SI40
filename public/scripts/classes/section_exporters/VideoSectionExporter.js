import { SectionExporter } from "./SectionExporter.js";
import { VideoSection } from "../sections/VideoSection.js"

export class VideoSectionExporter extends SectionExporter
{
    constructor()
    {
        super("video");
    }

    exportDataToSection(data, section_types_map)
    {
        return new VideoSection(data);
    }
}

