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
            $design->createHeader("Helping Hands > Links", "css/web_tech.css");
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
						include 'cal.php';
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>