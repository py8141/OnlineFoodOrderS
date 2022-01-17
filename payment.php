<?php
session_start();
require 'connection.php';
$conn = Connect();
if (!isset($_SESSION['login_customer'])) {
    header("location: index.php");
}
if (isset($_SESSION['login_manager'])) {
    header("location: index.php");
}
if (isset($_SESSION['login_admin'])) {
    header("location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>

<body>

    <div class="jumbotron" style="color: #FFFFFF; margin-bottom: 0rem; background: #333333; border-radius:0rem">
        <div class="container text-center">
            <h1>Choose your payment option</h1>
        </div>
    </div>
    <?php
    $g_total = 0;
    foreach ($_SESSION["cart"] as $keys => $values) {
        $total = ($values["quantity"] * $values["price"]);
        $g_total = $g_total + $total;
    }
    ?>
    <div class="site-section" id="section-home" style="background-size: cover; margin-top: -2rem">
        <div class="container">
            <div class="" style="height: 10rem">
                <h1 class="text-center" style="margin: auto ; padding: 5rem;">Delivery Address: <?php if (isset($_POST["address"])) {
                                                                                                    echo $_POST["address"];
                                                                                                } else {
                                                                                                    echo $_GET["address"];
                                                                                                } ?></h1><br>
            </div>
            <div class="table-responsive" style="padding-left: 100px; padding-right: 100px;">
                <table class="table table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th width="40%">Food Name</th>
                            <th width="10%">Quantity</th>
                            <th width="20%">Price Details</th>
                            <th width="15%">Order Total</th>
                        </tr>
                    </thead>
                    <?php
                    foreach ($_SESSION["cart"] as $keys => $values) {
                    ?>
                        <tr style="background-color: #e9ecef">
                            <td><?php echo $values["name"]; ?></td>
                            <td><?php echo $values["quantity"] ?></td>
                            <td>&#8377; <?php echo $values["price"]; ?></td>
                            <td>&#8377; <?php echo number_format($values["quantity"] * $values["price"], 2); ?></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
            <h1 class="text-center" style="color: black">Grand Total: &#8377;<?php echo "$g_total"; ?>/-</h1>
            <br>
            <h1 class="text-center">
                <a href="cart.php?rid=<?php echo $_SESSION["cart"][0]["R_ID"]; ?>"><button class="btn btn-warning"><span class="glyphicon glyphicon-circle-arrow-left"></span> Go back to cart</button></a>
                <button class="btn btn-success" data-toggle="modal" data-target="#onlineod"><span class="glyphicon glyphicon-"></span> Pay Online</button>
                <a href="cashpay.php?address=<?php if (isset($_POST["address"])) {
                                                    echo $_POST["address"];
                                                } else {
                                                    echo $_GET["address"];
                                                } ?>"><button class="btn btn-success"><span class="glyphicon glyphicon-"></span> Cash On Delivery</button></a>
            </h1>
        </div>
    </div>

</body>

</html>