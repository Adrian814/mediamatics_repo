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
            $design->createHeader("Helping Hands > AGB", "css/web_tech.css");
        ?>
    </head>
    <body>
        <div id="all">
            <?php

			//connect to database
    		$db = mysql_connect("a.db.shared.orchestra.io", "user_6b0d5c75", "bTh4cEKXeAtx!o") or die(mysql_error());
			mysql_select_db("db_6b0d5c75", $db) or die(mysql_error());

		    if (!$db) {
		        echo 'Error: Could not connect to database.';
		        exit;
		    }

		    $mysql = mysql_select_db('db_6b0d5c75');
		    if(!$mysql) {
		        echo 'Cannot select database.';
		        exit;
		    }
		
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
                    <h2>AGB</h2>
                    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et 		accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>
                </div>
                <div id="calendar">
                    <?php
						include 'cal.php';
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>