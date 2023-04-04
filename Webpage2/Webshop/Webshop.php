<!DOCTYPE html>
<html lang="en">
<?php include("../Library/head.html"); ?>
<body>
    <?php include("../Library/menu.php"); ?>

    <?php
        //include("../Library/Database_Functions.php"); // niet meer nodig want het menu includes het

        $MyDB = GetDatabase("localhost", "root", "", "de_lezers");
        
        if ($MyDB != null) {
            $query = ExecuteQuerry($MyDB, "SELECT * FROM product ORDER BY product.naam ASC");

            $result =  $query->fetchAll(PDO::FETCH_ASSOC);
            
            $Products = "";

            foreach ($result as $product) {
                // Draw Products
                $Products .= "<section class=Webshop_Product>";
                $Products .= "<div class=Webshop_Product_Topbar>";
                $Products .= "<p class=Webshop_Product_Title>" . $product['naam'] . "</p>";
                $Products .= "<p class=Webshop_Product_Price>€" . number_format($product['prijs'], 2, ".") . "</p>";
                $Products .= "</div>";
                $Products .= "<div class=Webshop_Product_Imgdiv><img class=Webshop_Product_Img alt='" . $product['naam'] . "_foto' src=../img/ProductImages/" . $product['fotoURL'] . "></div>";
                $Products .= "</section>";
            }
        
        }
    ?>
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