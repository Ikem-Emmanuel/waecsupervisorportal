<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html xmlns="http://www.w3.org/1999/xhtml">
<!--<![endif]-->

	<head>
		<title>WAEC Supervisors' E-Registration Portal</title>
		
		<?php include 'includes/header.php'; ?>
		
	</head>

   	<body>
  
   		<?php include 'includes/top_header.php'; ?>

   		<div class="container">

   			<?php	
				//Make sure that our query string parameters exist.
				if(isset ($_GET['user'])){
				//$token = trim($_GET['$token']);
				$userId = trim($_GET['user']);    
			?>

			
			<form data-toggle="validator" role="form" method="post" action="updatepassword.php" class="form-horizontal">
				<div class="row">
					<div class="col-md-12">
						<div class="col-md-3">
							<div class="row">
								<div class="form-group col-md-10 col-md-offset-1">
									 NEW PASSWORD:
									<input type="password" name="password1"  data-minlength="6" class="form-control" id="inputPassword" placeholder="Password" maxlength="10" required value="<?php if(isset($_SESSION["updateValues"])){ echo $_SESSION["updateValues"]['password1']; }?>">
									<span class="help-block">Minimum of 6 characters</span>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-10 col-md-offset-1">
								 CONFIRM PASSWORD:
								<input type="password" name="password2" placeholder="ConfirmPassword" class="form-control" id="inputPasswordConfirm" data-match="#inputPassword" maxlength="10"required="required"  data-match-error="Whoops, these don't match" value="<?php if(isset($_SESSION["updateValues"])){ echo $_SESSION["updateValues"]['password2']; }?>" required>
								<div class="help-block with-errors"></div>
							</div>
						</div>
						<input type = "hidden" name="userId" value="<?php if (isset($userId)) echo $userId; ?>" />				
						<div class="row">
							<div class="form-group col-md-10 col-md-offset-1">
								<button type="submit" name="submit" class="btn btn-primary">SUBMIT DETAILS</button> 
							</div>
						</div>
					</div>
				</div>
			</form>
			

	   		<?php } ?>

	   		<div class="search_line top_200 text-center">
			
			</div>

		</div>

		<?php include 'includes/footer.php'; ?>

	</body>	

</html>