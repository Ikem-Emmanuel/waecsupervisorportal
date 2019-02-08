<?php 
	session_start();
	if((isset($_SESSION["officerId"])) && ($_SESSION["level"])) {
		unset($_SESSION["officerId"]);
		unset($_SESSION["level"]);
		session_destroy();
		header("location:login.php");
	}
?>