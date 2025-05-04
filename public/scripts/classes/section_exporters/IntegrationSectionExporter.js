import { SectionExporter } from "./SectionExporter.js";
import { IntegrationSection } from "../sections/IntegrationSection.js"

/*

    Les exportateurs de sections d'activités permettent de créer une section d'intégration à partir de ses données JSON

*/
export class IntegrationSectionExporter extends SectionExporter
{
    constructor()
    {
        super("integration", "Intégration");
    }

    exportDataToSection(data, section_types_map)
    {
        return new IntegrationSection(data);
    }
}

