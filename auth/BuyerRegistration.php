<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Buyer Registration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/c587fc1763.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css?family=Raleway:400,600&display=swap');

        body {
            font-family: 'Raleway', sans-serif;
            background: #f0fdf4;
        }

        .card {
            margin-top: 50px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 128, 0, 0.2);
        }

        .card-header {
            background-color: #2e7d32;
            color: #fff;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
            text-align: center;
        }

        .form-control {
            border-radius: 10px;
            border: 1px solid #ccc;
        }

        .btn-primary {
            background-color: #2e7d32;
            border: none;
            border-radius: 10px;
            padding: 8px 20px;
        }

        .btn-primary:hover {
            background-color: #256d28;
        }

        .form-group label {
            font-weight: 600;
            color: #333;
        }
    </style>
</head>
<body>
    <main class="my-form">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4><i class="fas fa-user-plus mr-2"></i>Buyer Registration</h4>
                        </div>
                        <div class="card-body">
                            <form name="my-form" action="BuyerRegistration.php" method="POST">
                                <?php
                                    function formInput($label, $id, $name, $type = "text", $icon, $placeholder) {
                                        echo "
                                        <div class='form-group row'>
                                            <label for='$id' class='col-md-4 col-form-label text-md-right'>
                                                <i class='$icon mr-2'></i><b>$label</b>
                                            </label>
                                            <div class='col-md-6'>
                                                <input type='$type' id='$id' name='$name' class='form-control' placeholder='$placeholder' required>
                                            </div>
                                        </div>";
                                    }

                                    formInput("Full Name", "full_name", "name", "text", "fas fa-user", "Enter your full name");
                                    formInput("Phone Number", "phone_number", "phonenumber", "text", "fas fa-phone-alt", "Phone Number");
                                    formInput("E-Mail Address", "email_address", "mail", "email", "far fa-envelope", "Email ID");
                                ?>
                                
                                <div class="form-group row">
                                    <label for="present_address" class="col-md-4 col-form-label text-md-right">
                                        <i class="fas fa-home mr-2"></i><b>Present Address</b>
                                    </label>
                                    <div class="col-md-6">
                                        <textarea id="present_address" name="address" class="form-control" rows="3" placeholder="Enter your address" required></textarea>
                                    </div>
                                </div>

                                <?php
                                    formInput("Company Name", "company_name", "company_name", "text", "fas fa-building", "Company Name");
                                    formInput("License", "license", "license", "text", "fas fa-id-badge", "License Number");
                                    formInput("Bank Account No.", "account1", "account", "text", "fas fa-university", "Bank Account Number");
                                    formInput("PAN No.", "account2", "pan", "text", "fas fa-pencil-alt", "PAN Number");
                                    formInput("User Name", "user_name", "username", "text", "fas fa-user", "Username");
                                    formInput("Password", "p1", "password", "password", "fas fa-lock", "Password");
                                    formInput("Confirm Password", "p2", "confirmpassword", "password", "fas fa-lock", "Confirm Password");
                                ?>

                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary" name="register" value="Register">
                                        Register
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>

<?php
include("../Includes/db.php");
if (isset($_POST['register'])) {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $phonenumber = mysqli_real_escape_string($con, $_POST['phonenumber']);
    $address = mysqli_real_escape_string($con, $_POST['address']);
    $company_name = mysqli_real_escape_string($con, $_POST['company_name']);
    $license = mysqli_real_escape_string($con, $_POST['license']);
    $account = mysqli_real_escape_string($con, $_POST['account']);
    $pan = mysqli_real_escape_string($con, $_POST['pan']);
    $mail = mysqli_real_escape_string($con, $_POST['mail']);
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $confirmpassword = mysqli_real_escape_string($con, $_POST['confirmpassword']);

    if ($password === $confirmpassword) {
        $ciphering = "AES-128-CTR";
        $options = 0;
        $encryption_iv = '2345678910111211';
        $encryption_key = "DE";
        $encryption = openssl_encrypt($password, $ciphering, $encryption_key, $options, $encryption_iv);

        $query = "INSERT INTO buyerregistration 
        (buyer_name, buyer_phone, buyer_addr, buyer_comp, buyer_license, buyer_bank, buyer_pan, buyer_mail, buyer_username, buyer_password) 
        VALUES ('$name','$phonenumber','$address','$company_name','$license','$account','$pan','$mail','$username','$encryption')";

        mysqli_query($con, $query);
        echo "<script>alert('Successfully Registered');</script>";
        echo "<script>window.open('BuyerLogin.php','_self')</script>";
    } else {
        echo "<script>alert('Password and Confirm Password should match.');</script>";
    }
}
?>
