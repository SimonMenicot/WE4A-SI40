class AdminCheckbox
{
    constructor(checkbox)
    {
        this._checkbox = checkbox;
        this._callback_functions = {
            click: []
        };

        checkbox.addEventListener('click', () => {
            this.onCheckboxChanged();
        });
    }

    onCheckboxChanged()
    {
        if (this._checkbox.checked)
        {
            document.cookie = "admin_enabled=true";
        } else {
            document.cookie = "admin_enabled=false";
        }

        setTimeout(() => {
            location.reload();
        }, 200);
    }

}

window.addEventListener("load", () => {
    let admin_checkbox = new AdminCheckbox(document.getElementById("admin-checkbox"));
});

