<!DOCTYPE html>
<html lang="en">
<?php include("../Library/head.html"); ?>
<body>
    <?php include("../Library/menu.php"); ?>
    <!-- Page Code Goes Here --> 

    <main id="Inlog_Main">
        <div id="Inlog_Div">
            <form method="post" id="Login_Form">
                <div class="Inlog_Row"><label>Username: </label><input type="text" name="uname" required></div><br>
                <div class="Inlog_Row"><label>Password: </label><input type="password" name="pword" required></div><br>
                <input id="Inlog_Submit" type="submit" name="submit" value="Inloggen">
            </form>
            <?php
                if (isset($_POST["submit"])) {
                    // Include the db functions
                    include("../Library/Database_Functions.php");

                    // Enable the session if not already enabled
                    if (!isset($_SESSION)) {
                        session_start();
                    }

                    // Get the db ready.
                    $MyDB = GetDatabase("localhost", "root", "", "de_lezers");
    
                    if ($MyDB != null) {

                        $_SESSION["klantid"] = 0;
                    
                        header("Location: ../Homepage/home.php");
                    }
                    else {
                        echo "Error! 401 Database not found!";
                    }
                }
            ?>
            <p>Nog geen account? </p><a style="color: white;" href="../Inlog/Aanmeld.php">Aanmelden</a>
        </div>
    </main>

    <?php include("../Library/footer.html"); ?>
</body>
</html>