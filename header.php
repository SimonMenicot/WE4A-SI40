<?php

require "config.php";

function drawHeader(string $title): void
{
	?>
	<!DOCTYPE html>
<html>
<head>
	<title><?php echo $title ?> - Nooble</title>
	<link rel="stylesheet" href="<?php echo NOOBLE_CONFIG["SERVER"]["PATH_NAME"] ?>/static/styles/index.css"/>
	<script src="<?php echo NOOBLE_CONFIG["SERVER"]["PATH_NAME"] ?>/static/scripts/index.js"></script>
</head>
<body>
	<header>Nooble</header>
	<main>
	<?php
}

?>