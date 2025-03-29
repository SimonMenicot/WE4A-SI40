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
<div id="top-profile" class="h-20 row text-white bg-primary">
    <div id="main-info" class="col-md-4 ps-5">
        <h1>Sicolas Berley</h1>
        <h2>Etudiant</h2>
        <p>Description</p>
    </div>
    <div id="side-info" class="col-md-4">
        <h2>Adresse de courriel</h2>
        <h3>jean.paul@gmiel.com</h3>
        <h2>Dernière connexion</h2>
        <h3>26/03/2025 17h30, Belfort</h3>
        <h2>Fuseau horaire</h2>
        <h3>UTC+1</h3>
    </div>
    <div id="profile-pic" class="col-md-4">
        <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"] ?>/static/images/profile-pic.jpg" alt="Profile Picture" class="img-fluid" style="max-height: 100%;"/>
</div>

</body>