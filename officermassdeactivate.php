<?php 
session_start();
require_once"connection.php";
require_once "notifications.php";

		$con= new connection();
		$connection = $con->getConnection();
		$notifyObject= new notifications();
		
		
		//echo $curr_page; exit;
		if(isset($_POST['deactivateAll'])){
		
			if(!empty($_POST['check_list'])){
			
				$officer= $_POST['check_list'];
					
					foreach($officer as $val){
					$sql = "UPDATE officer set Status=0 where Id=$val";
					$execute = $connection->query($sql) or die(mysqli_error($connection));				
					}
							
				$_SESSION["officer_mass_deactivated"]="<div class='not_found'>Officers have been deactivated!<br /><br /><a href='' class='btn btn-primary'>Close</a></div>";
											header("location:viewofficers.php");
											return;
			}
		
			else 
			header("location:viewofficers.php");
		}
		
		if(isset($_POST['ActivateAll'])){
		
			if(!empty($_POST['check_list'])){
			
				$officer= $_POST['check_list'];
				
					foreach($officer as $val){
					$sql = "UPDATE officer set Status=1 where Id=$val";
					$execute = $connection->query($sql) or die(mysqli_error($connection));				
					}
							
				$_SESSION["officer_mass_activated"]="<div class='not_found'>Officers have been activated!<br /><br /><a href='' class='btn btn-primary'>Close</a></div>";
											header("location:viewofficers.php");
											return;
			}
		
			else 
			header("location:viewofficers.php");
			
		}
		
		?>