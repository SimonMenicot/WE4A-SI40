/*

    Un widget est un élément en plein écran permettant d'afficher une fenêtre de dialogue. 

    Au démarrage, il rajoute un élément qui s'affichera sur toute la fenêtre ; pour se fermer, il retire simplement son élément du corps du document. 

*/
export class Widget
{
    constructor(title, buttons)
    {
        let { div, widget_content, widget_buttons} = createWidget(title, buttons);

        this._div = div;
        this._widget_content = widget_content;
        this._widget_buttons = widget_buttons;

        this._buttons = buttons;
    }

    get content_element()
    {
        return this._widget_content;
    }

    get buttons()
    {
        return this._buttons;
    }

    close()
    {
        document.body.removeChild(this._div);
    }
}

/*

    Créer un widget : 
    <div class="fullscreen-prompt">
        <div class="fullscreen-wiget">
            <div class="widget-title">
                <h1>{ Le titre }</h1>
            </div>
            <div class="widget-content">
                { ... contenu ... }
            </div>
        </div>
    </div>

    Le "fullscreen-prompt" permet de griser l'arrière-plan, le "fullscreen-widget" permet d'afficher la fenêtre de dialogue
    au centre de la page et le "widget-content" est le contenu personnalisé en fonction du widget. 

    Les différents widgets sont les autres classes décrites dans ce dossier, qui héritent de Widget. 

*/
function createWidget(title, buttons)
{
    let div = document.createElement("div");
    div.classList.add("fullscreen-prompt");

    let widget = div.appendChild(document.createElement("div"));
    widget.classList.add("fullscreen-widget");

    let title_elem = widget.appendChild(document.createElement("div"));
    title_elem.classList.add("widget-title");
    title_elem.appendChild(document.createElement("h1")).innerText = title;

    let widget_content = widget.appendChild(document.createElement("div"));
    widget_content.classList.add('widget-content');

    let widget_buttons = widget.appendChild(document.createElement('div'));
    widget_buttons.classList.add('widget-buttons-list');

    for (let button of buttons)
    {
        widget_buttons.appendChild(button);
    }

    document.body.appendChild(div);

    return {
        div,
        widget_content,
        widget_buttons
    };
}

