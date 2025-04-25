import { SectionExporter } from "./SectionExporter.js";
import { ActivitySection } from "../sections/ActivitySection.js"

export class ActivitySectionExporter extends SectionExporter
{
    constructor()
    {
        super("activity", "Activité interactive");
    }

    exportDataToSection(data, section_types_map)
    {
        return new ActivitySection(data);
    }
}

