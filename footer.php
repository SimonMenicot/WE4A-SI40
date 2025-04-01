<?php

if (NOOBLE_CONFIG === null) {
	include "config.php";
};

?>		</main>
		<footer>
			Thanks for using Nooble<br>
			<?php 
$content = file_get_contents($_SERVER["DOCUMENT_ROOT"].NOOBLE_CONFIG["SERVER"]["PATH_NAME"]."/.git/FETCH_HEAD");

if ($content === false) return;

$lines = preg_split("/\n/", $content);

echo $lines[0];
?>
		</footer>
	</div>
</body>
</html>