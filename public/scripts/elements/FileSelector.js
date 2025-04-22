export class FileSelector
{
    /*

        Links the element with a files selector
         - on_file_selection: a callback function 
         - accept: the kind of documents to accept
         - multiple : when set to true, accepts multiple files

        Arguments required by on_file_selection :
         - files: list of selected files
         - event: event source of selection

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
        let file_selector = document.createElement("input");
        file_selector.type = "file";
        file_selector.accept = accept;
        file_selector.multiple = multiple;

        file_selector.addEventListener("change", (event) => {
            this._on_file_selection(file_selector.files, event);
        });

        file_selector.click();
    }


}