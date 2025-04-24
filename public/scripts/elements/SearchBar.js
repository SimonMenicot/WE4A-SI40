export class SearchBar
{
    constructor(element)
    {
        this._input = element.querySelector("input");
        this._button = element.querySelector("button");
    }

    get input()
    {
        return this._input;
    }

    get button()
    {
        return this._button;
    }

    get value()
    {
        return this._input.value;
    }

    set value(value)
    {
        this._input.value = value;
    }
}