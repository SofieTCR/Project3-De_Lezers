<header>

<ul class="ul_menu">
    <p class="p_menulogo">De Lezers</p>
    <li class="menu_li"><a href="../Homepage/home.php">Home</a></li>
    <li class="menu_li"><a href="../Medewerkerspage/Medewerkers.php">Personeels</a></li>
    <li class="menu_li"><a href="../Webshop/Webshop.php">Webshop</a></li>
    <li class="menu_li"><a href="../LeveringRetour/Leveringretour.php">Retour Policy</a></li>
    <li class="menu_li"><a href="#">Milleu</a></li>
    <li class="menu_li"><a href="#">Contact</a></li>
    <?php
        // Enable the session if not already enabled
        if (!isset($_SESSION)) {
            session_start();
        }
        
        // Check if you're logged in by checking the existence of a user id. 
        if (isset($_SESSION["klantId"])) {
            //echo "logged in";
            // if administrator

            // Include the db functions
            include("../Library/Database_Functions.php");

            // Get the db ready.
            $MyDB = GetDatabase("localhost", "root", "", "de_lezers");
        
            echo "<li class=menu_li><a href=../Systeembeheerder>Beheer</a></li>";

        }
        else {
            echo "<li class=menu_li><a href=../Inlog/Inlog.php>Login</a></li>";
        }

    ?>
</ul>
</header>
