<?php
	// generates the quote
	$result = mysql_query("SELECT * FROM `Quotes`");
	$num_results = mysql_num_rows($result);
	$randomId = rand(1, $num_results);
	$result2 = mysql_query("SELECT * WHERE QuoteId = ".$randomId." FROM `Quotes`");
	$row = mysql_fetch_array($result2);
	$quote = $row['Text'];
	echo $quote;
	echo 'Test';
?>
