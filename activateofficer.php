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
										
									$query = "update officer set status=1 where Id = $newid";
									$result = $connection->query($query) or die(mysqli_error());	
									
										$_SESSION["officer_activated"]="<div class='not_found'>Officer "  .$fullName. " has been activated!<br /><br /><a href='' class='btn btn-primary'>Close</a></div>";
							header("location:viewofficers.php");
							
									/* $success= "Officer ".$fullName." has been  Activated";
									echo ($notifyObject->successMessage($success)); */
								}
						?>

		