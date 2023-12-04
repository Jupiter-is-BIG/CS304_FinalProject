<?php 
    include 'auth.php';	
	$user = $_SESSION['authenticatedUser'];
?>

<!DOCTYPE html>
<html>
<head>
<title>Customer Page</title>
</head>
<body>

<?php     
    include 'header.php';
    include 'include/db_credentials.php';
?>

<?php
// TODO: Print Customer information
if (!$user) echo "<script>window.alert(Please login to see this page)</script>";
// Make sure to close connection
$con = mysqli_connect($connectionInfo["HOST"],$connectionInfo["UID"],$connectionInfo["PWD"]);
if(!$con) die("Database connection failed: " . mysqli_error());

$db_select = mysqli_select_db($con, $connectionInfo["Database"]);
if(!$db_select) die("Database selection failed: " . mysqli_error());

$sql = "select * from customer where userid = '" . $user . "'";
$result = mysqli_query($con, $sql);
$rs = mysqli_fetch_assoc($result);
echo "<h2>Customer Profile</h2>";
echo "<table>";
echo "<tr><td>Id</td><td>" . $rs["customerId"] . "</td></tr>";
echo "<tr><td>First Name</td><td>" . $rs["firstName"] . "</td></tr>";
echo "<tr><td>Last Name</td><td>" . $rs["lastName"] . "</td></tr>";
echo "<tr><td>Email</td><td>" . $rs["email"] . "</td></tr>";
echo "<tr><td>Phone</td><td>" . $rs["phonenum"] . "</td></tr>";
echo "<tr><td>Address</td><td>" . $rs["address"] . "</td></tr>";
echo "<tr><td>City</td><td>" . $rs["city"] . "</td></tr>";
echo "<tr><td>State</td><td>" . $rs["state"] . "</td></tr>";
echo "<tr><td>Postal Code</td><td>" . $rs["postalCode"] . "</td></tr>";
echo "<tr><td>Country</td><td>" . $rs["country"] . "</td></tr>";
echo "<tr><td>User Id</td><td>" . $rs["userid"] . "</td></tr>";

echo "</table>";










mysqli_close($con);
?>
</body>
</html>