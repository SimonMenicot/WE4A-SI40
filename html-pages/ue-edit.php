<?php
set_include_path("../");
require "header.php";
drawHeader("Welcome, Litzler");
?>
<div id="classpage-main-separation" class="content-separator">
    <div id="main-class-content" class="class-content">
        <div class="class-title-content">
            <a class="class-back-link" href=".">
                <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"] ?>/static/images/icons/back.png">
            </a>
            <h1>
                WE4A - Introduction au design WEB
            </h1>
        </div>

        <div id="main-class-section" class="section section-container section-editable">
            <div class="edit-container-buttons-actions">
                <button class="edit-content-action icon-button edit-content-horizontal">
                    <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/horizontal.png"/>
                </button>
                <button class="edit-content-action icon-button edit-content-wrap">
                    <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/wrap.png"/>
                </button>
            </div>
            <div class="container-editable-content">
                <div class="edit-content-section">
                    <div class="edit-content-buttons-actions">
                        <button class="edit-content-action icon-button edit-content-remove-line">
                            <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/close.png"/>
                        </button>
                        <button class="edit-content-action icon-button edit-content-move-previous disabled-button">
                            <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/up.png"/>
                        </button>
                        <button class="edit-content-action icon-button edit-content-move-next">
                            <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/down.png"/>
                        </button>
                    </div>
                    
                    <div class="section section-container section-editable">
                        <div class="edit-container-buttons-actions">
                            <button class="edit-content-action icon-button edit-content-horizontal">
                                <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/horizontal.png"/>
                            </button>
                            <button class="edit-content-action icon-button edit-content-wrap">
                                <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/wrap.png"/>
                            </button>
                        </div>
                        <div class="container-editable-content">
                            <div class="edit-content-section">
                                <div class="edit-content-buttons-actions">
                                    <button class="edit-content-action icon-button edit-content-remove-line">
                                        <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/close.png"/>
                                    </button>
                                    <button class="edit-content-action icon-button edit-content-move-previous disabled-button">
                                        <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/up.png"/>
                                    </button>
                                    <button class="edit-content-action icon-button edit-content-move-next">
                                        <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/down.png"/>
                                    </button>
                                </div>
                                
                                <div class="section section-raw-text section-editable" contenteditable="true">Ceci est un texte brute dans un container vertical</div>
                            </div>

                            <div class="edit-content-section">
                                <div class="edit-content-buttons-actions">
                                    <button class="edit-content-action icon-button edit-content-remove-line">
                                        <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/close.png"/>
                                    </button>
                                    <button class="edit-content-action icon-button edit-content-move-previous">
                                        <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/up.png"/>
                                    </button>
                                    <button class="edit-content-action icon-button edit-content-move-next">
                                        <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/down.png"/>
                                    </button>
                                </div>
                                
                                <div class="section section-raw-text section-editable" contenteditable="true">Qu'est-ce que le Lorem Ipsum ?
        Le Lorem Ipsum est simplement un faux texte utilisé dans l'industrie de l'impression et du traitement de texte. Depuis les années 1500, il est considéré comme le texte fictif standard, lorsque quelqu'un a pris une galère de caractères pour la mélanger et créer un livre d'exemple typographique. Il est parvenu à survivre non seulement cinq siècles, mais aussi l'entrée dans le traitement électronique du texte, sans être essentiellement modifié. Sa popularité a été renforcée dans les années 1960 avec la sortie des feuilles Letraset contenant des passages de Lorem Ipsum, et plus récemment grâce aux logiciels de publication assistée par ordinateur comme Aldus PageMaker qui incluent des versions de Lorem Ipsum.<br>
        Le morceau standard de Lorem Ipsum utilisé depuis les années 1500 est reproduit ci-dessous pour ceux que cela intéresse. Les sections 1.10.32 et 1.10.33 de "De Finibus Bonorum et Malorum" par Cicéron y sont également reproduites dans leur forme originale exacte, accompagnées des versions anglaises traduites en 1914 par H. Rackham.</div>
                            </div>

                            <div class="edit-content-section">
                                <div class="edit-content-buttons-actions">
                                    <button class="edit-content-action icon-button edit-content-remove-line">
                                        <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/close.png"/>
                                    </button>
                                    <button class="edit-content-action icon-button edit-content-move-previous">
                                        <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/up.png"/>
                                    </button>
                                    <button class="edit-content-action icon-button edit-content-move-next disabled-button">
                                        <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/down.png"/>
                                    </button>
                                </div>
                                
                                <div class="section section-rich-text section-editable">
                                    <div class="rich-text-section-edit-line">
                                        <button class="icon-button">
                                            <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/bold.png"/>
                                        </button>
                                        <button class="icon-button">
                                            <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/italic.png"/>
                                        </button>
                                        <button class="icon-button">
                                            <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/underlined.png"/>
                                        </button>
                                        <button class="icon-button">
                                            <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/preformat.png"/>
                                        </button>
                                        <button class="icon-button">
                                            <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/list.png"/>
                                        </button>
                                        <button class="icon-button">
                                            <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/enumeration.png"/>
                                        </button>
                                        <button class="icon-button">
                                            <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/link.png"/>
                                        </button>
                                    </div>
                                    <div class="rich-text-section-content" contenteditable="true">
                                        <h2>
                                            <em>Ceci est un texte riche</em>
                                        </h2>
                                        <p>
                                            <strong>Charles Stein</strong> est un statisticien américain né le 22 mars 1920 et mort le 24 novembre 2016, professeur émérite de statistiques à <a href="https://fr.wikipedia.org/wiki/Universit%C3%A9_Stanford" target="_blank"> Stanford</a>.
                                            Il est connu pour le <a href="https://fr.wikipedia.org/wiki/Paradoxe_de_Stein" target="_blank">paradoxe de Stein</a> en <a href="https://fr.wikipedia.org/wiki/Th%C3%A9orie_de_la_d%C3%A9cision" target="_blank">théorie de la décision</a> et pour la <a href="https://fr.wikipedia.org/wiki/M%C3%A9thode_de_Stein" target="_blank">méthode de Stein</a> qui permet de démontrer le <a href="https://fr.wikipedia.org/wiki/Th%C3%A9or%C3%A8me_central_limite" target="_blank"> central limite</a>.
                                        </p>
                                        <p>
                                            <strong>Auguste Van Assche</strong>, né le 5 juillet 1826 à <a href="https://fr.wikipedia.org/wiki/Gand" target="_blank">Gand</a> et mort le 24 février 1907, est un <a href="https://fr.wikipedia.org/wiki/Architecte" target="_blank">architecte</a> <a href="https://fr.wikipedia.org/wiki/Belgique" target="_blank">belge</a>, auteur de nombreuses restaurations et transformations de bâtiments médiévaux en Belgique.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="edit-container-buttons-actions">
                            <button class="edit-content-action icon-button edit-content-add">
                                <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/add.png"/>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="edit-content-section">
                    <div class="edit-content-buttons-actions">
                        <button class="edit-content-action icon-button edit-content-remove-line">
                            <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/close.png"/>
                        </button>
                        <button class="edit-content-action icon-button edit-content-move-previous">
                            <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/up.png"/>
                        </button>
                        <button class="edit-content-action icon-button edit-content-move-next">
                            <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/down.png"/>
                        </button>
                    </div>
                    
                    <div class="section section-raw-text section-editable" contenteditable="true">
                        Ce qui suit est un container horizontal avec wrap (miam miam)
                    </div>
                </div>

                <div class="edit-content-section">
                    <div class="edit-content-buttons-actions">
                        <button class="edit-content-action icon-button edit-content-remove-line">
                            <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/close.png"/>
                        </button>
                        <button class="edit-content-action icon-button edit-content-move-previous">
                            <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/up.png"/>
                        </button>
                        <button class="edit-content-action icon-button edit-content-move-next">
                            <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/down.png"/>
                        </button>
                    </div>
                    
                    <div class="section section-container horizontal-section-container wrapping-section-container section-editable">
                        <div class="edit-container-buttons-actions">
                            <button class="edit-content-action icon-button edit-content-vertical">
                                <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/vertical.png"/>
                            </button>
                            <button class="edit-content-action icon-button edit-content-nowrap">
                                <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/nowrap.png"/>
                            </button>
                        </div>
                        <div class="container-editable-content">
                            <div class="edit-content-section">
                                <div class="edit-content-buttons-actions">
                                    <button class="edit-content-action icon-button edit-content-remove-line">
                                        <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/close.png"/>
                                    </button>
                                    <button class="edit-content-action icon-button edit-content-move-previous disabled-button">
                                        <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/left.png"/>
                                    </button>
                                    <button class="edit-content-action icon-button edit-content-move-next">
                                        <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/right.png"/>
                                    </button>
                                </div>
                                
                                <div class="section section-file section-editable">
                                    <input type="text" class="file-description" value="TD1 : Validation/Remise à Niveau PHP/HTML/CSS"/>
                                    <button class="file-button">
                                        <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"] ?>/static/images/icons/upload.png">
                                        <span class="file-extension">TD1.zip</text>
                                    </button>
                                </div>
                            </div>

                            <div class="edit-content-section">
                                <div class="edit-content-buttons-actions">
                                    <button class="edit-content-action icon-button edit-content-remove-line">
                                        <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/close.png"/>
                                    </button>
                                    <button class="edit-content-action icon-button edit-content-move-previous">
                                        <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/left.png"/>
                                    </button>
                                    <button class="edit-content-action icon-button edit-content-move-next">
                                        <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/right.png"/>
                                    </button>
                                </div>
                                
                                <div class="section section-file section-editable">
                                    <input class="file-description" type="text" value="TD2 : PHP objet, Javascript"/>
                                    <button class="file-button">
                                        <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"] ?>/static/images/icons/upload.png">
                                        <span class="file-extension">TD2.zip</text>
                                    </button>
                                </div>
                            </div>

                            <div class="edit-content-section">
                                <div class="edit-content-buttons-actions">
                                    <button class="edit-content-action icon-button edit-content-remove-line">
                                        <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/close.png"/>
                                    </button>
                                    <button class="edit-content-action icon-button edit-content-move-previous">
                                        <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/left.png"/>
                                    </button>
                                    <button class="edit-content-action icon-button edit-content-move-next">
                                        <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/right.png"/>
                                    </button>
                                </div>
                                
                                <div class="section section-file section-editable">
                                    <input type="text" class="file-description" value="TD3 : version finale du site sans Symfony"/>
                                    <button class="file-button">
                                        <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"] ?>/static/images/icons/upload.png">
                                        <span class="file-extension">TD3.zip</text>
                                    </button>
                                </div>
                            </div>

                            <div class="edit-content-section">
                                <div class="edit-content-buttons-actions">
                                    <button class="edit-content-action icon-button edit-content-remove-line">
                                        <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/close.png"/>
                                    </button>
                                    <button class="edit-content-action icon-button edit-content-move-previous">
                                        <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/left.png"/>
                                    </button>
                                    <button class="edit-content-action icon-button edit-content-move-next disabled-button">
                                        <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/right.png"/>
                                    </button>
                                </div>
                                
                                <div class="section section-file section-editable">
                                    <input type="text" class="file-description" value="Le cahier des charges : Le but du projet est de créer une version simplifiée de Moodle, et le cahier des charges vous aidera à mieux situer ce que nous voulons dire par là. Vous devez utiliser Symfony pour pouvoir avoir une note supérieure à 15/20."/>
                                    <button class="file-button">
                                        <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"] ?>/static/images/icons/upload.png">
                                        <span class="file-extension">WE4A - Moodle Simplifié (devoir retiré).pdf</text>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="edit-container-buttons-actions">
                            <button class="edit-content-action icon-button edit-content-add">
                                <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/add.png"/>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="edit-content-section">
                    <div class="edit-content-buttons-actions">
                        <button class="edit-content-action icon-button edit-content-remove-line">
                            <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/close.png"/>
                        </button>
                        <button class="edit-content-action icon-button edit-content-move-previous">
                            <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/up.png"/>
                        </button>
                        <button class="edit-content-action icon-button edit-content-move-next">
                            <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/down.png"/>
                        </button>
                    </div>
                    
                    <div class="section section-container horizontal-section-container wrapping-section-container section-editable">
                        <div class="edit-container-buttons-actions">
                            <button class="edit-content-action icon-button edit-content-vertical">
                                <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/vertical.png"/>
                            </button>
                            <button class="edit-content-action icon-button edit-content-nowrap">
                                <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/nowrap.png"/>
                            </button>
                        </div>
                        <div class="container-editable-content">
                            <div class="edit-content-section">
                                <div class="edit-content-buttons-actions">
                                    <button class="edit-content-action icon-button edit-content-remove-line">
                                        <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/close.png"/>
                                    </button>
                                    <button class="edit-content-action icon-button edit-content-move-previous disabled-button">
                                        <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/left.png"/>
                                    </button>
                                    <button class="edit-content-action icon-button edit-content-move-next">
                                        <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/right.png"/>
                                    </button>
                                </div>
                                
                                <div class="section section-image section-editable">
                                    <img src="https://randomwordgenerator.com/img/picture-generator/55e2dc434c50a814f1dc8460962e33791c3ad6e04e50744074267bd19f4ac2_640.jpg"/>
                                    <button class="icon-button">
                                        <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/upload.png"/>
                                    </button>
                                </div>
                            </div>
                            <div class="edit-content-section">
                                <div class="edit-content-buttons-actions">
                                    <button class="edit-content-action icon-button edit-content-remove-line">
                                        <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/close.png"/>
                                    </button>
                                    <button class="edit-content-action icon-button edit-content-move-previous">
                                        <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/left.png"/>
                                    </button>
                                    <button class="edit-content-action icon-button edit-content-move-next disabled-button">
                                        <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/right.png"/>
                                    </button>
                                </div>
                                
                                <div class="section section-image section-editable">
                                    <img src="https://randomwordgenerator.com/img/picture-generator/5fe4d0474255b10ff3d8992cc12c30771037dbf85254784b772779d69f4e_640.jpg"/>
                                    <button class="icon-button">
                                        <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/upload.png"/>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="edit-container-buttons-actions">
                            <button class="edit-content-action icon-button edit-content-add">
                                <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/add.png"/>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="edit-content-section">
                    <div class="edit-content-buttons-actions">
                        <button class="edit-content-action icon-button edit-content-remove-line">
                            <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/close.png"/>
                        </button>
                        <button class="edit-content-action icon-button edit-content-move-previous">
                            <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/up.png"/>
                        </button>
                        <button class="edit-content-action icon-button edit-content-move-next">
                            <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/down.png"/>
                        </button>
                    </div>
                    
                    <div id="an_id_that_will_be_replaced_by_js" class="section section-activity section-editable">
                        <!--- The activities will be integrated with Javascript, and may not need to user "document.getElementById" --->
                        <p>
                            Ceci est une activité interactive. 
                        </p>

                        <button id="activity-button">
                            !Cliquez-moi!
                        </button>

                        <br>

                        <small>
                        The activities will be integrated with Javascript, and may not need to use "document.getElementById"
                        </small>

                        <p>
                            Cette activité est ici en mode édition (indépendant)
                        </p>

                        <button class="icon-button">
                            <img src="<?=NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/settings.png"/>
                            <span>Éditer...</span>
                        </button>

                        <script>
                            let defined_outside_there_div = document.getElementById("an_id_that_will_be_replaced_by_js");
                            defined_outside_there_div.querySelector("button").addEventListener("click", () => {
                                alert("Vous avez cliqué!!!");
                            })
                        </script>
                    </div>
                </div>

                <div class="edit-content-section">
                    <div class="edit-content-buttons-actions">
                        <button class="edit-content-action icon-button edit-content-remove-line">
                            <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/close.png"/>
                        </button>
                        <button class="edit-content-action icon-button edit-content-move-previous">
                            <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/up.png"/>
                        </button>
                        <button class="edit-content-action icon-button edit-content-move-next">
                            <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/down.png"/>
                        </button>
                    </div>
                    
                    <div class="section section-container horizontal-section-container section-editable">
                        <div class="edit-container-buttons-actions">
                            <button class="edit-content-action icon-button edit-content-vertical">
                                <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/vertical.png"/>
                            </button>
                            <button class="edit-content-action icon-button edit-content-wrap">
                                <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/wrap.png"/>
                            </button>
                        </div>
                        <div class="container-editable-content">
                            <div class="edit-content-section">
                                <div class="edit-content-buttons-actions">
                                    <button class="edit-content-action icon-button edit-content-remove-line">
                                        <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/close.png"/>
                                    </button>
                                    <button class="edit-content-action icon-button edit-content-move-previous disabled-button">
                                        <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/left.png"/>
                                    </button>
                                    <button class="edit-content-action icon-button edit-content-move-next">
                                        <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/right.png"/>
                                    </button>
                                </div>
                                
                                <iframe class="section section-integration section-editable" width="560" height="315" src="https://www.youtube.com/embed/lJIrF4YjHfQ?si=bNKfRgR0zomAqao8" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                            </div>

                            <div class="edit-content-section">
                                <div class="edit-content-buttons-actions">
                                    <button class="edit-content-action icon-button edit-content-remove-line">
                                        <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/close.png"/>
                                    </button>
                                    <button class="edit-content-action icon-button edit-content-move-previous">
                                        <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/left.png"/>
                                    </button>
                                    <button class="edit-content-action icon-button edit-content-move-next disabled-button">
                                        <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/right.png"/>
                                    </button>
                                </div>
                                
                                <div class="section section-raw-text section-editable" contenteditable="true">
        Qu'est-ce que le Lorem Ipsum ?<br>
        Le Lorem Ipsum est simplement un faux texte utilisé dans l'industrie de l'impression et du traitement de texte. Depuis les années 1500, il est considéré comme le texte fictif standard, lorsque quelqu'un a pris une galère de caractères pour la mélanger et créer un livre d'exemple typographique. Il est parvenu à survivre non seulement cinq siècles, mais aussi l'entrée dans le traitement électronique du texte, sans être essentiellement modifié. Sa popularité a été renforcée dans les années 1960 avec la sortie des feuilles Letraset contenant des passages de Lorem Ipsum, et plus récemment grâce aux logiciels de publication assistée par ordinateur comme Aldus PageMaker qui incluent des versions de Lorem Ipsum.<br>
        Le morceau standard de Lorem Ipsum utilisé depuis les années 1500 est reproduit ci-dessous pour ceux que cela intéresse. Les sections 1.10.32 et 1.10.33 de "De Finibus Bonorum et Malorum" par Cicéron y sont également reproduites dans leur forme originale exacte, accompagnées des versions anglaises traduites en 1914 par H. Rackham.</div>
                            </div>
                        </div>
                        <div class="edit-container-buttons-actions">
                            <button class="edit-content-action icon-button edit-content-add">
                                <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/add.png"/>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="edit-content-section">
                    <div class="edit-content-buttons-actions">
                        <button class="edit-content-action icon-button edit-content-remove-line">
                            <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/close.png"/>
                        </button>
                        <button class="edit-content-action icon-button edit-content-move-previous">
                            <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/up.png"/>
                        </button>
                        <button class="edit-content-action icon-button edit-content-move-next">
                            <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/down.png"/>
                        </button>
                    </div>
                    
                    <div class="section section-container horizontal-section-container section-editable">
                        <div class="edit-container-buttons-actions">
                            <button class="edit-content-action icon-button edit-content-vertical">
                                <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/vertical.png"/>
                            </button>
                            <button class="edit-content-action icon-button edit-content-wrap">
                                <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/wrap.png"/>
                            </button>
                        </div>
                        <div class="container-editable-content">
                            <div class="edit-content-section">
                                <div class="edit-content-buttons-actions">
                                    <button class="edit-content-action icon-button edit-content-remove-line">
                                        <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/close.png"/>
                                    </button>
                                    <button class="edit-content-action icon-button edit-content-move-previous disabled-button">
                                        <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/left.png"/>
                                    </button>
                                    <button class="edit-content-action icon-button edit-content-move-next">
                                        <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/right.png"/>
                                    </button>
                                </div>
                                
                                <div class="section section-video section-editable">
                                    <video controls src="http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/BigBuckBunny.mp4">
                                        Your browser is not compatible...<br>
                                        Download the video
                                        <a href="http://commondatastorage.googleapi.com/gtv-videos-bucket/sample/BigBuckBunny.mp4">
                                            here
                                        </a>
                                    </video>
                                    <button class="icon-button">
                                        <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/upload.png"/>
                                    </button>
                                </div>
                            </div>

                            <div class="edit-content-section">
                                <div class="edit-content-buttons-actions">
                                    <button class="edit-content-action icon-button edit-content-remove-line">
                                        <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/close.png"/>
                                    </button>
                                    <button class="edit-content-action icon-button edit-content-move-previous">
                                        <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/left.png"/>
                                    </button>
                                    <button class="edit-content-action icon-button edit-content-move-next disabled-button">
                                        <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/right.png"/>
                                    </button>
                                </div>
                                
                                <div class="section section-container section-editable">
                                    <div class="edit-container-buttons-actions">
                                        <button class="edit-content-action icon-button edit-content-horizontal">
                                            <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/horizontal.png"/>
                                        </button>
                                        <button class="edit-content-action icon-button edit-content-wrap">
                                            <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/wrap.png"/>
                                        </button>
                                    </div>
                                    <div class="container-editable-content">
                                        <div class="edit-content-section">
                                            <div class="edit-content-buttons-actions">
                                                <button class="edit-content-action icon-button edit-content-remove-line">
                                                    <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/close.png"/>
                                                </button>
                                                <button class="edit-content-action icon-button edit-content-move-previous disabled-button">
                                                    <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/up.png"/>
                                                </button>
                                                <button class="edit-content-action icon-button edit-content-move-next">
                                                    <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/down.png"/>
                                                </button>
                                            </div>
                                            
                                            <div class="section section-raw-text section-editable" contenteditable="true">
            Qu'est-ce que le Lorem Ipsum ?<br>
            Le Lorem Ipsum est simplement un faux texte utilisé dans l'industrie de l'impression et du traitement de texte. Depuis les années 1500, il est considéré comme le texte fictif standard, lorsque quelqu'un a pris une galère de caractères pour la mélanger et créer un livre d'exemple typographique. Il est parvenu à survivre non seulement cinq siècles, mais aussi l'entrée dans le traitement électronique du texte, sans être essentiellement modifié. Sa popularité a été renforcée dans les années 1960 avec la sortie des feuilles Letraset contenant des passages de Lorem Ipsum, et plus récemment grâce aux logiciels de publication assistée par ordinateur comme Aldus PageMaker qui incluent des versions de Lorem Ipsum.<br>
            Le morceau standard de Lorem Ipsum utilisé depuis les années 1500 est reproduit ci-dessous pour ceux que cela intéresse. Les sections 1.10.32 et 1.10.33 de "De Finibus Bonorum et Malorum" par Cicéron y sont également reproduites dans leur forme originale exacte, accompagnées des versions anglaises traduites en 1914 par H. Rackham.</div>
                                        </div>

                                        <div class="edit-content-section">
                                            <div class="edit-content-buttons-actions">
                                                <button class="edit-content-action icon-button edit-content-remove-line">
                                                    <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/close.png"/>
                                                </button>
                                                <button class="edit-content-action icon-button edit-content-move-previous">
                                                    <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/up.png"/>
                                                </button>
                                                <button class="edit-content-action icon-button edit-content-move-next disabled-button">
                                                    <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/down.png"/>
                                                </button>
                                            </div>
                                            
                                            <div class="section section-audio section-editable">
                                                <audio controls src="https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3">
                                                    Your browser is not compatible...<br>
                                                    Download the audio 
                                                    <a href="https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3">
                                                        here
                                                    </a>
                                                </audio>
                                                <button class="icon-button">
                                                    <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/upload.png"/>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="edit-container-buttons-actions">
                                        <button class="edit-content-action icon-button edit-content-add">
                                            <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/add.png"/>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="edit-container-buttons-actions">
                            <button class="edit-content-action icon-button edit-content-add">
                                <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/add.png"/>
                            </button>
                        </div>
                    </div>
                </div>


                <div class="edit-content-section">
                    <div class="edit-content-buttons-actions">
                        <button class="edit-content-action icon-button edit-content-remove-line">
                            <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/close.png"/>
                        </button>
                        <button class="edit-content-action icon-button edit-content-move-previous">
                            <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/up.png"/>
                        </button>
                        <button class="edit-content-action icon-button edit-content-move-next disabled-button">
                            <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/down.png"/>
                        </button>
                    </div>
                        
                    <div class="section section-container section-editable">
                        <div class="edit-container-buttons-actions">
                            <button class="edit-content-action icon-button edit-content-horizontal">
                                <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/horizontal.png"/>
                            </button>
                            <button class="edit-content-action icon-button edit-content-wrap">
                                <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/wrap.png"/>
                            </button>
                        </div>
                        <div class="container-editable-content">
                            <div class="edit-content-section">
                                <div class="edit-content-buttons-actions">
                                    <button class="edit-content-action icon-button edit-content-remove-line">
                                        <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/close.png"/>
                                    </button>
                                    <button class="edit-content-action icon-button edit-content-move-previous disabled-button">
                                        <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/up.png"/>
                                    </button>
                                    <button class="edit-content-action icon-button edit-content-move-next">
                                        <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/down.png"/>
                                    </button>
                                </div>
                                    
                                <div class="section section-raw-text section-editable" contenteditable="true">J'en profite pour glisse mon album</div>
                            </div>
                            <div class="edit-content-section">
                                <div class="edit-content-buttons-actions">
                                    <button class="edit-content-action icon-button edit-content-remove-line">
                                        <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/close.png"/>
                                    </button>
                                    <button class="edit-content-action icon-button edit-content-move-previous">
                                        <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/up.png"/>
                                    </button>
                                    <button class="edit-content-action icon-button edit-content-move-next">
                                        <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/down.png"/>
                                    </button>
                                </div>
                                    
                                <iframe class="section section-editable section-integration" src="https://open.spotify.com/embed/album/2UjSSrKiHFeFFb2WNMEv7X?utm_source=generator&theme=0" width="auto" height="352" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>
                            </div>
                            <div class="edit-content-section">
                                <div class="edit-content-buttons-actions">
                                    <button class="edit-content-action icon-button edit-content-remove-line">
                                        <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/close.png"/>
                                    </button>
                                    <button class="edit-content-action icon-button edit-content-move-previous">
                                        <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/up.png"/>
                                    </button>
                                    <button class="edit-content-action icon-button edit-content-move-next disabled-button">
                                        <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/down.png"/>
                                    </button>
                                </div>
                                    
                                <div class="section section-raw-text section-editable" contenteditable="true">Écoutez c'est cool</div>
                            </div>
                        </div>
                        <div class="edit-container-buttons-actions">
                            <button class="edit-content-action icon-button edit-content-add">
                                <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/add.png"/>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="edit-container-buttons-actions">
                <button class="edit-content-action icon-button edit-content-add">
                    <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/add.png"/>
                </button>
            </div>

        </div>
    </div>

    <?php include "activity-thread.php" ?>

</div>

<?php
	require "footer.php";
?>