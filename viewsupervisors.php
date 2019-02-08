<?php	
require_once"connection.php";
require_once"miscfunction.php";

	if(!isset($_SESSION["officerId"])){ header("location:login.php"); }
	if($_SESSION["level"] !=1){ header("location:login.php"); }	
	if(isset($_GET['page'])){
		$page= $_GET["page"];
	}
	$con= new connection();
	$connection = $con->getConnection();
	$misc= new MiscFunction($connection);
	if(isset($_SESSION["error_exist"])){
		$error = $_SESSION["error_exist"];
		echo $error;
		unset($_SESSION["error_exist"]);
	} 
	if(isset($_SESSION["record_not_found"])){
		echo $_SESSION["record_not_found"];
		unset($_SESSION["record_not_found"]);
	}

	if (isset($_SESSION["supervisor_deactivated"])) {
			echo $_SESSION["supervisor_deactivated"];
			unset($_SESSION["supervisor_deactivated"]);
		}	
	
	if (isset($_SESSION["supervisor_activated"])) {
			echo $_SESSION["supervisor_activated"];
			unset($_SESSION["supervisor_activated"]);
		}
		
		
	if (isset($_SESSION["officerId"])){
		$officeId = $_SESSION["officerId"];
	}			

	$num_rec_per_page=50;

	// Gets the page from the table
	if(isset($_GET["page"]) && $_GET["page"] >= 1){ $page  = $_GET["page"]; } else { $page=1; }
	$start_from = ($page-1) * $num_rec_per_page; 

	$result= $misc->viewFullList($start_from,$num_rec_per_page,$officeId);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html xmlns="http://www.w3.org/1999/xhtml">
<!--<![endif]-->

	<head> <?php include 'includes/header.php'; ?> </head>

   	<body>
  
   		<?php include 'includes/top_header.php'; ?>

		<div class="container">
				
			<div class="search_line row">

				<?php include 'includes/search_box.php'; ?>

				<div class="col-md-8 text-right top_10">
					<a href="inactive.php">View Inactive Supervisors</a> <a href="active.php">View Active Supervisors</a>
				</div>

			</div>

			<div class="search-result">
			<div class="row">

				<div class="titled">
					List of all your Registered Supervisors (Both Active & Inactive)
				</div>
			<form action= "massdeactivate.php" method="post">
				<table class="table table-striped table-bordered">
					<tr class="active">
						<th width="5%"></th>
						<th width="5%">S/N</th>
						<th width="15%">Supervisor ID</th>
						<th width="35%">Full Name</th>
						<th colspan="3" class="text-center">Action</th>
					</tr>
					<?php
					$start_from+=1;

					while ($row = $result->fetch_assoc()) {
						$check_school_field = true;
						

						$id=$row["Id"];
						if(trim($row["currentSchool"]) === "" ){ 
							$check_school_field = false;
						}

						$sup_Id = $row["SupervisorId"];
						?>
						<tr>	
						<td><input type="checkbox" name="check_list[]" value="<?php echo $sup_Id; ?>"> </td>		
						<td><?php echo $start_from; ?> </td>
						<td><?php echo $row["SupervisorId"]; ?> </td> 
						<td class="fullname"><?php echo $row["Fullname"]; ?> </td>
						<td class="text-center">
							<a href="<?php echo 'createsupervisor.php?id='.$id?>" class="btn btn-primary btn-sm">Edit Record</a>
						</td>
						
						<td class="text-center">
							<?php if(!$check_school_field) { ?>
								<button type="button" class="btn btn-success btn-sm" disabled='disabled'>View Photocard</button>
							<?php }else{ ?>
								<a href="<?php echo 'photocard.php?id='.$id?>" class="btn btn-success btn-sm">View Photocard</a>
								<?php } ?>
						</td>
						
						<td class="text-center">
							<?php
							if ($row["status"]==1){ 
								if(!$check_school_field) { ?>
									<button type="button" class="btn btn-info btn-sm" disabled='disabled'> Deactivate Supervisor </button>
								<?php }else{ ?>
									<a href='<?php echo "deactivate.php?id=".$id."&page=".$page?>' class="btn btn-info btn-sm">Deactivate Supervisor</a>
								<?php } 
							}
							else{
								if(!$check_school_field) { ?>
									<button type="button" class="btn btn-danger btn-sm" disabled='disabled'> Activate Supervisor </button>
								<?php }
								else{ ?>
								<a href="<?php echo "activate.php?id=".$id."&page=".$page?>" class="btn btn-danger btn-sm">Activate Supervisor</a>
							<?php } 
							} ?>
						</td>						  
						</tr>  
						<?php $start_from+=1;
					} ?>
				</table>
				<input type="submit" class="btn btn-danger" name="deactivateAll" value="Deactivate Selected Supervisors"/> 
		
				<div class="col-md-4 offset-8">
				<input type="submit" class="btn btn-success" name="ActivateAll" value="Activate Selected Supervisors"/> 
				</div>
				<input type="hidden" name="curr_page" value="<?php echo $page; ?>" />
			</form>
			</div>
		
		
		
			<div class="paginator">
				<?php
					$result2= $misc->viewSupervisor($officeId);
					$total_records = mysqli_num_rows($result2);  //count number of records
					$total_pages = ceil($total_records / $num_rec_per_page); 
					
					if($page == 1){
						echo "<a href='viewsupervisors.php?page=1' style='text-decoration: underline'>".'First'."</a> "; // Goto 1st page
					}else{
						echo "<a href='viewsupervisors.php?page=1'>".'First'."</a> "; // Goto 1st page
					}
					
					for($i=2; $i<$total_pages; $i++){
						if($i == $page){
							echo "<a href='viewsupervisors.php?page=".$i."' style='text-decoration: underline'>".$i."</a> "; 
						}else{
							echo "<a href='viewsupervisors.php?page=".$i."'>".$i."</a> "; 
						}
						
					}
					if (mysqli_num_rows($result)!=0 ){
						if($page == $total_records){
							echo "<a href='viewsupervisors.php?page=$total_pages' style='text-decoration: underline'>".'Last'."</a> "; // Goto last page
						}else{
							echo "<a href='viewsupervisors.php?page=$total_pages'>".'Last'."</a> "; // Goto last page
						}
					
					}
					
				?>
			</div>
		</div>
			
		</div>	
	
		<?php include 'includes/footer.php'; ?>

	</body>
	
</html>