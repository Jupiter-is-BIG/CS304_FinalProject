<!DOCTYPE html>
<html>
<head>
<title>Ray's Grocery - Product Information</title>
</head>
<body>

<?php 
    include 'header.php';
    include 'include/db_credentials.php';
?>

<?php
// Get product name to search for
// TODO: Retrieve and display info for the product
// $id = $_GET['id'];
$id = $_GET['id'];

$con = mysqli_connect($connectionInfo["HOST"],$connectionInfo["UID"],$connectionInfo["PWD"]);
if(!$con) die("Database connection failed: " . mysqli_error());

$db_select = mysqli_select_db($con, $connectionInfo["Database"]);
if(!$db_select) die("Database selection failed: " . mysqli_error());


$sql = "Select * from product where productid = ?";

$stmt = $con->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = mysqli_fetch_assoc($result);

$url = "addcart.php?id=" . $row['productId'] . "&name=" . urlencode($row['productName']) . "&price=" . $row['productPrice'];

// TODO: If there is a productImageURL, display using IMG tag
if($row['productImageURL']) {
    ?>  
        <h1><?php echo $row['productName'];?></h1>
        <img alt="Image" src="<?php echo $row['productImageURL']; ?>">
        <h3>Product Id: <?php echo $row['productId'];?></h3>
        <h3>Price: $<?php echo $row['productPrice'];?></h3>
        <?php 
            if ($row['productImage']) {
                ?>
            <img src="displayImage.php?id=<?php echo $row['productId'];?>" alt="BLOB Image">
            <?php
}
        ?>
        <br>
					<a href = <?php echo $url ?>>Add to cart</a>

					<a href="listprod.php">Continue Shopping</a>

    <?php
}

// TODO: Retrieve any image stored directly in database. Note: Call displayImage.php with product id as parameter.

// TODO: Add links to Add to Cart and Continue Shopping

    // Close the database connection
    mysqli_close($con);
?>
</body>
</html>