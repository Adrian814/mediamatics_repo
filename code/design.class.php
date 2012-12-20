<?php
/**
 * The class is responsible for the design of the website. 
 *
 * @author Adrian Siuda, Tobias Sennhauser
 * created on: 3.11.2009
 */
class designclass {

    /**
     *
     * @param String $title The title for this page.
     * @param String $css The CSS file to be used for this page.
     */
    function createHeader($title, $css)
    {
        echo '<title>' . $title . '</title>';
        echo '<link rel="stylesheet" type="text/css" href="'. $css . '">';
        echo '<meta http-equiv="content-type" content="text/html; charset=utf-8">';
        echo '<script type="text/javascript" src="js/month.js"> </script>';
    }

    /**
     * This functions draws the navigation panel on top of the website.
     *
     * @param String $navigation The CSS id name for the whole navigation container.
     * @param String $logo The CSS id for the logo.
     * @param String $title The CSS id for the title.
     * @param String $nav The CSS id for the navigation (horizontal set of links).
     * @param String $nav_class The CSS class which defines the look of the links.
     * @param String $login The CSS id for the login-part (top-right).
     */
    function createNavigation($navigation, $logo, $title, $nav, $nav_class, $login)
    {
        echo '<div id="' . $navigation . '">';
        echo '<div id="' . $logo . '">';
        echo '<a href="index.php">
                <img src="pictures/BlackFlagSymbol4.png" alt="Black Flag" style="border-style:none">
              </a>';
        echo '</div>';
        echo '<div id="' . $title . '">';
        echo '<a href="index.php" style="text-decoration:none; color:black;">Helping Hands</a>';
        echo '</div>';
        echo '<div id="' . $nav . '">';

        echo '<a href="index.php" class="' . $nav_class . '">Items</a>   ';
        if (isset($_SESSION["nick"])) {
            echo '<a href="createItem.php" class="' . $nav_class . '">Create New Item</a>   ';
			echo '<a href="watchlist.php" class="' . $nav_class . '">My Watchlist</a>   ';
            if ($_SESSION["nick"] == "Admin") {
                echo '<a href="adminuser.php" class="' . $nav_class . '">User</a> ';
            }
        }
		echo '<a href="informations.php" class="' . $nav_class . '">Informations</a>   ';
		echo '<a href="links.php" class="' . $nav_class . '">Links</a>   ';
		echo '<a href="http://www.cafepress.com/" class="' . $nav_class . '">Shop</a>   ';
		echo '<a href="help.php" class="' . $nav_class . '">Help</a>   ';
		echo '<a href="agb.php" class="' . $nav_class . '">AGV</a>   ';
		echo '<a href="about.php" class="' . $nav_class . '">About</a>';
        echo '</div>';

        echo '<!-- Login -->';
        echo '<div id="' . $login . '">';
        if(isset($_SESSION["nick"]))
        {
            echo '<a href="settings.php" class="' . $nav_class . '">' . $_SESSION["nick"] . '</a> <br>';
            echo '<a href="logout.php" class="' . $nav_class . '">Logout</a> <br>';
        }
        else // logged out
        {
            echo '<a href="login.php" class="' . $nav_class . '">Login</a> <br>';
            echo '<a href="signup.php" class="' . $nav_class . '">Sign Up!</a> <br>';
        }

        echo '</div>'; 


/*
        
        echo '<a href="about.php" class="' . $nav_class . '">About</a>'; */
       // echo '</div>';
        echo '</div>';

    }

    function createCalendar()
    {
       echo "<div id='calendar'>";
       include "cal.php";
       echo "</div>";
    }
}?>