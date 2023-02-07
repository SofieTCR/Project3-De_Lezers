<?php
include("../Menu/menu.php");

var_dump($_POST);

echo"Hello " . $_POST['usern'] . "<br><br>";

echo "Username: " . $_POST['usern'] . "<br>";

echo "Password: " . $_POST['pwd'] . "<br>";

?>