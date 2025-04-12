<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Farmer Registration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #e6f2e6;
        }

        .card {
            border-radius: 15px;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
        }

        .card-header {
            background-color: #292b2c;
            color: goldenrod;
            font-weight: bold;
        }

        .btn-primary {
            background-color: #292b2c;
            color: goldenrod;
            border: none;
        }

        .btn-primary:hover {
            background-color: #1c1d1e;
            color: gold;
        }

        label i {
            color: #28a745;
        }

        input, select, textarea {
            background-color: #f8fff8 !important;
        }
    </style>

    <script src="districts.js"></script> <!-- Assume you load your districts dynamically -->
</head>

<body>
<main class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border border-dark">
                <div class="card-header">
                    <h4 class="text-center" style="font-weight: bold; color: lime   ;">Farmer Registration</h4>
                </div>
                <div class="card-body">
                    <form name="my-form" action="FarmerRegister.php" method="post">
                        <div class="form-group row mb-3">
                            <label for="full_name" class="col-md-4 col-form-label text-md-right">
                                <i class="fas fa-user mr-2"></i><b>Full Name</b>
                            </label>
                            <div class="col-md-6">
                                <input type="text" id="full_name" class="form-control border border-dark" name="name" placeholder="Enter Your Name" required>
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="phone_number" class="col-md-4 col-form-label text-md-right">
                                <i class="fas fa-phone-alt mr-2"></i><b>Phone Number</b>
                            </label>
                            <div class="col-md-6">
                                <input type="text" id="phone_number" class="form-control border border-dark" name="phonenumber" placeholder="Phone Number" required>
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="present_address" class="col-md-4 col-form-label text-md-right">
                                <i class="fas fa-home mr-2"></i><b>Present Address</b>
                            </label>
                            <div class="col-md-6">
                                <textarea id="present_address" class="form-control border border-dark" rows="4" name="address" placeholder="Address" required></textarea>
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="states" class="col-md-4 col-form-label text-md-right">
                                <i class="fas fa-globe-americas mr-2"></i><b>State</b>
                            </label>
                            <div class="col-md-6">
                                <select name="statevalue" id="states" onchange="state()" class="form-control border border-dark" required>
                                    <option value="0">--Select State--</option>
                                    <option value="ANDAMAN & NICOBAR ISLANDS">ANDAMAN & NICOBAR ISLANDS</option>
                                    <option value="ANDHRA PRADESH">ANDHRA PRADESH</option>
                                    <option value="ARUNACHAL PRADESH">ARUNACHAL PRADESH</option>
                                    <option value="ASSAM">ASSAM</option>
                                    <option value="BIHAR">BIHAR</option>
                                    <option value="CHANDIGARH">CHANDIGARH</option>
                                    <option value="CHHATTISGARH">CHHATTISGARH</option>
                                    <option value="DADRA AND NAGAR HAVELI">DADRA AND NAGAR HAVELI</option>
                                    <option value="DAMAN AND DIU">DAMAN AND DIU</option>
                                    <option value="DELHI">DELHI</option>
                                    <option value="GOA">GOA</option>
                                    <option value="GUJARAT">GUJARAT</option>
                                    <option value="HARYANA">HARYANA</option>
                                    <option value="HIMACHAL PRADESH">HIMACHAL PRADESH</option>
                                    <option value="JAMMU AND KASHMIR">JAMMU AND KASHMIR</option>
                                    <option value="JHARKAND">JHARKAND</option>
                                    <option value="KARNATAKA">KARNATAKA</option>
                                    <option value="KERALA">KERALA</option>
                                    <option value="LAKSHADWEEP">LAKSHADWEEP</option>
                                    <option value="MADHYA PRADESH">MADHYA PRADESH</option>
                                    <option value="MAHARASHTRA">MAHARASHTRA</option>
                                    <option value="MANIPUR">MANIPUR</option>
                                    <option value="MEGHALAYA">MEGHALAYA</option>
                                    <option value="MIZORAM">MIZORAM</option>
                                    <option value="NAGALAND">NAGALAND</option>
                                    <option value="ODISHA">ODISHA</option>
                                    <option value="PUDUCHERRY">PUDUCHERRY</option>
                                    <option value="PUNJAB">PUNJAB</option>
                                    <option value="RAJASTHAN">RAJASTHAN</option>
                                    <option value="SIKKIM">SIKKIM</option>
                                    <option value="TAMIL NADU">TAMIL NADU</option>
                                    <option value="TELANGANA">TELANGANA</option>
                                    <option value="TRIPURA">TRIPURA</option>
                                    <option value="UTTAR PRADESH">UTTAR PRADESH</option>
                                    <option value="UTTARAKHAND">UTTARAKHAND</option>
                                    <option value="UTTARANCHAL">UTTARANCHAL</option>
                                    <option value="WEST BENGAL">WEST BENGAL</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row mb-3">
    <label for="district" class="col-md-4 col-form-label text-md-right">
        <i class="fas fa-globe-americas mr-2"></i><b>District</b>
    </label>
    <div class="col-md-6">
        <input type="text" name="district" id="district" class="form-control border border-dark" placeholder="Enter your District" required>
    </div>
    </div>


                        <div class="form-group row mb-3">
                            <label for="account2" class="col-md-4 col-form-label text-md-right">
                                <i class="fas fa-pencil-alt mr-2"></i><b>PAN No.</b>
                            </label>
                            <div class="col-md-6">
                                <input type="text" id="account2" class="form-control border border-dark" name="pan" placeholder="Pan number" required>
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="account1" class="col-md-4 col-form-label text-md-right">
                                <i class="fas fa-university mr-2"></i><b>Bank Account No.</b>
                            </label>
                            <div class="col-md-6">
                                <input type="text" id="account1" class="form-control border border-dark" name="account" placeholder="Bank Account number" required>
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="p1" class="col-md-4 col-form-label text-md-right">
                                <i class="fas fa-lock mr-2"></i><b>Password</b>
                            </label>
                            <div class="col-md-6">
                                <input id="p1" class="form-control border border-dark" type="password" name="password" placeholder="Password" required>
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="p2" class="col-md-4 col-form-label text-md-right">
                                <i class="fas fa-lock mr-2"></i><b>Confirm Password</b>
                            </label>
                            <div class="col-md-6">
                                <input id="p2" class="form-control border border-dark" type="password" name="confirmpassword" placeholder="Confirm Password" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-3 text-center">
                                <button type="submit" class="btn btn-primary px-4" style="background-color: #004d40; color: #cddc39; font-weight: bold; padding: 10px 30px; border-radius: 8px;" name="register" value="Register">Register</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
