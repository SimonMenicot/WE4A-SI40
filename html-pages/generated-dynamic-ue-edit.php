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

    <section id="activity-thread" class="side-thread">
        <div class="activity">
            <h1>
                Activité recent
            </h1>
            <div class="activity-content">
                <p>
                    J'ai créé un Figma
                </p>

                <div class="activity-author">
                    <img style="background:linear-gradient(to bottom right, red, blue)"/>
                    <p>Nicolas Daval</p>
                </div>

                <time>
                    Le 24/03/2025 à 10:00
                </time>
            </div>
        </div>

        <div class="activity">
            <h1>
                Devoir à rendre
            </h1>
            <div class="activity-content">
                <p>
                    J'ai créé un Figma
                </p>

                <div class="activity-author">
                    <img style="background:linear-gradient(to bottom right, red, blue)"/>
                    <p>Nicolas Daval</p>
                </div>

                <time>
                    Le 24/03/2025 à 10:00
                </time>
            </div>
        </div>

        <div class="activity">
            <h1>
                Salut tout le monde!
            </h1>
            <div class="activity-content">
                <p>
                    J'aime beaucoup les sardines au beurre, soit dit en passant ; pourquoi se borner à manger des haricots?
                </p>

                <div class="activity-author">
                    <img style="background:linear-gradient(to right, red, green)"/>
                    <p>Eden Morey</p>
                </div>

                <time>
                    24/03/2025 19:25
                </time>
            </div>
        </div>
    </section>

    <script type="module">

import { DEFAULT_SECTION_TYPES_MAP } from "<?=NOOBLE_CONFIG["SERVER"]["PATH_NAME"]?>/static/scripts/classes/SectionTypesMap.js"

(async () => {
let fetch_data = await fetch("./get-json-class-example.php");
let data = await fetch_data.json();

self.mainSection = DEFAULT_SECTION_TYPES_MAP.export(data);
self.maincontent = document.getElementById("main-class-content");
let json_output = document.getElementById("json-output");

json_output.innerText = JSON.stringify(self.mainSection.json_data, null, 2);

let html_base = self.maincontent.insertBefore(self.mainSection.editableHtmlElement, json_output);
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