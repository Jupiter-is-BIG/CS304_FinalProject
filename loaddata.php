<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body>
<?php
	include 'include/db_credentials.php';
	$con = mysqli_connect($connectionInfo["HOST"], $connectionInfo["UID"], $connectionInfo["PWD"]);

	if (!$con) {
		die("Database connection failed: " . mysqli_error());
	}

	$db_select = mysqli_select_db($con, $connectionInfo["Database"]);

	if (!$db_select) {
		die("Database selection failed: " . mysqli_error());
	}
	
	$fileName = "../ddl/SQLServer_orderdb.ddl";
	$file = file_get_contents($fileName, true);
	$lines = explode(";", $file);

	foreach ($lines as $line) {
		$line = trim($line);
		if ($line != "") {
			mysqli_query($con, $line);
		}
	}

	mysqli_close($con);

	header("Location: admin.php");
	exit();
?>

</body>
</html>