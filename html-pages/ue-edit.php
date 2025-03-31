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

        <div id="main-class-section" class="section section-container">
            <div class="edit-content-section">
                <div class="section section-container">
                    <div class="edit-content-section">
                        <div class="edit-content-buttons-actions">
                            <button class="edit-content-action edit-content-remove-line">
                                <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/close.png"/>
                            </button>
                            <button class="edit-content-action edit-content-move-top disabled-button">
                                <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/up.png"/>
                            </button>
                            <button class="edit-content-action edit-content-move-bottom">
                                <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/down.png"/>
                            </button>
                        </div>
                        
                        <div class="section section-raw-text section-editable" contenteditable="true">Ceci est un texte brute dans un container vertical</div>
                    </div>

                    <div class="edit-content-section">
                        <div class="edit-content-buttons-actions">
                            <button class="edit-content-action edit-content-remove-line">
                                <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/close.png"/>
                            </button>
                            <button class="edit-content-action edit-content-move-top disabled-button">
                                <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/up.png"/>
                            </button>
                            <button class="edit-content-action edit-content-move-bottom">
                                <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/down.png"/>
                            </button>
                        </div>
                        
                        <div class="section section-raw-text section-editable" contenteditable="true">Qu'est-ce que le Lorem Ipsum ?
Le Lorem Ipsum est simplement un faux texte utilisé dans l'industrie de l'impression et du traitement de texte. Depuis les années 1500, il est considéré comme le texte fictif standard, lorsque quelqu'un a pris une galère de caractères pour la mélanger et créer un livre d'exemple typographique. Il est parvenu à survivre non seulement cinq siècles, mais aussi l'entrée dans le traitement électronique du texte, sans être essentiellement modifié. Sa popularité a été renforcée dans les années 1960 avec la sortie des feuilles Letraset contenant des passages de Lorem Ipsum, et plus récemment grâce aux logiciels de publication assistée par ordinateur comme Aldus PageMaker qui incluent des versions de Lorem Ipsum.<br>
Le morceau standard de Lorem Ipsum utilisé depuis les années 1500 est reproduit ci-dessous pour ceux que cela intéresse. Les sections 1.10.32 et 1.10.33 de "De Finibus Bonorum et Malorum" par Cicéron y sont également reproduites dans leur forme originale exacte, accompagnées des versions anglaises traduites en 1914 par H. Rackham.</div>
                    </div>

                    <div class="edit-content-section">
                        <div class="edit-content-buttons-actions">
                            <button class="edit-content-action edit-content-remove-line">
                                <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/close.png"/>
                            </button>
                            <button class="edit-content-action edit-content-move-top disabled-button">
                                <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/up.png"/>
                            </button>
                            <button class="edit-content-action edit-content-move-bottom">
                                <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/down.png"/>
                            </button>
                        </div>
                        
                        <div class="section section-rich-text section-editable">
                            <div class="rich-text-section-edit-line">
                                <button><b>B</b></button>
                                <button><i>I</i></button>
                                <button><u>U</u></button>
                                <span>...</span>
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
                    <button class="edit-section-add-button">
                        Ajouter une section...
                    </button>
                </div>
            </div>

            <div class="edit-content-section">
                <div class="edit-content-buttons-actions">
                    <button class="edit-content-action edit-content-remove-line">
                        <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/close.png"/>
                    </button>
                    <button class="edit-content-action edit-content-move-top disabled-button">
                        <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/up.png"/>
                    </button>
                    <button class="edit-content-action edit-content-move-bottom">
                        <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/down.png"/>
                    </button>
                </div>
                
                <div class="section section-raw-text section-editable" contenteditable="true">
                    Ce qui suit est un container horizontal avec wrap (miam miam)
                </div>
            </div>

            <div class="edit-content-section">
                <div class="edit-content-buttons-actions">
                    <button class="edit-content-action edit-content-remove-line">
                        <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/close.png"/>
                    </button>
                    <button class="edit-content-action edit-content-move-top disabled-button">
                        <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/up.png"/>
                    </button>
                    <button class="edit-content-action edit-content-move-bottom">
                        <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/down.png"/>
                    </button>
                </div>
                
                <div class="section section-container horizontal-section-container wrapping-section-container section-editable">
                    <div class="edit-content-section">
                        <div class="edit-content-buttons-actions">
                            <button class="edit-content-action edit-content-remove-line">
                                <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/close.png"/>
                            </button>
                            <button class="edit-content-action edit-content-move-top disabled-button">
                                <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/left.png"/>
                            </button>
                            <button class="edit-content-action edit-content-move-bottom">
                                <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/right.png"/>
                            </button>
                        </div>
                        
                        <div class="section section-file section-editable">
                            <p class="file-description">TD1 : Sûrement pas sur Symfony mdr, débrouillez vous</p>
                            <a class="file-button" href="https://tests-and-previews.flopcreation.fr/downloads/UTBM - Nooble/TD1.zip" target="_blank">
                                <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"] ?>/static/images/icons/download.png">
                                <span class="file-extension">TD1.zip</text>
                            </a>
                        </div>
                    </div>

                    <div class="edit-content-section">
                        <div class="edit-content-buttons-actions">
                            <button class="edit-content-action edit-content-remove-line">
                                <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/close.png"/>
                            </button>
                            <button class="edit-content-action edit-content-move-top disabled-button">
                                <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/left.png"/>
                            </button>
                            <button class="edit-content-action edit-content-move-bottom">
                                <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/right.png"/>
                            </button>
                        </div>
                        
                        <div class="section section-file section-editable">
                            <p class="file-description">TD2 : Tiens, et si on faisait du PHP?</p>
                            <a class="file-button" href="https://tests-and-previews.flopcreation.fr/downloads/UTBM - Nooble/TD2.zip" target="_blank">
                                <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"] ?>/static/images/icons/download.png">
                                <span class="file-extension">TD2.zip</text>
                            </a>
                        </div>
                    </div>

                    <div class="edit-content-section">
                        <div class="edit-content-buttons-actions">
                            <button class="edit-content-action edit-content-remove-line">
                                <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/close.png"/>
                            </button>
                            <button class="edit-content-action edit-content-move-top disabled-button">
                                <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/left.png"/>
                            </button>
                            <button class="edit-content-action edit-content-move-bottom">
                                <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/right.png"/>
                            </button>
                        </div>
                        
                        <div class="section section-file section-editable">
                            <p class="file-description">TD3 : Symfony? Noooon, AJAX bien sûr!</p>
                            <a class="file-button" href="https://tests-and-previews.flopcreation.fr/downloads/UTBM - Nooble/TD3.zip" target="_blank">
                                <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"] ?>/static/images/icons/download.png">
                                <span class="file-extension">TD3.zip</text>
                            </a>
                        </div>
                    </div>

                    <div class="edit-content-section">
                        <div class="edit-content-buttons-actions">
                            <button class="edit-content-action edit-content-remove-line">
                                <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/close.png"/>
                            </button>
                            <button class="edit-content-action edit-content-move-top disabled-button">
                                <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/left.png"/>
                            </button>
                            <button class="edit-content-action edit-content-move-bottom">
                                <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/right.png"/>
                            </button>
                        </div>
                        
                        <div class="section section-file section-editable">
                            <p class="file-description">Le cahier des charges : ce que vous allez devoir faire en 2 semaines, en même temps que les autres projets, que vos clubs, que votre vie en général en fait. Ou pas. </p>
                            <a class="file-button" href="https://tests-and-previews.flopcreation.fr/downloads/UTBM - Nooble/WE4A - Moodle Simplifié (devoir retiré).pdf" target="_blank">
                                <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"] ?>/static/images/icons/download.png">
                                <span class="file-extension">WE4A - Moodle Simplifié (devoir retiré).pdf</text>
                            </a>
                        </div>
                    </div>
                    <button class="edit-section-add-button">
                        Ajouter une section...
                    </button>
                </div>
            </div>

            <div class="edit-content-section">
                <div class="edit-content-buttons-actions">
                    <button class="edit-content-action edit-content-remove-line">
                        <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/close.png"/>
                    </button>
                    <button class="edit-content-action edit-content-move-top disabled-button">
                        <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/up.png"/>
                    </button>
                    <button class="edit-content-action edit-content-move-bottom">
                        <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/down.png"/>
                    </button>
                </div>
                
                <div class="section section-container horizontal-section-container wrapping-section-container section-editable">
                    <div class="edit-content-section">
                        <div class="edit-content-buttons-actions">
                            <button class="edit-content-action edit-content-remove-line">
                                <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/close.png"/>
                            </button>
                            <button class="edit-content-action edit-content-move-top disabled-button">
                                <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/left.png"/>
                            </button>
                            <button class="edit-content-action edit-content-move-bottom">
                                <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/right.png"/>
                            </button>
                        </div>
                        
                        <img class="section section-image section-editable" src="https://randomwordgenerator.com/img/picture-generator/55e2dc434c50a814f1dc8460962e33791c3ad6e04e50744074267bd19f4ac2_640.jpg"/>
                    </div>
                    <div class="edit-content-section">
                        <div class="edit-content-buttons-actions">
                            <button class="edit-content-action edit-content-remove-line">
                                <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/close.png"/>
                            </button>
                            <button class="edit-content-action edit-content-move-top disabled-button">
                                <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/left.png"/>
                            </button>
                            <button class="edit-content-action edit-content-move-bottom">
                                <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/right.png"/>
                            </button>
                        </div>
                        
                        <img class="section section-image" src="https://randomwordgenerator.com/img/picture-generator/5fe4d0474255b10ff3d8992cc12c30771037dbf85254784b772779d69f4e_640.jpg"/>
                    </div>
                    <button class="edit-section-add-button">
                        Ajouter une section...
                    </button>
                </div>
            </div>

            <div class="edit-content-section">
                <div class="edit-content-buttons-actions">
                    <button class="edit-content-action edit-content-remove-line">
                        <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/close.png"/>
                    </button>
                    <button class="edit-content-action edit-content-move-top disabled-button">
                        <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/up.png"/>
                    </button>
                    <button class="edit-content-action edit-content-move-bottom">
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
                    <button class="edit-content-action edit-content-remove-line">
                        <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/close.png"/>
                    </button>
                    <button class="edit-content-action edit-content-move-top disabled-button">
                        <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/up.png"/>
                    </button>
                    <button class="edit-content-action edit-content-move-bottom">
                        <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/down.png"/>
                    </button>
                </div>
                
                <div class="section section-container horizontal-section-container section-editable">
                    <div class="edit-content-section">
                        <div class="edit-content-buttons-actions">
                            <button class="edit-content-action edit-content-remove-line">
                                <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/close.png"/>
                            </button>
                            <button class="edit-content-action edit-content-move-top disabled-button">
                                <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/left.png"/>
                            </button>
                            <button class="edit-content-action edit-content-move-bottom">
                                <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/right.png"/>
                            </button>
                        </div>
                        
                        <iframe class="section section-integration section-editable" width="560" height="315" src="https://www.youtube.com/embed/lJIrF4YjHfQ?si=bNKfRgR0zomAqao8" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    </div>

                    <div class="edit-content-section">
                        <div class="edit-content-buttons-actions">
                            <button class="edit-content-action edit-content-remove-line">
                                <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/close.png"/>
                            </button>
                            <button class="edit-content-action edit-content-move-top disabled-button">
                                <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/left.png"/>
                            </button>
                            <button class="edit-content-action edit-content-move-bottom">
                                <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/right.png"/>
                            </button>
                        </div>
                        
                        <div class="section section-raw-text section-editable" contenteditable="true">
