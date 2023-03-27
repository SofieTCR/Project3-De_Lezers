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

                CRUDDisplay($MyDB, "product"); // unfinished
            }
            else {
                header("Location: ../Homepage/home.php");
            }
        ?>
    </main>

    <?php include("../Library/footer.html"); ?>
</body>
</html>

