<?php 
    include 'auth.php';    
    $user = $_SESSION['authenticatedUser'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Page</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="font-sans bg-gray-200">

<?php     
    include 'include/db_credentials.php';
?>


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
          <a href="./customer.php" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Profile</a>
        </li>
        <li>
          <a href="./showcart.php" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">My Cart</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<?php
// TODO: Print Customer information
if (!$user) {
    echo "<script>window.alert('Please login to see this page')</script>";
} else {
    // Make sure to close connection
    $con = mysqli_connect($connectionInfo["HOST"], $connectionInfo["UID"], $connectionInfo["PWD"]);
    if (!$con) die("Database connection failed: " . mysqli_error());

    $db_select = mysqli_select_db($con, $connectionInfo["Database"]);
    if (!$db_select) die("Database selection failed: " . mysqli_error());

    $sql = "SELECT * FROM customer WHERE userid = '" . $user . "'";
    $result = mysqli_query($con, $sql);
    $rs = mysqli_fetch_assoc($result);
    ?>

    <div class="container mx-auto mt-8 p-6 bg-white rounded-lg shadow-md">
        <div class="flex flex-row space-x-2">
            <div class="text-3xl">👤</div>
            <h2 class="text-3xl font-bold mb-4 text-gray-800">Customer Profile</h2>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <p class="text-lg font-semibold mb-2">Personal Information</p>
                <p><span class="font-semibold">Name:</span> <?= $rs["firstName"] ?> <?= $rs["lastName"] ?></p>
                <p><span class="font-semibold">Email:</span> <?= $rs["email"] ?></p>
                <p><span class="font-semibold">Phone:</span> <?= $rs["phonenum"] ?></p>
            </div>
            <div>
                <p class="text-lg font-semibold mb-2">Address Information</p>
                <p><span class="font-semibold">Address:</span> <?= $rs["address"] ?></p>
                <p><span class="font-semibold">City:</span> <?= $rs["city"] ?></p>
                <p><span class="font-semibold">State:</span> <?= $rs["state"] ?></p>
                <p><span class="font-semibold">Postal Code:</span> <?= $rs["postalCode"] ?></p>
                <p><span class="font-semibold">Country:</span> <?= $rs["country"] ?></p>
            </div>
        </div>

        <p class="text-lg font-semibold mt-4">User Information</p>
        <p><span class="font-semibold">User ID:</span> <?= $rs["userid"] ?></p>
    </div>


    <div class="container mx-auto mt-8 p-6 bg-white rounded-lg shadow-md mb-8">
    <div class="flex flex-row space-x-2">
        <div class="text-3xl">🛒</div>
        <h2 class="text-3xl font-bold mb-4 text-gray-800">My Orders</h2>
    </div>

    <?php
    $sql = "Select orderId, orderDate, customer.customerId, firstName, lastName,  totalAmount from ordersummary natural join customer where userid = '" . $user . "'";
    $result = mysqli_query($con, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        $sql2 = "Select productId, quantity, price from orderproduct where orderId = " . $row['orderId'];
        $result2 = mysqli_query($con, $sql2);
    ?>
        <div class="bg-gray-100 m-5 p-5 rounded-xl shadow-md hover:shadow-lg transition duration-300 ease-in-out">
            <div class="flex flex-row justify-between items-center">
                <h2 class="text-xl font-bold text-gray-800">Order ID <?php echo $row['orderId']; ?></h2>
                <p class="text-gray-600">Order Date: <?php echo $row['orderDate']; ?></p>
            </div>
            <p class="text-xl text-red-800">Total Amount: $<?php echo number_format($row['totalAmount'], 2); ?></p>
            <div class="flex justify-center mt-4">
                <div class="w-full border-t border-gray-300 pt-4">
                    <div class="grid grid-cols-3 gap-4 text-sm text-gray-600">
                        <div class="flex items-center justify-center">Product Id</div>
                        <div class="flex items-center justify-center">Quantity</div>
                        <div class="flex items-center justify-center">Price</div>
                    </div>

                    <?php
                    while ($row2 = mysqli_fetch_assoc($result2)) {
                    ?>
                        <div class="grid grid-cols-3 gap-4 mt-2 text-sm">
                            <div class="flex items-center justify-center"><?php echo $row2['productId'] ?></div>
                            <div class="flex items-center justify-center"><?php echo $row2['quantity'] ?></div>
                            <div class="flex items-center justify-center text-red-700">$<?php echo number_format($row2['price'], 2) ?></div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    <?php
    }
    ?>
</div>






    <div class="container mx-auto mt-8 p-6 bg-white rounded-lg shadow-md mb-8">
        <div class="flex flex-row space-x-2">
            <div class="text-3xl">✏️</div>
            <h2 class="text-3xl font-bold mb-4 text-gray-800">Edit Profile</h2>
        </div>

        

    <form action="update_profile.php" method="post">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
       
            <div>
                <p class="text-lg font-semibold mb-2">Address Information</p>
                <div class="flex flex-col space-y-2">
                <label for="address" class="block text-sm font-medium text-gray-600">Address:</label>
                <input type="text" name="address" id="address" value="<?= $rs["address"] ?>" class="mt-1 p-2 border rounded-md w-full">

                <label for="city" class="block text-sm font-medium text-gray-600">City:</label>
                <input type="text" name="city" id="city" value="<?= $rs["city"] ?>" class="mt-1 p-2 border rounded-md w-full">

                <label for="state" class="block text-sm font-medium text-gray-600">State:</label>
                <input type="text" name="state" id="state" value="<?= $rs["state"] ?>" class="mt-1 p-2 border rounded-md w-full">

                <label for="postalCode" class="block text-sm font-medium text-gray-600">Postal Code:</label>
                <input type="text" name="postalCode" id="postalCode" value="<?= $rs["postalCode"] ?>" class="mt-1 p-2 border rounded-md w-full">

                <label for="country" class="block text-sm font-medium text-gray-600">Country:</label>
                <input type="text" name="country" id="country" value="<?= $rs["country"] ?>" class="mt-1 p-2 border rounded-md w-full">
                </div>
            </div>
            <div class="mt-4">
            <p class="text-lg font-semibold mb-2">Change Password</p>
            <label for="oldPassword" class="block text-sm font-medium text-gray-600">Old Password:</label>
            <input type="password" name="oldPassword" id="oldPassword" class="mt-1 p-2 border rounded-md w-full">

            <label for="newPassword" class="block text-sm font-medium text-gray-600">New Password:</label>
            <input type="password" name="newPassword" id="newPassword" class="mt-1 p-2 border rounded-md w-full">
        </div>
        </div>
        <div class="mt-6">
            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Save Changes
            </button>
        </div>
    </form>
</div>


</div>


    <?php
    mysqli_close($con);
}
?>
</body>
</html>
