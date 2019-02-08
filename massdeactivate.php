<?php 
session_start();
require_once"connection.php";
require_once "notifications.php";

		$con= new connection();
		$connection = $con->getConnection();
		$notifyObject= new notifications();
		
		$officeId = $_SESSION["officerId"]; //id of the loggedin officer
		$curr_page = $_POST["curr_page"];
		//echo $curr_page; exit;
		if(isset($_POST['deactivateAll'])){
		
			if(!empty($_POST['check_list'])){
			
				$supervisor= $_POST['check_list'];
					
					foreach($supervisor as $val){
					$sql = "UPDATE supervisor set status=0 where SupervisorId='$val' and OfficeId='$officeId' AND currentSchool !=''";
					$execute = $connection->query($sql) or die(mysqli_error($connection));				
					}
							
				$_SESSION["supervisor_deactivated"]="<div class='not_found'>Supervisors  have been deactivated!<br /><br /><a href='' class='btn btn-primary'>Close</a></div>";
											header("location:viewsupervisors.php?page=".$curr_page);
											return;
			}
		
			else 
			header("location:viewsupervisors.php?page=".$curr_page);
		}
		
		if(isset($_POST['ActivateAll'])){
		
			if(!empty($_POST['check_list'])){
			
				$supervisor= $_POST['check_list'];
				
					foreach($supervisor as $val){
					$sql = "UPDATE supervisor set status=1 where SupervisorId='$val' and OfficeId='$officeId' AND currentSchool !=''";
					$execute = $connection->query($sql) or die(mysqli_error($connection));				
					}
							
				$_SESSION["supervisor_deactivated"]="<div class='not_found'>Supervisors  have been activated!<br /><br /><a href='' class='btn btn-primary'>Close</a></div>";
											header("location:viewsupervisors.php?page=".$curr_page);
											return;
			}
		
			else 
			header("location:viewsupervisors.php?page=".$curr_page);
			
		}
		
		?>