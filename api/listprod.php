<?php 
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>YOUR NAME Grocery</title>
<script src="https://cdn.tailwindcss.com"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#categoryDropdown').change(function() {
            var selectedUrl = $('option:selected', this).data('url');
            if (selectedUrl) {
                window.location.href = selectedUrl;
            }
        });
    });
</script>
</head>
<body class="bg-gray-200">


<nav class="bg-white border-gray-200 dark:bg-gray-900">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
    <a href="./" class="flex items-center space-x-3 rtl:space-x-reverse">
        <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Ray's Grocery</span>
    </a>
    <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false">
        <span class="sr-only">Open main menu</span>
    
    </button>
    <div class="hidden w-full md:block md:w-auto" id="navbar-default">
      <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
        <li>
          <a href="./" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Home</a>
        </li>
        <li>
          <a href="../customer.php" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Profile</a>
        </li>
        <li>
          <a href="../showcart.php" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">My Cart</a>
        </li>
      </ul>
    </div>
  </div>
</nav>


<?php
$catId = "-1";
if(isset($_GET['po'])) {
	$catId = $_GET['po'];
}

?>
<form method="get" action="listprod.php">
    <div class="flex flex-col items-center">
    <?php 
        if (isset($_SESSION['authenticatedUser']) && $_SESSION['authenticatedUser']) {
            echo ("<h1 class=\"m-2 text-xl mt-5\"> Welcome " . $_SESSION['authenticatedUser'] . "!</h1>");
        }
        ?>
        <h1 class="text-xl font-bold m-5">Search for the products you want to buy</h1>
        <div class="flex flex-row">
            <input type="text" name="productName" size="50" class="border border-black rounded-lg h-10 px-2 m-3">
            <!-- ADD DROP DOWN -->
            <select id="categoryDropdown" name="categoryId" class="border border-black rounded-lg h-10 m-3">
                <option value="-1">All Categories</option>
                <?php
                // Fetch categories from the database and populate the dropdown menu
                include 'include/db_credentials.php';
                $con = mysqli_connect($connectionInfo["HOST"],$connectionInfo["UID"],$connectionInfo["PWD"]);
                $db_select = mysqli_select_db($con, $connectionInfo["Database"]);
                $categoryQuery = "SELECT * FROM category";
                $categoryResult = mysqli_query($con, $categoryQuery);
                while ($category = mysqli_fetch_assoc($categoryResult)) {
                    echo "<option data-url=\"listprod.php?po=" . $category['categoryId'] . "\" value=\"" . $category['categoryId'] . "\">" . $category['categoryName'] . "</option>";
                }
                $con->close();
                ?>
            </select>
        </div>
        <div class="flex flex-row space-x-2">
            <input type="submit" value="Submit" class="bg-green-300 rounded-lg p-2"><input type="reset" value="Reset" class="bg-gray-300 rounded-lg p-2"> 
        </div>
        (Leave blank for all products)
    </div>
</form>

