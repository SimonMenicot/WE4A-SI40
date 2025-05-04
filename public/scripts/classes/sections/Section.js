/*

    Une section est un élément qui permet d'afficher du contenu de cours de manière unique. 
    Cette classe est une classe "abstraite" permettant de définir les éléments de base d'une section
    Les autres sections définies dans le même dossier hérite de cette classe. 

    Les sections sont crées par un SectionExporter correspondant. 

*/
export class Section
{
    constructor(type, data)
    {
        this._type /*string*/ = type; // le type de section
        this._data = data; // le contenu dépend du type de section. Il ne s'agit à ce stade pas du JSON, mais de la lecture du JSON

        this._events = {
            modified: [] // une liste de callbacks functions 
        }
    }

    addEventListener(name, func) // ajouter une fonction à appeler lors d'un évènement
    {
        this._events[name].push(func);
    }

    get type() // retourne le nom du type de section
    {
        return this._type;
    }

    get data() // retourne les données de la section
    {
        return this._data;
    }

    set data(value) // définit les données de la section
    {
        this._data = value;
    }

    notifyEvents(name, args, requires_reload = false) // annonce un évènement aux fonctions connectées
    {
        // définition de l'évènement
        let event = new CustomEvent(name, 
            {
                detail : {
                    data: args,
                    requires_reload: requires_reload
                }
            }
        );

        // appel des différents callback functions
        for (let func of this._events[name])
        {
            (async () => func(event))();
        }
    }

    /*

        Cette fonction renvoie l'élement HTML à inclure dans le cours en mode lecture
        Elle doit être redéfinie par la section héritée de cette classe, mais ne doit pas être appelée directement. 

        Voir Section::(get htmlElement)


    */
    render() 
    {
        return document.createComment("empty section");
    }

    /*

        Cette fonction renvoie l'élement HTML à inclure dans le cours en mode lecture
        Elle doit être redéfinie par la section héritée de cette classe, mais ne doit pas être appelée directement. 

        Voir Section::(get editableHtmlElement)


    */
        renderEditable()
    {
        return this.render();
    }

    /*

        Prépare l'élement HTML à inclure dans le cours en mode lecture
        Cette fonction get ne dois pas être redéfinie dans la section fille, voir Section::render()
    
    */
    get htmlElement()
    {
        let element = this.render();
        element.classList.add("section", "section-" + this._type);
        return element;
    }

    /*

        Prépare l'élement HTML à inclure dans le cours en mode édition
        Cette fonction get ne dois pas être redéfinie dans la section fille, voir Section::renderEditable()
    
    */
    get editableHtmlElement()
    {
        let element = this.renderEditable();
        element.classList.add("section", "section-" + this._type, "section-editable");
        return element;
    }

    /*

        Cette fonction renvoie les données JSON utiles lors de la sauvegarde du cours. 
        Elle doit être redéfinie par la section héritée de cette classe, mais ne doit pas être appelée directement. 

        Voir Section::(get json_data)
    
    */
    exportToJsonData() 
    {
        return null;
    }

    /*

        Cette fonction est appelée pour préparer la sauvegarde du cours, avant son enregistrement

    */
    async onSave()
    {}

    /*

        Prépare le document JSON à enregistrer dans la base de donnée et renvoie le document JSON lié à la section
        Cette fonction get ne dois pas être redéfinie dans la section fille, voir Section::exportToJsonData()
    
    */
    get json_data()
    {
        return {
            "type": this._type,
            "data": this.exportToJsonData()
        };
    }
}


