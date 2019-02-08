<?php 
	
									require_once "connection.php";
									require_once "officerdao.php";
									require_once "miscfunction.php";
									require_once "notifications.php";

										if(isset($_POST["submit"])){
											$userName=$_POST["userName"];
											$email=$_POST["email"];
											
											$con= new Connection();
											$connection= $con->getConnection();
											$misc= new MiscFunction($connection);
											$notifyObject = new Notifications();
											$forgetValues = array("username"=>$userName,"email"=>$email);
											$_SESSION["forgetValues"]=$forgetValues;		
											
											$validateDetails= $misc->validateOfficerDetails ($userName,$email);//validate input fields		 
											
											if($validateDetails===0) {
												header("location:forgetpassword.php");	
									        }

											$getOfficer=$misc->getOfficers();
											$id="";
											$recipient="";
											while($row= $getOfficer->fetch_assoc()){			
												if(($userName==$row["Username"]) && ($email==$row["Email"])){
																					
													$id=$row["Id"];
													$recipient=$row["Email"];
													$_SESSION["user_found"]= "user found";													
												}
											//return;												
											}	
											if (!isset($_SESSION["user_found"])){
													$error="Username or Email invalid";
													$_SESSION["confirm_error"]=$error;
													header("location:forgetpassword.php");
													return;
													}										
												?>
											<html>	
											<head>
						<?php include 'includes/header.php'; ?>
					</head>
				   	<body>
				   		<?php include 'includes/top_header_out.php';	?>
				   		
				   		<?php 
				   		
											$sendToken= $misc->sendToken($id,$recipient);
													//echo $id; echo $recipient; exit; 
												if ($sendToken== true){
													$successMsg = "Link Sent successfully";
													echo ($notifyObject->successMessage($successMsg));
													//return;
													}
												else if ($sendToken== false){
													$errorMsg= "Email sending failed ";
													echo ($notifyObject->errorMessage($errorMsg));
													//return;
													}
									
		include 'includes/footer.php'; 
		if (isset($_SESSION["user_found"]))
		{
			unset ($_SESSION["user_found"]);
		}  

		?>
		

	</body>
</html>

<?php } 
?>
