import { SectionExporter } from "./SectionExporter.js";
import { ContainerSection } from "../sections/ContainerSection.js"
import { SectionAdder } from "../adding_sections/SectionAdder.js";

/*

    Les exportateurs de sections d'activités permettent de créer une section de conteneur à partir de ses données JSON

*/
export class ContainerSectionExporter extends SectionExporter
{
    constructor()
    {
        super("container", "Conteneur");
    }

    exportDataToSection(data, section_types_map)
    {

        // On commence par créer les enfants
        let children = [];

        for (let child_data of data.children)
        {
            // On crée un nouvel enfant en fonction de ses données
            children.push(section_types_map.export(child_data));
        }

        // On crée les nouvelles données
        let new_data = {
            is_horizontal: data.is_horizontal,
            is_wrapping: data.is_wrapping,
            children: children
        }

        return new ContainerSection(new_data, new SectionAdder(section_types_map));
    }

    async createNew(section_types_map)
    {
        return new ContainerSection({
            is_horizontal: true,
            is_wrapping: false,
            children: []
        }, new SectionAdder(section_types_map));
    }
}