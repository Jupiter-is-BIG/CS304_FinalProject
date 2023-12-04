<?php
// Get the current list of products
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Your Shopping Cart</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>

<body class="bg-gray-100">
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
          <a href="./api/" class="block py-2 px-3  rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:p-0 text-white md:hover:text-blue-500 hover:bg-gray-700 hover:text-white md:hover:bg-transparent">Home</a>
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
    $productList = null;
    if ( count($_SESSION['productList'])) {
        $productList = $_SESSION['productList'];
    ?>
        <div class="container mx-auto p-8 bg-white rounded-md shadow-md my-8">
            <h1 class="text-3xl mb-4">Your Shopping Cart</h1>

            <?php
            $total = 0;

            foreach ($productList as $id => $prod) {
                $add = "update.php?id=" . $prod['id'] . "&val=1";
                $sub = "update.php?id=" . $prod['id'] . "&val=-1";
                $x = "update.php?id=" . $prod['id'] . "&val=0";
                $price = $prod['price'];
                $total = $total + $prod['quantity'] * $price;
            ?>
                <div class="flex items-center justify-between bg-gray-200 p-4 my-3 rounded-md">
                    <div class="flex items-center space-x-4">
                        <div class="flex-shrink-0 w-16 h-16">
                            <!-- Product Image (if available) -->
                        </div>
                        <div>
                            <p class="text-gray-800 text-lg font-semibold"><?php echo $prod["name"] ?></p>
                            <p class="text-gray-500 text-sm">ID: <?php echo $prod["id"] ?></p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center space-x-2">
                            <p class="text-gray-500">Quantity:</p>
                            <p class="text-gray-800 font-semibold"><?php echo $prod["quantity"] ?></p>
                        </div>
                        <p class="text-gray-800 font-semibold">Price: $<?php echo number_format($price, 2) ?></p>
                        <p class="text-gray-800 font-semibold">Subtotal: $<?php echo number_format($prod['quantity'] * $price, 2) ?></p>
                        <div class="flex items-center space-x-2">
                            <a href="<?php echo $add ?>"><button class="bg-blue-500 text-white rounded-md px-3 py-1">➕</button></a>
                            <a href="<?php echo $sub ?>"><button class="bg-red-500 text-white rounded-md px-3 py-1">➖</button></a>
                            <a href="<?php echo $x ?>"><button class="bg-gray-500 text-white rounded-md px-3 py-1">🗑️</button></a>
                        </div>
                    </div>
                </div>
            <?php
            }
            echo("<p class='text-lg text-red-600 text-right mr-10'>Order Total: $" . number_format($total, 2) . "</p>");
            echo("<h2 class='text-right'><a href='checkout.php' class='bg-black text-white px-4 py-2 rounded-md mt-5'>Check Out</a></h2>");
            ?>

        </div>
    <?php
    } else {
        echo("<h1 class='text-3xl text-center mt-10'>Your shopping cart is empty!</h1>");
    }
    ?>

    <h2 class="w-screen flex justify-center items-center mt-5">
        <a href="listprod.php" class="bg-black text-white px-4 py-2 rounded-md flex justify-center items-center w-1/2">
            <p>Continue Shopping</p>
        </a>
    </h2>

</body>

</html>
