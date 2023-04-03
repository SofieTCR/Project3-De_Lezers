<!DOCTYPE html>
<html lang="en">
<?php include("../Library/head.html"); ?>
<body>
    <?php include("../Library/menu.php"); ?>

    <!-- Page Code Goes Here -->

    <main id="Systeembeheerder_Main">
        <div id="Aanmeld_Div">
        <?php
            if (CheckAdministrator()) { // we are an admin, proceed
                $MyDB = GetDatabase("localhost", "root", "", "de_lezers");

                if(isset($_POST["submit"])) {
                    CRUDEdit($MyDB, $_POST["table"], $_POST["submit"], GetPrimaryKeys($_POST)); // Call the editing page
                }
                else {
                    header("Location: ../Systeembeheerder/CRUD.php");
                }
            }
            else {
                header("Location: ../Homepage/home.php");
            }
        ?>
        </div>
    </main>

    <?php include("../Library/footer.html"); ?>
</body>
</html>