Qu'est-ce que le Lorem Ipsum ?<br>
Le Lorem Ipsum est simplement un faux texte utilisé dans l'industrie de l'impression et du traitement de texte. Depuis les années 1500, il est considéré comme le texte fictif standard, lorsque quelqu'un a pris une galère de caractères pour la mélanger et créer un livre d'exemple typographique. Il est parvenu à survivre non seulement cinq siècles, mais aussi l'entrée dans le traitement électronique du texte, sans être essentiellement modifié. Sa popularité a été renforcée dans les années 1960 avec la sortie des feuilles Letraset contenant des passages de Lorem Ipsum, et plus récemment grâce aux logiciels de publication assistée par ordinateur comme Aldus PageMaker qui incluent des versions de Lorem Ipsum.<br>
Le morceau standard de Lorem Ipsum utilisé depuis les années 1500 est reproduit ci-dessous pour ceux que cela intéresse. Les sections 1.10.32 et 1.10.33 de "De Finibus Bonorum et Malorum" par Cicéron y sont également reproduites dans leur forme originale exacte, accompagnées des versions anglaises traduites en 1914 par H. Rackham.</div>
                    </div>
                    <button class="edit-section-add-button">
                        Ajouter une section...
                    </button>
                </div>
            </div>

            <div class="edit-content-section">
                <div class="edit-content-buttons-actions">
                    <button class="edit-content-action edit-content-remove-line">
                        <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/close.png"/>
                    </button>
                    <button class="edit-content-action edit-content-move-top disabled-button">
                        <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/up.png"/>
                    </button>
                    <button class="edit-content-action edit-content-move-bottom">
                        <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/down.png"/>
                    </button>
                </div>
                
                <div class="section section-container horizontal-section-container section-editable">
                    <div class="edit-content-section">
                        <div class="edit-content-buttons-actions">
                            <button class="edit-content-action edit-content-remove-line">
                                <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/close.png"/>
                            </button>
                            <button class="edit-content-action edit-content-move-top disabled-button">
                                <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/left.png"/>
                            </button>
                            <button class="edit-content-action edit-content-move-bottom">
                                <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/right.png"/>
                            </button>
                        </div>
                        
                        <video controls class="section section-video section-editable" src="http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/BigBuckBunny.mp4">
                            Your browser is not compatible...<br>
                            Download the video
                            <a href="http://commondatastorage.googleapi.com/gtv-videos-bucket/sample/BigBuckBunny.mp4">
                                here
                            </a>
                        </video>
                    </div>

                    <div class="edit-content-section">
                        <div class="edit-content-buttons-actions">
                            <button class="edit-content-action edit-content-remove-line">
                                <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/close.png"/>
                            </button>
                            <button class="edit-content-action edit-content-move-top disabled-button">
                                <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/left.png"/>
                            </button>
                            <button class="edit-content-action edit-content-move-bottom">
                                <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/right.png"/>
                            </button>
                        </div>
                        
                        <div class="section section-container section-editable">
                            <div class="edit-content-section">
                                <div class="edit-content-buttons-actions">
                                    <button class="edit-content-action edit-content-remove-line">
                                        <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/close.png"/>
                                    </button>
                                    <button class="edit-content-action edit-content-move-top disabled-button">
                                        <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/up.png"/>
                                    </button>
                                    <button class="edit-content-action edit-content-move-bottom">
                                        <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/down.png"/>
                                    </button>
                                </div>
                                
                                <div class="section section-raw-text section-editable">
