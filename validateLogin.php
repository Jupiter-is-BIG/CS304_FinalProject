<?php 
    session_start();          
    $authenticatedUser = validateLogin();
    
    if ($authenticatedUser != null)
		echo $authenticatedUser;
        // header('Location: index.php');      		// Successful login
    else
        header('Location: login.php');	             // Failed login - redirect back to login page with a message     
    
	function validateLogin()
	{	  
	    $user = $_POST["username"];	 
	    $pw = $_POST["password"];
		$retStr = null;

		if ($user == null || $pw == null)
			return null;
		if ((strlen($user) == 0) || (strlen($pw) == 0))
			return null;

		include 'include/db_credentials.php';
		$con = mysqli_connect($connectionInfo["HOST"],$connectionInfo["UID"],$connectionInfo["PWD"]);
		if(!$con) die("Database connection failed: " . mysqli_error());
		
		$db_select = mysqli_select_db($con, $connectionInfo["Database"]);
		if(!$db_select) die("Database selection failed: " . mysqli_error());
		
		// TODO: Check if userId and password match some customer account. If so, set retStr to be the username.
		$sql = "Select * from customer where userId = ? and password = ?";		
		$stmt = $con->prepare($sql);
		$stmt->bind_param("ss", $user, $pw);
		$stmt->execute();
		$result = $stmt->get_result();
		$rst = mysqli_fetch_assoc($result);
		$retStr = null;
		if ($rst) {
			$retStr = $user;
		} 
		
		
		mysqli_close($con);

		
		if ($retStr != null)
		{	$_SESSION["loginMessage"] = null;
	       	$_SESSION["authenticatedUser"] = $user;
		}
		else
		    $_SESSION["loginMessage"] = "Could not connect to the system using that username/password.";

		return $retStr;
	}	
?>