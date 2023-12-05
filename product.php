<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ray's Grocery - Product Information</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans">
<nav class="border-gray-200 bg-gray-900">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
    <a href="./" class="flex items-center space-x-3 rtl:space-x-reverse">
        <span class="self-center text-2xl font-semibold whitespace-nowrap text-white">Ray's Grocery</span>
    </a>
    <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 hover:bg-gray-700 focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false">
        <span class="sr-only">Open main menu</span>
    
    </button>
    <div class="hidden w-full md:block md:w-auto" id="navbar-default">
      <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white bg-gray-800 md:bg-gray-900 border-gray-700">
        <li>
          <a href="./" class="block py-2 px-3  rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:p-0 text-white md:hover:text-blue-500 hover:bg-gray-700 hover:text-white md:hover:bg-transparent">Home</a>
        </li>
        <li>
          <a href="./customer.php" class="block py-2 px-3 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Profile</a>
        </li>
        <li>
          <a href="./listprod.php" class="block py-2 px-3 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Shop</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<?php 
    include 'include/db_credentials.php';
?>

<?php
// Get product name to search for
$id = $_GET['id'];

$con = mysqli_connect($connectionInfo["HOST"], $connectionInfo["UID"], $connectionInfo["PWD"]);
if (!$con) die("Database connection failed: " . mysqli_error());

$db_select = mysqli_select_db($con, $connectionInfo["Database"]);
if (!$db_select) die("Database selection failed: " . mysqli_error());

$sql = "Select * from product where productid = ?";

$stmt = $con->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = mysqli_fetch_assoc($result);

$url = "addcart.php?id=" . $row['productId'] . "&name=" . urlencode($row['productName']) . "&price=" . $row['productPrice'];
?>

<div class="container mx-auto my-8 p-4 bg-white shadow-lg rounded-lg">
    <h1 class="text-3xl font-semibold mb-4"><?php echo $row['productName']; ?></h1>


    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div class="text-lg">
            <h3 class="text-xl font-semibold mb-2">Product Details</h3>
            <p class="text-gray-700">Product Id: <?php echo $row['productId']; ?></p>
            <p class="text-gray-700">Price: $<?php echo $row['productPrice']; ?></p>
            <p class="text-gray-700"><?php echo $row['productDesc']; ?></p>
            <?php if ($row['productImageURL']) { ?>
        <img src="<?php echo $row['productImageURL']; ?>" alt="Product Image" class="mb-4 rounded-lg shadow-lg">
    <?php } ?>
        </div>
        <div>
            <?php if ($row['productImage']) { ?>
                <img src="displayImage.php?id=<?php echo $row['productId'];?>" alt="BLOB Image" class="w-full h-auto rounded-lg shadow-lg">
            <?php } else { ?>
                <img src="./img/nan.png" alt="BLOB Image" class="w-full h-auto rounded-lg shadow-lg">
            <?php } ?>
        </div>
    </div>

    <div class="mt-4">
        <a href="<?php echo $url; ?>" class="bg-blue-500 text-white py-2 px-4 rounded-md inline-block">Add to Cart</a>
        <a href="listprod.php" class="ml-2 text-blue-500">Continue Shopping</a>
    </div>
</div>

<?php
// Close the database connection
mysqli_close($con);
?>
</body>
</html>
