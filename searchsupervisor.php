<?php 

	if(isset($_GET['search']) && isset($_GET['office_id'])){
		$searchVal = $_GET['search'];

		//validates search parameter
		if (preg_match('/[\'^£$%&*(){}@#~?><>,|=_+¬-]/',$searchVal)){
			echo "Search field contains special characers";
		}else{
		require_once "connection.php";
		require_once "miscfunction.php";

		$con = new connection();
		$connection = $con->getConnection();
		$misc = new Miscfunction($connection);

		
		$office_id =  $_GET['office_id'];
		$result = $misc->search($searchVal, $office_id);
		$total_record = mysqli_num_rows($result);
		
		$start_from = 1;

			if($total_record > 0){
		?>
			<div class="row">

				<div class="titled">
					SEARCH RESULT (<?php echo $total_record; ?> supervisor record(s) found)
				</div>
				
				<table class="table table-striped table-bordered">
					<tr class="active">
						<th width="5%">S/N</th>
						<th width="15%">Supervisor ID</th>
						<th width="35%">Full Name</th>
						<th colspan="3" class="text-center">Action</th>
					</tr>
					<?php
					while ($row = $result->fetch_assoc()) {
						$id=$row["Id"];
						?>
						<tr>	
							<td><?php  echo $start_from; ?> </td>
							<td> <?php echo $row["SupervisorId"]; ?> </td> 
							<td class="fullname"><?php echo $row["Fullname"]; ?> </td>
							<td class="text-center">
								<a href="<?php echo "createsupervisor.php?id=".$id?>"  target="_blank" class="btn btn-primary btn-sm">Edit Record</a>
							</td>
							<td class="text-center">
								<?php 
								$currentSchool = trim($row["currentSchool"]);
								if(empty($currentSchool)){ ?>
									<button class="btn btn-primary btn-sm" disabled="disabled">View Photocard</button>
								<?php } else{ ?>
									<a href="<?php echo 'photocard.php?id='.$id?>" target="_blank" class="btn btn-primary btn-sm">View Photocard</a>
								<?php } ?>
							</td>
							
							<td class="text-center">
								<?php 
									if ($row["status"]==1){ 
										if(empty($currentSchool)){ ?>
										<button class="btn btn-success btn-sm" disabled='disabled'>Deactivate Supervisor</button>
										<?php }
										else{ ?> 
										<a href="<?php echo 'deactivate.php?id='.$id?>"><button class="btn btn-success btn-sm" >Deactivate Supervisor</button></a> <?php }
									}
									else{ 
										if(empty($currentSchool)){ ?>
											<button class="btn btn-danger btn-sm" disabled='disabled'>Activate Supervisor</button>
										<?php }
										else{ ?>
										<a href="<?php echo 'activate.php?id='.$id?>"><button class="btn btn-danger btn-sm" >Activate Supervisor</button> </a> <?php } 
									}?>
							</td>
						</tr>
						<?php $start_from+=1;
					} ?>
				</table>
				
			</div>

	<?php	}
		else{ ?>
			<div class="row">

				<div class="titled">
					NO RECORD MATCH YOUR SEARCH
				</div>
			</div>
	<?php	}
	}
}
?>