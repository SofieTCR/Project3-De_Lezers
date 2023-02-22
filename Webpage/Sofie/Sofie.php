<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sofie's Pagina</title>
</head>
<body>
    <?php  include("../Menu/menu.php"); ?>
    Hallo dit is sofie's pagina.
    <?php 
        echo("Het is vandaag: " . date("l"));

    ?>

    <form action="./action_page.php" method="post">
        <input type="text" name="uname" id="uname"><br>
        <input type="password" name="pword" id="pword"><br>
        <input type="submit">
    </form>
</body>
</html>