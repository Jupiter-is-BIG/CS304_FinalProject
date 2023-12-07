<?php
// Your existing registration processing code

if (isset($_POST['create_account'])) {
    // Perform the registration process
    
    // After successful registration, redirect to login.php
    header("Location: login.php");
    exit();
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Extract form data
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $phonenum = $_POST['phonenum'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $postalcode = $_POST['postalcode'];
    $country = $_POST['country'];
    $userid = $_POST['userid'];
    $password = $_POST['password'];

    // TODO: Perform validation and sanitization on form data

    // Connect to the database
    $con = mysqli_connect($connectionInfo["HOST"], $connectionInfo["UID"], $connectionInfo["PWD"]);
    if (!$con) die("Database connection failed: " . mysqli_error());

    $db_select = mysqli_select_db($con, $connectionInfo["Database"]);
    if (!$db_select) die("Database selection failed: " . mysqli_error());

    // Insert a new row into the 'customer' table
    $insertSql = "INSERT INTO customer (firstname, lastname, email, phonenum, address, city, state, postalcode, country, userid, password) VALUES ('$firstname', '$lastname', '$email', '$phonenum', '$address', '$city', '$state', '$postalcode', '$country', '$userid', '$password')";
    $insertResult = mysqli_query($con, $insertSql);

    if ($insertResult) {
        echo "New account created!";
    } else {
        echo "Error: " . $insertSql . "<br>" . mysqli_error($con);
    }

    // Close the database connection
    mysqli_close($con);
}
?>