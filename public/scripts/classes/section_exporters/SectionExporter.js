/*

    Un exportateur de section permettre de transformer les données JSON en un objet Section (voir le dossier Section.js), 

*/
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

    /*

        Cette méthode permet d'exporter des données JSON en une section

    */
    exportDataToSection(data, section_types_map)
    {
        return null; // cette section doit retourner la section définir dans le dossier "../sections"
    }

    /*

        Cette méthode permet de créer une nouvelle section à partir de rien

    */
    async createNew(section_types_map)
    {
        throw new Error("nothing to create");        
    }

}
