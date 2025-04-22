import { ActivitySectionExporter } from "./section_exporters/ActivitySectionExporter.js";
import { AudioSectionExporter } from "./section_exporters/AudioSectionExporter.js";
import { ContainerSectionExporter } from "./section_exporters/ContainerSectionExporter.js";
import { FileSectionExporter } from "./section_exporters/FileSectionExporter.js";
import { ImageSectionExporter } from "./section_exporters/ImageSectionExporter.js";
import { IntegrationSectionExporter } from "./section_exporters/IntegrationSectionExporter.js";
import { RawTextSectionExporter } from "./section_exporters/RawTextSectionExporter.js";
import { RichTextSectionExporter } from "./section_exporters/RichTextSectionExporter.js";
import { VideoSectionExporter } from "./section_exporters/VideoSectionExporter.js";

class SectionTypesMap
{
    constructor()
    {
        this._defined_types = {}
    }

    addTypeExporter(type_exporter)
    {
        this._defined_types[type_exporter.type] = type_exporter;
    }

    getTypeExporterByType(typename)
    {
        return this._defined_types[typename];
    }

    getExporterTypes()
    {
        return Object.keys(this._defined_types);
    }

    export(data)
    {
        return this.getTypeExporterByType(data.type).exportDataToSection(data.data, this)
    }
}

export const DEFAULT_SECTION_TYPES_MAP = new SectionTypesMap();

DEFAULT_SECTION_TYPES_MAP.addTypeExporter(new ContainerSectionExporter());
DEFAULT_SECTION_TYPES_MAP.addTypeExporter(new RawTextSectionExporter());
DEFAULT_SECTION_TYPES_MAP.addTypeExporter(new RichTextSectionExporter());
DEFAULT_SECTION_TYPES_MAP.addTypeExporter(new FileSectionExporter());
DEFAULT_SECTION_TYPES_MAP.addTypeExporter(new ImageSectionExporter());
DEFAULT_SECTION_TYPES_MAP.addTypeExporter(new ActivitySectionExporter());
DEFAULT_SECTION_TYPES_MAP.addTypeExporter(new IntegrationSectionExporter());
DEFAULT_SECTION_TYPES_MAP.addTypeExporter(new VideoSectionExporter());
DEFAULT_SECTION_TYPES_MAP.addTypeExporter(new AudioSectionExporter());
