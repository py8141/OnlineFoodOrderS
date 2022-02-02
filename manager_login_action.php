<?php
session_start();
if (isset($_SESSION['login_customer'])) { //if customer logged in
    header('location: index.php');
}

if (isset($_SESSION['login_manager'])) { //if manager logged in
    header('location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="modal fade" id="signupDialog" tabindex="-1" role="dialog" onclick="window.location='index.php'">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <h3>
                    <div id="dialogMsg" class="modal-body bg-primary">
                    </div>
                </h3>
                <div class="modal-footer">
                    <a type="button" href="index.php" class="btn btn-primary">Close</a>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <?php
    require 'connection.php';

    $conn = Connect();

    if (isset($_POST['submit'])) {
        $username = $conn->real_escape_string($_POST['username']);
        $password = $conn->real_escape_string($_POST['password']);
        $msg = "Username or password is incorrect";
        $query = "select * from manager where username='$username' and password='$password'";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            $_SESSION['login_manager'] = $username;
            $msg = "Login success";
        }
        echo   '<script>
                    $(document).ready(function() {
                        $("#dialogMsg").text("' . $msg . '");
                        $("#signupDialog").modal();
                    });
                </script>';
        $conn->close();
    } else {
        header('location: index.php');
    }
    ?>

</body>

</html>