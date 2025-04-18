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

        this._submit_button.setAttribute("disabled", "");

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

        switch (data.status )
        {
            case 200:
            location.href = "/";
            break;
        
            case 401:
            this._error_text.innerText = "Nom d'utilisateur ou mot de passe incorrect";
            break;
        
            default:
            this._error_text.innerText = "An unkown error occured. Please contact your administrator";
            break;
        }
    }
}


