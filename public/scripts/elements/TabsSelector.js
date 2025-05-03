/*

    Le TabsSelector permet de lier des onglets à leur panneaux. 
    
    Pour créer un élément compatible avec le TabsSelector, il suffit de créer un div qui contienne de sous-éléments:
    - un élément div de classe "tabs-button" qui contient les boutons
    - un élément div de classe "tabs-content" qui contient les panneaux

    On n'a pas besoin de préciser quel bouton lier avec quel panneaux, car cela se fait dans l'ordre dans lequel sont placés les éléments. 

    Par exemple : 
    <div>
        <div class="tabs-buttons">
            <button>Bouton1</button
            <button>Bouton2</button
        </div>
        <div class="tabs-content">
            <text> Contenu 1 </text>
            <div>
                <h1> Panneau </h1>
                <p>Ceci est le panneau 2</p>
            </div>
        </div>
    </div>

    Le bouton1 affichera automatiquement texte "Contenu 1", et le bouton2 affichera le texte "Ceci est le panneau 2". 

    Pour effectuer cela, le TabsSelector ajoute simplement la classe "hidden" aux enfants qui devraient être cachés et la retire de l'élément à montrer.

    Pour le style, voir public/styles/elements/tabs.css.

*/
export class TabsSelector
{
    constructor(element) 
    {
        this._element = element;

        // on récupère les deux divisions
        this._tabs_buttons = this._element.querySelector("div.tabs-buttons");
        this._tabs_content = this._element.querySelector("div.tabs-content");

        // cette variable contient l'élément sélectionné
        this._selected_element = 0;
        this.update();

        let i = 0;
        for (let child of this._tabs_buttons.children)
        {
            let local_i = i;

            child.addEventListener("click", () => {
                this.selected_element = local_i;
            });

            ++i;
        }

    }

    // renvoie l'index l'élément sélectionné
    get selected_element()
    {
        return this._selected_element;
    }

    // sélectionne un élément
    set selected_element(n)
    {
        this._selected_element = n;
        this.update();
    }

    // permet de rafraichir et d'afficher la bonne division
    update()
    {
        let i;

        // sélectionner le bon bouton
        i = 0;
        for (let child of this._tabs_buttons.children)
        {
            if (i === this._selected_element)
            {
                child.classList.add("selected");
            } else {
                child.classList.remove("selected");
            }

            ++i;
        }

        // afficher la bonne division
        i = 0;
        for (let child of this._tabs_content.children)
        {
            if (i === this._selected_element)
            {
                child.classList.remove("hidden");
            } else {
                child.classList.add("hidden");
            }

            ++i;
        }

    }

}

