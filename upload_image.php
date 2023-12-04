<?php
include 'auth.php';
include 'include/db_credentials.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $con = mysqli_connect($connectionInfo["HOST"], $connectionInfo["UID"], $connectionInfo["PWD"]);
    if (!$con) die("Database connection failed: " . mysqli_error());
   
    $db_select = mysqli_select_db($con, $connectionInfo["Database"]);
    if (!$db_select) die("Database selection failed: " . mysqli_error());

    $productId = $_POST['productId'];

    // Process image upload
    $image = $_FILES['image']['tmp_name'];
    $imageData = addslashes(file_get_contents($image));

    // Insert data into the database
    $sql = "UPDATE product SET productImage = '$imageData' WHERE productId = " . $productId;
    $result = mysqli_query($con, $sql);

    if ($result) {
        echo "Image uploaded successfully!";
        mysqli_close($con);
            header("Location: admin.php");
            exit();
    } else {
        echo "Error uploading image: " . mysqli_error($con);
    }

    mysqli_close($con);
}

//
