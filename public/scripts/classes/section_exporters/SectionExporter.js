export class SectionExporter
{
    constructor(type, name)
    {
        this._type = type;
        this._name = name;
    }

    get type()
    {
        return this._type;
    }

    get name()
    {
        return this._name;
    }

    exportDataToSection(data, section_types_map)
    {
        return null; // this section should return the defined Section as defined in the "../sections" folder
    }

    async createNew(section_types_map)
    {
        throw new Error("nothing to create");        
    }

}
