<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://cdn.tailwindcss.com"></script>
    <title>YOUR NAME Grocery Order List</title>
    <!-- <style>
        .card {
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 20px;
            margin: 10px;
            width: auto;
        }
    </style> -->
</head>
<body>

<h1 class="text-3xl w-full text-center m-3">Order List</h1>

<?php
include 'include/db_credentials.php';

/** Create connection, and validate that it connected successfully **/

/**
Useful code for formatting currency:
	number_format(yourCurrencyVariableHere,2)
**/

/** Write query to retrieve all order headers **/

/** For each order in the results
		Print out the order header information
		Write a query to retrieve the products in the order
			- Use sqlsrv_prepare($connection, $sql, array( &$variable ) 
				and sqlsrv_execute($preparedStatement) 
				so you can reuse the query multiple times (just change the value of $variable)
		For each product in the order
			Write out product information 
**/


/** Close connection **/

	// Connecting to db and checking for errors
	$con = mysqli_connect($connectionInfo["HOST"],$connectionInfo["UID"],$connectionInfo["PWD"]);
	if(!$con) die("Database connection failed: " . mysqli_error());

	$db_select = mysqli_select_db($con, $connectionInfo["Database"]);
	if(!$db_select) die("Database selection failed: " . mysqli_error());

	$sql = "Select orderId, orderDate, customer.customerId, firstName, lastName,  totalAmount from ordersummary natural join customer";
	$result = mysqli_query($con, $sql);

	while ($row = mysqli_fetch_assoc($result)) {
		$sql2 = "Select productId, quantity, price from orderproduct where orderId = " . $row['orderId'];
		$result2 = mysqli_query($con, $sql2);
        ?>
        <div class="bg-slate-200 m-5 p-5 rounded-xl">
			<div class="flex flex-row justify-between">
			<h2 class="text-xl">Order ID <?php echo $row['orderId']; ?></h2>
            <p>Order Date: <?php echo $row['orderDate']; ?></p>
			</div>
            <p class="text-sm">Customer ID: <?php echo $row['customerId']; ?></p>
            <p class="text-lg my-5">Customer Name: <?php echo $row['firstName'] . " " . $row['lastName']; ?></p>
            <p class="text-xl text-red-800">Total Amount: $<?php echo number_format($row['totalAmount'],2); ?></p>
			<div class="flex justify-center">
			<div class="w-1/2 m-1 border border-sky-500 rounded-lg bg-red-100 flex flex-col px-10 items-center">
			<div class="flex flex-row justify-between mx-5 w-full align-center font-bold mb-2">
				<p>Product Id</p>
				<p>Quantity</p>
				<p>Price</p>
			</div>
			<?php 
			while ($row2 = mysqli_fetch_assoc($result2)) {
				?>
				<div class="flex flex-row justify-between mx-5 w-full align-center">
				<p class=""><?php echo $row2['productId'] ?></p>
				<p class=""><?php echo $row2['quantity'] ?></p>
				<p class="text-red-700"> $<?php echo number_format($row2['price'],2) ?></p>
			</div>
					
				<?php
			}
			?>
			</div>
			</div>
			
			
        </div>
        <?php
    }

    // Close the database connection
    mysqli_close($con);
	
?>

</body>
</html>

