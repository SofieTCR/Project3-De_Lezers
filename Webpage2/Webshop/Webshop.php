<!DOCTYPE html>
<html lang="en">
<?php include("../Library/head.html"); ?>
<body>
    <?php include("../Library/menu.php"); ?>

    <?php
        //include("../Library/Database_Functions.php"); // niet meer nodig want het menu includes het

        $MyDB = GetDatabase("localhost", "root", "", "de_lezers");

        $Products = "";

        $Types = "";

        $Prices = "";
        
        if ($MyDB != null) {
            $sql = "SELECT DISTINCT product.soort FROM product";

            $query = ExecuteQuerry($MyDB, $sql);

            $Types =  $query->fetchAll(PDO::FETCH_ASSOC);

            $sql = "SELECT min(product.prijs) as 'minprice', max(product.prijs) as 'maxprice' from product";

            $query = ExecuteQuerry($MyDB, $sql);

            $Prices =  $query->fetchAll(PDO::FETCH_ASSOC);

            $sql = "SELECT * FROM product WHERE";

            if(isset($_POST["submit"])) {
                $sql .= " product.naam LIKE '%" . filter_var($_POST["searchbar"], FILTER_SANITIZE_STRING) . "%'";
                if ($_POST['soort'] != "all") {
                    $sql .= " AND product.soort = '" . $_POST["soort"] . "'";                    
                }
                $sql .= " AND product.prijs BETWEEN '" . $_POST["minprice"] - 0.01 . "' AND '" . $_POST["maxprice"] . "'";
            }
            else {
                $sql .= " 1";
            }
            

            $sql .= " ORDER BY product.naam ASC";

            $query = ExecuteQuerry($MyDB, $sql);

            $result =  $query->fetchAll(PDO::FETCH_ASSOC);
            
            if (count($result) < 4) {
                $Products .= "<style> .Webshop_Product{ margin-top: -32.5vh; </style>";
            }

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

    <form method="post" id="Webshop_Main">
        <!-- <form method="post"> -->
            <section id="Webshop_FilterSection"> <!-- Section for filter -->
                <div id="Webshop_FilterDiv">
                    <h1>Filter:</h1>
                    <?php
                        $output = "";
                        if (isset($_POST["submit"])) {
                            $output .= "<div id=Webshop_Filter_Soort><label>Alle</label><input type=radio name=soort value=all"; 
                            if ($_POST["soort"] == "all") { $output .= " checked=checked"; }
                            $output .= " onchange='UpdateForm()'>";
                            foreach ($Types as $Type) {
                                $output .= "<label>" . $Type['soort']. "</label><input type=radio name=soort value='" . $Type['soort'] . "'";
                                if ($_POST["soort"] == $Type['soort']) { $output .= " checked=checked"; }
                                $output .= " onchange='UpdateForm()'>";
                            }
                            $output .= "</div><div id=Webshop_Filter_Price><input required type=number name=minprice step=0.01 value='" . $_POST["minprice"] . "' onchange='UpdateForm()' min='" . $Prices[0]["minprice"] . "' max='" . $_POST["maxprice"] . "'><p>Prijs</p>";
                            $output .= "<input required type=number name=maxprice step=0.01 value='" . $_POST["maxprice"] . "' onchange='UpdateForm()' min='" . $_POST["minprice"] . "' max='" . $Prices[0]["maxprice"] . "'></div>";
                        }
                        else {
                            $output .= "<div id=Webshop_Filter_Soort><label>Alle</label><input type=radio name=soort value=all checked=checked onchange='UpdateForm()'>";
                            foreach ($Types as $Type) {
                                $output .= "<label>" . $Type['soort']. "</label><input type=radio name=soort value='" . $Type['soort'] . "' onchange='UpdateForm()'>";
                            }
                            $output .= "</div><div id=Webshop_Filter_Price><input required type=number name=minprice step=0.01 value='" . $Prices[0]["minprice"] . "' onchange='UpdateForm()' min='" . $Prices[0]["minprice"] . "' max='" . $Prices[0]["maxprice"] . "'><p>Prijs</p>";
                            $output .= "<input required type=number name=maxprice step=0.01 value='" . $Prices[0]["maxprice"] . "' onchange='UpdateForm()' min='" . $Prices[0]["minprice"] . "' max='" . $Prices[0]["maxprice"] . "'></div>";

                        }
                        echo $output;
                    ?>
                </div>
            </section>
            <section id="Webshop_ProductSection"> <!-- Section for products -->
                <section id="Webshop_SearchBar">
                    <input id="Webshop_SearchBar_Field" type="text" placeholder="Search for..." name="searchbar" value=<?php if(isset($_POST["searchbar"])) { echo $_POST["searchbar"]; }else {echo "";}?>>
                    <input id="Webshop_SearchBar_Button" type="submit" name="submit" value="Search">
                </section>
                <!-- echo all the products in here -->
                <?php echo($Products); ?>
            </section>
        <!-- </form> -->
    </form>
    <?php include("../Library/footer.html"); ?>
    <script>
        function UpdateForm() {
            document.getElementById("Webshop_SearchBar_Button").click();
        }
    </script>
</body>
</html>