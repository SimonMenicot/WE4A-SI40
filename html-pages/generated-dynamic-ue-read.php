<?php
set_include_path("../");
require "header.php";
drawHeader("Welcome, Litzler", false);
?>
<div id="classpage-main-separation" class="content-separator">
    <div id="main-class-content" class="class-content">
        <div class="class-title-content">
            <a class="class-back-link" href=".">
                <img src="<?= NOOBLE_CONFIG["SERVER"]["PATH_NAME"] ?>/static/images/icons/back.png">
            </a>
            <h1>
                WE4A - Introduction au design WEB
            </h1>
        </div>
        <pre id="json-output" style="overflow-x: scroll; border: 1px solid grey; background: #eee">

        </pre>
    </div>

    <?php include "activity-thread.php" ?>

    <script type="module">

import { DEFAULT_SECTION_TYPES_MAP } from "<?=NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/scripts/classes/SectionTypesMap.js"

(async () => {
let fetch_data = await fetch("./get-json-class-example.php");
let data = await fetch_data.json();

self.mainSection = DEFAULT_SECTION_TYPES_MAP.export(data);
self.maincontent = document.getElementById("main-class-content");
let json_output = document.getElementById("json-output");

json_output.innerText = JSON.stringify(self.mainSection.json_data, null, 2);

let html_base = self.maincontent.insertBefore(self.mainSection.htmlElement, json_output);
html_base.id="main-class-section";

self.mainSection.addEventListener("modified", () => {
    let new_html = self.mainSection.editableHtmlElement;
    self.maincontent.replaceChild(new_html, html_base);
    html_base = new_html;
    json_output.innerText = JSON.stringify(self.mainSection.json_data, null, 2);
});
    
})()

    </script>
</div>

<?php
	require "footer.php";
?>