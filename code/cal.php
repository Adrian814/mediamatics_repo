<?php
	// generates the quote
	$result = mysql_query("SELECT * FROM `Quotes`");
	$num_results = mysql_num_rows($result);
	$randomId = rand(1, $num_results);
	$result2 = mysql_query("SELECT * FROM `Quotes` WHERE QuoteId = '".$randomId."';");
	$row = mysql_fetch_array($result2);
	$quote = $row['Text'];
	echo $quote;
	echo '<br><br>
		  <a href="index.php"><img src="http://unitedwaycalvert.org/images/banner160x370-Side-Banner-2.jpg" alt="banner" style="border-style:none"></a>';
	echo "<br><br>
		  <script language='javascript'type='text/javascript'>function FG_4ccb04fb46c30_loadScript(){var fgScriptUrl='http://donate.firstgiving.com/dpa/static/js/site/fg_consumer_donation_opener.min.js';var script=document.createElement('script');script.type='text/javascript';if(script.readyState){script.onreadystatechange=function(){if(script.readyState=="loaded"||script.readyState=="complete"){script.onreadystatechange=null}}}else{script.onload=function(){}}script.src=fgScriptUrl;document.body.appendChild(script)}FG_4ccb04fb46c30_loadScript();</script></script> 

		<!-- Basic information about this charity. You may remove this DIV if you do not need it displayed -->
		<div style='width: 200px;'><div id='fgOrganizationName'><strong>INTERNATIONAL RESCUE COMMITTEE INC</strong></div>NEW YORK10168<br /><strong>EIN:</strong>135660870</div>
		<!-- Donation Button block -->
		<div id='fg_donation-button-block'>
		<!-- The Donation Button. You can restyle this to fit with your site design by removing the inline style elements. -->
		<a href='javascript:void(0)' id='b7e806c8-edd0-11df-ab8c-4061860da51d' class='fg-donation-button-4ccb04fb46c30' onclick='FG_DONATE_BUTTON.openDonationWindow(this, 'https://donate.firstgiving.com'); return false;' style='text-indent: -999999px; background: url(http://donate.firstgiving.com/dpa/static/img/consumer_donation_button.png) no-repeat; width: 202px; height: 62px; display: block; pointer: cursor; outline: 0;'>Donate Now</a>
		<!-- Get this FirstGiving Donation Button block. You may remove this if it does not fit with your design. -->
		<div id='fg_get-this-action' style='width: 200px; margin-top: 5px;'>
		<a href='javascript:void(0)' style='text-decoration: none;'>
		<span style='background: url(http://donate.firstgiving.com/dpa/static/img/consumer_donation_button.png) no-repeat -15px -62px; width: 15px; height: 20px; float: left; margin-left: 15px;'></span>
		<span style='vertical-align: middle; color: #666666; font-size: 12px; font-weight: bold; margin-left: 10px; line-height: 18px;'>Get This FirstGiving Button</span>
		</a>
		</div>
		</div>";
?>
