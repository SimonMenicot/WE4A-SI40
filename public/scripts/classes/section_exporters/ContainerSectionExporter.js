import { SectionExporter } from "./SectionExporter.js";
import { ContainerSection } from "../sections/ContainerSection.js"

export class ContainerSectionExporter extends SectionExporter
{
    constructor()
    {
        super("container");
    }

    exportDataToSection(data, section_types_map)
    {
        let children = [];

        for (let child_data of data.children)
        {
            children.push(section_types_map.export(child_data));
        }
        
        let new_data = {
            is_horizontal: data.is_horizontal,
            is_wrapping: data.is_wrapping,
            children: children
        }

        return new ContainerSection(new_data);
    }
}