<?php
    function getProducts() {
        $dbconn = pg_connect("host=127.0.0.1 port=5432 dbname=test_pgdb user=postgres password=CMZC32)^ED-oJLkDp##sz6k.");
        if (!$dbconn) {
            echo("An error occurred\n");
            return [];
        } else {
            if (isset($_GET['submit'])) {
                $item = $_GET['item'];
                $seller = $_GET['seller'];
                $price = intval($_GET['minprice']);
                $queryString = "SELECT * FROM products WHERE seller='$seller' AND item='$item' AND price>=$price";
            } else {
                $queryString = "SELECT * FROM products;";
            }

            $queryResult = pg_query($dbconn, $queryString);
            if (!$queryResult) {
                echo("An error occurred\n");
                echo pg_last_error($dbconn);
                return [];
            } else {
                $rows = [];
                $arrayIndex = 0;
                while ($row = pg_fetch_row($queryResult)) {
                    $rows[$arrayIndex] = $row;
                    $arrayIndex++;
                }

                return $rows;
            }
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Log In to Worst Purchase</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/globals.css">
        <link rel="stylesheet" href="../css/browse.css">
    </head>
    <body>
        <main>
            <header>
                <section id="header">
                    <div id="logo">
                        <h1>Worst Purchase</h1>
                    </div>
                    <div id="login-signup">
                        <a href="../login.html">Log In/Sign Up</a>
                    </div>
                </section>
                <nav id="top-bar">
                    <div class="nav-item">
                        <h2>Home</h2>
                        <p class="collapsible">Section 1</p>
                        <p class="collapsible">Section 2</p>
                    </div>
                    <div class="nav-item">
                        <h2>About</h2>
                        <p class="collapsible">About the Company</p>
                        <p class="collapsible">Meet Our Team</p>
                        <p class="collapsible">Meet the Losers Who Got Fired</p>
                    </div>
                    <div class="nav-item">
                        <h2>Purchase</h2>
                    </div>
                    <div class="nav-item">
                        <h2>Support</h2>
                    </div>
                </nav>
            </header>

            <section id="body">
                <div id="form">
                <h2>Search Filters</h2>
                <form action="" method="get">
                    <label for="seller">Seller Name</label>
                    <br>
                    <input type="text" name="seller" id="seller">
                    <br>
                    <label for="item">Item Name</label>
                    <br>
                    <input type="text" name="item" id="item">
                    <br>
                    <label for="minprice">Minimum Price ($)</label>
                    <br>
                    <input type="text" name="minprice" id="minprice">
                    <br>
                    <input type="submit" name="submit" id="submit">
                </form>
                </div>
                <div id="products">
                <?php
                    $products = getProducts();
                    for ($i = 0; $i < count($products); $i++) {
                        echo "<div class='product'>";
                        $product = $products[$i];
                        for ($j = 0; $j < count($product); $j++) {
                            echo "<p>", "$product[$j]", "</p>";
                        }
                        echo "</div>";
                    }
                ?>
                </div>
            </section>

        </main>
        <script src="../js/globals.js"></script>
    </body>
</html>
