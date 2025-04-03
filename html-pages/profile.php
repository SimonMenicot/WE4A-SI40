<?php
set_include_path("../");
require "header.php";
drawHeader("ça parle de toi là");
?>
    <link rel="stylesheet" href="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"] ?>/static/styles/bootstrap.min.css"/>
    <link rel="stylesheet" href="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"] ?>/static/styles/pages/temporary-profile-style.css"/>

    <div id="top-profile" class="bg-primary">
        <div class="row">
            <div class="col-8">
                <div class="row">
                    <div id="description" class="col-6">
                        <h1>Sicolas Berley</h1>
                        <h2>Etudiant</h2>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries.</p>
                    </div>
                    <div id="coordonnees" class="col-6">
                        <h2>Adresse de courriel</h2>
                        <h3>jean.paul@gmiel.com</h3>
                        <h2>Dernière connexion</h2>
                        <h3>26/03/2025 17h30, Belfort</h3>
                        <h2>Fuseau horaire</h2>
                        <h3>UTC+1</h3>
                    </div>
                </div>
                <div id="logos">
                    <a href="https://youtu.be/dQw4w9WgXcQ?si=P-2GDqOQpbUTdIEf"><img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"] ?>/static/images/icons/LinkedIn_icon.svg.png" alt="Logo 1" /></a>
                    <a href="https://youtu.be/dQw4w9WgXcQ?si=P-2GDqOQpbUTdIEf"><img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"] ?>/static/images/icons/Microsoft-Teams-Logo.png" alt="Logo 2" /></a>
                    <a href="https://youtu.be/dQw4w9WgXcQ?si=P-2GDqOQpbUTdIEf"><img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"] ?>/static/images/icons/outlook.svg.png" alt="Logo 3" /></a>
                </div>
            </div>
            <div id="profile-pic" class="col-4">
                <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"] ?>/static/images/profile-pic.jpg" alt="Profile Picture" class="img-fluid" style="max-height: 100%;"/>
            </div>
        </div>
    </div>

    <div id="rest-info" class="row justify-content-between px-4">
        <div id="UE" class="col-4 mx-auto my-4">
            <h2>UE Suivies</h2>
            <p>WE4A : Introduction to Web Design</p>
            <p>WE4A : Introduction to Web Design</p>
            <p>WE4A : Introduction to Web Design</p>
        </div>
        <div id="jsp" class="col-4 mx-auto my-4">
            <h2>JSP</h2>
            <p>info intéressante 1</p>
            <p>info intéressante 2</p>
            <p>info intéressante 3</p>
        </div>
        <div id="right-menu" class="col-4 mx-auto my-4">
            <h2>Menu</h2>
            <p>info intéressante 1</p>
            <p>info intéressante 2</p>
            <p>info intéressante 3</p>
            <p>info intéressante 4</p>
        </div>
    </div>

<?php
include "footer.php"
?>