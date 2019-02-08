<?php 
require_once "connection.php";
require_once "miscfunction.php";
	
	//get office Id of a logged in officer
	if(isset($_SESSION["officerId"])){
		$id = $_SESSION["officerId"];	

		$con = new Connection;
		$connection = $con->getConnection();

		$miscfunction = new MiscFunction($connection);
		$miscfunction->download($id);//downloads list of supervisors with respect to officename; saves file as "officename_officelocation.CSV"
	}
	else{
		header("location:login.php");
	}
?>