<?php

	include 'include/db_credentials.php';
	$name = "";
	/** Get product name to search for **/
	if (isset($_GET['productName'])){
		$name = $_GET['productName'];
	}

	/** $name now contains the search string the user entered
	 Use it to build a query and print out the results. **/

	/** Create and validate connection **/

	/** Print out the ResultSet **/

	/** 
	For each product create a link of the form
	addcart.php?id=<productId>&name=<productName>&price=<productPrice>
	Note: As some product names contain special characters, you may need to encode URL parameter for product name like this: urlencode($productName)
	**/
	
	/** Close connection **/

	/**
        Useful code for formatting currency:
	       number_format(yourCurrencyVariableHere,2)
     **/

	 // Connecting to db and checking for errors
	$con = mysqli_connect($connectionInfo["HOST"],$connectionInfo["UID"],$connectionInfo["PWD"]);
	if(!$con) die("Database connection failed: " . mysqli_error());

	$db_select = mysqli_select_db($con, $connectionInfo["Database"]);
	if(!$db_select) die("Database selection failed: " . mysqli_error());
    if (isset($_SESSION['authenticatedUser']) && $_SESSION['authenticatedUser'] && $_SESSION['authenticatedUser']!="") {
        $sql2 = "SELECT categoryId,productId,productName,productPrice,productImage,categoryName,count(*) as sales from ordersummary natural join orderproduct natural join product natural join customer natural join category where userid = '" . $_SESSION['authenticatedUser'] . "' group by categoryId,productId,productName,productPrice,productImage,categoryName having sales > 0 order by sales desc limit 5";
        $result2 = mysqli_query($con, $sql2);
        ?>
            <h1 class="text-2xl font-bold m-5">Recommendations</h1>
            <div class="flex flex-row overflow-x-auto px-2">
            <?php
                while($row2 = mysqli_fetch_assoc($result2)) {
                    $productUrl = "product.php?id=" . $row2['productId'];
                    $addToCartUrl = "addcart.php?id=" . $row2['productId'] . "&name=" . urlencode($row2['productName']) . "&price=" . $row2['productPrice'];
            ?>
                <div class="bg-white m-2 p-3 w-[200px] shadow-lg hover:shadow-2xl transition duration-300 rounded-lg flex flex-col justify-between">
                    <a href="<?php echo $productUrl; ?>">
                        <?php if ($row2['productImage']) { ?>
                            <img src="displayImage.php?id=<?php echo $row2['productId'];?>" alt="Product Image" class="w-full h-[150px] object-cover rounded-lg mb-2">
                        <?php } else { ?>
                            <img src="../img/nan.png" alt="Product Image" class="w-full h-[150px] object-cover rounded-lg mb-2">
                        <?php } ?>
                        <div class="text-lg font-semibold text-gray-800"><?php echo $row2['productName']; ?></div>
                        <div class="text-sm text-gray-500 mb-1"><?php echo $row2['categoryName']; ?></div>
                       
                    </a>
                    <div class="flex flex-row justify-between">
                    <div class="text-xl text-green-500 font-semibold">$<?php echo number_format($row2['productPrice'], 2); ?></div>
                    <a href="<?php echo $addToCartUrl; ?>" class="w-8 h-8  bg-green-500 text-white rounded-full flex justify-center items-center hover:bg-green-600 transition duration-200">+</a>

                    </div>
                </div>
            <?php
                }
            ?>
        </div>
        <br>
        <h1 class="text-2xl font-bold m-5">Products</h1>
        <?php
        
    }





	$sql = "SELECT categoryId,productId,productName,productPrice,productImage,categoryName,count(*) as sales  FROM product natural join category natural join orderproduct WHERE productName LIKE CONCAT('%', ?, '%') group by categoryId,productId,productName,productPrice,productImage,categoryName order by sales desc";
	$stmt = $con->prepare($sql);
	$stmt->bind_param("s", $name);
	$stmt->execute();
   
    

	$result = $stmt->get_result();
	$stmt->close();

	while ($row = mysqli_fetch_assoc($result)) {
		if ($catId != "-1" && $catId != $row['categoryId']) continue;
		$url = "addcart.php?id=" . $row['productId'] . "&name=" . urlencode($row['productName']) . "&price=" . $row['productPrice'];
        $url2 = "product.php?id=" . $row['productId'];
        ?>
		<div class="flex justify-center">
    <div class="bg-gray-800 m-2 p-6 rounded-xl w-[70%] shadow-lg hover:shadow-2xl transition duration-300">

        <div class="flex flex-row items-center">
            <?php if ($row['productImage']) { ?>
                <img src="displayImage.php?id=<?php echo $row['productId'];?>" alt="BLOB Image" class="w-[20%] h-auto rounded-lg shadow-lg">
            <?php } else { ?>
                <img src="../img/nan.png" alt="BLOB Image" class="w-[20%] h-auto rounded-lg shadow-lg">
            <?php } ?>

            <div class="flex flex-col ml-4">
                <a class="text-2xl text-white font-semibold hover:underline" href=<?php echo $url2 ?>><?php echo $row['productName']; ?></a>
                <p class="text-lg text-gray-400">(<?php echo $row['categoryName']; ?>)</p>
            </div>

            <div class="ml-auto text-right">
                <a class="rounded-full border border-white w-12 h-12 flex justify-center items-center bg-white text-gray-800 hover:bg-gray-200 hover:text-gray-800 transition duration-200" href=<?php echo $url ?>>+</a>
                <div class="text-xl text-green-500 font-semibold mt-2"> $<?php echo number_format($row['productPrice'], 2); ?></div>
            </div>
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