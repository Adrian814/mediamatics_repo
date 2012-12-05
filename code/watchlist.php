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
					
       	echo "<br>";
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
	
	    // page navigation
	    if (!isset($_REQUEST['Total'])) {
	        $result = mysql_query($query);
	        $Total = mysql_num_rows($result);
	        unset($result);
	    }
	    else
	        $Total = $_REQUEST['Total'];

	    if (!isset($_REQUEST['Page']))
	        $Page = 1;
	    else
	        $Page = $_REQUEST['Page'];
	    if ($Page > $Total)
	        $Page = $Total;

	    $PerPage = 7;
	    $LinkNumber = 3;
	    $PageNumber = ceil($Total/$PerPage);
	    if ($LinkNumber % 2 == 0)
	        $LinkNumber++;
	    $NumericLinks = ($LinkNumber - 1) / 2;
	    $url = $_SERVER['PHP_SELF'] . "?Order=$Order";

	    $query .= " limit ". ($Page * $PerPage - $PerPage) .", ".$PerPage;
	    $result = mysql_query($query);

	    $SkipCharactersFront = '';
	    $SkipCharactersBack = '';
	    $BeginningLink = '';
	    $EndLink = '';
	    $BackLink = '';
	    $ContinueLink = '';
	    $ViewableLinks = '';

	    if ($PageNumber > 1) {
	        $Nr = $Page - $NumericLinks;
	        $Display = 0;
	        while ($Nr <= $PageNumber) {
	            if ($Nr < 1) {
	                $Nr++;
	                continue;
	            }
	            elseif ($Nr > $Page + $NumericLinks)
	                break;
	        if ($Nr == $Page)
	            $ViewableLinks .= "<font style='font-weight:bold'> $Nr </font>";
	        else
	            $ViewableLinks .= '<a  class="adi" href="'.$url.'&Page='.$Nr.'&Total='.$Total.'">'.$Nr.'</a>';
	        $Nr++;
	        $Display++;
	        }
	    }

	    if ($Page > 1) {
	        $BeginningLink = '<a class="adi" href="'.$url.'&Page=1&Total='.$Total.'">Beginning </a>' . ' ';
	        if ($Page - 1 > 1)
	          $BackLink = ' ' . '<a  class="adi"href="'.$url.'&Page='.($Page - 1).'&Total='.$Total.'">Back </a>';
	    }

	    if ($Page < $PageNumber) {
	        $EndLink = ' ' . '<a class="adi" href="'.$url.'&Page='.$PageNumber.'&Total='.$Total.'"> End</a>';
	        if ($Page + 1 < $PageNumber)
	        $ContinueLink = '<a class="adi" href="'.$url.'&Page='.($Page+1).'&Total='.$Total.'"> Continue</a>' . ' ';
	    }

	    if ($Page - $NumericLinks > 1)
	        $SkipCharactersFront = '... ';
	    if ($Page + $NumericLinks < $PageNumber)
	        $SkipCharactersBack = ' ...';

	    $Nav = $BeginningLink;
	    $Nav .= $BackLink;
	    $Nav .= $SkipCharactersFront;
	    $Nav .= $ViewableLinks;
	    $Nav .= $SkipCharactersBack;
	    $Nav .= $ContinueLink;
	    $Nav .= $EndLink;

	    // generates the list of events
		$query1 = 'SELECT * WHERE `User` = $user FROM `Watchlist` ORDER BY `Date` DESC';
	    $result1 = mysql_query($query1);
	    if ($result1) {
	    	$num_results1 = mysql_num_rows($result1);
		    for ($i=0; $i < $num_results1; $i++) {
		        $row1 = mysql_fetch_array($result1);
		        $ItemId = $row1['ItemId']
				$query2 = 'SELECT * WHERE `ItemId` = $ItemId FROM `Events` ORDER BY `Date` DESC';
				$result2 = mysql_query($query2);
				$row2 = mysql_fetch_array($result2);
			    echo "
					<form action='index.php?Order=$Order&Page=$Page&Total=$Total' method='post'>
			       	 	<table>
					        <td>
					            <tr>
						            <b><a href=EventProfile.php?EventId=". $row2['EventId'] ." class='adi'>".$row2['Title']." [".$row2['Category']."]: </a><b>
					            </tr>
					            <tr>
					                <td colspan='2', rowspan='2' valign='top' id='event_descr'>
					                    $Description
					                    <br><a class='adi' href='"."EventProfile.php?EventId=".$row2['EventId']."'style='font-style:italic;'> more...<a>
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
        ?>
                </div>
                <div id="calendar">
                    <?php
                        include "cal.php";
                        //include "Calendar.php";
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>