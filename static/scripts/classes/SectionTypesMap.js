import { ActivitySectionExporter } from "./section_exporters.js/ActivitySectionExporter.js";
import { AudioSectionExporter } from "./section_exporters.js/AudioSectionExporter.js";
import { ContainerSectionExporter } from "./section_exporters.js/ContainerSectionExporter.js";
import { FileSectionExporter } from "./section_exporters.js/FileSectionExporter.js";
import { ImageSectionExporter } from "./section_exporters.js/ImageSectionExporter.js";
import { IntegrationSectionExporter } from "./section_exporters.js/IntegrationSectionExporter.js";
import { RawTextSectionExporter } from "./section_exporters.js/RawTextSectionExporter.js";
import { RichTextSectionExporter } from "./section_exporters.js/RichTextSectionExporter.js";
import { VideoSectionExporter } from "./section_exporters.js/VideoSectionExporter.js";

class SectionTypesMap
{
    constructor()
    {
        this._defined_types = {}
    }

    addSectionExporter(type_exporter)
    {
        this._defined_types[type_exporter.type] = type_exporter;
    }

    getSectionExporterByType(typename)
    {
        return this._defined_types[typename];
    }

    getExporterTypes()
    {
        return Object.keys(this._defined_types);
    }

    export(data)
    {
        return this.getSectionExporterByType(data.type).exportDataToSection(data.data, this)
    }
}

export const DEFAULT_SECTION_TYPES_MAP = new SectionTypesMap();

DEFAULT_SECTION_TYPES_MAP.addSectionExporter(new ContainerSectionExporter());
DEFAULT_SECTION_TYPES_MAP.addSectionExporter(new RawTextSectionExporter());
DEFAULT_SECTION_TYPES_MAP.addSectionExporter(new RichTextSectionExporter());
DEFAULT_SECTION_TYPES_MAP.addSectionExporter(new FileSectionExporter());
DEFAULT_SECTION_TYPES_MAP.addSectionExporter(new ImageSectionExporter());
DEFAULT_SECTION_TYPES_MAP.addSectionExporter(new ActivitySectionExporter());
DEFAULT_SECTION_TYPES_MAP.addSectionExporter(new IntegrationSectionExporter());
DEFAULT_SECTION_TYPES_MAP.addSectionExporter(new VideoSectionExporter());
DEFAULT_SECTION_TYPES_MAP.addSectionExporter(new AudioSectionExporter());
