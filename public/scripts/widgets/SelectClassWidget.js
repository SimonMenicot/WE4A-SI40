import { SearchBar } from "../elements/SearchBar.js";
import { SearchList } from "../elements/SearchList.js";
import { Widget } from "./Widget.js";

export class SelectClassWidget extends Widget
{
    constructor(criteria, multiple=false, default_classes=[])
    {
        let ok_button = document.createElement("button");
        ok_button.classList.add("main-button");
        ok_button.textContent = "OK";

        let cancel_button = document.createElement("button");
        cancel_button.classList.add("main-button");
        cancel_button.textContent = "Annuler";

        if (multiple)
            super("Sélectionner des cours", [
                cancel_button, ok_button
            ]);
        else 
            super("Sélectionner un cours", [
                cancel_button
            ]);

        this._criteria = criteria;
        this._multiple = multiple;

        if (multiple) this._selected_classes = default_classes;

        this._ok_button = ok_button;
        this._cancel_button = cancel_button;

        this.content_element.innerHTML = `
<div class="search-bar" id="classes-search-bar">
    <input type="text" placeholder="Rechercher..."/>
    <button class="icon-button main-button">
        <img src="/images/icons/search.png"/>
    </button>
</div>
<div class="classes-list selecting" id="classes">
</div>
`;
        this._classes_search_bar = new SearchBar(this.content_element.querySelector("#classes-search-bar"));
        this._classes_list_div = this.content_element.querySelector("#classes");

        this._search_list = new SearchList(this._classes_search_bar, this._classes_list_div);

        let search_timeout = null;

        this._classes_search_bar.input.addEventListener("input", () => {
            if (search_timeout !== null) clearTimeout(search_timeout);

            search_timeout = setTimeout(() => {
                this.refresh();
            }, 1000)
        });
    }

    async refresh()
    {
        let classes_data = await fetch("/classes/list?max-count=50&contains=" + encodeURIComponent(this._classes_search_bar.value));
        let classes = await classes_data.json();

        let nre = this._search_list.no_result_element;
        this._classes_list_div.innerHTML = "";
        this._classes_list_div.appendChild(nre);

        for (let classe of classes)
        {
/*            let class_link = this._classes_list_div.appendChild(document.createElement("a"));
            class_link.classList.add("class-preview-link");
            class_link.href = "/profile/" + class.id;
            class_link.target = "_blank";*/

            let local_class = classe; // classe is in a "global" and would contain the last class on callbacks
            
            let class_div = this._classes_list_div.appendChild(document.createElement("div"));
            class_div.classList.add("class-preview");

            if (this._multiple)
            {
                if (this._selected_classes.includes(local_class.id))
                {
                    class_div.classList.add('selected');
                }

                class_div.addEventListener('click', () => {
                    let index = this._selected_classes.indexOf(local_class.id);

                    if (index === -1)
                    {
                        this._selected_classes.push(local_class.id);
                        class_div.classList.add('selected');
                    } else {
                        this._selected_classes.splice(index, 1);
                        class_div.classList.remove('selected');
                    }
                })
            } else {
                class_div.addEventListener('click', () => {
                    // resolve
                })
            }

            if (!this._criteria(classe)) class_div.classList.add("disabled");

            class_div.style["background-image"] = "url('data:image/png;base64," + classe.thumbnail + "')";

            class_div.appendChild(document.createElement("h1")).innerHTML = classe.name;
            class_div.appendChild(document.createElement("p")).innerText = classe.description;

        }

        this._search_list.reload();

    }

    async main()
    {
        await this.refresh();

        try {
            return await new Promise((resolve, reject) => {
                this._ok_button.addEventListener("click", async () => {
                    try {
                        resolve(this._selected_classes); // ok can be clicked only when multiple is true
                    } catch (e) {
                        this._ok_button.removeAttribute('disabled');
                        this._cancel_button.removeAttribute('disabled');

                        console.error(e);
                    }
                });
                
                this._cancel_button.addEventListener("click", async () => {
                    reject();
                });
            });
        } catch(exc) {
            return null;
        } finally {
            this.close();
        }
    }

}

