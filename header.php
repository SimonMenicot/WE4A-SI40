<?php

require "config.php";

function drawHeader(string $title): void
{
	?>
	<!DOCTYPE html>
<html>
<head>
	<title><?= $title ?> - Nooble</title>
	<link rel="stylesheet" href="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"] ?>/static/styles/index.css"/>
	<link rel="icon" type="image/png" href="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"] ?>/static/images/logo.png">
	<script src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"] ?>/static/scripts/index.js"></script>
</head>
<body>
	<header>
		<div id="header-logo">
			<img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"] ?>/static/images/logo.png" class="logo-medium">
			<h1><a href="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"] ?>">Nooble</a></h1>
		</div>
	</header>
	<div id="root">
		<main>
	<?php
}

?>