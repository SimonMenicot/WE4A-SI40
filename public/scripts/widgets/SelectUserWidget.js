import { SearchBar } from "../elements/SearchBar.js";
import { SearchList } from "../elements/SearchList.js";
import { Widget } from "./Widget.js";

export class SelectUserWidget extends Widget
{
    constructor(criteria, multiple=false, default_users=[])
    {
        let ok_button = document.createElement("button");
        ok_button.classList.add("main-button");
        ok_button.textContent = "OK";

        let cancel_button = document.createElement("button");
        cancel_button.classList.add("main-button");
        cancel_button.textContent = "Annuler";

        if (multiple)
            super("Sélectionner un compte", [
                cancel_button, ok_button
            ]);
        else 
            super("Sélectionner un compte", [
                cancel_button
            ]);

        this._criteria = criteria;
        this._multiple = multiple;

        if (multiple) this._selected_users = default_users;

        this._ok_button = ok_button;
        this._cancel_button = cancel_button;

        this.content_element.innerHTML = `
<div class="search-bar" id="users-search-bar">
    <input type="text" placeholder="Rechercher..."/>
    <button class="icon-button main-button">
        <img src="/images/icons/search.png"/>
    </button>
</div>
<div class="users-list" id="users">
</div>
`;
        this._users_search_bar = new SearchBar(this.content_element.querySelector("#users-search-bar"));
        this._users_list_div = this.content_element.querySelector("#users");

        this._search_list = new SearchList(this._users_search_bar, this._users_list_div);

        let search_timeout = null;

        this._users_search_bar.input.addEventListener("input", () => {
            if (search_timeout !== null) clearTimeout(search_timeout);

            search_timeout = setTimeout(() => {
                this.refresh();
            }, 1000)
        });
    }

    async refresh()
    {
        let users_data = await fetch("/users/list?max-count=50&contains=" + encodeURIComponent(this._users_search_bar.value));
        let users = await users_data.json();

        let nre = this._search_list.no_result_element;
        this._users_list_div.innerHTML = "";
        this._users_list_div.appendChild(nre);

        for (let user of users)
        {
/*            let user_link = this._users_list_div.appendChild(document.createElement("a"));
            user_link.classList.add("user-preview-link");
            user_link.href = "/profile/" + user.id;
            user_link.target = "_blank";*/

            let local_user = user; // user is in a "global" and would contain the last user on callbacks
            
            let user_div = this._users_list_div.appendChild(document.createElement("div"));
            user_div.classList.add("user-preview");

            if (this._multiple)
            {
                if (this._selected_users.includes(local_user.id))
                {
                    user_div.classList.add('selected');
                }

                user_div.addEventListener('click', () => {
                    let index = this._selected_users.indexOf(local_user.id);

                    if (index === -1)
                    {
                        this._selected_users.push(local_user.id);
                        user_div.classList.add('selected');
                    } else {
                        this._selected_users.splice(index, 1);
                        user_div.classList.remove('selected');
                    }
                })
            } else {
                user_div.addEventListener('click', () => {
                    // resolve
                })
            }

            if (!this._criteria(user)) user_div.classList.add("disabled");

            user_div.appendChild(document.createElement("img")).src = "data:image/png;base64," + user.image;

            let user_description_div = user_div.appendChild(document.createElement("div"));
            user_description_div.classList.add("user-description");

            let title = user.surname + " " + user.name + "<span class='user-roles'> - ";
            for (let role of user.roles)
            {
                switch (role)
                {
                    case "ROLE_ADMIN":
                    title += "Administrateur ";
                    break;

                    case "ROLE_TEACHER":
                    title += "Enseignant ";
                    break;

                    case "ROLE_STUDENT":
                    title += "Élève ";
                    break;
                }
            }

            user_description_div.appendChild(document.createElement("h1")).innerHTML = title + " </span>";
            user_description_div.appendChild(document.createElement("p")).innerText = user.description;

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
                        resolve(this._selected_users); // ok can be clicked only when multiple is true
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

