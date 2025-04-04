<?php
set_include_path("../");
require "header.php";
drawHeader("Welcome, Teacher", true);
?>
<div id="homepage-main-separation" class="content-separator">
	<div id="homepage-content" class="main-page-content">
		<h1>Bonjour, Mr. Litzler!</h1>
		<div id="classes" class="classes-list"><?php
		for ($i=0; $i < 16; ++$i)
		{?>
			<div class="class-preview">
				<h1>WE4A</h1>
				<p>Introduction au design WEB</p>

				<span class="class-edit-icon">
					<img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/images/icons/edit.png" />
				</span>
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