<?php
set_include_path("../");
require "header.php";
drawHeader("ça parle de toi là");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf8"/>
    <link rel"stylesheet
    <link rel="stylesheet" href="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"] ?>/static/styles/bootstrap.min.css"/>
    <link rel="icon" type="image/png" href="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"] ?>/static/images/logo.png">
    <link rel="stylesheet" href="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"] ?>/static/styles/colors/bs-colors.css"/>
</head>

<body>
<div id="top-profile" class="h-20 row text-white bg-primary justify-content-between px-4">
    <div id="main-info" class="col-md-4 mx-auto my-4">
        <h1>Sicolas Berley</h1>
        <h2>Etudiant</h2>
        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries.</p>
    </div>
    <div id="side-info" class="col-md-4">
        <h2>Adresse de courriel</h2>
        <h3>jean.paul@gmiel.com</h3>
        <h2>Dernière connexion</h2>
        <h3>26/03/2025 17h30, Belfort</h3>
        <h2>Fuseau horaire</h2>
        <h3>UTC+1</h3>
    </div>
    <div id="profile-pic" class="col-md-3">
        <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"] ?>/static/images/profile-pic.jpg" alt="Profile Picture" class="img-fluid" style="max-height: 100%;"/>
    </div>
    <div id="logos" class="col-md-1">
        <a href="https://youtu.be/dQw4w9WgXcQ?si=P-2GDqOQpbUTdIEf"><img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"] ?>/static/images/icons/LinkedIn_icon.svg.png" alt="Logo 1" class="img-fluid"/></a>
        <a href="https://youtu.be/dQw4w9WgXcQ?si=P-2GDqOQpbUTdIEf"><img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"] ?>/static/images/icons/Microsoft-Teams-Logo.png" alt="Logo 2" class="img-fluid"/></a>
        <a href="https://youtu.be/dQw4w9WgXcQ?si=P-2GDqOQpbUTdIEf"><img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"] ?>/static/images/icons/e-mail.png" alt="Logo 3" class="img-fluid"/></a>
    </div>
</div>
<div id="rest-info" class="h-40 row justify-content-between px-4">
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


</body>