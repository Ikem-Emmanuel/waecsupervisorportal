<?php 
			require_once "connection.php";
			require_once "miscfunction.php";
			require_once "notifications.php";

			if(!isset($_SESSION["officerId"])){ header("location:login.php"); }
			if($_SESSION["level"] ==1){ header("location:login.php"); }
			
						
							//Fetches the id and then compares with the database
							if(isset($_GET["id"])){
								$id = $_GET["id"];
								$con= new connection();
								$connection = $con->getConnection();		
								$notifyObject= new Notifications();
								$miscFunction = new MiscFunction($connection);
								
								// Function searches the supervisor table from the database 
								$row = $miscFunction->getOfficerDetails($id);
								$status= $row["Status"];
								$newid= $row["Id"];
								$fullname=$row["Fullname"];		  
									
								$query = "update officer set status=0 where Id = $newid";
								$result = $connection->query($query) or die(mysqli_error());

								$_SESSION["officer_deactivated"]="<div class='not_found'>Officer ".$fullname. " has been deactivated!<br /><br /><a href='' class='btn btn-primary'>Close</a></div>";
							header("location:viewofficers.php");
								
								/* $errorMsg = "Officer ".$fullname." has been  Deactivated";
								echo ($notifyObject->errorMessage($errorMsg)) */;
							}
						?>

		