<html>
<head>
<title>Ray's Grocery Shipment Processing</title>
</head>
<body>

<?php
include 'include/db_credentials.php';

$con = mysqli_connect($connectionInfo["HOST"],$connectionInfo["UID"],$connectionInfo["PWD"]);
if(!$con) die("Database connection failed: " . mysqli_error());

$db_select = mysqli_select_db($con, $connectionInfo["Database"]);
if(!$db_select) die("Database selection failed: " . mysqli_error());

	// TODO: Get order id     
	$id = $_GET['id']; 

	$sql = "select * from ordersummary where orderId = " . $id;
	$result = mysqli_query($con, $sql);
	$rs = mysqli_fetch_assoc($result);
		// TODO: Check if valid order id
	if(!$rs) echo "<h2>No such order!</h2>";
	// TODO: Start a transaction 
	else {
			// TODO: Retrieve all items in order with given id
		$sql2 = "select * from orderproduct where orderId = " . $id;
		$rs = mysqli_query($con, $sql2);
		$suc = 1;
		$count = 0;
		while($row = mysqli_fetch_assoc($rs)) {
			$count++;
			$pid = $row["productId"];
			$qt = $row["quantity"];
			$sql3 = "select * from productinventory where productId = " . $pid . " and warehouseId = 1";
			$r = mysqli_query($con, $sql3);
			$ro = mysqli_fetch_assoc($r);
			if ($ro["quantity"] < $qt) {echo "<h2>Shipment not done. Not enough inventory for productId " . $pid . " </h2>"; $suc = 0; break;}
			if($count > 3){echo "<h2>Can't ship more than 3 items.</h2>"; $suc = 0; break;}
		}

		if ($suc == 1) {
			$sql4 = "select * from orderproduct where orderId = " . $id;
			$rs = mysqli_query($con, $sql4);
			while($row = mysqli_fetch_assoc($rs)) {
				$pid = $row["productId"];
				$qt = $row["quantity"];
				$sql5 = "select * from productinventory where productId = " . $pid . " and warehouseId = 1";
				$r = mysqli_query($con, $sql5);
				$ro = mysqli_fetch_assoc($r);
				if ($ro["quantity"] < $qt) {echo "<h2>Shipment not done. Not enough inventory for productId " . $pid . " </h2>"; $suc = 0; break;}
				$newIn = $ro["quantity"] - $qt;
				echo "<p>Ordered Product: " . $pid .  " Qty: " . $qt . " Previous Inventory: " . $ro["quantity"] . " New Inventory " . $newIn . " </p>";
				$sql6 = "update productinventory set quantity = " . $newIn . " where productId = " . $pid . " and warehouseId = 1";
				mysqli_query($con, $sql6);

    

			}
		}
	}


	
	
	

	// TODO: Create a new shipment record.
	// TODO: For each item verify sufficient quantity available in warehouse 1.
	// TODO: If any item does not have sufficient inventory, cancel transaction and rollback. Otherwise, update inventory for each item.
	
	// TODO: Make sure to commit or rollback active transaction
	mysqli_close($con);
?>

<h2><a href="./index.php">Back to Main Page</a></h2>

</body>
</html>
