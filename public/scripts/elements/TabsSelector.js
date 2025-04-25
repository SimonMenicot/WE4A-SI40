export class TabsSelector
{
    constructor(element) // element must be a div.tabs-container
    {
        this._element = element;

        this._tabs_buttons = this._element.querySelector("div.tabs-buttons");
        this._tabs_content = this._element.querySelector("div.tabs-content");

        this._selected_element = 0;
        this.update();

        let i = 0;
        for (let child of this._tabs_buttons.children)
        {
            let local_i = i;

            child.addEventListener("click", () => {
                this.selected_element = local_i;
            });

            ++i;
        }

    }

    get selected_element()
    {
        return this._selected_element;
    }

    set selected_element(n)
    {
        this._selected_element = n;
        this.update();
    }

    update()
    {
        let i;

        i = 0;
        for (let child of this._tabs_buttons.children)
        {
            if (i === this._selected_element)
            {
                child.classList.add("selected");
            } else {
                child.classList.remove("selected");
            }

            ++i;
        }

        i = 0;
        for (let child of this._tabs_content.children)
        {
            if (i === this._selected_element)
            {
                child.classList.remove("hidden");
            } else {
                child.classList.add("hidden");
            }

            ++i;
        }

    }

}

