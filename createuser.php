<?php
session_start();
// Check if form is submitted
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     // Get form data
//     $firstname = $_POST['firstname'];
//     $lastname = $_POST['lastname'];
//     $email = $_POST['email'];
//     $phonenum = $_POST['phonenum'];
//     // ... add the rest of your form fields here

//     // Database credentials
//     $servername = "localhost";
//     $username = "username";
//     $password = "password";
//     $dbname = "orders";

//     try {
//         // Create connection
//         $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
//         // Set the PDO error mode to exception
//         $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//         // Prepare SQL statement
//         $sql = "INSERT INTO customer (firstname, lastname, email, phonenum) VALUES (?, ?, ?, ?)";
//         $stmt = $conn->prepare($sql);
//         $stmt->execute([$firstname, $lastname, $email, $phonenum]);

//         echo "New account created!";
//     } catch(PDOException $e) {
//         echo "Error: " . $e->getMessage();
//     }

//     // Close connection
//     $conn = null;
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Sign Up</title>
    <!--Chatgpt used for design and layout of page -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-cover bg-center bg-fixed min-h-screen w-screen" style="background-image: url('./img/background.jpg');">
<nav class="border-gray-200 bg-gray-900">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
    <a href="./" class="flex items-center space-x-3 rtl:space-x-reverse">
        <span class="self-center text-2xl font-semibold whitespace-nowrap text-white">Ray's Grocery</span>
    </a>    
  </div>
</nav>
<div class="backdrop-filter backdrop-blur-md flex flex-col items-center justify-center px-6 py-8 mx-auto md:py-0">
    <div class="w-full bg-white rounded-lg shadow dark:border sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
        <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
            <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                Create User Account
            </h1>
                <form action="index.php" method="post" class="mt-4">               
                    <!-- User Details -->
                    <label for="firstname">First name:</label><br>
                    <input type="text" name="firstname" id="firstname" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="First Name" required><br>

                    <label for="lastname">Last name:</label><br>
                    <input type="text" name="lastname" id="lastname" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Last Name"  required=""><br>

                    <label for="email">Email:</label><br>
                    <input type="email" name ="emailaddress" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Email address"  required ><br>

                    <label for="phonenum">Phone Number:</label><br>
                    <input type="tel" name ="phonenum" id="phonenum" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Phone Number"  required  maxlength="10"><br>

                    <!-- Address Details -->
                    <label for="address">Address:</label><br>
                    <input type="text" id="address" name="address" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Address"  required ><br>

                    <label for="city">City:</label><br>
                    <input type="text" id="city" name="city" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="City"  required ><br>

                    <label for="state">State:</label><br>
                    <input type="text" id="state" name="state" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="State"  required  ><br>

                    <label for="postalcode">Postal Code:</label><br>
                    <input type="text" id="postalcode" name="postalcode" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Postal Code"  required  maxlength="10"><br>

                    <label for="country">Country:</label><br>
                    <input type="text" id="country" name="country" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Country"  required ><br>

                    <!-- Login Details -->
                    <label for="userid">User ID:</label><br>
                    <input type="text" id="userid" name="userid" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Username"  required  minlength="3"><br>

                    <label for="password">Password:</label><br>
                    <input type="password" id="password" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="*******"  required ><br>
                    <!-- Submit Button -->
                
                    <button type="submit" class="my-2 w-full text-white bg-gray-600 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Create Account</button>
                </form>
                <!-- End of Form -->                    
                <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                    Already have an account? <a href="./login.php" class="font-medium text-primary-600 hover:underline dark:text-primary-500">Log in</a>
                </p>
                
            </div>
        </div>
    </div>
</div>
</body>
</html>