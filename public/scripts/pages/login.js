export default class LoginDiv
{
    constructor(
        mail_input,
        password_input,
        submit_button,
        error_text
    )
    {
        this._mail_input = mail_input;
        this._password_input = password_input;
        this._submit_button = submit_button;
        this._error_text = error_text;

        this._mail_input.addEventListener("input", () => {
            this.onInput()
        });

        this._password_input.addEventListener("input", () => {
            this.onInput()
        });

        this._submit_button.addEventListener("click", () => {
            this.onSubmit();
        });

        this.onInput()
    }

    onInput()
    {
        if (this.isValid())
        {
            this._submit_button.removeAttribute("disabled");
        } else {
            this._submit_button.setAttribute("disabled", "");
        }

        this._error_text.innerText = "";
    }

    isValid()
    {
        return this._mail_input.value.toLowerCase()
            .match(
            /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|.(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
            ) 
        && this._password_input.value.length > 0;
    }

    async onSubmit()
    {
        let mail = this._mail_input.value;
        let password = this._password_input.value;

        let data = await fetch(
            "/authenticate",
            {
                method: "POST",
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    username: mail,
                    password
                })
            }
        );

        let result = await data.json();

        if (result.status_code == 200) 
        {
            location.href = "/";
        } else {
            this._error_text.innerText = "Erreur lors de la connexion (" + result.error + ")";
            this._submit_button.setAttribute("disabled", "");
        }
    }
}


