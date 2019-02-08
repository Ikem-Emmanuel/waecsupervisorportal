<?php
require_once "miscfunction.php";
require_once "connection.php";
	if(!isset($_SESSION["officerId"])){ header("location:login.php"); }
	if($_SESSION["level"] ==1){ header("location:login.php"); }
		
	$officerLevel = $_SESSION["level"];		
	$con = new connection();
	$connection = $con->getConnection();
	$miscfunction = new MiscFunction($connection);
	
	if (isset($_GET["id"])) {
		$id= $_GET["id"];		
		
		$row = $miscfunction->getofficerDetails($id);
		
		$office_Id= $row["OfficeId"];
		$fullname= $row["Fullname"];
		$username= $row["Username"];
		$phone=    $row["Phone"];
		$email=    $row["Email"];		
		
		$firstname="";
		$lastname="";
		list($firstname,$lastname)= explode(".", $username);
	}
	 
	if($officerLevel == 3){
		$offices = $miscfunction->getAllOffices();	
	}else{
		$offices = $miscfunction->getOffices();	
	}
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
  
   		<?php include 'includes/top_header_admin.php'; ?>

		<div class="container">

			<div class="row">

				<div class="creator col-md-6 col-md-offset-3">
				
					<div class="row text-center"><b>
							<?php 						
							
							if(isset($_SESSION["username_exists"])){ echo $_SESSION["username_exists"]; 
							unset($_SESSION["username_exists"]);
							
							echo "<br/>";
							/**$browserType = $_SERVER['HTTP_USER_AGENT'];
							if(strpos($browserType, 'Firefox') === true) {
							    exit(); }**/							    
							} 
							
							if(isset($_SESSION["email_exist"])){
								echo $_SESSION["email_exist"]; 
								unset($_SESSION["email_exist"]); 
							}
							
							?> </b>
					</div>

					<form data-toggle="validator" role="form" method="post" action="validateofficer.php">

						<div class="form-group">

							<label class="col-md-4 control-label">First Name *</label>
							<div class="col-md-8">
								<!-- Form field values are saved in an associative array, $_SESSION["inputFieldValues"], when the form is submitted.
									 Each index in the array contains user's input from each field which is echoed in thier respective positions if there is an error on the form
								-->
								<input type="text" name="fName" class="form-control capitalize" data-error="Enter Officer's first name" required="required" maxlength="20"
								value="<?php if(isset($_SESSION["inputFieldValues"]['firstName'])){ echo $_SESSION["inputFieldValues"]['firstName']; }
								elseif (isset($fullname)) { echo $firstname; } ?>"  />		
							</div>

							<div class="create_error">
								<?php if(isset($_SESSION["fnameError"])){ echo $_SESSION["fnameError"]; unset($_SESSION["fnameError"]); } ?>
							</div>

							<div class="help-block with-errors create_error"></div>

						</div><br/><br/>


						<div class="form-group">

							<label class="col-md-4 control-label">Last Name *</label>
							<div class="col-md-8">
								<input type="text" name="lName" class="form-control capitalize" data-error="Enter Officer's last name" required="required" maxlength="20"
								value="<?php if(isset($_SESSION["inputFieldValues"]['lastname'])){ echo $_SESSION["inputFieldValues"]['lastname']; }
								elseif (isset($fullname)) { echo $lastname;  } ?>" />
							</div>

							<div class="create_error">
								<?php if(isset($_SESSION["lnameError"])){ echo $_SESSION["lnameError"]; unset($_SESSION["lnameError"]); } ?>
							</div>

							<div class="help-block with-errors create_error"></div>

						</div><br/><br/>


						
						<div class="form-group">

							<label class="col-md-4 control-label">Select Office *</label>
							<div class="col-md-8">
								<select name="officeId" required="required" data-error="please select one option" class="form-control">
									<option value="" selected="selected">Make a selection</option>
									<?php while($row = $offices->fetch_assoc()){ ?>
									<option value="<?php echo $row["OfficeId"]; ?>" <?php 						
										 if((isset($_SESSION["inputFieldValues"]['officeId'])) && (($_SESSION["inputFieldValues"]['officeId']) === $row["OfficeId"])){echo "selected";}
										elseif(isset($office_Id) && ($office_Id === $row["OfficeId"])) {echo "selected";}   ?>>						
										<?php  echo $row["Name"];?>  
									</option>
									<?php	} ?>
								</select>
							</div>

							<div class="create_error">
								<?php if(isset($_SESSION["idError"])){ echo $_SESSION["idError"]; unset($_SESSION["idError"]); } ?>
							</div>

							<div class="help-block with-errors create_error"></div>

						</div><br/><br/>

						
						<div class="form-group">

							<label class="col-md-4 control-label">Email *</label>
							<div class="col-md-8">
								<input type="email" name="email" class="form-control" required="required" data-error="Enter a valid email" required="required"
								value="<?php 
								 if(isset($_SESSION["inputFieldValues"]['email'])){ echo $_SESSION["inputFieldValues"]['email']; }
								elseif(isset($email)) { echo $email;  }  ?>"  />
							</div>

							<div class="create_error">
								<?php if(isset($_SESSION["mailError"])){ echo $_SESSION["mailError"]; unset($_SESSION["mailError"]); }  
								 ?>
							</div>

							<div class="help-block with-errors create_error"></div>
						</div><br/><br/>


						<div class="form-group">

							<label class="col-md-4 control-label">Phone Number *</label>
							<div class="col-md-8">
								<input type="number" name="phone" pattern="[0-9]{11}" title="enter a valid phone number!" data-error="Enter a valid phone number"  class="form-control" 
								value="<?php if(isset($_SESSION["inputFieldValues"])){ echo $_SESSION["inputFieldValues"]['phone']; }
								elseif(isset($phone)) { echo $phone;  } ?>" required="required" />
							</div>

							<div class="create_error">
								<?php if(isset($_SESSION["phoneError"])){ echo $_SESSION["phoneError"]; unset($_SESSION["phoneError"]); } ?>
							</div>

							<div class="help-block with-errors create_error"></div>
						</div>	

						<?php if (isset($id)){ ?> 
						<input type = "hidden" name="issent" value="<?php if (isset($id)) echo $id ?>" />		
						<?php } ?> 
						
						<?php if(isset($_SESSION["inputFieldValues"])) unset($_SESSION["inputFieldValues"]); ?>
						<br/><br/>
						<div class="form-group col-md-2 col-md-offset-4">
						<button type="submit" name="submit" class="btn btn-primary">Submit</button>
						</div>
			
					</form>

				</div>

			</div>

		</div>

		<?php include 'includes/footer.php'; ?>
  	
  	</body>

</html>  