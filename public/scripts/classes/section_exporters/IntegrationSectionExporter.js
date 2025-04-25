import { SectionExporter } from "./SectionExporter.js";
import { IntegrationSection } from "../sections/IntegrationSection.js"

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

