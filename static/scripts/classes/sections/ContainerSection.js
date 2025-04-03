import { Section } from "./Section.js";

export class ContainerSection extends Section
{
    constructor(data)
    {
        super("container", data);

        for (let child of this.children)
        {
            child.addEventListener("modified", (event) => {
                this.notifyEvents("modified", {
                    reason: 'child-modification',
                    child: child,
                    event: event
                })
            });
        }
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

        this.notifyEvents("modified", {
            reason: 'inner-modification',
            modification: 'direction',
            horizontal: enabled
        });
    }

    set is_wrapping(enabled)
    {
        let data = this.data;
        data.is_wrapping = enabled;
        this.data = data;

        this.notifyEvents("modified", {
            reason: 'inner-modification',
            modification: 'wrapping',
            wraps: enabled
        });
    }

    addChild(child)
    {
        this.data.children.push(child);

        this.notifyEvents("modified", {
            reason: 'children-addition',
            new_child: child
        });
    }

    removeChild(index)
    {
        let child = this.data.children.splice(index, 1)[0];

        this.notifyEvents("modified", {
            reason: 'children-removal',
            child_index: index,
            child: child
        });
    }

    moveChildToPrevious(index)
    {
        let child = this.children[index-1];

        this.children[index - 1] = this.children[index];
        this.children[index] = child;

        this.notifyEvents("modified", {
            reason: 'children-move',
            child_index: index,
            child: child
        });
    }

    moveChildToNext(index)
    {
        let child = this.children[index];

        this.children[index] = this.children[index + 1];
        this.children[index + 1] = child;

        this.notifyEvents("modified", {
            reason: 'children-move',
            child_index: index,
            child: child
        });
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
        direction_button.addEventListener("click", () => {
            this.is_horizontal = !this.is_horizontal;
        });

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
        wrap_button.addEventListener("click", () => {
            this.is_wrapping = !this.is_wrapping;
        });

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
            let local_child_index = child_index; // Remember the child index for further operation

            let innerdiv = editable_div.appendChild(document.createElement("div"));
            innerdiv.classList.add("edit-content-section");

            let element_edit_buttons_actions = innerdiv.appendChild(document.createElement("div"));
            element_edit_buttons_actions.classList.add("edit-content-buttons-actions");

            let remove_button = element_edit_buttons_actions.appendChild(document.createElement("button"));
            remove_button.classList.add("edit-content-action", "edit-content-remove-line", "icon-button");
            remove_button.addEventListener("click", () => {
                this.removeChild(local_child_index);
            })
    
            let remove_button_image = remove_button.appendChild(document.createElement("img"));
            remove_button_image.src = NOOBLE_CONFIG["PATH_NAME"] + "/static/images/icons/close.png";
        
            let move_previous_button = element_edit_buttons_actions.appendChild(document.createElement("button"));
            move_previous_button.classList.add("edit-content-action", "edit-content-remove-line", "icon-button");
            move_previous_button.addEventListener("click", () => {
                this.moveChildToPrevious(local_child_index);
            })
    
            let move_previous_button_image = move_previous_button.appendChild(document.createElement("img"));

            if (this.is_horizontal)
                move_previous_button_image.src = NOOBLE_CONFIG["PATH_NAME"] + "/static/images/icons/left.png";
            else
                move_previous_button_image.src = NOOBLE_CONFIG["PATH_NAME"] + "/static/images/icons/up.png";
        
            let move_next_button = element_edit_buttons_actions.appendChild(document.createElement("button"));
            move_next_button.classList.add("edit-content-action", "edit-content-remove-line", "icon-button");
            move_next_button.addEventListener("click", () => {
                this.moveChildToNext(local_child_index);
            })
    
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
            children: this.children.map((child) => child.json_data)
        };
    }


}


