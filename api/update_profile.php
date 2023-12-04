<?php
include 'auth.php';
include 'include/db_credentials.php';

// Ensure the user is authenticated
if (!isset($_SESSION['authenticatedUser'])) {
    // Redirect to login page or handle unauthenticated user
    header("Location: login.php");
    exit();
}

// Get the authenticated user
$user = $_SESSION['authenticatedUser'];

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Extract form data
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $postalCode = $_POST['postalCode'];
    $country = $_POST['country'];
    $oldPassword = $_POST['oldPassword'];
    $newPassword = $_POST['newPassword'];

    // TODO: Perform validation and sanitization on form data

    // Connect to the database
    $con = mysqli_connect($connectionInfo["HOST"], $connectionInfo["UID"], $connectionInfo["PWD"]);
    if (!$con) die("Database connection failed: " . mysqli_error());

    $db_select = mysqli_select_db($con, $connectionInfo["Database"]);
    if (!$db_select) die("Database selection failed: " . mysqli_error());
    

    // Update the user's profile information
    $updateSql = "UPDATE customer SET address='$address', city='$city', state='$state', postalCode='$postalCode', country='$country' WHERE userid='$user'";
    $updateResult = mysqli_query($con, $updateSql);

    // If a new password is provided, update it
    if (!empty($newPassword)) {
        // Validate the old password before updating
        $validateOldPasswordSql = "SELECT * FROM customer WHERE userid='$user' AND password='$oldPassword'";
        $result = mysqli_query($con, $validateOldPasswordSql);
        
        if (mysqli_num_rows($result) > 0) {
            // Old password is valid, proceed to update with the new password
            $updateSql = "UPDATE customer SET password='$newPassword' WHERE userid='$user'";
            $updateResult = mysqli_query($con, $updateSql);
            // if ($updateResult) {
            //     echo "<script>window.alert('Profile updated successfully.')</script>";
            // } else {
            //     echo "<script>window.alert('Error updating profile: " . mysqli_error($con) . "')</script>";
            // }
        } else {
            // Old password is not valid
            echo "<script>window.alert('Old password is incorrect. Password not updated.')</script>";
            mysqli_close($con);
            header("Location: customer.php");
            exit();
        }
    } else {
        // if ($updateResult) {
        //     echo "<script>window.alert('Profile updated successfully.')</script>";
        // } else {
        //     echo "<script>window.alert('Error updating profile: " . mysqli_error($con) . "')</script>";
        // }
    }


    // Close the database connection
    mysqli_close($con);
}

// Redirect to the profile page
header("Location: customer.php");
exit();
?>
