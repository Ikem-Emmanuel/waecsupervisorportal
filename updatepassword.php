<?php
require_once "connection.php";
require_once "miscfunction.php";
require_once "officer.php";
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
		<title>WAEC Supervisors' E-Registration Portal - View Supervisor List</title>
		
		<?php include 'includes/header.php'; ?>
		
	</head>

   	<body>
  
   		<?php include 'includes/top_header_out.php'; ?>

		<div class="container">

	<?php
	$con= new Connection();
	$connection= $con->getConnection();
	$misc = new MiscFunction($connection);
        $notifyObject = new Notifications();
	//Make sure that our query string parameters exist.
	if(isset($_POST["submit"])){
		if (isset($_POST["userId"])){
			$id=$_POST["userId"];
			
			$passWord1=$_POST["password1"];
			$passWord2=$_POST["password2"];
			
			$updateValues = array("password1"=>$passWord1,"password2"=>$passWord2);
			
			$_SESSION["updateValues"]=$updateValues;
			
			$validatePassword= $misc->validatePassword($passWord1);
			$validatePassword= $misc->validatePassword($passWord2);			
			
			if($validatePassword===0) {
				header("location:newpassword.php");	
			}
			
			if ($passWord1==$passWord2){
				$passWord1= sha1($passWord1);
				$query= "update officer set Password='$passWord1' where Id=$id";
				$result = $connection->query($query) or die(mysqli_error($connection));
				$success = "Password Successfully changed";echo ($notifyObject->successMessage($success));
			}			
			else{
				$errorMsg= "Passwords do not match";
				echo ($notifyObject->errorMessage($errorMsg));
			}
		}
	}	
?>
	
		</div>

		<?php include 'includes/footer.php'; ?>

	</body>

</html>