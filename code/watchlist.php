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
            $design->createHeader("Helping Hands > Watchlist", "css/web_tech.css");
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
					    //check the user rights       
					    if (!isset($_SESSION["nick"])) {
					        echo "<meta http-equiv='refresh' content='0; url=index.php'>";
					    }
					    if (isset($_SESSION["nick"])) {
							$postingdateSelected = 0;
							$titleSelected = 0;
							$categorySelected = 0;
							$Seite = 0;
					
							//connects to database
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
	
						    // generates the list of events
							$query1 = "SELECT * FROM `Watchlist` WHERE `User` = ".$_SESSION["nick"]." ORDER BY `Date` DESC";
						    $result1 = mysql_query($query1);
						    if ($result1) {
						    	$num_results1 = mysql_num_rows($result1);
							    for ($i=0; $i < $num_results1; $i++) {
							        $row1 = mysql_fetch_array($result1);
							        $ItemId = $row1['ItemId'];
									$query2 = "SELECT * FROM `Events` WHERE `ItemId` = ".$ItemId." ORDER BY `Date` DESC";
									$result2 = mysql_query($query2);
									$row2 = mysql_fetch_array($result2);
								    echo "
										<form action='index.php?Order=$Order&Page=$Page&Total=$Total' method='post'>
								       	 	<table>
										        <td>
										            <tr>
											            <b><a href=itemProfile.php?ItemId=".$row2['ItemId']." class='adi'>".$row2['Title']." [".$row2['Category']."]: </a><b>
										            </tr>
										            <tr>
										                <td colspan='2', rowspan='2' valign='top' id='event_descr'>
										                    $Description
										                    <br><a href=itemProfile.php?ItemId=".$row2['ItemId']." class='adi' style='font-style:italic;'> more...<a>
										                </td>
										            </tr>
										            <br>
												</td>
								    ";
								}
							}
								    echo "
								        	</table>
										</form>
								    ";
						} 
        			?>
                </div>
                <div id="calendar">
                    <?php
                        //include "cal.php";
                        //include "Calendar.php";
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>