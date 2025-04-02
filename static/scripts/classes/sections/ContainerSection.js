import { Section } from "./Section.js";

export class ContainerSection extends Section
{
    constructor(data)
    {
        super("container", data);
    }

    get is_horizontal()
    {
        return this.data.is_horizontal;
    }

    get is_wrapping()
    {
        return this.data.is_wrapping;
    }

    get children()
    {
        return this.data.children;
    }

    set is_horizontal(enabled)
    {
        let data = this.data;
        data.is_horizontal = enabled;
        this.data = data;
    }

    set is_wrapping(enabled)
    {
        let data = this.data;
        data.is_wrapping = enabled;
        this.data = data;
    }

    addChild(child)
    {
        this._children.push(child);
    }

    removeChild(index)
    {
        this._children.splice(index, 1);
    }

    render()
    {
        let div = document.createElement("div");

        if (this.is_horizontal)
        {
            div.classList.add("horizontal-section-container");
        }

        if (this.is_wrapping)
        {
            div.classList.add("wrapping-section-container");
        }

        for (let child of this.children)
        {
            div.appendChild(child.htmlElement);
        }

        return div;
    }

    renderEditable()
    {
        let div = document.createElement("div");

        if (this.is_horizontal)
        {
            div.classList.add("horizontal-section-container");
        }

        if (this.is_wrapping)
        {
            div.classList.add("wrapping-section-container");
        }
    
        let start_edit_buttons_actions = div.appendChild(document.createElement("div"));
        start_edit_buttons_actions.classList.add("edit-container-buttons-actions");

        let direction_button = start_edit_buttons_actions.appendChild(document.createElement("button"));
        direction_button.classList.add("edit-content-action", "icon-button");

        let direction_button_image = direction_button.appendChild(document.createElement("img"));

        if (this.is_horizontal)
        {
            direction_button.classList.add("edit-content-vertical");
            direction_button_image.src = NOOBLE_CONFIG["PATH_NAME"] + "/static/images/icons/vertical.png";
        } else {
            direction_button.classList.add("edit-content-horizontal");
            direction_button_image.src = NOOBLE_CONFIG["PATH_NAME"] + "/static/images/icons/horizontal.png";
        }

        let wrap_button = start_edit_buttons_actions.appendChild(document.createElement("button"));
        wrap_button.classList.add("edit-content-action", "icon-button");

        let wrap_button_image = wrap_button.appendChild(document.createElement("img"));

        if (this.is_wrapping)
        {
            wrap_button.classList.add("edit-content-nowrap");
            wrap_button_image.src = NOOBLE_CONFIG["PATH_NAME"] + "/static/images/icons/nowrap.png";
        } else {
            wrap_button.classList.add("edit-content-wrap");
            wrap_button_image.src = NOOBLE_CONFIG["PATH_NAME"] + "/static/images/icons/wrap.png";
        }

        let editable_div = div.appendChild(document.createElement("div"));
        editable_div.classList.add("container-editable-content");

        let child_index = 0;
        
        for (let child of this.children)
        {
            let innerdiv = editable_div.appendChild(document.createElement("div"));
            innerdiv.classList.add("edit-content-section");

            let element_edit_buttons_actions = innerdiv.appendChild(document.createElement("div"));
            element_edit_buttons_actions.classList.add("edit-content-buttons-actions");

            let remove_button = element_edit_buttons_actions.appendChild(document.createElement("button"));
            remove_button.classList.add("edit-content-action", "edit-content-remove-line", "icon-button");
    
            let remove_button_image = remove_button.appendChild(document.createElement("img"));
            remove_button_image.src = NOOBLE_CONFIG["PATH_NAME"] + "/static/images/icons/close.png";
        
            let move_previous_button = element_edit_buttons_actions.appendChild(document.createElement("button"));
            move_previous_button.classList.add("edit-content-action", "edit-content-remove-line", "icon-button");
    
            let move_previous_button_image = move_previous_button.appendChild(document.createElement("img"));

            if (this.is_horizontal)
                move_previous_button_image.src = NOOBLE_CONFIG["PATH_NAME"] + "/static/images/icons/left.png";
            else
                move_previous_button_image.src = NOOBLE_CONFIG["PATH_NAME"] + "/static/images/icons/up.png";
        
            let move_next_button = element_edit_buttons_actions.appendChild(document.createElement("button"));
            move_next_button.classList.add("edit-content-action", "edit-content-remove-line", "icon-button");
    
            let move_next_button_image = move_next_button.appendChild(document.createElement("img"));

            if (this.is_horizontal)
                move_next_button_image.src = NOOBLE_CONFIG["PATH_NAME"] + "/static/images/icons/right.png";
            else
                move_next_button_image.src = NOOBLE_CONFIG["PATH_NAME"] + "/static/images/icons/down.png";

            if (child_index === 0)
            {
                move_previous_button.classList.add("disabled-button");
            } 

            if (child_index === this.children.length -1)
            {
                move_next_button.classList.add("disabled-button");
            }
        
            innerdiv.appendChild(child.editableHtmlElement);

            ++child_index;
        }

        let end_edit_buttons_actions = div.appendChild(document.createElement("div"));
        end_edit_buttons_actions.classList.add("edit-container-buttons-actions");

        let add_button = end_edit_buttons_actions.appendChild(document.createElement("button"));
        add_button.classList.add("edit-content-action", "edit-content-remove-line", "icon-button");

        let add_button_image = add_button.appendChild(document.createElement("img"));
        add_button_image.src = NOOBLE_CONFIG["PATH_NAME"] + "/static/images/icons/add.png";
    
        return div;
    }

    exportToJsonData()
    {
        return {
            is_horizontal: this.is_horizontal,
            is_wrapping: this.is_wrapping,
            children: this.children.map((child) => child.exportToJsonData())
        };
    }


}


