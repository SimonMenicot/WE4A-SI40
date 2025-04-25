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

