<?php
// Your existing registration processing code

if (isset($_POST['create_account'])) {
    // Perform the registration process
    
    // After successful registration, redirect to login.php
    header("Location: login.php");
    exit();
}
?>