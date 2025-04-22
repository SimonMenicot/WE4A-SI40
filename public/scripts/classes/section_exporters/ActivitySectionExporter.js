import { SectionExporter } from "./SectionExporter.js";
import { ActivitySection } from "../sections/ActivitySection.js"

export class ActivitySectionExporter extends SectionExporter
{
    constructor()
    {
        super("activity");
    }

    exportDataToSection(data, section_types_map)
    {
        return new ActivitySection(data);
    }
}

