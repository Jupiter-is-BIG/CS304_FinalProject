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
<body>

<?php
$catId = "-1";
if(isset($_GET['po'])) {
	$catId = $_GET['po'];
}

?>
<form method="get" action="listprod.php">
    <div class="flex flex-col items-center">
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

	$sql = "SELECT * FROM product natural join category WHERE productName LIKE CONCAT('%', ?, '%')";
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
        <div class="bg-yellow-200 m-5 p-5 rounded-xl w-1/2 shadow-md hover:bg-blue-300 hover:shadow-xl transition duration-300">
			<div class="flex flex-row justify-between items-center">
				<div class="flex flex-row items-center space-x-5">
					<a class="rounded-xl border border-black w-10 h-10 flex justify-center items-center bg-black text-white hover:bg-white hover:text-black transition duration-200" href = <?php echo $url ?>>+</a>
				<a class="text-xl" href=<?php echo $url2 ?>><?php echo $row['productName']; ?></a>
				<h2 class="text-xl text-blue-600">(<?php echo $row['categoryName']; ?>)</h2>
				</div>
            <div> $<?php echo number_format($row['productPrice'],2); ?></div>
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