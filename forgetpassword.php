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
  
   		<?php include 'includes/top_header_out.php'; ?>

   		<div class="container">

	   		<div class="login col-md-6 col-md-offset-3">

                <h4>Reset your password</h4>

				<div class="row login_errors">
					<?php 
					   session_start();
						if(isset($_SESSION["validate_error"])) {
							echo $_SESSION["validate_error"];
							unset($_SESSION["validate_error"]);
							
							$browserType = $_SERVER['HTTP_USER_AGENT'];
							if(strpos($browserType, 'Firefox') == true) {
							    exit(); }
						}
						
						if (isset($_SESSION["confirm_error"])) {
							echo $_SESSION["confirm_error"];
							unset($_SESSION["confirm_error"]);
							
						}
					?>
				</div>

				<form data-toggle="validator" role="form" method="post" action="confirm.php" class="form-horizontal">
					
					<div class="form-group">
						<label class="sr-only" for="username">Username</label>
						<div class="input-group">
							<div class="input-group-addon"><i class="fa fa-user fa-2x"></i></div>

							<input type="text" name="userName" id="inputName" class="form-control" data-minlength="6" maxlength="20" data-error="Username is invalid" 
							required="required" placeholder="Username" value="<?php if(isset($_SESSION["forgetValues"])){ echo $_SESSION["forgetValues"]['username']; }?>" />
						</div>
					</div><br />


					<div class="form-group">
						<label class="sr-only" for="username">Email</label>
						<div class="input-group">
							<div class="input-group-addon"><i class="fa fa-envelope fa-2x"></i></div>

							<input type="email" name="email" class="form-control" maxlength="35" required="required" id="inputEmail" placeholder="Your registered Email" 
							data-error="Email address is invalid" required value="<?php if(isset($_SESSION["forgetValues"])){ echo $_SESSION["forgetValues"]['email']; }?>" />
						</div>
					</div><br />

					<button type="submit" name="submit" class="btn btn-primary col-md-6 col-md-offset-6">Request Password</button>
							
				</form>

			</div>

		</div>

		<?php include 'includes/footer.php'; ?>

	</body>

</html>