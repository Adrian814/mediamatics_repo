<?php
    include "ini_set.inc.php";
	// include "user.class.php";
	// $user = new userclass();
    $db = $user->getDB();
	var $url
    
    if (!$db) { 
        echo 'Error: Could not connect to database.';
        exit; 
    }
    
    $mysql = mysql_select_db('user_6b0d5c75');

    if(!$mysql) {
        echo 'Cannot select database.'; 
        exit;
    }

    // checks, if all fields were filled
    elseif (empty($_POST['Creator'])
            or empty($_POST['Type'])
			or empty($_POST['Category'])
            or empty($_POST['SampleYear']) or empty($_POST['SampleMonth']) or empty($_POST['SampleDay'])
            or empty($_POST['Place'])
            or empty($_POST['E-Mail'])) {
                echo "<font color='red'>Please fill all the mandatory fields!</font><br><br>
                <a href='./CreateEvent.php'>< Back to \"Create Event\"</a><br>";
            }
    else {
		if(empty($_POST['Picture']))
			$url = 'http://yourtimematters.com.au/wp-content/uploads/2012/11/iStock_000002090601XSmall.jpg';
		else $url = $_POST['Picture'];
	    // fills the events table in the database
	    $query = "INSERT INTO Events (Creator, Type, Title, Category, Description, Date, Duration, Place, E-Mail, Picture)"
	              ."VALUES (\"".$_SESSION["nick"]."\","
	                        ."\"".$_POST['Creator']."\","
	                        ."\"".$_POST['Type']."\","
							."\"".$_POST['Title']."\","
							."\"".$_POST['Category']."\","
							."\"".$_POST['Description']."\","
	                        ."\"".$_POST['SampleYear']."-".$_POST['SampleMonth']."-".$_POST['SampleDay']."\","
	                        ."\"".$_POST['Duration']."\","
	                        ."\"".$_POST['Place']."\","
	                        ."\"".$_POST[date("Y-m-d")]."\","
							."\"".$_POST['E-Mail']."\","
	                        ."\"".$_POST[$url]."\");";
	  	  //echo $query;
		  mysql_query($query);
   }
?>