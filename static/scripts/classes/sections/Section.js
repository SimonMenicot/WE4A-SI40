export class Section
{
    constructor(type, data)
    {
        this._type = type;
        this._data = data;

        this._events = {
            modified: []
        }
    }

    addEventListener(name, func)
    {
        this._events[name].push(func);
    }

    get type()
    {
        return this._type;
    }

    get data()
    {
        return this._data;
    }

    set data(value)
    {
        this._data = value;
    }

    notifyEvents(name, ...args)
    {
        let event = new CustomEvent(name, {
            ...args
        });

        for (let func of this._events[name])
        {
            (async () => func(event))();
        }
    }

    render() // this function must return the raw generated element
    {
        return document.createComment("empty section");
    }

    renderEditable() // this function must return the raw editable element
    {
        return this.render();
    }

    get htmlElement()
    {
        let element = this.render();
        element.classList.add("section", "section-" + this._type);
        return element;
    }

    get editableHtmlElement()
    {
        let element = this.renderEditable();
        element.classList.add("section", "section-" + this._type, "section-editable");
        return element;
    }

    exportToJsonData() // this function exports the content of the section to saveable data
    {
        return null;
    }

    get json_data()
    {
        return {
            "type": this._type,
            "data": this.exportToJsonData()
        };
    }
}


