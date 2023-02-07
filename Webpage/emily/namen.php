<html>
</link rel="stylesheet" href="style.css">

<?php  include("../Menu/menu.php"); ?>

<?php

$a[0] = "Peter";
$a[1] = "Anne";
$a[2] = "Roos";

$b = array(10,11,12,34,100,1000);

echo '<table border="1" width="200">';
foreach($b as $value){
 // tr toevoegen en td
echo "<tr><td>";

 // print naam
 echo $value . "<br>";


 // afsluiten tr en td
 echo "</td></tr>";
}

echo '<table>';

echo "<br>";

?>