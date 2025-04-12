<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Bootstrap and FontAwesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/c587fc1763.js" crossorigin="anonymous"></script>

    <style>
        body {
            background-color: #f7f8f7;
            font-family: sans-serif;
        }

        h3 {
            color: #1a3e2d;
            font-weight: bold;
            text-align: center;
            margin-top: 20px;
        }

        .box {
            background-color: white;
            border: 3px solid #1a3e2d;
            border-radius: 20px;
            width: 400px;
            margin: 40px auto;
            padding: 30px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .inp {
            margin-bottom: 15px;
            width: 100%;
            padding: 10px;
            border-radius: 12px;
            border: 1px solid #1a3e2d;
            text-align: center;
        }

        input[type="submit"] {
            background-color: #1a3e2d;
            color: goldenrod;
            padding: 10px 30px;
            border: none;
            border-radius: 12px;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #145031;
        }

        .form-container {
            text-align: center;
        }

        a {
            color: goldenrod;
        }
    </style>
</head>
<body>

    <h3><i class="fa fa-lock"></i> Forgot Password</h3>
    <div class="box">
        <form method="post" class="form-container">
            <input type="text" class="inp" name="phonenumber" placeholder="Phone Number" required><br>
            <input type="text" class="inp" name="pan" placeholder="PAN Number" required><br>
            <input type="password" class="inp" name="password" placeholder="New Password" required><br>
            <input type="password" class="inp" name="confirmpassword" placeholder="Confirm Password" required><br>
            <input type="submit" style="background-color: #004d40; color: #cddc39; font-weight: bold; padding: 10px 30px; border-radius: 8px;" name="register" value="Reset Password">
        </form>
    </div>

<?php
include("../Includes/db.php");
if (isset($_POST['register'])) {
    $phonenumber = mysqli_real_escape_string($con, $_POST['phonenumber']);
    $pan = mysqli_real_escape_string($con, $_POST['pan']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $confirmpassword = mysqli_real_escape_string($con, $_POST['confirmpassword']);

    $query = "select * from farmerregistration where farmer_phone = '$phonenumber' and farmer_pan = '$pan'";
    $run_query = mysqli_query($con, $query);
    $count_rows = mysqli_num_rows($run_query);

    $ciphering = "AES-128-CTR";
    $iv_length = openssl_cipher_iv_length($ciphering);
    $options = 0;
    $encryption_iv = '2345678910111211';
    $encryption_key = "DE";

    $encryption = openssl_encrypt($password, $ciphering, $encryption_key, $options, $encryption_iv);

    if (strcmp($password, $confirmpassword) == 0) {
        if ($count_rows != 0) {
            $update_query = "update farmerregistration set farmer_password = '$encryption' 
                             where farmer_phone = '$phonenumber' and farmer_pan = '$pan'";
            mysqli_query($con, $update_query);

            echo "<script>alert('Password Updated Successfully');</script>";
            echo "<script>window.open('FarmerLogin.php','_self')</script>";
        } else {
            echo "<script>alert('Please Enter Valid Details');</script>";
        }
    } else {
        echo "<script>alert('Passwords do not match');</script>";
    }
}
?>

</body>
</html>
