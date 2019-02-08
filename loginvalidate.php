<?php 
		require_once "connection.php";
		require_once "miscfunction.php";
		require_once "officer.php";
		require_once "officerdao.php";
		require_once "notifications.php";
			
		$con= new Connection();
		$connection= $con->getConnection();
		$misc= new MiscFunction($connection);
		$notifyObject = new Notifications();
					
			if(isset($_POST["submit"])){
				
						$username= $_POST["username"];
						$password= $_POST["password"];

						$loginValues = array("username"=>$username,"password"=>$password);
						$_SESSION["loginValues"]=$loginValues;
							
						$validateLogin= $misc->validateLogin($username,$password);

						 if($validateLogin === false) {						 	
							header("location:login.php");	
						}
						 
						$result= $misc->getOfficer($username,$password);
						if ((mysqli_num_rows($result))==1){
							while ($row= $result->fetch_assoc()){
								$status=$row["Status"];

								if($status==0){
									header("location:deactivated.php");
									//exit();
								}
								else{

								$_SESSION["fullname"]=$row["Fullname"];
								$_SESSION["Identification"]=$row["Id"];
								$_SESSION["officerId"]=$row["OfficeId"];
								$_SESSION["username"]=$username;
								$level=$row["Level"];
								$_SESSION["level"]=$level;
								$_SESSION["Officer_Id"] = $row["Officer_Id"];
								
								//$details= array("identification"=>$Identification,"officerId"=>$officerId,"userName"=>$username,"level"=>$level);
								//$_SESSION["details"]=$details;
								
								
								if($level==1){ 
									header("location:officerindex.php");
									return;
								}
								elseif(($level == 2) || ($level == 3)){
									header("location:index.php");
									return;
								}
								 }
							}
						}
						else{
								 $error="Username or Password is invalid";
								 $_SESSION["error_msg"]=$error;
								header("location:login.php");
							}
					}
								
								//change password
								elseif(isset($_POST["reset"])){
									$officerId ="";

									if(isset($_SESSION["Identification"])) {
										$officerId = $_SESSION["Identification"]; 
									}
									
									$oldPassword= $_POST["oldPassword"];
									$newPassword= $_POST["newPassword"];
									$confirmPassword = $_POST["confirmPassword"];		
									
									$error = $misc->validateResetFields($officerId,$oldPassword,$newPassword,$confirmPassword);

									
									if($error !==""){
										$_SESSION["resetError"] = $error;
										header("location:resetpassword.php");  
										exit;
									}
									
									$officerDaoObject = new OfficerDao($connection);
									$officerDaoObject->changePassword($newPassword, $officerId);
									?>
									
									
										<head>
											
											<?php include 'includes/header.php'; 
											include 'includes/top_header_out.php'; 
											?>
											
										</head>
									
   										<body>
									<?php 
									
									$msg ="Password Changed Successfully...";
									echo ($notifyObject->successMessage($msg));
									
								}


	?>

   		<br/><br/><br/>
   		<center>
			<a href="login.php">
				<button class="btn btn-primary btn-md">HOME</button>
			</a>
		</center>
		
		<?php include 'includes/footer.php'; ?>

	</body>	

</html>