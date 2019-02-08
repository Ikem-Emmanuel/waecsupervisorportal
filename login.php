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

		<?php include 'includes/top_header_out.php'; ?>

		
		<div class="container">

            <div class="login col-md-6 col-md-offset-3">

                <h4>Login to Register Supervisors</h4>

				<div class="row login_errors">
					<?php
						session_start();
							if(isset($_SESSION["login_error"])){							
							 echo $_SESSION["login_error"];
							 unset($_SESSION["login_error"]);
							
							/**$browserType = $_SERVER['HTTP_USER_AGENT'];
							if(strpos($browserType, 'Firefox') == true) {
							    exit(); }
							**/
							}
							if(isset($_SESSION["error_msg"])){
								echo $_SESSION["error_msg"];
								unset($_SESSION["error_msg"]);
							
							}
							
					?>
				</div>

				<form data-toggle="validator" role="form" method="post" action="loginvalidate.php" class="form-horizontal">
					<div class="form-group">
						<label class="sr-only" for="username">Username</label>
						<div class="input-group">
							<div class="input-group-addon"><i class="fa fa-user fa-2x"></i></div>
							<input type="text" name="username" id="inputName" class="form-control" placeholder="Username" 
							data-error=" Username is invalid" data-minlength="6"  required="required" maxlength="25" 
							value="<?php if(isset($_SESSION["loginValues"])){ echo $_SESSION["loginValues"]['username']; }?>">
						</div>
					</div><br/>
						
					<div class="form-group">
						<label class="sr-only" for="password">Password</label>
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-lock fa-2x"></i></div>
							<input type="password" name="password" data-minlength="6" class="form-control" 
							id="inputPassword" data-error="Password is invalid"  placeholder="Password" required="required" 
							maxlength="25"  value="<?php if(isset($_SESSION["loginValues"])){ echo $_SESSION["loginValues"]['password']; }?>">
						</div>
					</div><br />

					<!--<span class="col-md-6"><a href="forgetpassword.php">Forgot password?</a></span> -->
					 
					<button type="submit" name="submit" class="btn btn-primary col-md-3 col-md-offset-3">Login</button>

				</form>

			</div>

    	</div>


		<?php include 'includes/footer.php'; ?>

	</body>

</html>