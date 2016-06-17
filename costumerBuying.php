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
                $obj = new printDatabase();
                echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"table.css\">";
                echo "<table>";
                echo "<thead>";
                echo "<tr><td>Mass</td><td>Type</td><td>Color</td><td>Price</td>";
                echo "</thead>";
                echo "<tbody>";
                $obj->tableForm();
                echo "</tbody>";
                echo "</table>";
                ?>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
                <div class="col-md-4">
                    <h2>Hi again,
                    <?php
                    session_start();
                    echo $_SESSION['username'];
                    ?> when we meet each other at the shop, you will have to pay
                    <?php
                    require_once 'databaseConnection.php';
                    $obj = new databaseConnection();
                    $price = $obj->paymant();
                    echo "\$" . $price;
                    ?> Thank's :)
                </h2>
                    <a href="register.html"><input type="submit" class="btn btn-lg btn-primary active" name="Logout" value="Logout"></a>
            </div>
        </div>
    </div>
</body>
</html>