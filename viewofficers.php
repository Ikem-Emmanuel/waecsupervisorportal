<?php 
require_once"connection.php";
require_once"miscfunction.php";
require_once"notifications.php";;

		if(!isset($_SESSION["officerId"])){ header("location:login.php"); }
		if($_SESSION["level"] == 1){ header("location:login.php"); }
		
		$officeId = $_SESSION["officerId"];
		$officerLevel = $_SESSION["level"];
		
		if (isset($_SESSION["record_not_found"])) {
			echo $_SESSION["record_not_found"];
			unset($_SESSION["record_not_found"]);
		}
		
		if (isset($_SESSION["password_reset"])) {
			echo $_SESSION["password_reset"];
			unset($_SESSION["password_reset"]);
		}
		if (isset($_SESSION["officer_deactivated"])) {
			echo $_SESSION["officer_deactivated"];
			unset($_SESSION["officer_deactivated"]);
		}
		
		if (isset($_SESSION["officer_activated"])) {
			echo $_SESSION["officer_activated"];
			unset($_SESSION["officer_activated"]);
		}
		
		if (isset($_SESSION["officer_mass_deactivated"])) {
			echo $_SESSION["officer_mass_deactivated"];
			unset($_SESSION["officer_mass_deactivated"]);
		}	
	
		if (isset($_SESSION["officer_mass_activated"])) {
			echo $_SESSION["officer_mass_activated"];
			unset($_SESSION["officer_mass_activated"]);
		}

		$con= new connection();
		$connection = $con->getConnection();
		$misc= new MiscFunction($connection);

		$num_rec_per_page=150;

		// Gets the page from the table

		if(isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
		$start_from = ($page-1) * $num_rec_per_page; 

		if($officerLevel == 3){ //view all officers, incuding officers in Nigerian head office
			$result= $misc->viewFullOfficerList($start_from,$num_rec_per_page);
		}else{ //view only state officers
			$result= $misc->viewStateOfficers($start_from,$num_rec_per_page);
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

			<div class="search_line row">
				
				<div class="form-group">
					<div class="input-field col-md-4">
						<i class="material-icons prefix">&#xE8B6;</i>
						<?php if($officerLevel == 3){ ?>
							<input type="text" id="search-all-officers" office-id="<?php echo $officeId; ?>" class="form-control" name="search"  maxlength="20" required="required">
						<?php	}else{ ?>
							<input type="text" id="search-officer" office-id="<?php echo $officeId; ?>" class="form-control" name="search"  maxlength="20" required="required">
							<?php	} ?>
						
						<label class="control-label" for="search-officer">Search by Officer Name</label>
					</div>
				</div>
				

				<div class="col-md-4 text-right top_10"></div>
				
				<div class="col-md-4 text-right ">
					<a href="downloadofficers.php" class="btn btn-danger"> Download list of officers</a> 
				</div>

			</div>

			<div class="search-result">
		 	<div class="row">

				<div class="titled">
					List of all Approved Registration Officers
				</div>

			<form action= "officermassdeactivate.php" method="post">
				<table class="table table-striped table-bordered">
					<tr>
						<th colspan="2">S/N</th>
						<th width="22%">Full Name</th>
						<th width="12%">Phone Number</th>
						<th width="12%">Username </th>
						<th width="10%">Email</th>
						<th width="28%">Designated Office</th>
						<th colspan="3" class="text-center">Action</th>
					</tr>

					<?php
						$start_from+=1;
						while ($row = $result->fetch_assoc()) {
			
						$id=$row["Id"];
						$office_Id=$row["OfficeId"];
						?>
	
					<tr>			
						<td><input type="checkbox" name="check_list[]" value="<?php echo $id; ?>"> </td>
			  			<td><?php  echo $start_from;	  ?> </td>
			  			<td><?php echo $row["Fullname"]; ?> 
			  			<td><?php echo $row["Phone"]; ?> 
			  			<td><?php echo $row["Username"]; ?>
			  			<td><?php echo $row["Email"]; ?></td>
			  			<td>
							<?php
							   
							$offices = $misc->getOfficeName($office_Id);
							while($row2 = $offices->fetch_assoc()){ 
							echo $row2["Name"]; }?>
			  			</td>
			  			<td>
							<a href="<?php echo "registerofficer.php?id=".$id?>"> <button name="edit" class="btn btn-primary btn-sm" type="button">Edit Record</button></a>
						</td>
						<td>
							<?php 
								if ($row["Status"]==1){ ?> <a href="<?php echo "deactivateofficer.php?id=".$id ?>">
								<button name="DEACTIVATE" class="btn btn-success btn-sm" type="button">Deactivate</button></a>
							<?php }
								else {  ?>
								<a href="<?php echo "activateofficer.php?id=".$id ?>"><button name="ACTIVATE" class="btn btn-danger btn-sm" type="button">Activate</button> </a> <?php } ?>
			  			</td>
			  			<td>
			  				<a href="<?php echo "resetofficerpassword.php?id=".$id ?>"><button name="resetPassword" class="btn btn-primary btn-sm" type="button">Reset Password</button> </a>
			  			</td>
			  
					</tr> 

						<?php $start_from+=1;
						}
						?>


				</table>
				
				<div class="row">
					<div class="col-md-4 col-md-offset-1">
						<input type="submit" class="btn btn-success" name="ActivateAll" value="Activate Selected Officers"/> 
					</div>
					<div class="col-md-4">
						<input type="submit" class="btn btn-danger" name="deactivateAll" value="Deactivate Selected Officers"/> 
					</div>
				</div>
			</form>
		
				

			</div>
			
	
			<div class="paginator">
				<?php
					if($officerLevel == 2){
						$result2= $misc->viewOfficersList();
					}
					else{
						$result2= $misc->viewOfficersList2();
					}
					
					$total_records = $result2['total'];  //count number of records
					$total_pages = ceil($total_records / $num_rec_per_page); 

					echo "<a href='viewofficers.php?page=1'>".'First'."</a> "; // Goto 1st page  
					
					if($total_pages > 1){
						for($i=2; $i<$total_pages; $i++) { 
							echo "<a href='viewofficers.php?page=".$i."'>".$i."</a> "; 
						}
						echo "<a href='viewofficers.php?page=$total_pages'>".'Last'."</a> "; // Goto last page
					}
					
				?>
			</div>
		</div>
	</div>
	
		<?php include 'includes/footer.php'; ?>

	</body>
	
</html>