export class FileSelector
{
    /*

        Relie l'élément à un sélecteur de fichiers
        - on_file_selection : fonction de rappel
        - accept : type de documents à accepter
        - multiple : accepte plusieurs fichiers si défini sur true

        Arguments requis par on_file_selection :
        - files : liste des fichiers sélectionnés
        - event : source de l'événement de sélection

    */
    constructor(click_element, on_file_selection, accept, multiple=false)
    {
        this._click_element = click_element;
        this._click_element.addEventListener("click", () => {
            this.chooseFile(accept, multiple);
        });

        this._on_file_selection = on_file_selection;
    }

    async chooseFile(accept, multiple=false)
    {
        // on crée un sélecteur de fichier (sans l'ajouter au document)
        let file_selector = document.createElement("input");
        file_selector.type = "file";
        file_selector.accept = accept;
        file_selector.multiple = multiple;

        // appeler la fonction de retour lorsqu'un fichier est choisit
        file_selector.addEventListener("change", (event) => {
            this._on_file_selection(file_selector.files, event);
        });

        file_selector.click();
    }


}