Qu'est-ce que le Lorem Ipsum ?<br>
Le Lorem Ipsum est simplement un faux texte utilisé dans l'industrie de l'impression et du traitement de texte. Depuis les années 1500, il est considéré comme le texte fictif standard, lorsque quelqu'un a pris une galère de caractères pour la mélanger et créer un livre d'exemple typographique. Il est parvenu à survivre non seulement cinq siècles, mais aussi l'entrée dans le traitement électronique du texte, sans être essentiellement modifié. Sa popularité a été renforcée dans les années 1960 avec la sortie des feuilles Letraset contenant des passages de Lorem Ipsum, et plus récemment grâce aux logiciels de publication assistée par ordinateur comme Aldus PageMaker qui incluent des versions de Lorem Ipsum.<br>
Le morceau standard de Lorem Ipsum utilisé depuis les années 1500 est reproduit ci-dessous pour ceux que cela intéresse. Les sections 1.10.32 et 1.10.33 de "De Finibus Bonorum et Malorum" par Cicéron y sont également reproduites dans leur forme originale exacte, accompagnées des versions anglaises traduites en 1914 par H. Rackham.</div>
                            </div>

                            <div class="edit-content-section">
                                <div class="edit-content-buttons-actions">
                                    <button class="edit-content-action edit-content-remove-line">
                                        <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/close.png"/>
                                    </button>
                                    <button class="edit-content-action edit-content-move-top disabled-button">
                                        <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/up.png"/>
                                    </button>
                                    <button class="edit-content-action edit-content-move-bottom">
                                        <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/down.png"/>
                                    </button>
                                </div>
                                
                                <audio controls class="section section-audio section-editable" src="https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3">
                                    Your browser is not compatible...<br>
                                    Download the audio 
                                    <a href="https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3">
                                        here
                                    </a>
                                </audio>
                            </div>
                            <button class="edit-section-add-button">
                                Ajouter une section...
                            </button>
                        </div>
                    </div>
                    <button class="edit-section-add-button">
                        Ajouter une section...
                    </button>
                </div>
            </div>


            <div class="edit-content-section">
                <div class="edit-content-buttons-actions">
                    <button class="edit-content-action edit-content-remove-line">
                        <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/close.png"/>
                    </button>
                    <button class="edit-content-action edit-content-move-top disabled-button">
                        <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/up.png"/>
                    </button>
                    <button class="edit-content-action edit-content-move-bottom">
                        <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/down.png"/>
                    </button>
                </div>
                    
                <div class="section section-container section-editable">
                    <div class="edit-content-section">
                        <div class="edit-content-buttons-actions">
                            <button class="edit-content-action edit-content-remove-line">
                                <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/close.png"/>
                            </button>
                            <button class="edit-content-action edit-content-move-top disabled-button">
                                <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/up.png"/>
                            </button>
                            <button class="edit-content-action edit-content-move-bottom">
                                <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/down.png"/>
                            </button>
                        </div>
                            
                        <div class="section section-raw-text section-editable">J'en profite pour glisse mon album</div>
                    </div>
                    <div class="edit-content-section">
                        <div class="edit-content-buttons-actions">
                            <button class="edit-content-action edit-content-remove-line">
                                <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/close.png"/>
                            </button>
                            <button class="edit-content-action edit-content-move-top disabled-button">
                                <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/up.png"/>
                            </button>
                            <button class="edit-content-action edit-content-move-bottom">
                                <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/down.png"/>
                            </button>
                        </div>
                            
                        <iframe src="https://open.spotify.com/embed/album/2UjSSrKiHFeFFb2WNMEv7X?utm_source=generator&theme=0" width="100%" height="352" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>
                    </div>
                    <div class="edit-content-section">
                        <div class="edit-content-buttons-actions">
                            <button class="edit-content-action edit-content-remove-line">
                                <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/close.png"/>
                            </button>
                            <button class="edit-content-action edit-content-move-top disabled-button">
                                <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/up.png"/>
                            </button>
                            <button class="edit-content-action edit-content-move-bottom">
                                <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/down.png"/>
                            </button>
                        </div>
                            
                        <div class="section section-raw-text section-editable">Écoutez c'est cool</div>
                        <button class="edit-section-add-button">
                            Ajouter une section...
                        </button>
                    </div>
                </div>
                <button class="edit-section-add-button">
                    Ajouter une section...
                </button>
            </div>

        </div>
    </div>

    <section id="activity-thread" class="side-thread">
        <div class="activity">
            <h1>
                Activité recent
            </h1>
            <div class="activity-content">
                <p>
                    J'ai créé un Figma
                </p>

                <div class="activity-author">
                    <img style="background:linear-gradient(to bottom right, red, blue)"/>
                    <p>Nicolas Daval</p>
                </div>

                <time>
                    Le 24/03/2025 à 10:00
                </time>
            </div>
        </div>

        <div class="activity">
            <h1>
                Devoir à rendre
            </h1>
            <div class="activity-content">
                <p>
                    J'ai créé un Figma
                </p>

                <div class="activity-author">
                    <img style="background:linear-gradient(to bottom right, red, blue)"/>
                    <p>Nicolas Daval</p>
                </div>

                <time>
                    Le 24/03/2025 à 10:00
                </time>
            </div>
        </div>

        <div class="activity">
            <h1>
                Salut tout le monde!
            </h1>
            <div class="activity-content">
                <p>
                    J'aime beaucoup les sardines au beurre, soit dit en passant ; pourquoi se borner à manger des haricots?
                </p>

                <div class="activity-author">
                    <img style="background:linear-gradient(to right, red, green)"/>
                    <p>Eden Morey</p>
                </div>

                <time>
                    24/03/2025 19:25
                </time>
            </div>
        </div>
    </section>
</div>

<?php
	require "footer.php";
?>