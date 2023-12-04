<?php 
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ray's Groceries</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-cover bg-center bg-fixed h-screen w-screen" style="background-image: url('../img/background.jpg');">

    <!-- Navigation Bar -->
    

    <!-- Main Content -->
    <div class="w-full h-full backdrop-filter  backdrop-blur-lg">
    <nav class="bg-gray-800 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-semibold">Ray's Groceries</h1>
            <div class="flex space-x-4">
                <a href="login.php" class="hover:text-gray-300">Login</a>
                <a href="listprod.php" class="hover:text-gray-300">Begin Shopping</a>
                <a href="listorder.php" class="hover:text-gray-300">List All Orders</a>
                <a href="customer.php" class="hover:text-gray-300">My Profile</a>
                <a href="admin.php" class="hover:text-gray-300">Administrators</a>
                <a href="logout.php" class="hover:text-gray-300">Log Out</a>
            </div>
        </div>
    </nav>
    <div class="flex justify-center items-center ">
    <div class="bg-white bg-opacity-75 backdrop-filter backdrop-blur-lg p-8 rounded-md shadow-md mt-8 mx-auto max-w-2xl">
        <?php 
            if ($_SESSION['authenticatedUser']) {
                echo ("<p class='text-center text-3xl mb-4'>Welcome, " . $_SESSION['authenticatedUser'] . "!</p>");
            }
        ?>
        <h2 class="text-4xl font-semibold mb-4">Welcome to Ray's Groceries</h2>
        <p class="text-gray-700 mb-8">
            Ray's Groceries is your modern and convenient solution for all your grocery needs. We offer a curated
            selection of high-quality products at unbeatable prices. Experience the future of grocery shopping with us!
        </p>

        <!-- Description about the shop -->
        <div class="mb-8">
            <h3 class="text-2xl font-semibold mb-2">About Us</h3>
            <p class="text-gray-700">
                At Ray's Groceries, we are dedicated to providing a seamless online shopping experience. Our
                user-friendly platform allows you to explore a diverse range of products and make hassle-free purchases.
                Join us and redefine your grocery shopping experience!
            </p>
        </div>

        <!-- Call-to-action button -->
        <div>
            <a href="listprod.php" class="bg-blue-500 text-white py-3 px-6 rounded-md hover:bg-blue-600">Begin Shopping</a>
        </div>
    </div>
    
    </div>
    

</body>

</html>
