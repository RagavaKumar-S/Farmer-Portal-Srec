<?php

session_start();

session_destroy();

echo "<script>window.open('../FarmerPortal/FarmerLogin.php','_self')</script>";


?>