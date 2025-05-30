<?php
set_include_path("../");
require "header.php";
drawHeader("ça parle de toi là");
?>
<div id="main-profile-page" class="top-banner">
    <div class="profile-identity">
        <div class="profile-infos">
            <div class="profile-description">
                <h1>Sicolas Berley</h1>
                <h2>Etudiant</h2>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries.</p>
            </div>
            <ul class="profile-coordinates">
                <li>
                    <h2>Adresse de courriel</h2>
                    <p>jean.paul@gmiel.com</p>
                </li>
                <li>
                    <h2>Dernière connexion</h2>
                    <p>26/03/2025 17h30, Belfort</p>
                </li>
                <li>
                    <h2>Fuseau horaire</h2>
                    <p>UTC+1</p>
                </li>
            </ul>
        </div>
        <div class="profile-logos">
            <a href="https://youtu.be/dQw4w9WgXcQ?si=P-2GDqOQpbUTdIEf" class="img-link" target="_blank">
                <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"] ?>/static/images/logos/LinkedIn_icon.svg.png" alt="LinkedIn logo"/>
                <span>Sicolas Berley</span>
            </a>
            <a href="https://youtu.be/dQw4w9WgXcQ?si=P-2GDqOQpbUTdIEf" class="img-link" target="_blank">
                <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"] ?>/static/images/logos/Microsoft-Teams-Logo.png" alt="Microsoft Teams logo"/>
                <span>Berley Sicolas</span>
            </a>
            <a href="https://youtu.be/dQw4w9WgXcQ?si=P-2GDqOQpbUTdIEf" class="img-link" target="_blank">
                <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"] ?>/static/images/logos/outlook.svg.png" alt="Outlook logo"/>
                <span>sicolas.berley@platform.com</span>
            </a>
        </div>
    </div>
    <img class="profile-thumbnail" src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"] ?>/static/images/profile-pic.jpg" alt="Profile Picture"/>
</div>

<div id="profilepage-main-separation" class="content-separator">
    <div id="profile-listing">
        <div class="profile-list">
            <h2>UE Suivies</h2>
            <ul>
                <li>WE4A : Introduction to Web Design</li>
                <li>WE4A : Introduction to Web Design</li>
                <li>WE4A : Introduction to Web Design</li>
            </ul>
        </div>
        <div class="profile-list">
            <h2>JSP</h2>
            <ul>
                <li>info intéressante 1</li>
                <li>info intéressante 2</li>
                <li>info intéressante 3</li>
            </ul>
        </div>
        <div class="profile-options">
            <h2>Menu</h2>
            <ul>
                <li>Paramètres du profile...</li>
                <li>Accessibilité...</li>
                <li>Modifier le profile...</li>
                <li>J'aime le riz. Et vous?</li>
            </ul>
        </div>
    </div>

    <?php include "activity-thread.php" ?>

</div>

<?php
include "footer.php"
?>