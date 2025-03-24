<?php
set_include_path("../");
require "config.php";
?><!DOCTYPE html>
<html>
    <head>
        <meta charset="utf8"/>
        <link rel="stylesheet" href="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"] ?>/static/styles/index.css"/>
    </head>

    <body>
        <div id="login-div" class="center-div">
            <h1>Welcome back to Nooble!</h1>

            <form name="login">
                <h2>Please connect to your account</h2>

                <label>Email:</label>
                <input type="email" id="login-mail"/>

                <label>Password:</label>
                <input type="password" id="login-password"/>

                <input type="submit" id="login-password" value="Sign in"/>

                <a href=".">I have forgotten my password</a>
            </form>
        </div>
    </body>
</html>