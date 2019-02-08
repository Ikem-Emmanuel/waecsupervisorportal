<?php 
			require_once "connection.php";
			require_once "miscfunction.php";
			require_once "notifications.php";
			
			if(!isset($_SESSION["officerId"])){ header("location:login.php"); }
			if($_SESSION["level"] ==1){ header("location:login.php"); }
			
								//Fetches the id and then compares with the database
								if (isset($_GET["id"])){
									$id = $_GET["id"];
									$con= new connection();
									$connection = $con->getConnection();
									$miscfunction = new MiscFunction($connection);
									$notifyObject= new Notifications();
									/**
									*Function searches the supervisor table from the database 
									*@param $connection- instance of connection class
									*@return $resultset - result of search query
									*/
									
									$row = $miscfunction->getOfficerDetails($id);
									
									$status= $row["Status"];
									$newid= $row["Id"];
									$fullName=$row["Fullname"];
									
									$reset_pass= "1234567";	
									$newPassword = sha1($reset_pass);
									
									$query = "update officer set Password='$newPassword' where Id = '$id'";
									$result = $connection->query($query) or die(mysqli_error());	
									
									
									$_SESSION["password_reset"]="<div class='not_found'>Officer "  .$fullName. "'s password has been reset<br /><br /><a href='' class='btn btn-primary'>Close</a></div>";
							header("location:viewofficers.php");
							
									/* $success= "Officer ".$fullName." has been  Activated";
									echo ($notifyObject->successMessage($success)); */
								}
						?>

		