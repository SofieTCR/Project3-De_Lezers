<?php
 // include("gemiddeldebedrag.php");
// $hostName = "localhost";
// $username = "root";
// $password = "";
// $databaseName = "de_lezers";
// $conn = new PDO("mysql:host=$hostName;dbname=$databaseName", $username, $password);
// $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
include("../Library/Database_Functions.php");

$MyDB = GetDatabase("localhost", "root", "", "de_lezers");


try {

$query = "SELECT klant.voornaam, klant.achternaam, productid, naam, soort, prijs FROM product, klant";
// $result = $conn->query($query);

$result = ExecuteQuerry($MyDB, $query);

 ?>
 <table border="1" cellpadding="10" cellspacing="0">
 <?php
 $sn=1;
 while($data = $result->fetch(PDO::FETCH_ASSOC)) {
   
   ?>
    <tr>
   <td><?php echo $sn; ?> </td>
   <td><?php echo $data['voornaam'] , $data['achternaam']; ?> </td>
   <td><?php echo $data['productid']; ?> </td>
   <td><?php echo $data['naam']; ?> </td>
   <td><?php echo $data['soort']; ?> </td>
   <td><?php echo $data['prijs']; ?> </td>
    </tr>
    <?php
  }
  ?>
</table>

  <?php
} catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
}


$query = "SELECT boek.Uitgever, AVG(product.prijs) FROM product, product_has_boek, boek WHERE product.productId = product_has_boek.Product_productId AND boek.boekId = product_has_boek.Boek_boekId GROUP BY boek.Uitgever"; 
	 
// $result = mysql_query($query) or die(mysql_error());
$result = ExecuteQuerry($MyDB, $query);


// resultaat uitprinten
while($row = $result->fetch(PDO::FETCH_ASSOC)) {
	echo "Gemiddelde prijs ". $row['Uitgever']. " is $".$row['AVG(product.prijs)'];
	echo "<br />";
}
?>