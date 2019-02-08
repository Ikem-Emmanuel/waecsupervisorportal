<?php	
	require_once "connection.php";
	require_once "miscfunction.php";
	include 'header.php';
	//check if user is logged in; else redirect to login page
	if(!isset($_SESSION["officerId"])){ header("location:login.php"); }
	if($_SESSION["level"] == 1){ header("location:login.php"); }
			
	$con = new connection();
	$connection = $con->getConnection();

	$miscfunction = new MiscFunction($connection);
	$offices = $miscfunction->getOffices();
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

		<script>
			function myFunction() {
				window.print();
			}
		</script>
		
	</head>

   	<body>
  

   			<?php include 'includes/top_header_admin.php'; ?>

		<div class="container">

			<div class="row top_10">
			<br>
				<div class="titled">
					Statistics of all Supervisor Registrations
				</div>

				<div class="noprint text-right">
					<button onclick="myFunction()" class="btn btn-primary">Print this Table</button>
				</div><br />

				<table class="table table-striped table-bordered">
					<tr>
						<th width="5%">S/N</th>
						<th width="30%">Office Name</th>
						<th width="30%">Number of Registered Supervisors</th>
						<th width="15%">Active Supervisors</th>
						<th width="20%">Inactive Supervisors</th>
					</tr>

					<?php $count =1;		
					while($row = $offices->fetch_assoc()){
						 ?>
					<tr>
						<td><?php echo $count; $count++; ?></td>
						<td><?php echo $row["Name"]; ?></td>					
						<?php
							$officeId = $row["OfficeId"];
							$supervisorsDetails = $miscfunction->supervisorPerOffice($officeId);						
								foreach($supervisorsDetails as $value){ ?>
						<td><?php echo $value; ?></td>
							<?php } ?>				
					</tr>
					<?php } ?>
				</table>

			</div>

			<div class="noprint text-center top_10">
				<button onclick="myFunction()" class="btn btn-primary">Print this page</button>
			</div>

		</div>

		<?php include 'includes/footer.php'; ?>

	</body>

</html>