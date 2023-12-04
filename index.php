<?php 
    session_start();
?>

<!DOCTYPE html>
<html>
<head>
<script src="https://cdn.tailwindcss.com"></script>

        <title>Ray's Grocery Main Page</title>

</head>
<body>
<h1 class="flex flex-col justify-center items-center h-screen w-full bg-red-100">
        <p class="text-3xl ">Welcome to Ray's Grocery</p>
        <?php 
        if ($_SESSION['authenticatedUser']) {
            echo ("<p> Welcome " . $_SESSION['authenticatedUser'] . "!</p>");
        }
        ?>
        <div class="flex flex-col justify-center items-center space-x-5 m-5 ">
        <div class="hover:bg-black hover:text-white transition duration-200 p-2 rounded-md"><a href="login.php">Login</a></div>
        <div class="hover:bg-black hover:text-white transition duration-200 p-2 rounded-md"><a href="listprod.php">Begin Shopping</a></div>
        <div class="hover:bg-black hover:text-white transition duration-200 p-2 rounded-md"><a href="listorder.php">List All Orders</a></div>
        <div class="hover:bg-black hover:text-white transition duration-200 p-2 rounded-md"><a href="customer.php">Customer Info</a></div>
        <div class="hover:bg-black hover:text-white transition duration-200 p-2 rounded-md"><a href="admin.php">Administrators</a></div>
        <div class="hover:bg-black hover:text-white transition duration-200 p-2 rounded-md"><a href="logout.php">Log out</a></div>
       </div>
        
</h1>



</body>
</head>




