<?php 
require_once "connection.php";
require_once "supervisordao.php";
require_once "miscfunction.php";
require_once "notifications.php";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html xmlns="http://www.w3.org/1999/xhtml">
<!--<![endif]-->

	<head>
		
		<?php include 'includes/header.php'; ?>

	</head>

   	<body>
  
   		<?php include 'includes/top_header.php'; ?>

		<div class="container dashboard">


<?php 
	
	if(isset($_POST["submit"])){
		$fullName = $_POST["fullName"];
		$gender = $_POST["gender"];
		$age = $_POST["age"];
		$qualification = $_POST["qualification"];
		$specialization = $_POST["specialization"];
		$grade = $_POST["grade"];
		$experience = $_POST["experience"];
		$officeAddress= $_POST["officeAddress"];
		
		if (isset($_SESSION["officerId"])){
			$officeId= $_SESSION["officerId"];
		}
		
		$state = $_POST["name_of_state"];
		$lga = $_POST["lga"];
		$schoolName = $_POST["name_of_school"];
		$homeAddress = $_POST["homeAddress"];
		$vehicleNo = $_POST["vehicleNo"];
		$email = $_POST["email"];
		$phoneNo = $_POST["phoneNo"];
		$alternatePhone = $_POST["alternatePhone"];
		
		if(isset($_POST["loggedin_Officer"])){
			$Officer_Id = $_POST["loggedin_Officer"]; //OfficerId of a logged in officer; used to identify which officer registers a supervisor
		}		
		$fileName = basename($_FILES["user_profile_pic"]["name"]);
		$status=1;
					
				
		$inputValues = array("fullname"=>$fullName,"gender"=>$gender,"age"=>$age,"qualification"=>$qualification,"specialization"=>$specialization, "grade"=>$grade, "experience"=>$experience, "officeAddress"=>$officeAddress,"lga"=>$lga, "homeAddress"=>$homeAddress,"vehicleNo"=>$vehicleNo, "state"=>$state, "lga"=>$lga, "schoolName"=>$schoolName, "email"=>$email,"phoneNo"=>$phoneNo,"alternatePhone"=>$alternatePhone);

		$con = new connection();
		$connection = $con->getConnection();
		$miscfunction = new MiscFunction($connection); 
		$DAOobject = new SupervisorDao($connection);
		$notifyObject= new Notifications();

			if(isset($_POST["issent"])){
				$id= $_POST["issent"] ;

				//ValidateField function returns false if there was an error in any of the fields  
				$errorExist = $miscfunction->validateField($fullName,$gender,$age,$qualification,$specialization,$grade,$experience,$officeAddress,$officeId,$schoolName,$state,$lga,$homeAddress,$vehicleNo,$email,$alternatePhone,$phoneNo,$fileName);

					if($errorExist == true){
						$_SESSION["inputFieldValues"] = $inputValues;
						header("location:createsupervisor.php?id=".$id);
						exit;
					}

					//move picture to directory if there is no error
					$uploadFilePath="";					
					if($fileName != ""){
						//delete existing supervisor's picture in the database
						if(isset($_POST["file_Pics"])){
							$dir = $_POST["file_Pics"];
							if(file_exists($dir)){
								unlink($dir);
							}
						}
						//move picture to directory
						$uploadFilePath = $miscfunction->moveToDirectory($fileName);
					}
					elseif(isset($_POST["file_Pics"])){
						$uploadFilePath= $_POST["file_Pics"];
					}
					
					$supervisorObj = new Supervisor($uploadFilePath,$fullName,$gender,$age,$qualification,$specialization,$grade,$experience, $officeId,$state,$schoolName,$officeAddress,$lga,$homeAddress,$vehicleNo,$email,$phoneNo,$status,$alternatePhone);

					$result = $DAOobject->updateSupervisor($supervisorObj, $id, $Officer_Id);
					if($result){
						$successMsg= "Supervisor ". $fullName."'s records have been updated Succesfully";	
						echo($notifyObject->successMessage($successMsg));
					}
					else{ echo($notifyObject->errorMessage("Unable to update Supervisor Record")); }

			}
			else { //create new superviosr record
				//ValidateField function returns true if there was an error in any of the fields;
				$errorExist = $miscfunction->validateField($fullName,$gender,$age,$qualification,$specialization,$grade,$experience,$officeAddress,$officeId,$schoolName,$state,$lga,$homeAddress,$vehicleNo,$email,$alternatePhone,$phoneNo,$fileName);

				if($errorExist == true){
					$_SESSION["inputFieldValues"] = $inputValues;
					header("location:createsupervisor.php");
					exit;
				}
					//move image to directory if there is no error
					$uploadFilePath = $miscfunction->moveToDirectory($fileName);
					$supervisorObj = new Supervisor($uploadFilePath,$fullName,$gender,$age,$qualification,$specialization,$grade,$experience, $officeId, $state, $schoolName, $officeAddress,$lga,$homeAddress,$vehicleNo,$email,$phoneNo,$status,$alternatePhone); 
					$result = $DAOobject->createSupervisor($supervisorObj, $Officer_Id);
					
					if($result){
						$successMsg= "Supervisor ".$fullName ."  has been Created";
						echo($notifyObject->successMessage($successMsg));
					}
					else{ echo($notifyObject->errorMessage("Unable to create Supervisor")); }
			}
	}
?>

		<div class="search_line text-center">

			<a href="officerindex.php">Home</a>

		</div>

</div>

		<?php include 'includes/footer.php'; ?>
  	
  	</body>

</html>  