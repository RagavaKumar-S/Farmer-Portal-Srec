<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buyer Forgot Password</title>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');

        body {
            background-color: #f2f2f2;
            font-family: 'Poppins', sans-serif;
        }

        .box {
            max-width: 400px;
            margin: 60px auto;
            background-color: #fff;
            border: 2px solid #1e7e34;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 0 10px rgba(0, 128, 0, 0.2);
        }

        h3 {
            color: #1e7e34;
            text-align: center;
            margin-bottom: 30px;
        }

        .inp {
            width: 100%;
            padding: 10px 15px;
            border: 1px solid #ccc;
            border-radius: 10px;
            margin-bottom: 20px;
            transition: 0.3s ease;
        }

        .inp:focus {
            outline: none;
            border-color: #1e7e34;
            box-shadow: 0 0 5px rgba(30, 126, 52, 0.5);
        }

        input[type="submit"] {
            background-color: #1e7e34;
            color: white;
            border: none;
            padding: 10px 25px;
            border-radius: 10px;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #155d25;
        }
    </style>
</head>

<body>
    <div class="box">
        <form action="BuyerForgotPassword.php" method="post">
            <h3>Forgot Password</h3>

            <input type="phonenumber" class="inp" name="phonenumber" placeholder="Phone Number" required>
            <input type="text" class="inp" name="pan" placeholder="PAN Number" required>
            <input type="password" class="inp" name="password" placeholder="New Password" required>
            <input type="password" class="inp" name="confirmpassword" placeholder="Confirm Password" required>

            <!-- Centering the button -->
            <div style="text-align: center;">
                <input type="submit" name="register" value="Update Password">
            </div>
        </form>
    </div>
</body>

</html>

<?php
include("../Includes/db.php");

if (isset($_POST['register'])) {
    $phonenumber = mysqli_real_escape_string($con, $_POST['phonenumber']);
    $pan = mysqli_real_escape_string($con, $_POST['pan']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $confirmpassword = mysqli_real_escape_string($con, $_POST['confirmpassword']);

    $query = "SELECT * FROM buyerregistration WHERE buyer_phone = '$phonenumber' AND buyer_pan = '$pan'";
    $run_query = mysqli_query($con, $query);
    $count_rows = mysqli_num_rows($run_query);

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

    if (strcmp($password, $confirmpassword) == 0) {
        if ($count_rows != 0) {
            $update_query = "UPDATE buyerregistration 
                             SET buyer_password = '$encryption' 
                             WHERE buyer_phone = '$phonenumber' AND buyer_pan = '$pan'";
            $run_query = mysqli_query($con, $update_query);

            echo "<script>alert('Password Updated Successfully');</script>";
            echo "<script>window.open('BuyerLogin.php','_self')</script>";
        } else {
            echo "<script>alert('Please Enter Valid Details');</script>";
        }
    } else {
        echo "<script>alert('Passwords do not match');</script>";
    }
}
?>
