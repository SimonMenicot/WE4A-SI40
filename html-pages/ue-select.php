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
</div>

<?php
	require "footer.php";
?>