include("../Includes/db.php");

$ciphering = "AES-128-CTR";
$iv_length = openssl_cipher_iv_length($ciphering);
$options = 0;
$encryption_iv = '2345678910111211';
$encryption_key = "DE";

if (isset($_POST['register'])) {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $phonenumber = mysqli_real_escape_string($con, $_POST['phonenumber']);
    $address = mysqli_real_escape_string($con, $_POST['address']);
    $account = mysqli_real_escape_string($con, $_POST['account']);
    $pan = mysqli_real_escape_string($con, $_POST['pan']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $confirmpassword = mysqli_real_escape_string($con, $_POST['confirmpassword']);
    $district = mysqli_real_escape_string($con, $_POST['district']);
    $state = mysqli_real_escape_string($con, $_POST['statevalue']);

    $encryption = openssl_encrypt($password, $ciphering, $encryption_key, $options, $encryption_iv);

    if ($password === $confirmpassword) {
        $query = "INSERT INTO farmerregistration (farmer_name, farmer_phone, farmer_address, farmer_state, farmer_district, farmer_pan, farmer_bank, farmer_password)
                  VALUES ('$name', '$phonenumber', '$address', '$state', '$district', '$pan', '$account', '$encryption')";
        $run_register_query = mysqli_query($con, $query);
        echo "<script>console.log('Successfully Inserted');</script>";
        echo "<script>window.open('FarmerLogin.php','_self')</script>";
    } else {
        echo "<script>alert('Password and Confirm Password should be the same');</script>";
    }
}
?>
</body>
</html>
