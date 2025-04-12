<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Buyer Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap & Font Awesome -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/c587fc1763.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f0fdf4;
        }

        .login-container {
            margin-top: 8%;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 128, 0, 0.2);
            padding: 30px;
        }

        .login-header {
            background-color: #14532d;
            color: #d1fae5;
            padding: 15px;
            text-align: center;
            border-radius: 10px 10px 0 0;
            font-weight: bold;
        }

        .btn-login {
            background-color: #166534;
            color: #ffffff;
            width: 100%;
        }

        .btn-login:hover {
            background-color: #14532d;
        }

        a {
            color: #166534;
        }

        .form-group label {
            font-weight: 500;
        }

        .card-footer {
            background-color: #f9fafb;
            text-align: center;
        }
    </style>
</head>

<body>

    <div class="login-container">
        <div class="login-header">
            <h4><i class="fas fa-leaf mr-2"></i>Buyer Login</h4>
        </div>
        <div class="p-4">
            <form action="BuyerLogin.php" method="POST">
                <div class="form-group">
                    <label for="phone_number"><i class="fas fa-phone-alt mr-2"></i>Phone Number</label>
                    <input type="text" id="phone_number" name="phonenumber" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="password"><i class="fas fa-lock mr-2"></i>Password</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>

                <button type="submit" name="login" value="Login" class="btn btn-login mt-3">Login</button>

                <div class="text-center mt-3">
                    <a href="BuyerForgotPassword.php">Forgot Password?</a> |
                    <a href="BuyerRegistration.php">Create New Account</a>
                </div>
            </form>
        </div>
    </div>

</body>

</html>

<?php
include("../Includes/db.php");

if (isset($_POST['login'])) {

    $phonenumber = mysqli_real_escape_string($con, $_POST['phonenumber']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    $ciphering = "AES-128-CTR";
    $iv_length = openssl_cipher_iv_length($ciphering);
    $options = 0;
    $encryption_iv = '2345678910111211';
    $encryption_key = "DE";

    $encryption = openssl_encrypt(
        $password,
        $ciphering,
        $encryption_key,
        $options,
        $encryption_iv
    );

    $query = "SELECT * FROM buyerregistration WHERE buyer_phone = '$phonenumber' AND buyer_password = '$encryption'";
    $run_query = mysqli_query($con, $query);
    $count_rows = mysqli_num_rows($run_query);

    if ($count_rows == 0) {
        echo "<script>alert('Please Enter Valid Details');</script>";
        echo "<script>window.open('BuyerLogin.php','_self')</script>";
    }

    while ($row = mysqli_fetch_array($run_query)) {
        $id = $row['buyer_id'];
    }

    $_SESSION['phonenumber'] = $phonenumber;
    echo "<script>window.open('../BuyerPortal2/bhome.php','_self')</script>";
}
?>
