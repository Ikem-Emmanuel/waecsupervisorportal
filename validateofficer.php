<?php 
	require_once "connection.php";
	require_once "officerdao.php";
	require_once "miscfunction.php";
	require_once "notifications.php";
	//include_once('http://hisroyalwebness.com/sendmail/sendemail.php');
	
	$notifyObject = new Notifications();
	
	if(isset($_POST["submit"])){
		$fName = $_POST["fName"];
		$lName = $_POST["lName"];
		$officeId = $_POST["officeId"];
		$email = $_POST["email"];
		$phone = $_POST["phone"];
		$username = ucfirst($fName).".".ucfirst($lName);//officer's username	

		$con = new connection();
		$connection = $con->getConnection();
		$miscfunc = new MiscFunction($connection);
		//$directmail= new sendemail();

		$inputValues = array("firstName"=>$fName,"lastname"=>$lName,"officeId"=>$officeId,"email"=>$email,"phone"=>$phone);


		if(isset($_POST["issent"])){
			$id=$_POST["issent"];
			$officerdetails=$miscfunc->getOfficerDetail($id);

			while($row = $officerdetails->fetch_assoc()){
				$password=$row["Password"];
				$status=$row["Status"];
				$level=$row["Level"];
				$userEmail = $row["Email"];
				$db_username = $row["Username"];
			}

			$errorMsg = $miscfunc->validateInput($fName,$lName,$officeId,$email,$phone,$username,$userEmail,$db_username,$id);
			
			
			if($errorMsg == false){
				$_SESSION["inputFieldValues"] = $inputValues;
				header("location:registerofficer.php?id=$id");
				return;
			}
			
			$newOfficer = new Officer($fName,$lName,$officeId,$username,$password,$email,$phone,$status,$level);//officer object
		    	$officerDao = new OfficerDao($connection);
			$officerDao->updateOfficer($newOfficer, $id);// updates a new officer
			$successMsg ="Officer  ".$fName."  ".$lName."  has been updated  successfully" ; ?>
			
			<head>
		
				<?php include 'includes/header.php'; ?>
				</head>
		
		   		<body>
		  
		  		<div class="noprint">
		   			<?php include 'includes/top_header_admin.php'; ?>
		   		</div>
		
				<div class="container">
				
			<?php 
			echo ($notifyObject->successMessage($successMsg)); 
		}
		else{
			//$password = $miscfunc->getPassword(10);//generates officer's password 
			$password = "1234567";
			
			if($officeId==="254"){
				$level=2; //represents an admin officer,
			}else{
				$level=1; //represents a new active officer,
			}
	
			$status=1; // implies newly created user is activated
			
				$errorMsg = $miscfunc->validateInput($fName,$lName,$officeId,$email,$phone,$username); //validate
				if($errorMsg == false){
					$_SESSION["inputFieldValues"] = $inputValues;
					header("location:registerofficer.php");
					return;
				}

				$newOfficer = new Officer($fName,$lName,$officeId,$username,$password,$email,$phone,$status,$level);//officer object
				$officerDao = new OfficerDao($connection);
				
				$officerDao->createOfficer($newOfficer);//creates a new officer
				$success ="Officer  ".$fName."  ".$lName."  successfully created"; ?>
				
				<head>
		
				<?php include 'includes/header.php'; ?>
				</head>
		
		   		<body>
		  
		  		<div class="noprint">
		   			<?php include 'includes/top_header_admin.php'; ?>
		   		</div>
		
				<div class="container">
				
				<?php
				echo ($notifyObject->successMessage($success));
				
				//$mailSent=$miscfunc->sendMail($email,$username,$password);
				//$mailsent=$directmail->sendMail($email,$username,$password);
				
				/** if($mailSent == true){
					$officerDao->createOfficer($newOfficer);//creates a new officer
					$success ="Officer  ".$fName."  ".$lName."  successfully created and a mail has been sent to officer's email address";
					echo ($notifyObject->successMessage($success));
				}
				
				elseif($mailSent == false){
					$errorMsg =$fName."  ".$lName."  was not created <br/> There was an error while sending a mail to officer's email address, please retry";
					echo ($notifyObject->errorMessage($errorMsg));
				} **/


		}
	}
?>

	   		<div class="search_line text-center">
	   			<a href="viewofficers.php">View Full list of Officers</a>
	   		</div>	   

	   	</div>

	  	<?php include 'includes/footer.php'; ?>

	</body>

</html>