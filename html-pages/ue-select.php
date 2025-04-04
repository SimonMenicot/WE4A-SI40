<?php
set_include_path("../");
require "header.php";
drawHeader("Welcome, Student");
?>
<div id="homepage-main-separation" class="content-separator">
    <div id="homepage-content" class="main-page-content">
        <h1>Bonjour, Nimen Laden!</h1>
        <div id="classes" class="classes-list"><?php

        for ($i=0; $i < 16; ++$i)
        {?>
            <div class="class-preview">
                <h1>WE4A</h1>
                <p>Introduction au design WEB</p>
            </div>
        <?php
        }
        ?>
        </div>
    </div>

    <?php include "activity-thread.php" ?>

</div>

<?php
	require "footer.php";
?>