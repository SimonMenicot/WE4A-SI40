import { Widget } from "./Widget.js";

export class ConfirmWidget extends Widget {
    constructor(prompt, description)
    {
        let ok_button = document.createElement("button");
        ok_button.classList.add("main-button");
        ok_button.textContent = "OK";

        let cancel_button = document.createElement("button");
        cancel_button.classList.add("main-button");
        cancel_button.textContent = "Annuler";

        super(prompt, [cancel_button, ok_button]);

        this._ok_button = ok_button;
        this._cancel_button = cancel_button;

        this.content_element.appendChild(document.createElement("p")).textContent = description;
    }

    async main()
    {
        try {
            return await new Promise((resolve, reject) => {
                this._ok_button.addEventListener("click", () => {
                    resolve(true);
                });
    
                this._cancel_button.addEventListener("click", () => {
                    resolve(false);
                });
            });
        } finally {
            this.close();
        }
    }

}
