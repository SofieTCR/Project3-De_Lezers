<?php
    include("../Library/Database_Functions.php");

    $MyDB = GetDatabase("localhost", "root", "", "de_lezers");
    
    if ($MyDB != null) {
        $query = ExecuteQuerry($MyDB, "SELECT * FROM product");

        $result =  $query->fetchAll(PDO::FETCH_ASSOC);
        
        $Products = "";

        foreach ($result as $product) {
            // Draw Products
            $Products .= "<section class=Webshop_Product>";
            $Products .= "<p class=Webshop_Product_Title>" . $product['naam'] . "</p>";
            $Products .= "<p class=Webshop_Product_Price>" . $product['prijs'] . "</p>";
            $Products .= "<img class=Webshop_Product_Img alt='" . $product['naam'] . "_foto' src=../img/ProductImages/" . $product['fotoURL'] . ">";
            $Products .= "</section>";
        }
    
    }
    

?>


<!DOCTYPE html>
<html lang="en">
<?php include("../Library/head.html"); ?>
<body>
    <?php include("../Library/menu.php"); ?>
    <!-- Page Code Goes Here --> 

    <main id="Webshop_Main">
        <section id="Webshop_FilterDiv"> <!-- Section for filter -->
            <h1>Filter:</h1>
        </section>
        <section id="Webshop_ProductDiv"> <!-- Section for products -->
            <section id="Webshop_SearchBar">
                <h1>Search:</h1>
            </section>
            <!-- echo all the products in here -->
            <?php echo($Products); ?>
        </section>
    </main>

    <?php include("../Library/footer.html"); ?>
</body>
</html>