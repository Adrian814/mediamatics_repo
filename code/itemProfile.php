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

						//checks the user rights
						if (isset($_SESSION['nick'])) {
						    if ($_SESSION['nick'] == "Admin") {
						        if (isset($_POST['DeleteComment'])) {
						            $CommentId = $_POST['DeleteComment'];
						            mysql_query("DELETE FROM `Comments` WHERE CommentId = \"$CommentId\"");
						        }
						    }
						}
			      
			  		    // reads the informations of an event from the database and fills a html table
			 	        $query = "SELECT * FROM `Items` WHERE ItemId=$ItemId";
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
				                        <td style='font-weight:bold'>Creator</td>";
	
				                        if(isset($_SESSION["nick"]))
				                            echo "<td><a href='profile.php?nick=".$row['Creator']."' class='nav'>".$row['Creator']."</a></td>";
				                        else
				                            echo "<td>".$row['Creator']."</td>";
	
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
				                </table>";
				        }

				        echo "<hr>";
   
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