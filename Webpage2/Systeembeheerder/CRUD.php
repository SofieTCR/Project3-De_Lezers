<!DOCTYPE html>
<html lang="en">
<?php include("../Library/head.html"); ?>
<body>
    <?php include("../Library/menu.php"); ?>

    <!-- Page Code Goes Here -->

    <main id="Systeembeheerder_Main">
        <?php
            if (CheckAdministrator()) { // we are an admin, proceed
                $MyDB = GetDatabase("localhost", "root", "", "de_lezers");

                if (isset($_POST["table"])) {
                    CRUDDisplay($MyDB, $_POST["table"]); // Print all the stuff in the table
                }
                else {
                    $selection = "<form method=post class=Systeembeheer_CRUDDisplayselect><h3 class=Systeembeheer_CRUDDisplaytitle>Select table:</h3>";

                    $sql = "SHOW TABLES";
                    $query = ExecuteQuerry($MyDB, $sql);
                    $data =  $query->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($data as $dat) {
                        $selection .= "<input class=Systeembeheer_CRUDDisplayselectlink type=submit name=table value='" . $dat[array_keys($dat)[0]] . "'>";
                    }

                    $selection .= "</form>";
                    echo ($selection);
                }
            }
            else {
                header("Location: ../Homepage/home.php");
            }
        ?>
    </main>

    <?php include("../Library/footer.html"); ?>
</body>
</html>

