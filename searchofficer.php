<?php 
	$search = "";
	if(isset($_GET["searchval"])){
		$search= $_GET["searchval"];
	}
	elseif(isset($_GET["searchAllOfficers"])) {
		$search= $_GET["searchAllOfficers"];
	}
		//validates search parameter
		if (preg_match('/[\'^£$%&*(){}@#~?><>,|=_+¬-]/',$search)){
			echo "Search field contains special characers";
		}
		else{
			require_once "connection.php";
			require_once "miscfunction.php";

			$con = new connection();
			$connection = $con->getConnection();
			$misc = new Miscfunction($connection);
			if(isset($_GET["searchval"])){
				$result= $misc->officerSearch($search);
			}
			elseif(isset($_GET["searchAllOfficers"])) {
				$result= $misc->searchAllOfficers($search);
			}
			

			if(mysqli_num_rows($result) > 0){ ?>
				<div class="row">
					<div class="titled">
						Here is your search result
					</div>

					<table class="table table-striped table-bordered">
						<tr>
							<th width="5%">S/N</th>
							<th width="22%">Full Name</th>
							<th width="12%">Phone Number</th>
							<th width="12%">Username </th>
							<th width="10%">Email</th>
							<th width="28%">Designated Office</th>
							<th colspan="3" class="text-center">Action</th>
						</tr>
						<?php  
							$count=0 ;
							while ($row = $result->fetch_assoc()) {	?>
							<tr>									
								<td><?php echo $count +=1; $id =$row["Id"];?></td>
								<td><?php echo $row["Fullname"];?></td>
								<td><?php echo $row["Phone"]; ?></td>
								<td><?php echo $row["Username"]; ?>
								<td><?php echo $row["Email"]; ?></td>	
								<td> <?php $officeId =$row["OfficeId"] ;											 
									$result2= $misc->searchOffice($officeId);
									while ($row2 = $result2->fetch_assoc()){
										echo $row2["Name"];
									} ?> 
								</td>
								<td>
									<a href="<?php echo "registerofficer.php?id=".$id?>"> <button name="edit" class="btn btn-primary btn-sm">Edit Record</button></a>
								</td>																							 
								<td><?php 
										if($row["Status"]==1){ ?> 
											<a href="<?php echo "deactivateofficer.php?id=".$id ?>"><button name="DEACTIVATE" class="btn btn-success btn-sm">Deactivate</button></a> 
											<?php }
										else {  ?>
											<a href="<?php echo "activateofficer.php?id=".$id ?>"><button name="ACTIVATE" class="btn btn-danger btn-sm">Activate</button> </a> 
									<?php } ?>
								</td>
								<td>
					  				<a href="<?php echo "resetofficerpassword.php?id=".$id ?>"><button name="resetPassword" class="btn btn-primary btn-sm">Reset Password</button> </a>
					  			</td>
								
							</tr>												 
						<?php } ?>
					</table>
				</div>
		<?php	}
			else{  ?>
				<div class="row">
					<div class="titled">
						NO RECORD MATCH YOUR SEARCH
					</div>
				</div>
		<?php }
		} ?>