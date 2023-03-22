

<!DOCTYPE html>
<html lang="en">
<?php include("../Library/head.html"); ?>
<body>
    <?php include("../Library/menu.php"); ?>
    <!-- Page Code Goes Here --> 

    <main id="Inlog_Main">
        <div id="Inlog_Div">
            <form method="post" id="Login_Form">
                <div>Username: <input type="text" name="uname"></div> 
                <div>Password: <input type="password" name="pword"></div> 
                <input id="Login_Submit" type="submit" name="submit" value="Inloggen">
            </form>
            <?php
                if (isset($_POST["submit"])) {
                    session_start();

                    $_SESSION["klantid"] = 0;
                    
                    header("Location: ../Homepage/home.php");
                }
            ?>
        </div>
    </main>

    <?php include("../Library/footer.html"); ?>
</body>
</html>