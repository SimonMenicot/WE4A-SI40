<?php

require "config.php";

function drawHeader(string $title, bool $is_admin = false, string... $addition_scripts): void
{
	?>
	<!DOCTYPE html>
<html>
<head>
	<title><?= $title ?> - Nooble</title>
	<link rel="stylesheet" href="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"] ?>/static/styles/index.css"/>
	<link rel="icon" type="image/png" href="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"] ?>/static/images/logo.png">
	<script src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"] ?>/static/scripts/index.js"></script>
	<script>
const NOOBLE_CONFIG = {
	"PATH_NAME": <?= json_encode(NOOBLE_CONFIG["SERVER"]["PATH_NAME"], true) ?>
}
	</script>
<?php
foreach ($addition_scripts as $script)
{
?>
	<script type="module" src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"] ?>/static/scripts/<?=$script?>"></script>
<?php
}
?>
</head>
<body>
	<header>
		<div id="header-logo">
			<img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"] ?>/static/images/logo.png" class="logo-medium">
			<h1>
				<a href="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"] ?>">Nooble</a>
			</h1>
		</div>
		<span class="header-space">

		</span>

	<?php
	if ($is_admin)
	{
		?><div id="header-admin-prof-switch">
			<span>Administrateur</span>
			<input type="checkbox">
			<span class="checkbox-style"></span>
		</div><?php
	}
	?>
		<div id="header-user-icon">
			<img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"] ?>/static/images/profile-pic.jpg"/>
			<span>
				Nuck Chorris
			</span>
		</div>
	</header>
	<div id="root">
		<main>
	<?php
}

?>