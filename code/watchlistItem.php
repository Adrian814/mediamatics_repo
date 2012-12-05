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
            $design->createHeader("Demo Kalender", "css/web_tech.css");        
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
				    $db = $user->getDB();

				    if (!$db) { 
				        echo 'Error: Could not connect to database.';
				        exit; 
				    }

				    $mysql = mysql_select_db('user_6b0d5c75');

				    if(!$mysql) {
				        echo 'Cannot select database.'; 
				        exit;
				    }

			    	<p><span id="add">Item successfully added to the watchlist!</span></p>
			                
                    if(isset($_GET["id"])){
	                    // fills the events table in the database
					    $query = "INSERT INTO Watchlist (WatchlistId, User, EventId, Date)
					             ."VALUES (\"".$_SESSION["WatchlistId"]."\","."\"".$_POST['User']."\","."\"".$_Get['EventId']."\","."\"".$_POST['date("Y-m-d")']."\",";
								 //echo $query;
								 mysql_query($query);
					}
			   ?>
            </div>
                <div id="calendar">
                    <?php
                        include "cal.php";
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>