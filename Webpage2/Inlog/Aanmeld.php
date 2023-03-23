<!DOCTYPE html>
<html lang="en">
<?php include("../Library/head.html"); ?>
<body>
    <?php include("../Library/menu.php"); ?>
    <!-- Page Code Goes Here --> 

    <main id="Aanmeld_Main">
        <div id="Aanmeld_Div">
            <form method="post" id="Aanmeld_Form">
                <div class="Aanmeld_Row"><label>Username: </label><input type="text" name="Username" required></div><br>
                <div class="Aanmeld_Row"><label>Password: </label><input type="text" name="Password" required></div><br>
                <div class="Aanmeld_Row"><label>Voornaam: </label><input type="text" name="Voornaam" required></div><br>
                <div class="Aanmeld_Row"><label>Achternaam: </label><input type="text" name="Achternaam" required></div><br>
                <div class="Aanmeld_Row"><label>Geboorte Datum: </label><input type="date" name="Gebdatum" required></div><br>
                <div class="Aanmeld_Row"><label>Straat + Huisnummer: </label><input type="text" name="Adres" required></div><br>
                <div class="Aanmeld_Row"><label>Postcode: </label><input type="text" name="Postcode" required></div><br>
                <div class="Aanmeld_Row"><label>Plaats: </label><input type="text" name="Plaats" required></div><br>
                <div class="Aanmeld_Row"><label>E-Mail: </label><input type="email" name="Email"></div><br>
                <div class="Aanmeld_Row"><label>Telefoon: </label><input type="tel" name="Telefoon"></div><br>
                <input id="Aanmeld_Submit" type="submit" name="submit" value="Aanmelden">
            </form>
            <?php
                if (isset($_POST["submit"])) {

                    // Get the db ready.
                    $MyDB = GetDatabase("localhost", "root", "", "de_lezers");

                    if ($MyDB != null) {

                        // Check if no user exists with this username
                        $sql = "SELECT * FROM klant WHERE klant.Username = '" . $_POST["Username"] . "'";
                        $query = ExecuteQuerry($MyDB, $sql);
                        $result = $query->fetchAll(PDO::FETCH_ASSOC);

                        if (count($result) != 0) { // if there's no existing user, proceed. else, throw an error to the user
                            echo "Username is in gebruik. Probeer een ander!";
                            exit;
                        }

                        $sql = "INSERT INTO klant (Voornaam, Achternaam, Gebdatum, Adres, Plaats, Postcode, Username, Password";

                        if ($_POST["Email"] != "") {
                            $sql .= ", Email";
                        }
                        if ($_POST["Telefoon"] != "") {
                            $sql .= ", Telefoon";
                        }

                        $sql .= ") VALUES (";

                        // Add values to SQL string
                        $sql .= "'" . $_POST["Voornaam"] . "', ";
                        $sql .= "'" . $_POST["Achternaam"] . "', ";
                        $sql .= "'" . $_POST["Gebdatum"] . "', ";
                        $sql .= "'" . $_POST["Adres"] . "', ";
                        $sql .= "'" . $_POST["Plaats"] . "', ";
                        $sql .= "'" . $_POST["Postcode"] . "', ";
                        $sql .= "'" . $_POST["Username"] . "', ";
                        $sql .= "'" . $_POST["Password"] . "'";
                        if ($_POST["Email"] != "") {
                            $sql .= ", '" . $_POST["Email"] . "'";
                        }
                        if ($_POST["Telefoon"] != "") {
                            $sql .= ", '" . $_POST["Telefoon"] . "'";
                        }
                        $sql .= ");";

                        //echo $sql; // print the string to check its correct.

                        try {
                            ExecuteQuerry($MyDB, $sql);
                            // Enable the session if not already enabled
                            if (!isset($_SESSION)) {
                                session_start();
                            }

                            $sql = "SELECT klant.klantId FROM klant WHERE klant.Username = '" . $_POST["Username"] . "'";

                            //echo $sql; // print the string to check its correct.

                            $query = ExecuteQuerry($MyDB, $sql);
                            $result = $query->fetchAll(PDO::FETCH_ASSOC);

                            //echo $result[0]["klantId"];

                            $_SESSION["klantId"] = $result[0]["klantId"];

                            header("Location: ../Homepage/home.php");

                        } catch (PDOException $th) {
                            Echo "Error: 402 Unable to write to database! <br><br>" . $th;
                        }
                        
                    }
                    else {
                        echo "Error! 401 Database not found!";
                    }
                }
            ?>
            <p>Al een account? </p><a style="color: white;" href="../Inlog/Inlog.php">Inloggen</a>
        </div>
    </main>

    <?php include("../Library/footer.html"); ?>
</body>
</html>