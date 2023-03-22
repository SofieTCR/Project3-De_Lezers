<?php include("../Library/menu.php"); ?>

<?php

$average = mysql_query(
    "SELECT product.prijs FROM product, boek, product_has_boek
    WHERE product.productId = product_has_boek.Product_productId AND boek.boekId = product_has_boek.Boek_boekId AND boek.Uitgever = "";");
    while($row = mysql_fetch_array($average)){
echo $row['PriceAverage'];
}

?>