<?php
include("../Includes/db.php");
//session_start();
include("../Functions/functions.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Farmer Login</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Bootstrap CDN -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;600&display=swap" rel="stylesheet">

	<style>
		body {
			background: linear-gradient(to right, #e8f5e9, #c8e6c9);
			font-family: 'Raleway', sans-serif;
			min-height: 100vh;
			display: flex;
			justify-content: center;
			align-items: center;
		}

		.login-container {
			background-color: #ffffff;
			padding: 40px;
			border-radius: 10px;
			box-shadow: 0 4px 20px rgba(0, 128, 0, 0.2);
			width: 100%;
			max-width: 500px;
		}

		h2 {
			color: #2e7d32;
			text-align: center;
			margin-bottom: 30px;
			font-weight: 700;
		}

		.form-label {
			font-weight: 600;
			color: #2e7d32;
		}

		.form-control {
			border: 1px solid #81c784;
			border-radius: 6px;
		}

		.btn-primary {
			background-color: #2e7d32;
			border: none;
			width: 100%;
			font-weight: bold;
			transition: 0.3s ease;
		}

		.btn-primary:hover {
			background-color: #1b5e20;
		}

		.links {
			margin-top: 20px;
			text-align: center;
		}

		.links a {
			color: #1b5e20;
			font-weight: 600;
			text-decoration: none;
		}

		.links a:hover {
			text-decoration: underline;
		}
	</style>
</head>

<body>

	<div class="login-container">
		<h2>Farmer Login</h2>
		<form action="FarmerLogin.php" method="post">

			<div class="form-group">
				<label for="phone_number" class="form-label">Phone Number</label>
				<input type="text" id="phone_number" class="form-control" name="phonenumber" placeholder="Enter phone number" required>
			</div>

			<div class="form-group">
				<label for="p1" class="form-label">Password</label>
				<input id="p1" class="form-control" type="password" name="password" placeholder="Enter password" required>
			</div>

			<button type="submit" class="btn btn-primary" name="login" value="Login">Login</button>

			<div class="links mt-3">
				<a href="FarmerForgotPassword.php">Forgot Password?</a> <br>
				<a href="FarmerRegister.php">Create New Account</a>
			</div>
		</form>
	</div>

</body>

</html>

<?php
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

	$query = "select * from farmerregistration where farmer_phone = '$phonenumber' and farmer_password = '$encryption'";
	$run_query = mysqli_query($con, $query);
	$count_rows = mysqli_num_rows($run_query);
	if ($count_rows == 0) {
		echo "<script>alert('Please Enter Valid Details');</script>";
		echo "<script>window.open('FarmerLogin.php','_self')</script>";
	}
	while ($row = mysqli_fetch_array($run_query)) {
		$id = $row['farmer_id'];
	}

	$_SESSION['phonenumber'] = $phonenumber;
	echo "<script>window.open('../FarmerPortal/farmerHomepage.php','_self')</script>";
}
?>
