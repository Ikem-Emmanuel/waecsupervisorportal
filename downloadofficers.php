<?php 
require_once "connection.php";
require_once "miscfunction.php";
		
	//checks if the Adminofficer is logged in
	if(!isset($_SESSION["officerId"])){ header("location:login.php"); }
	if($_SESSION["level"] ==1 ){ header("location:login.php"); }
		
		$con = new Connection;
		$connection = $con->getConnection();
		
		$miscfunction = new MiscFunction($connection);
		$miscfunction->downloadAllOfficers();//downloads list of all registered officers
		
?>