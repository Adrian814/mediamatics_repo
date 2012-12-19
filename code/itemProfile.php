<?php session_start(); ?>

<html>
    <head>
        <?php
            //include "ini_set.inc.php";
            include "design.class.php";
            include "user.class.php";

            $user = new userclass();
            $user->checkCookie();

            $design = new designclass();
            $design->createHeader("Item Profile", "css/web_tech.css");
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
			        	$ItemId = $_GET['ItemId'];
			  			$user->getDB();
	
						//Admin: delete comments 
						if (isset($_SESSION['nick'])) {
						    if ($_SESSION['nick'] == 'Admin') {
						        if (isset($_POST['DeleteComment'])) {
						            $CommentId = $_POST['DeleteComment'];
						            mysql_query("DELETE FROM `Comments` WHERE CommentId = \"$CommentId\"");
						        }
						    }
						}
			      
			  		    // reads the informations of an event from the database and fills a html table
			 	        $query = "SELECT * FROM `Items` WHERE ItemId = $ItemId";
				        $result = mysql_query($query);
				        if ($result) {
				            $row = mysql_fetch_array($result);
          
				            echo "<h2>".$row['Title']."</h2>";
				            echo "
				                <table border='0' cellpadding ='5' width='60%'>
				                    <colgroup>
				                        <col width='10%'>
				                        <col width='80%'>
				                    </colgroup>
				                    <tr>
				                        <td style='font-weight:bold'>User</td>";
	
				                        if(isset($_SESSION["nick"]))
				                            echo "<td><a href='profile.php?nick=".$row['User']."' class='nav'>".$row['User']."</a></td>";
				                        else
				                            echo "<td>".$row['User']."</td>";
	
				            echo "  </tr>
				                    <tr>
				                        <td style='font-weight:bold'>Type</td>
				                        <td>".$row['Type']."</td>
				                    </tr>
				                    <tr>
				                        <td style='font-weight:bold'>Category</td>
				                        <td>".$row['Category']."</td>
				                    </tr>
				                    <tr>
			 	                       <td valign='top' style='font-weight:bold'>Description</td>
				                        <td style='text-align:justify;'>".$row['Description']."</td>
				                    </tr>
				                    <tr>
				                        <td style='font-weight:bold'>Date</td>
				                        <td>".date('d.m.o', strtotime($row['Date']))."</td>
				                    </tr>
				                    <tr>
				                        <td style='font-weight:bold'>Duration</td>
				                        <td>".$row['Duration']."</td>
				                    </tr>
				                    <tr>
				                        <td style='font-weight:bold'>Place</td>
				                        <td>".$row['Place']."</td>
				                    </tr>
				                    <tr>
				                        <td style='font-weight:bold'>E-Mail</td>
				                        <td>".$row['E-Mail']."</td>
				                    </tr>
									<tr>
				                        <td valign='top' style='font-weight:bold'>Picture</td>
				                        <td>"."<img src='".$row['Picture']."'></td>
				                    </tr>
				                    <tr>
				                        <td style='font-weight:bold'>Postingdate</td>
				                        <td>".date('d.m.o', strtotime($row['Postingdate']))."</td>
				                    </tr>
									<tr>
				                        <td style='font-weight:bold'>Share on Facebook</td>
				                        <td><a href='https://www.facebook.com/dialog/feed?
										  app_id=458358780877780&
										  link=".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']."&
										  picture=http://fbrell.com/f8.jpg&
										  name=Helping%20Hands&
										  caption=Item&
										  description=We%20need%20you!&
										  redirect_uri=https://mighty-lowlands-6381.herokuapp.com/'>Click here!</a></td>
				                    </tr>
				                </table>";
				        }

				        echo "<hr>";
   					
				        // makes a list of comments and a comment field for new comments for logged in users
				        echo "<h3><img src='./pictures/Bubble.jpg'> Comments:</h3>";

				        if (isset($_POST['formaction'])) {
				            if (empty($_POST['Content']))
				                   echo "<font color='red'>Please fill the comment-field!</font><br><br>";
				            else {
				                $query = "INSERT INTO Comments (ItemId, Date, User, Content)" .
				                         "VALUES (\"".$ItemId."\","
				                                 ."NOW(),"
				                                 ."\"".$_SESSION["nick"]."\","
				                                 ."\"".$_POST['Content']."\");";
				                mysql_query($query);
				            }
				        }

				        $query = "SELECT * FROM `Comments` WHERE ItemId=$ItemId";
				        $result = mysql_query($query);
				        $num_results = mysql_num_rows($result);
				        if ($result) {
				            if (!isset($_SESSION["nick"])) {
				                if ($num_results == 0) {
				                    echo "<font color='blue'>There are no comments for this event at the time!</font><br><br>";
				                }
				                else {
				                    for ($i=0; $i < $num_results; $i++) {
				                        $row = mysql_fetch_array($result);
				                        echo "
				                            <table cellpadding ='5' width='80%'>
				                                <tr>
				                                    <td style='font-weight:bold'>On ".date('d.m.o', strtotime($row['Date']))." by ".$row['User']."</td>
				                                </tr>
				                                <tr>
				                                    <td colspan='2' style='text-align:justify;'>".$row['Content']."</td>
				                                </tr>
				                            </table>
				                        ";
				                    }
				                }
				                echo "<br><font color='blue'>You have to be logged in to comment!</font><br><br>";
				            }
				            else {
				                if ("Admin" != $_SESSION["nick"]) {
				                    if ($num_results == 0) {
				                        echo "<font color='blue'>There are no comments for this event at the time!</font><br><br>";
				                    }
				                    else {
				                        for ($i=0; $i < $num_results; $i++) {
				                            $row = mysql_fetch_array($result);
				                            echo "
				                                <table cellpadding ='5' width='80%'>
				                                    <tr>
				                                        <td style='font-weight:bold'>On ".date('d.m.o', strtotime($row['Date']))." by <a href='profile.php?nick=".$row['User']."' class='nav'>".$row['User']."</a>:"."</td>
				                                    </tr>
				                                    <tr>
				                                        <td colspan='2' style='text-align:justify;'>".$row['Content']."</td>
				                                    </tr>
				                                </table>
				                            ";
				                        }
				                    }
				                    echo "
				                        <br><br>
				                        Enter a comment, if you like!<br><br>
				                        <form action='itemProfile.php?ItemId=$ItemId' method='post'>
				                            <textarea name='Content' cols='30' rows='5'></textarea>
				                            <br>
				                            <input type='submit' name='formaction' value='Submit'>
				                            <input type='reset' value='Reset'><br><br>
				                        </form>
				                    ";
				                    }
				                else {
				                    if ($num_results == 0) {
				                        echo "<font color='blue'>There are no comments for this event at the time!</font><br><br>";
				                    }
				                    else {
				                        for ($i=0; $i < $num_results; $i++) {
				                            $row = mysql_fetch_array($result);
				                            echo "
				                                <form action='itemProfile.php?ItemId=$ItemId' method='post'>
				                                    <table cellpadding ='5' width='80%'>
				                                        <tr>
				                                            <td style='font-weight:bold'>On ".date('d.m.o', strtotime($row['Date']))." by <a href='profile.php?nick=".$row['User']."' class='nav'>".$row['User']."</a>:"."</td>
				                                        </tr>
				                                        <tr>
				                                            <td colspan='2' style='text-align:justify;'>".$row['Content']."</td>
				                                        </tr>
				                                    </table>
				                                    <button name='DeleteComment' type='submit' value='".$row['CommentId']."'>Delete Comment</button><br>
				                                </form>
				                            ";  
				                        }
				                    }
				                    echo "
				                        <br><br>
				                        Enter a comment, if you like!<br><br>
				                        <form action='itemProfile.php?ItemId=$ItemId' method='post'>
				                        <textarea name='Content' cols='30' rows='5'></textarea>
				                        <br>
				                        <input type='submit' name='formaction' value='Submit'>
				                        <input type='reset' value='Reset'><br><br>
				                    </form>
				                    ";
				                }
				            }
				        }
					
					// delete, report, watchlist button, checks rights
					if(isset($_SESSION["nick"])) {
					    if($_SESSION["nick"] == "Admin") {
					        echo"
					            <form action='index.php' method='post'>
					                <button name='DeleteItem' type='submit' value='$ItemId'>Delete Item</button><br><br>
					            </form>";
					    }
					    else
					        echo "<input type='button' onclick='window.location.href=\"reportItem.php?ItemId=$ItemId\"' value='Report Item' name='report' /><br><br>";
							echo "<input type='button' onclick='window.location.href=\"watchlistItem.php?ItemId=$ItemId\"' value='Watchlist' name='watchlist' /><br><br>";
					}
					else
					    echo "<input type='button' onclick='window.location.href=\"reportItem.php?id=$ItemId\"' value='Report Item' name='report' /><br><br>";
				    ?>
			    </div>
			    <div id="calendar">
			    	<?php
						//include "cal.php";
				    ?>
				</div>
	        </div>
        </div>
    </body>
</html>