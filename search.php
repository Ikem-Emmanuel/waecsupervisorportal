<?php 
require_once"connection.php";
require_once"miscfunction.php";
	if(!isset($_SESSION["officerId"])){ header("location:login.php"); }
	if($_SESSION["level"] !=1){ header("location:login.php"); }
	
				if(isset($_SESSION["officerId"])){
					$officeId= $_SESSION["officerId"];
				}
				$error = "";

				//Accepts the search parameter from the previous page and validates
				if(isset ($_POST["submit"])){
					$search= $_POST["search"];

					if(empty($search)){
						echo "Search parameter cannot be empty";
					}
					if(strlen($search)>=50){
						$error.="Search length exceeds limit"."<br/>";
					}
					if(preg_match('/[\'^£$%&*(){}@#~?><>,|=_+¬-]/',$search)){
						$error.="Search field contains special characers<br/>";
					}						

					//if error exits in the search parameter it is saves in session and echos it on viewsupervisor.php
					if($error != ""){
						$_SESSION["error_exist"] = $error;
						header("location:viewsupervisors.php");
						return;
					}		

				else {
					$con= new connection();
					$connection = $con->getConnection();

					$misc= new MiscFunction($connection);
					$result= $misc->search($search,$officeId);

					if(mysqli_num_rows($result) ==0 ){ 
					
					$_SESSION["record_not_found"]="<div class='not_found'>Record not found. Try using another name or ID!<br /><br /><a href='' class='btn btn-primary'>Close</a></div>";
					header("location:viewsupervisors.php");
					
				}
					
					else if (mysqli_num_rows($result) !==0 ){ ?>
					
	<head>
		<?php include 'includes/header.php'; ?>
		
	</head>

   	<body>
  
   		<?php include 'includes/top_header.php'; ?>

		<div class="container">
	
							<div class="search_line row">

								<?php include 'includes/search_box.php'; ?>

								<div class="col-md-8 text-right top_10">
									<a href="viewsupervisors.php">List of all Supervisors</a>
								</div>

							</div>


							<div class="titled">
								Here is your search result
							</div>

							<table class="table table-striped table-bordered">
								<tr class="active">
									<th width="5%">S/N</th>
									<th width="15%">Supervisor ID</th>
									<th width="35%">Full Name</th>
									<th colspan="3" class="text-center">Action</th>
								</tr>

								<?php $start_from=0;
									$start_from+=1;
									while ($row = $result->fetch_assoc()) {	?>
										<tr>	
											<td> <?php echo $start_from; ?> </td>
											
											
											
											<td> <?php $sup_Id = $row["SupervisorId"];
											$off_Id = $row["OfficeId"];
											$supervisor_Id = "4".$off_Id.$sup_Id; 
											echo $supervisor_Id;
											$id =$row["Id"];?></td>
											<td> <?php echo $row["Fullname"];?></td>										 

											<td class="text-center">
												<a href="<?php echo "createsupervisor.php?id=".$id?>"> <button name="edit" class="btn btn-primary btn-sm">Edit Record</button></a>
											</td>

											<td class="text-center">
												<a href="<?php echo "photocard.php?id=".$id?>"> <button name="edit" class="btn btn-primary btn-sm">View Photocard</button></a>
											</td>
											<td class="text-center">
												<?php 
												if ($row["status"]==1){ ?> 
												<a href="<?php echo "deactivate.php?id=".$id ?>"><button name="DEACTIVATE" class="btn btn-success btn-sm">Deactivate Supervisors</button></a> 
												<?php }
													
												else {  ?>
													<a href="<?php echo "activate.php?id=".$id ?>"><button name="ACTIVATE" class="btn btn-danger btn-sm">Activate Supervisors</button> </a> 
												<?php } ?>
											</td>
										</tr>

											<?php $start_from+=1; } ?>
								</table>	
							</div>						
					<?php	}
					
				}
				} ?>
				
		</div>



	</body>
	
</html>