import { SectionExporter } from "./SectionExporter.js";
import { ActivitySection } from "../sections/ActivitySection.js"

/*

    Les exportateurs de sections d'activités permettent de créer une section d'activité à partir de ses données JSON

*/
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

