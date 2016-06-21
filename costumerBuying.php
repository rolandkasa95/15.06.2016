<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login/Registration</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="jumbotron">
            <?php
                session_start();
                echo "<h2 style=\"text-align: center\">Well here's wat we can offer you: " . $_SESSION['username'] . "</h2>";
            ?>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <h2>
                    This is what we can offer, but what would you like to buy?
                </h2>
                    <form role="form" action="productForm.php" method="GET">
                        <div class="form-group" style="display: inline-block">
                            <label for="type">Product type: </label>
                            <input type="text" class="form-control" id="type" name="type" required>
                        </div>
                        <div class="form-group" style="display: inline-block">
                            <label for="mass">Amount: </label>
                            <input type="number" class="form-control" id="mass" name="mass" required>
                        </div>
                        <div class="form-group" style="display: inline-block">
                            <label for="color">Color: </label>
                            <input type="text" class="form-control" id="color" name="color" required>
                            <br />
                            <input type="submit" class="btn btn-danger" value="Add to cart">
                        </div>
                    </form>
            </div>
            <div class="col-sm-6">
                <?php
                require_once 'printDatabase.php';
                $obj = new printDatabase(true);
                echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"table.css\">";
                echo "<table>";
                echo "<thead>";
                echo "<tr><td>Mass</td><td>Type</td><td>Color</td><td>Price</td>";
                echo "</thead>";
                echo "<tbody>";
                $obj->tableForm(true);
                echo "</tbody>";
                echo "</table>";
                ?>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h3>
                    <?php
                    require_once 'databaseConnection.php';
                    session_start();
                    $obj = new databaseConnection();
                    $price = $obj->paymant();
                    if($price){
                        echo "Hi again " . $_SESSION['username'] .", <br />" . "you have to pay \$" . $price . " at the shop.";
                    }else{
                        echo "Hi again " . $_SESSION['username'] .", <br />" . "for now you don't have to pay anithing.";
                    }
                    ?>
                </h3>
                <a href="register.html"><input type="submit" class="btn btn-lg btn-primary active" name="Logout" value="Logout"></a>
            </div>
            <div class="col-md-4">
                  <h3>
                    <?php

                    require_once "databaseConnection.php";
                    $databaseConnection = new databaseConnection();
                    $result = $databaseConnection->printDatabase("admin","users","username='" . $_SESSION['username'] . "'");
                    foreach ($result as $row){
                        $admin = $row['admin'];
                    }
                    if ($admin){
                        require_once 'printDatabase.php';
                        $obj = new printDatabase(false);
                        echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"table.css\">";
                        echo "<table>";
                        echo "<thead>";
                        echo "<tr><td>Username</td><td>Payment</td></tr>";
                        echo "</thead>";
                        echo "<tbody>";
                        $obj->tableForm(false);
                        echo "</tbody>";
                        echo "</table>";
                        echo "</div>";
                        echo "<div class=\"col-md-4\">";
                        echo  "<form role=\"form\" action=\"payment_checkout.php\" method=\"GET\">";
                        echo  "<div class=\"form-group\" style=\"display: inline-block\">";
                        echo  "<label for=\"username\">Checkout user: </label>";
                        echo  "<input type=\"text\" class=\"form-control\" id=\"username\" name=\"username\" required>";
                        echo  "</div>";
                        echo  "<br />";
                        echo  "<a href=\"costumerBuying.php\"><input type=\"submit\" class=\"btn btn-lg btn-success active\" name=\"checkout\" value=\"Checkout\"></a>";
                        echo  "</form>";
                    }
                    ?>
                  </h3>
            </div>
        </div>
    </div>
</body>
</html>