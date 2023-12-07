<?php
    session_start();  
	if(isset($_SESSION['authenticatedUser'])) $authenticated = $_SESSION['authenticatedUser']  == null ? false : true;
	else {
		header('Location: login.php');
	}

	if (!$authenticated)
	{
		// $loginMessage = "You have not been authorized to access the URL " . $_SERVER['REQUEST_URI'];
        // $_SESSION['loginMessage']  = $loginMessage;        
		header('Location: login.php');
	}
?>
