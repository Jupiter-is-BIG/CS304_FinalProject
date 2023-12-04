<?php
/** Get customer id **/
$custId = null;
$p = "";
if(isset($_GET['po'])) {
	$p = $_GET['po'];
}
if(isset($_GET['customerId'])){
	$custId = $_GET['customerId'];
}
session_start();
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<script src="https://cdn.tailwindcss.com"></script>
<title>Ray's Grocerries</title>
</head>
<body>

<?php
include 'include/db_credentials.php';
$productList = null;
if (isset($_SESSION['productList'])){
	$productList = $_SESSION['productList'];
}

/**
Determine if valid customer id was entered
Determine if there are products in the shopping cart
If either are not true, display an error message
**/

/** Make connection and validate **/

/** Save order information to database**/


	/**
	// Use retrieval of auto-generated keys.
	$sql = "INSERT INTO <TABLE> OUTPUT INSERTED.orderId VALUES( ... )";
	$pstmt = sqlsrv_query( ... );
	if(!sqlsrv_fetch($pstmt)){
		//Use sqlsrv_errors();
	}
	$orderId = sqlsrv_get_field($pstmt,0);
	**/

/** Insert each item into OrderedProduct table using OrderId from previous INSERT **/

/** Update total amount for order record **/

/** For each entry in the productList is an array with key values: id, name, quantity, price **/

/**
	foreach ($productList as $id => $prod) {
		\\$prod['id'], $prod['name'], $prod['quantity'], $prod['price']
		...
	}
**/

/** Print out order summary **/

/** Clear session/cart **/


$con = mysqli_connect($connectionInfo["HOST"],$connectionInfo["UID"],$connectionInfo["PWD"]);
if(!$con) die("Database connection failed: " . mysqli_error());

$db_select = mysqli_select_db($con, $connectionInfo["Database"]);
if(!$db_select) die("Database selection failed: " . mysqli_error());

if ($custId) {
	$sql = "Select * from customer where customerId = " . $custId;
	$result = mysqli_query($con, $sql);
	
	if ($usr = mysqli_fetch_assoc($result)) {

		if ($usr["password"] == $p) {
		
		if (isset($_SESSION['productList']) && count($_SESSION['productList'])) {
			
			$dateTime = new DateTime();
$currentDateTime = $dateTime->format("Y-m-d H:i:s");
$sql = "INSERT INTO ordersummary (orderDate, totalAmount, customerId) VALUES ('" . $currentDateTime . "', 0 ," . $custId .  ")";

if (mysqli_query($con, $sql)) {
	?> <p class="text-xl font-bold">Summary of Purchase</p> <?php
    $orderId = mysqli_insert_id($con);
    $total = 0;
    foreach ($_SESSION['productList'] as $prod) {

        $total += $prod['price']*$prod['quantity'];

        $sql2 = "INSERT INTO orderproduct (orderId, productId, quantity, price) VALUES (?, ?, ?, ?)";

        $stmt = $con->prepare($sql2);
        $stmt->bind_param("iiid", $orderId, $prod['id'], $prod['quantity'], $prod['price']);
        $stmt->execute();
        $stmt->close();
        
        ?>
        <div class="flex justify-center">
			
						<div class="bg-yellow-200 m-5 p-5 rounded-xl w-1/2 shadow-md hover:bg-blue-300 hover:shadow-xl transition duration-300">
							<div class="flex flex-row justify-between items-center">
								<h2 class="text-xl"><?php echo $prod['name']; ?></h2>
							<div class=""> Quantity: <?php echo $prod['quantity']; ?></div>
							<div class="text-red-700"> Price: $<?php echo number_format($prod['price'],2); ?></div>
							</div>	
						</div>
						
						</div>


        <?php
    }
	?> <p>Total Amount: $<?php echo $total; ?></p>
	<a href="./api/index.php" class= "text-lg text-center">Home</a><?php
    $sql3 = "UPDATE ordersummary SET totalAmount = ? WHERE orderId = ?";
    $stmt2 = $con->prepare($sql3);
    $stmt2->bind_param("di", $total, $orderId);
    $stmt2->execute();
    $stmt2->close();
}
else {
				echo "Error: " . $sql . "<br>" . mysqli_error($con);
			}
			
			$_SESSION['productList'] = array();
		} else {
			?>
			<div>Error: No items in the cart.</div>
			<?php 
		}
	
	} else {
		?>
		<div>Error: Wrong Password. Please go back to the last page and try again.</div>
		<?php 
	}} else{
		?>
		<div>Error: User does not exist. Please go back to the last page and try again.</div>
		<?php 
	} 
} else{ 
	?>
		<div>Error: User does not exist. Please go back to the last page and try again.</div>
		<?php 
}
    // Close the database connection
    mysqli_close($con);

?>

</body>
</html>

