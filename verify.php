<?php
	//Make sure that our query string parameters exist.
	if(isset($_GET['token']) && isset($_GET['user'])){
		$token = trim($_GET['token']);
		$userId = trim($_GET['user']);
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
  
   		<?php include 'includes/top_header_out.php'; ?>

   		<div class="container">

	   		<div class="login col-md-6 col-md-offset-3">

	   			<h4>Enter your new password</h4>

				<form method="post" action="confirm.php" class="form-horizontal">

					<div class="form-group">
						<label class="sr-only" for="username">New Password</label>
						<div class="input-group">
							<div class="input-group-addon"><i class="fa fa-unlock fa-2x"></i></div>

							<input type="password" name="password1" class="form-control" maxlength="15" required="required" placeholder="New Password" />
						</div>
					</div><br />


					<div class="form-group">
						<label class="sr-only" for="username">Confirm New Password</label>
						<div class="input-group">
							<div class="input-group-addon"><i class="fa fa-unlock fa-2x"></i></div>

							<input type="password" name="password2" class="form-control" maxlength="15" required="required" placeholder="Confirm New Password" />
						</div>
					</div><br />
					<input type="hidden" type="text" value=" $userId" />
					<button type="submit" name="submit" class="btn btn-primary col-md-6 col-md-offset-6">Change Password</button>

				</form>

			</div>

		</div>

		<?php include 'includes/footer.php'; ?>

	</body>

</html>