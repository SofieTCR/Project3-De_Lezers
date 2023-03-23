<!DOCTYPE html>
<html lang="en">
<?php include("../Library/head.html"); ?>
<body>
    <?php include("../Library/menu.php"); ?>
    <!-- Page Code Goes Here --> 

    <main id="Inlog_Main">
        <div id="Inlog_Div">
            <form method="post" id="Login_Form">
                <div class="Inlog_Row"><label>Username: </label><input type="text" name="Username" required></div><br>
                <div class="Inlog_Row"><label>Password: </label><input type="password" name="Password" required></div><br>
                <input id="Inlog_Submit" type="submit" name="submit" value="Inloggen">
            </form>
            <?php
                if (isset($_POST["submit"])) {

                    // Enable the session if not already enabled
                    if (!isset($_SESSION)) {
                        session_start();
                    }

                    // Get the db ready.
                    $MyDB = GetDatabase("localhost", "root", "", "de_lezers");
    
                    if ($MyDB != null) {
                        try {
                            // Start by checking if the Username exists in the database
                            $sql = "SELECT * FROM klant WHERE klant.Username = '" . $_POST["Username"] . "'";
                            $query = ExecuteQuerry($MyDB, $sql);
                            $result = $query->fetchAll(PDO::FETCH_ASSOC);

                            if (count($result) == 0) { // if there's no existing user, proceed. else, throw an error to the user
                                echo "Username is onjuist!";
                                exit;
                            }

                            // if we get to this point the username was accepted

                            // Start by checking if the Username exists in the database
                            $sql = "SELECT * FROM klant WHERE klant.Username = '" . $_POST["Username"] . "' AND klant.Password = '" . $_POST["Password"] . "'";
                            $query = ExecuteQuerry($MyDB, $sql);
                            $result = $query->fetchAll(PDO::FETCH_ASSOC);

                            if (count($result) == 0) { // if there's no existing user, proceed. else, throw an error to the user
                                echo "Password is onjuist!";
                                exit;
                            }

                            $sql = "SELECT klant.klantId FROM klant WHERE klant.Username = '" . $_POST["Username"] . "'";

                            //echo $sql; // print the string to check its correct.

                            $query = ExecuteQuerry($MyDB, $sql);
                            $result = $query->fetchAll(PDO::FETCH_ASSOC);

                            //echo $result[0]["klantId"];

                            $_SESSION["klantId"] = $result[0]["klantId"];
                        
                            header("Location: ../Homepage/home.php");
                        }
                        catch (PDOException $th) {
                            Echo "Error: 403 Unable to read from the database! <br><br>" . $th;
                        }
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