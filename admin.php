<?php 
    // TODO: Include files auth.php and include/db_credentials.php
    include 'auth.php';
    include 'include/db_credentials.php';
    ?>

<?php
 $con = mysqli_connect($connectionInfo["HOST"], $connectionInfo["UID"], $connectionInfo["PWD"]);
 if (!$con) die("Database connection failed: " . mysqli_error());

 $db_select = mysqli_select_db($con, $connectionInfo["Database"]);
 if (!$db_select) die("Database selection failed: " . mysqli_error());

 $sql = "SELECT DATE(orderdate) AS order_date, SUM(totalAmount) AS amt FROM ordersummary GROUP BY order_date";
 $result = mysqli_query($con, $sql);

    $dataPoints = array(
    );

    while ($row = mysqli_fetch_assoc($result)) {
        $dataPoints[] = array(
            "y" => (int)$row['amt'],
            "label" => $row['order_date']
        );
        
    }
 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator Page</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        window.onload = function () {
            var chart = new CanvasJS.Chart("chartContainer", {
                title: {
                    text: "Sales Report Graph"
                },
                axisY: {
                    title: "Total Sale Amount"
                },
                axisX: {
                    title: "Date"
                },
                data: [{
                    type: "line",
                    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart.render();
        }
    </script>
</head>

<body class="bg-gray-100 p-8">

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
          <a href="../customer.php" class="block py-2 px-3 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Profile</a>
        </li>
        <li>
          <a href="../listprod.php" class="block py-2 px-3 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Shop</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

        <!-- Sales Chart Section -->
        <div class="bg-white p-8 rounded-md shadow-md">
            <h2 class="text-2xl font-semibold mb-4">Total Sales by Day</h2>

            <div class="overflow-x-auto">
                <table class='table-auto w-full'>
                    <thead>
                        <tr>
                            <th class='px-4 py-2'>Order Date</th>
                            <th class='px-4 py-2'>Sale</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($dataPoints as $dataPoint) {
                            echo "<tr>";
                            echo "<td class='border px-4 py-2'>" . $dataPoint['label'] . "</td>";
                            echo "<td class='border px-4 py-2'>" . $dataPoint['y'] . "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <div id="chartContainer" style="height: 370px; width: 100%;"></div>
            <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
        </div>

        <!-- Customer Details Section -->
        <?php
           $sql = "SELECT * from customer";
           $result = mysqli_query($con, $sql);
        ?>
        <div class="bg-white p-8 rounded-md shadow-md">
            <h2 class="text-2xl font-semibold mb-4">Customer Details</h2>

            <div class="overflow-x-auto">
                <table class='table-auto w-full'>
                    <thead>
                        <tr>
                            <th class='px-4 py-2'>Customer ID</th>
                            <th class='px-4 py-2'>Name</th>
                            <th class='px-4 py-2'>Email</th>
                            <th class='px-4 py-2'>Phone</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td class='border px-4 py-2'>" . $row['customerId'] . "</td>";
                            echo "<td class='border px-4 py-2'>" . $row['firstName'] . " " . $row['lastName'] . "</td>";
                            echo "<td class='border px-4 py-2'>" . $row['email'] . "</td>";
                            echo "<td class='border px-4 py-2'>" . $row['phonenum'] . "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</body>

</html>

<?php
// Close the database connection
mysqli_close($con);
?>
