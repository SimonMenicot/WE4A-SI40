export class SearchList
{
    constructor(search_bar, search_parent)
    {
        this._search_bar = search_bar;
        this._search_parent = search_parent;

        let no_result_element = document.createElement("span");
        no_result_element.classList.add("result-text");
        no_result_element.classList.add("error");
        if (search_parent.children.length)
            this._no_result_element = search_parent.insertBefore(no_result_element, search_parent.children[0]);
        else 
           this._no_result_element = search_parent.appendChild(no_result_element);

        search_bar.button.addEventListener('click', () => {
            this.reload();
        });

        search_bar.input.addEventListener('input', () => {
            this.reload();
        });
    }

    get search_bar()
    {
        return this._search_bar;
    }

    get search_parent()
    {
        return this._search_parent;
    }

    get no_result_element()
    {
        return this._no_result_element;
    }

    reload()
    {
        let value = this._search_bar.value;

        if (value === "")
        {
            this._no_result_element.innerText = "";

            for (let element of this._search_parent.children)
            {
                element.classList.remove("hidden");
            }

            return;
        } 

        let found = false;

        for (let element of this._search_parent.children)
        {
            if (element === this._no_result_element) continue;

            let matching = false;

            for (let keyword of value.split(" "))
            {
                if (keyword === "") continue;

                if (this.contains_keyword(element, keyword))
                {
                    matching = true;
                    found = true;
                    break;
                }
            }

            if (matching)
            {
                element.classList.remove("hidden");
            } else {
                element.classList.add("hidden");
            }
        }

        if (found) 
            this._no_result_element.innerText = "";
        else 
            this._no_result_element.innerText = "Aucun résultat correspondant";
    }

    contains_keyword(element, keyword)
    {
        if (element.innerText.toLowerCase().includes(keyword.toLowerCase())) return true;

        for (let child of element.children)
        {
            if (this.contains_keyword(child, keyword)) return true;
        }

        return false;
    }
}