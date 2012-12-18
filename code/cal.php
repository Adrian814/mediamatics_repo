<?php
	// generates the quote
	$result = mysql_query("SELECT * FROM `Quotes`");
	$num_results = mysql_num_rows($result);
	$randomId = rand(1, $num_results);
	echo $randomId;
	$result2 = mysql_query("SELECT * FROM `Quotes` WHERE QuoteId = '".$randomId."';");
	$row = mysql_fetch_array($result2);
	$quote = $row['Text'];
	echo $quote;
	echo 'Test';
?>
