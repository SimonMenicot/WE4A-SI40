import { Widget } from "./Widget.js";
import { AlertWidget } from "./AlertWidget.js";

export class CreateUserWidget extends Widget
{
    constructor()
    {
        let ok_button = document.createElement("button");
        ok_button.classList.add("main-button");
        ok_button.textContent = "OK";

        let cancel_button = document.createElement("button");
        cancel_button.classList.add("main-button");
        cancel_button.textContent = "Annuler";

        super("Ajouter un utilisateur...", [
            cancel_button, ok_button
        ]);

        this._ok_button = ok_button;
        this._cancel_button = cancel_button;

        this.content_element.innerHTML = `
<div class="form">
    <label> Prénom </label>
    <input type="text" id="user-surname"/>
    <label> Nom </label>
    <input type="text" id="user-name"/>
    <label> Adresse mail </label>
    <input type="text" id="user-mail-address"/>
</div>
`;
        this._name_input = this.content_element.querySelector("#user-name");
        this._surname_input = this.content_element.querySelector("#user-surname");
        this._mail_input = this.content_element.querySelector("#user-mail-address");

        this._name_input.addEventListener("input", () => {
            this.onFieldsChange();
        });

        this._surname_input.addEventListener("input", () => {
            this.onFieldsChange();
        });

        this._mail_input.addEventListener("input", () => {
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
                        let user_id = await this.createUser(this._name_input.value, this._surname_input.value, this._mail_input.value);
                        resolve(user_id);
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
         || this._surname_input.value === ""
         || !this._mail_input.value.match(
            /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|.(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
            )
        ) {
            this._ok_button.setAttribute('disabled', '');
        } else {
            this._ok_button.removeAttribute('disabled');
        }
    }

    async createUser(name, surname, mail)
    {
        this._ok_button.setAttribute('disabled', '');
        this._cancel_button.setAttribute('disabled', '');

        let data = await fetch("/user/new", {
            method: "POST",
            body: JSON.stringify({
                name: name,
                surname: surname,
                mail: mail
            })
        });

        if (data.status === 202) {
            let json_data = await data.json();

            let alert = new AlertWidget("Utilisateur créé", "Mot de passe : " + json_data.password);
            await alert.main();
            
            return json_data['user-id'];
        } else {
            throw new Error(data.status);
        }

    }

}

