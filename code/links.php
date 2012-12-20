<?php session_start(); ?>

<html>
    <head>
        <?php
            include "ini_set.inc.php";
            include "design.class.php";
            include "user.class.php";

            $user = new userclass();
            $user->checkCookie();

            $design = new designclass();
            $design->createHeader("Demo Kalender > About", "css/web_tech.css");


        ?>

    </head>
    <body>
        <div id="all">

            <?php

                $design->createNavigation(  "navigation",
                                            "navigation_logo",
                                            "navigation_title",
                                            "navigation_nav",
                                            "nav",
                                            //"loginLinks",
                                            "navigation_login");

            ?>
            <div id="body">
                <div id="content">
                    <h2>Links</h2>
						<p>
						  <a href="http://www.tagesschau.de/">ARD Tagesschau</a> Nachrichten<br>
						  <a href="http://www.heise.de/newsticker/">Heise Newsticker</a> Computer-Nachrichten<br>
						  <a href="http://de.news.yahoo.com/">Yahoo Nachrichtenticker</a> Nachrichten<br>
						  <a href="http://www.oneworld.net/section/current">OneWorld News</a> Nachrichten (en)
						</p>
                </div>
                <div id="calendar">
                    <?php
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>