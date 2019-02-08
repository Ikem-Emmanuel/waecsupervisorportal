<?php
require_once"connection.php";
require_once"miscfunction.php";
require_once "notifications.php";
	
	if(!isset($_SESSION["officerId"])){ header("location:login.php"); }
	//if($_SESSION["level"] !=1){ header("location:login.php"); }	
	
	$con= new connection();
	$connection = $con->getConnection();
	$misc= new MiscFunction($connection);
		$notifyObject= new notifications();
	if(isset($_SESSION["error_exist"])){
		$error = $_SESSION["error_exist"];
		echo $error;
		unset($_SESSION["error_exist"]);
	}
	$num_rec_per_page=50;

	if(isset($_SESSION["officerId"])){
		$officeId= $_SESSION["officerId"];
	}
		
	// Gets the page from the table
	if(isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
	$start_from = ($page-1) * $num_rec_per_page; 

	$result= $misc->viewActivePaginator($start_from,$num_rec_per_page,$officeId);
	$result2= $misc->viewActiveSupervisor($officeId);
	
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
  
   		<?php include 'includes/top_header.php'; ?>

   		<div class="container">
				
			<div class="search_line row">

				<?php include 'includes/search_box.php'; ?>

				<div class="col-md-8 text-right top_10">
					<a href="inactive.php">View Inactive Supervisors</a> <a href="viewsupervisors.php">View full list of Supervisors</a>
				</div>

			</div>
			
			<div class="search-result">
			<div class="row">
				<?php 
					if (mysqli_num_rows($result2)== 0){
						$errorMsg="NO ACTIVE SUPERVISORS!!!";
						echo ($notifyObject->errorMessage($errorMsg));
					}else{
					?>

				<h2 class="titled">List of all your ACTIVE registered supervisors</h2>

				<table class="table table-striped table-bordered">
					<tr class="active">
						<th width="5%">S/N</th>
						<th width="15%">ID</th>
						<th width="35%">Full Name</th>
						<th colspan="3" class="text-center">Action</th>
					</tr>
					<?php
						$start_from+=1;
						while($row = $result->fetch_assoc()){
							$id=$row["Id"];
							$currentSchool = trim($row["currentSchool"]);
							?>
							<tr>
								<td><?php  echo $start_from;  ?> </td>
								<td><?php echo $row["SupervisorId"]; ?> </td>
								<td class="fullname"><?php echo $row["Fullname"]; ?> </td>					  
								<td class="text-center">
									<a href="<?php echo "createsupervisor.php?id=".$id?>"> <button name="edit" class="btn btn-primary btn-sm">Edit Record</button></a>
								</td>

								<td class="text-center">
								<?php if($currentSchool === ""){ ?>
									<button type="button" class="btn btn-success btn-sm" disabled='disabled' > View Photocard </button>
								<?php } else{ ?>
									<a href="<?php echo "photocard.php?id=".$id?>"> <button name="edit" class="btn btn-success btn-sm">View Photocard</button></a>
								<?php } ?>
								</td>

								<td class="text-center">
								<?php if($currentSchool === ""){ ?>
									<button type="button" class="btn btn-info btn-sm" disabled='disabled' > Deactivate Supervisor </button>
								<?php } else{ ?>
									<a href="<?php echo "deactivate.php?id=".$id?>"> <button name="delete" class="btn btn-info btn-sm">Deactivate Supervisor</button></a>
								<?php } ?>
								</td>				  
							</tr>  
							<?php $start_from+=1;
						} ?>
				</table>

				<div class="paginator">
					<?php
						
						$total_records = mysqli_num_rows($result2);  //count number of records
						$total_pages = ceil($total_records / $num_rec_per_page); 

						if($page == 1){
							echo "<a href='active.php?page=1' style='text-decoration: underline'>".'First'."</a>"; // Goto 1st page
						}else{
							echo "<a href='active.php?page=1'>".'First'."</a>"; // Goto 1st page
						}
				

						for($i=2; $i<$total_pages; $i++){ 
							if($i == $page){
								echo "<a href='active.php?page=".$i."' style='text-decoration: underline'>".$i."</a>"; 
							}else{
								echo "<a href='active.php?page=".$i."'>".$i."</a>"; 
							}
						}
						
						if($page == $total_pages){
							echo "<a href='active.php?page=$total_pages' style='text-decoration: underline'>".'Last'."</a>"; // Goto last page
						}else{
							echo "<a href='active.php?page=$total_pages'>".'Last'."</a>"; // Goto last page
						}
					?>
				</div>
			
			<?php } ?>
			</div>
		</div>

		</div>

		<?php include 'includes/footer.php'; ?>

	</body>	

</html>