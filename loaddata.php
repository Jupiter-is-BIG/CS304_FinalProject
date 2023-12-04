<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body>
<?php
	include 'include/db_credentials.php';
	$con = mysqli_connect($connectionInfo["HOST"],$connectionInfo["UID"],$connectionInfo["PWD"]);

	if(!$con) {
		die("Database connection failed: " . mysqli_error());
	}

	$db_select = mysqli_select_db($con, $connectionInfo["Database"]);

	if(!$db_select) {
		die("Database selection failed: " . mysqli_error());
	}
	echo("<h1>Connecting to database.</h1><p>");
	
	$fileName = "./ddl/SQLServer_orderdb.ddl";
	$file = file_get_contents($fileName, true);
	$lines = explode(";", $file);
	echo("<ol>");
	foreach ($lines as $line){
		$line = trim($line);
		if($line != ""){
			echo("<li>".$line . ";</li><br/>");
			mysqli_query($con, $line);
		}
	}
	// sqlsrv_close($con);
	echo("</p><h2>Database loading complete!</h2>");
?>
</body>
</html>