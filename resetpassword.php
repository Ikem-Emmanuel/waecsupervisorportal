<?php 
session_start();
if(!isset($_SESSION["officerId"])){ header("location:login.php"); }
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html xmlns="http://www.w3.org/1999/xhtml">
<!--<![endif]-->

	<head>
		<?php include 'includes/login_header.php'; ?>
	</head>
	

	<body>

		<?php include 'includes/top_header.php'; ?>

		<div class="container">

            <div class="login col-md-6 col-md-offset-3">

                <h4>Change your Password</h4>

				<div class="row login_errors">
					<?php if(isset($_SESSION["resetError"])){ echo $_SESSION["resetError"]; unset($_SESSION["resetError"]); }?>
				</div>
		
		 		<form method="post" data-toggle="validator" role="form" action="loginvalidate.php" class="form-horizontal">		 
					<div class="form-group">			
						<label class="sr-only" for="username">Old Password</label>
						<div class="input-group">
							<div class="input-group-addon"><i class="fa fa-user fa-2x"></i></div>
							<input type="password" name="oldPassword" data-minlength="6" class="form-control"  maxlength="10"  
							placeholder="Old Password"  data-error=" Password is invalid" required="required">
						</div>
					</div><br/>
		
	    			<div class="form-group">
						<label class="sr-only" for="username">New Password</label>
						<div class="input-group">
							<div class="input-group-addon"><i class="fa fa-unlock fa-2x"></i></div>
							<input type="password" name="newPassword" id="inputPassword" data-minlength="6" class="form-control" placeholder="New Password" required="required">
						</div>
					</div><br/>
		
	    			<div class="form-group">
						<label class="sr-only" for="username">Confirm New Password</label>
						<div class="input-group">
							<div class="input-group-addon"><i class="fa fa-unlock-alt fa-2x"></i></div>
							<input type="password" name="confirmPassword" id="inputPasswordConfirm" data-match="#inputPassword" 
							maxlength="10" data-minlength="6" class="form-control"  placeholder="Confirm Password"  data-error="Passwords do not match" required="required" />
						</div>
					</div><br/>

		 			<button type="submit" name="reset" class="btn btn-primary col-md-3 col-md-offset-3">Submit</button>
		
	  			</form>


			</div>

    	</div>
	  
		<?php include 'includes/footer.php'; ?>

	</body>

</html>