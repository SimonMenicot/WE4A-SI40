/*

    Ce script est un script affiché sur toutes les pages.

*/

// script permettant de gérer la checkbox administrateur.
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
            document.cookie = "admin_enabled=true;path=/;";
        } else {
            document.cookie = "admin_enabled=false;path=/;";
        }

        setTimeout(() => {
            location.reload();
        }, 200);
    }

}

// chargement des scripts. 
window.addEventListener("load", () => {
    let admin_checkbox_element = document.getElementById("admin-checkbox");

    if (admin_checkbox_element != null) {
        let admin_checkbox = new AdminCheckbox(admin_checkbox_element);
    }

});

