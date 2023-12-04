<!DOCTYPE html>
<html>
<head>
<title>Administrator Page</title>
</head>
<body>

<?php 
// TODO: Include files auth.php and include/db_credentials.php

    include 'auth.php';
    include 'include/db_credentials.php';

?>

<?php
// TODO: Write SQL query that prints out total order amount by day
$con = mysqli_connect($connectionInfo["HOST"],$connectionInfo["UID"],$connectionInfo["PWD"]);
if(!$con) die("Database connection failed: " . mysqli_error());

$db_select = mysqli_select_db($con, $connectionInfo["Database"]);
if(!$db_select) die("Database selection failed: " . mysqli_error());

$sql = "select DATE(orderdate) AS order_date, sum(totalAmount) as amt from ordersummary group by order_date";
$result = mysqli_query($con, $sql);
echo "<table>";
echo "<tr><th>Order Date</th><th>Sale</th></tr>";

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . $row['order_date'] . "</td>";
    echo "<td>" . $row['amt'] . "</td>";
    echo "</tr>";
}

echo "</table>";
mysqli_close($con);

?>
</body>
</html>