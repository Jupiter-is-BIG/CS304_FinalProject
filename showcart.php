<?php
// Get the current list of products
session_start();
?>

<!DOCTYPE html>
<html>
<head>
<script src="https://cdn.tailwindcss.com"></script>
<title>Your Shopping Cart</title>
</head>
<body class="bg-yellow-100">

<?php
$productList = null;
if (count($_SESSION['productList'])){
	$productList = $_SESSION['productList'];
	?>
		<h1 class="text-3xl m-4">Your Shopping Cart</h1>
		
	<?php
	
	$total =0;

	foreach ($productList as $id => $prod) {
		$add = "update.php?id=" . $prod['id'] . "&val=1";
		$sub = "update.php?id=" . $prod['id'] . "&val=-1";
		$x = "update.php?id=" . $prod['id'] . "&val=0";
		$price = $prod['price'];
		$total = $total +$prod['quantity']*$price;

		?>
			<div class="flex flex-row space-x-10 m-5 items-center bg-gray-100 justify-between p-2">
			<p><p class="text-xs text-gray-400 mr-5">Id: </p><p><?php echo $prod["id"]?></p></p>
			<p><p class="text-xs text-gray-400 mr-5">Name: </p><p><?php echo $prod["name"]?></p></p>
			<p><p class="text-xs text-gray-400 mr-5">Quantity: </p><p><?php echo $prod["quantity"]?></p></p>
			<p><p class="text-xs text-gray-400 mr-5">Price: </p><p><?php echo number_format($price ,2)?></p></p>
			<p><p class="text-xs text-gray-400 mr-5">Subtital: </p><p><?php echo number_format($prod['quantity']*$price, 2)?></p></p>
			<a href="<?php echo $add ?>"><button>➕</button></a>
			<a href="<?php echo $sub ?>"><button>➖</button></a>
			<a href="<?php echo $x ?>"><button>🗑️</button></a>
			</div>
		<?php
		
		
	}
	echo("<p class = \"text-lg text-red-600 text-right mr-10\">Order Total $" . number_format($total,2) . "</p>");

	echo("<h2><a href=\"checkout.php\" class=\"bg-black text-white p-2 rounded-md m-10\">Check Out</a></h2>");
} else{
	echo("<H1 class=\"text-3xl m-10 text-center\">Your shopping cart is empty!</H1>");
}
?>
<h2 class="w-screen flex justify-center items-center"><a href="listprod.php"  class="bg-black text-white p-2 rounded-md flex justify-center items-center w-1/2"><p>Continue Shopping</p></a></h2>


</body>
</html> 

