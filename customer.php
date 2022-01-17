<?php
session_start();
require 'connection.php';
$conn = Connect();
if (!isset($_SESSION['login_customer'])) {
    header("location: index.php");
}
if (isset($_SESSION['login_manager'])) {
    header("location: manager.php");
}

unset($_SESSION["cart"]);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Panel</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="jumbotron" style="color: #FFFFFF; margin-bottom: 0rem; background: #333333; border-radius:0rem">
        <div class="container text-right">
            <li><a href="customer.php" class="nav-link">Welcome, <?php echo $_SESSION["login_customer"] ?></a></li>
            <li><a href="restaurant_choose.php"><span class="glyphicon glyphicon-shopping-cart"></span>Restaurants</a></li>
            <li><a href="logout.php" class="nav-link">Logout</a></li>
        </div>
    </div>
    <div class="site-section" id="section-home" style="background-image: url(images/food_bg.jpg); background-size: cover;">
        <div class="container">
            <div class="row align-items-center justify-content-center">

                <div class="col-md-12" data-aos="fade-up" data-aos-delay="400">
                    <div class="container">
                        <div class="jumbotron">
                            <h1>Pending Orders</h1>
                        </div>
                    </div>
                    <div class="table-responsive" style="padding-left: 100px; padding-right: 100px;">
                        <table class="table table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th width="10%">Order ID</th>
                                    <th width="40%">Restaurant</th>
                                    <th width="20%">Date Of Order</th>
                                    <th width="15%">Order Total</th>
                                </tr>
                            </thead>

                            <?php
                            $username = $_SESSION["login_customer"];
                            $query = "select * from orders where username='" . $username . "' and order_status='PLACED' order by order_date desc";
                            $result = mysqli_query($conn, $query);
                            if ($result) {
                                while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                    <tr style="background-color: #e9ecef">
                                        <td><?php echo $row["order_ID"]; ?></td>
                                        <?php $query1 = "select name from restaurant where R_ID=" . $row["R_ID"] . "";
                                        $res = mysqli_query($conn, $query1);
                                        $res_name = mysqli_fetch_assoc($res); ?>
                                        <td><?php echo $res_name["name"] ?></td>
                                        <td><?php echo $row["order_date"] ?></td>
                                        <td>&#8377; <?php echo $row["total_price"]; ?></td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                        </table>

                    </div>
                    <br><br><br><br>
                    <div class="row align-items-center justify-content-center text-center">

                        <div class="col-md-12" data-aos="fade-up" data-aos-delay="400">
                            <div class="container">
                                <div class="jumbotron">
                                    <h1>Previous Orders</h1>
                                </div>
                            </div>
                            <div class="table-responsive" style="padding-left: 100px; padding-right: 100px;">
                                <table class="table table-striped">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th width="10%">Order ID</th>
                                            <th width="40%">Restaurant</th>
                                            <th width="20%">Date Of Order</th>
                                            <th width="15%">Order Total</th>
                                            <th width="15%">Action</th>
                                        </tr>
                                    </thead>

                                    <?php
                                    $username = $_SESSION["login_customer"];
                                    $query = "select * from orders where username='" . $username . "' and order_status='DELIVERED' order by order_date desc";
                                    $result = mysqli_query($conn, $query);
                                    if ($result) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                            <tr style="background-color: #e9ecef">
                                                <td><?php echo $row["order_ID"]; ?></td>
                                                <?php $query1 = "select name from restaurant where R_ID=" . $row["R_ID"] . "";
                                                $res = mysqli_query($conn, $query1);
                                                $res_name = mysqli_fetch_assoc($res); ?>
                                                <td><?php echo $res_name["name"] ?></td>
                                                <td><?php echo $row["order_date"] ?></td>
                                                <td>&#8377; <?php echo $row["total_price"]; ?></td>
                                                <td><button type="button" class="btn btn-primary btn-sm" data-target="#order<?php echo $row['order_ID'] ?>">
                                                        Expand
                                                    </button></td>
                                            </tr>
                                    <?php
                                        }
                                    }
                                    ?>
                                </table>

                            </div>
                            <br><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>