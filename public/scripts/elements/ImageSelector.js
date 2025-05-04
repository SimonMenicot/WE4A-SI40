import { FileSelector } from "./FileSelector.js";

export class ImageSelector extends FileSelector
{
    /*

        Choisir une image et s'assurer qu'elle n'est pas modifiée

    */
    constructor(button, image, on_change, dimx, dimy)
    {
        super(button, (files) => {
            this.onFileSelected(files)
        }, "image/*");

        this._on_change = on_change;
        this._dimx = dimx;
        this._dimy = dimy;

        this.setImage(image);
    }

    get base64_png_data()
    {
        return this._base64_data;
    }

    onFileSelected(files)
    {
        let reader = new FileReader();

        reader.addEventListener("loadend", () => {
            this.setImage(reader.result);
        })

        reader.readAsDataURL(files[0]);
    }

    setImage(image_base64)
    {
        let canvas = document.createElement("canvas");
        canvas.width = this._dimx;
        canvas.height = this._dimy
        const ctx = canvas.getContext("2d");

        var image = new Image();

        image.addEventListener("load", () => {
            let imgwidth = image.width;
            let imgheight = image.height;

            let cnvwidth = canvas.width;
            let cnvheight = canvas.height;

            let kept_height;
            let kept_width;
            let img_startx;
            let img_starty;

            if (imgwidth/imgheight > cnvwidth/cnvheight)
            {
                // image est trop longue, il faut garder la hauteur et couper la largeur
                kept_width = imgheight * cnvwidth / cnvheight;
                kept_height = imgheight;
                img_startx = (imgwidth - kept_width) / 2;
                img_starty = 0;
            } else {
                // image est trop longue, il faut garder la largeur et couper la hauteur
                kept_width = imgwidth;
                kept_height = imgwidth * cnvheight / cnvwidth;
                img_startx = 0;
                img_starty = (imgheight - kept_height) / 2;
            }

            ctx.drawImage(image, img_startx, img_starty, kept_width, kept_height, 0, 0, canvas.width, canvas.height);

            this._base64_data = canvas.toDataURL().substring("data:image/png;base64,".length);

            this._on_change(this._base64_data);
        });

        image.src = image_base64;

    }


}