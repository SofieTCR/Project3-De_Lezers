<?php
    $Products = "<section class=Webshop_Product></section>"
    

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