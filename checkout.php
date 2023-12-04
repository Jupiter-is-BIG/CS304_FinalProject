<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grocery Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.15/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-cover bg-center bg-fixed backdrop-filter backdrop-blur-md" style="background-image: url('./img/background.jpg');">

    <div class="flex items-center justify-center h-screen">
        <div class="bg-white bg-opacity-80 backdrop-filter backdrop-blur-md p-8 rounded-md shadow-md max-w-md w-full">
            <h1 class="text-xl font-semibold mb-6 text-center">Enter your customer ID and password to complete the transaction:</h1>

            <form class="space-y-4" method="get" action="order.php">
                <input class="form-input" type="text" name="customerId" placeholder="Customer ID" required>
                <input class="form-input" type="password" name="po" placeholder="Password" required>

                <div class="flex space-x-4 justify-center">
                    <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded-md hover:bg-green-600">Submit</button>
                    <button type="reset" class="bg-gray-400 text-white py-2 px-4 rounded-md hover:bg-gray-500">Reset</button>
                </div>
            </form>
        </div>
    </div>

</body>

</html>
