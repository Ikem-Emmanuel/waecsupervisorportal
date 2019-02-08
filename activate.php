<?php
require_once "connection.php";
require_once "miscfunction.php";
require_once "notifications.php";

if(!isset($_SESSION["officerId"])){ header("location:login.php"); }
if($_SESSION["level"] !=1){ header("location:login.php"); }

		//Fetches the id and then compares with the database
		if (isset($_GET["id"])) {
			if(isset($_GET['page'])){
				$page= $_GET["page"];
			}
				$id = $_GET["id"];
				$con= new connection();
			    $connection = $con->getConnection();
				
				$notifyObject= new Notifications();
				$miscfunction = new MiscFunction($connection);
				
				//Function searches the supervisor table from the database		
				$row = $miscfunction->getDetails($id);
				//activate supervisor if record exists
				if(is_null($row)){
					$_SESSION["supervisor_activated"]="<div class='not_found'>Supervisor's record not found!<br /><br /><a href='' class='btn btn-primary'>Close</a></div>";
				}else{
					$currentSchool = trim($row["currentSchool"]);
					if($currentSchool === ""){
						$_SESSION["supervisor_activated"]="<div class='not_found'>Unable to activate Supervisor.<br/>Please Update Supervisor's record.<br /><br /><a href='' class='btn btn-primary'>Close</a></div>";
					}else{
						$status= $row["status"];
						$newid= $row["Id"];
						$fullname=$row["Fullname"];		  
							
						$query = "update supervisor set status=1 where Id = $newid";
					    $result = $connection->query($query) or die(mysqli_error($connection));	
						
						$_SESSION["supervisor_activated"]="<div class='not_found'>Supervisor "  .$fullname. " has been activated!<br /><br /><a href='' class='btn btn-primary'>Close</a></div>";
					}
					
				}
				  
					
					header("location:viewsupervisors.php?page=".$page);
		}			
?>