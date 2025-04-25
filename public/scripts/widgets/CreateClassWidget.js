import { Widget } from "./Widget.js";

export class CreateClassWidget extends Widget
{
    constructor()
    {
        let ok_button = document.createElement("button");
        ok_button.classList.add("main-button");
        ok_button.textContent = "OK";

        let cancel_button = document.createElement("button");
        cancel_button.classList.add("main-button");
        cancel_button.textContent = "Annuler";

        super("Créer un nouveau cours...", [
            cancel_button, ok_button
        ]);

        this._ok_button = ok_button;
        this._cancel_button = cancel_button;

        this.content_element.innerHTML = `
<div class="form">
    <label> Nom du cours </label>
    <input type="text" id="class-name"/>
    <label> Description brève du cours </label>
    <input type="text" id="class-description"/>
</div>
`;
        this._name_input = this.content_element.querySelector("#class-name");
        this._description_input = this.content_element.querySelector("#class-description");

        this._name_input.addEventListener("input", () => {
            this.onFieldsChange();
        });

        this._description_input.addEventListener("input", () => {
            this.onFieldsChange();
        });

    }

    async main()
    {
        this.onFieldsChange();

        try {
            return await new Promise((resolve, reject) => {
                this._ok_button.addEventListener("click", async () => {
                    try {
                        let class_id = await this.createClass(this._name_input.value, this._description_input.value);
                        resolve(class_id);
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

    onFieldsChange()
    {
        if (this._name_input.value === "" 
         || this._description_input.value === ""
        ) {
            this._ok_button.setAttribute('disabled', '');
        } else {
            this._ok_button.removeAttribute('disabled');
        }
    }

    async createClass(name, description)
    {
        this._ok_button.setAttribute('disabled', '');
        this._cancel_button.setAttribute('disabled', '');

        let data = await fetch("/classes/new", {
            method: "POST",
            body: JSON.stringify({
                name: name,
                description: description
            })
        });

        if (data.status === 202) {
            let json_data = await data.json();
            return json_data['class-id'];
        } else {
            throw new Error(data.status);
        }

    }

}

