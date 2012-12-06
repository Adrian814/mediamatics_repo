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
                    <h2>About</h2>
                     Platform for help services (demand and request)
                     
                     <p>This website was written by Adrian Siuda.</p>

                     <p>
                         Comments and remarks can be sent to the <a href="mailto:democal2009@gmail.com">admin</a>.
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