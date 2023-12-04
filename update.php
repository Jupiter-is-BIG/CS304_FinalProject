<?php
// Get the current list of products
session_start();
$productList = null;
if (isset($_SESSION['productList'])){
	$productList = $_SESSION['productList'];
} else{ 	// No products currently in list.  Create a list.
	$productList = array();
}

// Add new product selected
// Get product information
if(isset($_GET['id']) && isset($_GET['val'])){
	$id = $_GET['id'];
	$val = $_GET['val'];
} else {
	header('Location: listprod.php');
}

// Update quantity if add same item to order again
if (isset($productList[$id])){
    if ($val == 0) unset($productList[$id]);
    else if ($val == -1 && $productList[$id]['quantity'] == 0);
	else $productList[$id]['quantity'] = $productList[$id]['quantity'] + $val;
}

$_SESSION['productList'] = $productList;
header('Location: showcart.php');
?>