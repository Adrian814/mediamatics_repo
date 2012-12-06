<?php
session_start();
?>

<html>
    <head>
        <?php
            include "ini_set.inc.php";
            include "design.class.php";
            include "user.class.php";

            $user = new userclass();
            $user->checkCookie();

            $design = new designclass();
            $design->createHeader("Item added to Watchlist", "css/web_tech.css");      
        ?>

    </head>
    <body>
        <div id="all">
            <?php
                $design->createNavigation("navigation", "navigation_logo", "navigation_title", "navigation_nav", "nav", "navigation_login");
            ?>
            <div id="body">
                <div id="content">
					<?php
					    //open database
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
						
						//add item to watchlist	   
					    if(isset($_GET["ItemId"])){
					  		$query = "INSERT INTO `Watchlist` (`User`, `EventId`, `Date`)"."VALUES (\"".$_SESSION["nick"]."\","."\"".$_Get['EventId']."\","."\"".date("Y-m-d")."\");";
			 				mysql_query($query);
						}
						
						echo "<p><span id="add">Item successfully added to the watchlist!</span></p>";
					?>
                </div>
                <div id="calendar">
                    <?php
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>