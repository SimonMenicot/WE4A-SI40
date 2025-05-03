import { Widget } from "./Widget.js";

/*

    Analogue à la fonction "alert" définie dans les navigateurs. 

*/
export class AlertWidget extends Widget {
    constructor(title, description)
    {
        let ok_button = document.createElement("button");
        ok_button.classList.add("main-button");
        ok_button.textContent = "OK";

        super(title, [ok_button]);

        this._ok_button = ok_button;

        this.content_element.appendChild(document.createElement("p")).textContent = description;
    }

    async main()
    {
        return await new Promise((resolve, reject) => {
            this._ok_button.addEventListener("click", () => {
                this.close();
                resolve();
            });
        });
    }

}
