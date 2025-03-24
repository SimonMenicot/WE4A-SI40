<?php
set_include_path("../");
require "header.php";
drawHeader("Welcome, Student");
?>
<div id="homepage-main-separation" class="content-separator">
    <div id="classes" class="classes-list"><?php

    for ($i=0; $i < 23; ++$i)
    {?>
        <div class="class-preview">
            <h1>WE4A</h1>
            <p>Introduction to web</p>
        </div>
    <?php
    }
    ?>
        </div>

    <section id="activity-thread" class="side-thread">
        <div class="activity">
            <h1>
                Recent activity
            </h1>
            <div class="activity-content">
                <p>
                    I have created a Figma
                </p>

                <div class="activity-author">
                    <img style="background:linear-gradient(to bottom right, red, blue)"/>
                    <p>Nicolas Daval</p>
                </div>

                <time>
                    2025/03/24 10:00
                </time>
            </div>
        </div>

        <div class="activity">
            <h1>
                Homework to give back
            </h1>
            <div class="activity-content">
                <p>
                    I have created a Figma
                </p>

                <div class="activity-author">
                    <img style="background:linear-gradient(to bottom right, red, blue)"/>
                    <p>Nicolas Daval</p>
                </div>

                <time>
                    2025/03/24 10:00
                </time>
            </div>
        </div>

        <div class="activity">
            <h1>
                Hi everybody!
            </h1>
            <div class="activity-content">
                <p>
                    I will lunch tomorrow afternoon after having drunk some water. 
                </p>

                <div class="activity-author">
                    <img style="background:linear-gradient(to bottom right, red, blue)"/>
                    <p>Nicolas Daval</p>
                </div>

                <time>
                    2025/03/24 19:25
                </time>
            </div>
        </div>
    </section>
</div>

<?php
	require "footer.php";
?>