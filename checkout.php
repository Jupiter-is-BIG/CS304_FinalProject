<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grocery CheckOut Line</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.15/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f7fa;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .form-input {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-button {
            background-color: #4caf50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .form-button:hover {
            background-color: #45a049;
        }

        .form-button-secondary {
            background-color: #ccc;
        }

        .form-button-secondary:hover {
            background-color: #bbb;
        }
    </style>
</head>

<body>
    <div class="container mt-8">
        <h1 class="text-3xl font-semibold mb-6">Enter your customer ID and PO number to complete the transaction:</h1>

        <form class="space-y-4" method="get" action="order.php">
            <input class="form-input" type="text" name="customerId" placeholder="Customer ID" required>
            <input class="form-input" type="text" name="po" placeholder="PO Number" required>

            <div class="flex space-x-4">
                <button type="submit" class="form-button">Submit</button>
                <button type="reset" class="form-button form-button-secondary">Reset</button>
            </div>
        </form>
    </div>
</body>

</html>
