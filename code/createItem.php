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
            $design->createHeader("Helping Hands > Create Item", "css/web_tech.css");
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
				    else {
						include 'Date.php'; // this file is needed for the date fields of the form
				        //form
				        echo"
				            <h2>Create New Item</h2>
				            Please enter all the necessary information about your item!<br><br>
				            <form action='index.php' method='post'>
				                <table border='0' cellpadding ='5'>
				                    <colgroup>
				                        <col width='100'>
				                        <col>
				                    </colgroup>
				                    <tr>
				                        <td>Type*</td>
				                        <td><input name='Type' type='text' size='30' maxlength='30'></td>
				                    </tr>
				                    <tr>
				                        <td>Title*</td>
				                        <td><input name='Title' type='text' size='30' maxlength='30'></td>
				                    </tr>
									<tr>
				                        <td>Category*</td>
				                        <td>
											<select name='Category'>
					                            <option value='Random Acts of Kindness'>Random Acts of Kindness</option>
					                            <option value='Gifts'>Gifts</option>
					                            <option value='Donation'>Donation</option>
												<option value='Volunteering'>Volunteering</option>
												<option value='Wish'>Wish</option>
												<option value='Information'>Information</option>
												<option value='Emergency'>Emergency</option>
												<option value='Sharing'>Sharing</option>
												<option value='Engagement'>Engagement</option>
												<option value='Benefit'>Benefit</option>
												<option value='Idea'>Idea</option>								
					                        </select>
										</td>
				                    </tr>
									<tr>
					                    <td valign='top'>Description</td>
					                    <td><textarea name='Description' cols='50' rows='10'></textarea></td>
					                </tr>
				                    <tr>
				                        <td>Date*</td>
				                        <td>"?><?php DateSelector("Sample")?><?php echo "</td>
				                    </tr>
				                    <tr>
				                        <td>Duration</td>
				                        <td><input name='Duration' type='text' size='30' maxlength='30'></td>
				                    </tr>
									<tr>
					                    <td>Place*</td>
					                    <td><input name='Place' type='text' size='30' maxlength='30'></td>
					                </tr>
				                    <tr>
				                        <td>E-Mail</td>
				                        <td><input name='E-Mail' type='text' size='30' maxlength='30'></td>
				                    </tr>
				                    <tr>
				                        <td>Picture</td>
				                        <td><input name='Picture' type='text' size='100' maxlength='30'></td>
				                    </tr>
				                </table><br>
				                <input type='submit' name='createItem_form' value='Submit'>
				                <input type='reset' value='Reset'>
				            </form><p>
				            * mandatory!</p>";
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