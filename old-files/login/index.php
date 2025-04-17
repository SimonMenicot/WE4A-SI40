<! WE40-SI40/login >

<?php
	set_include_path("../");
	require "header.php";
	drawHeader("Please log in");
?>

<h1>Login</h1>
<form>
	<label for="ident">Nom d'utilisateur</label><input type="text" id="ident"> <br/>
	<label for="passw">Mot de passe</label><input type="password" id="passw"> <br/>
	<input type="submit" value="Se connecter">
</form>

<?php
	require "footer.php";
?>