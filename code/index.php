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
            $design->createHeader("Helping Hands", "css/web_tech.css");

            if(isset($_POST["createEvent_form"]))
            {
                include "EventCreated.php";
            }
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
                	echo "<br>";
            		$db = mysql_connect("a.db.shared.orchestra.io", "user_6b0d5c75", "bTh4cEKXeAtx!o") or die(mysql_error());
   					mysql_select_db("db_6b0d5c75", $db) or die(mysql_error());

				    $dateSelected = 0;
				    $Seite = 0;

				    if (!$db) {
				        echo 'Error: Could not connect to database.';
				        exit;
				    }

				    $mysql = mysql_select_db('db_6b0d5c75');
				    if(!$mysql) {
				        echo 'Cannot select database.';
				        exit;
				    }
    
				    // deletes events, when the admin clicked on the delete event button in the event profile
				    if (isset($_SESSION["nick"])) {
				        if($_SESSION["nick"] == "Admin") {
				            if (isset($_POST['DeleteEvent'])) {
				                $EventId = $_POST['DeleteEvent'];
				                mysql_query("DELETE FROM `Events` WHERE EventId = \"$EventId\"");
				                mysql_query("DELETE FROM `Comments` WHERE EventId = \"$EventId\"");
				            }
				        }
				    }
/*
    // prepares the query for the order of the list
    if (isset($_GET['Order'])) {
        if (($_GET['Order']) == "Date") {
            $query = 'SELECT * FROM `Events` ORDER BY `Date` ASC';
            $dateSelected="selected";
            $Order="Date";
        }
        elseif (($_GET['Order']) == "Points") {
        $query = 'SELECT * FROM `Events` ORDER BY `Points` DESC';
        $pointsSelected="selected";
        $Order="Points";
        }
        elseif (($_GET['Order']) == "Participants") {
        $query = 'SELECT * FROM `Events`ORDER BY `Participants` DESC';
        $participantsSelected="selected";
        $Order="Participants";
        }
    }
    else {
        $query = 'SELECT * FROM `Events` ORDER BY `Date` ASC';
        $dateSelected="selected";
        $Order="Date";
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
*/

    $Nav = $BeginningLink;
    $Nav .= $BackLink;
    $Nav .= $SkipCharactersFront;
    $Nav .= $ViewableLinks;
    $Nav .= $SkipCharactersBack;
    $Nav .= $ContinueLink;
    $Nav .= $EndLink;
    
/*
    //select menu for order             
    echo "
    <table width='100%'>
    <td>
        <form action='index.php' method='get'>
            <label for='Order'>Sort by:</label>
                        <select type='submit' name='Order' size='1' OnChange ='submit()'>
                            <option $dateSelected>Date</option>
                            <option $pointsSelected>Points</option>
                            <option $participantsSelected>Participants</option>
                        </select>
        </form>
    </td>
    <td>
        <p align='right'>$Nav<p>
    </td>
    </table>
    ";
*/

    // generates the list of events
    $result = mysql_query($query);
    if ($result) {
    	$num_results = mysql_num_rows($result);
    for ($i=0; $i < $num_results; $i++) {
        $row = mysql_fetch_array($result);
        $Description = substr($row['Description'], 0, 200);

    echo "
    <form action='index.php?Order=$Order&Page=$Page&Total=$Total' method='post'>
        <table>
            <tr>
	            <a href=EventProfile.php?EventId=". $row['EventId'] ." class='adi'>"
	            .$row['Title']
	            ." [".$row['Category']."]: </a>
            </tr>
            <tr>
                <td colspan='2', rowspan='2' valign='top' id='event_descr'>
                    $Description
                    <br><a class='adi' href='"."EventProfile.php?EventId=".$row['EventId']."'style='font-style:italic;'> more...<a>
                </td>
            </tr>
            <br>
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