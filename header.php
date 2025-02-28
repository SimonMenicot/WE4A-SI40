<?php

require "config.php";

function drawHeader(string $title): void
{
	?>
	<!DOCTYPE html>
<html>
<head>
	<title><?php echo $title ?> - Nooble</title>
	<link rel="stylesheet" href="<?php echo NOOBLE_CONFIG["SERVER"]["PATH_NAME"] ?>/static/styles/index.css">
	<scripts src="<?php echo NOOBLE_CONFIG["SERVER"]["PATH_NAME"] ?>/static/scripts/script.js">
</head>
<body>
	<header>Nooble</header>
	<?php
}

?>
