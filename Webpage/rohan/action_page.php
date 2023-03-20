<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Action php</title>
</head>
<body>
    <?php
    
    $a[0] = "Jan";
    $a[1] = "Rob";
    $a[2] = "Piet";

    echo '<table border="1" width "200">';
    if (isset ($_POST)){
        echo "<tr><td>";
        echo ("Username: " . $_POST["uname"] . "<br>");
        echo "</td></tr>";
        echo "<tr><td>";
        echo ("Password: " . $_POST["password"]);
        echo "</td></tr>";
    } 
    foreach($a as $value){
        echo "<tr><td>";
        echo $value . "<br>";
        echo "</td></tr>";
        
    }
    ?>
      <?php
    echo "Today is " . date("y/m/d") . "<br>"; ?>
<?php
    $len = strlen($_POST ['uname']);

    if ($len < 5){
        echo "Username groter  dan 4 tekens<br>";
    }

    elseif($len > 10){
        echo "username moet korter dan 10";
    }
   ?>

</body>
</html>
