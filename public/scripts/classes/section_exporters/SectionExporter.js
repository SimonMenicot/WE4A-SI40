export class SectionExporter
{
    constructor(type)
    {
        this._type = type;
    }

    get type()
    {
        return this._type;
    }

    exportDataToSection(data, section_types_map)
    {
        return null; // this section should return the defined Section as defined in the "../sections" folder
    }
}
