<?php
	
	if(isset($_GET['statename'])){
		require_once "connection.php";
		require_once "miscfunction.php";

		$con= new connection();
	    $connection = $con->getConnection();
		$miscfunction = new MiscFunction($connection);

		
			$statename = $_GET['statename'];
		
			$result =  $miscfunction->getLga($statename); ?>

			<option value="">Select a local government in <?php echo $statename; ?></option>
			<?php 
				while($row = $result->fetch_assoc()){ ?>
					<option value="<?php echo $row['lga'];?>"><?php echo $row['lga']; ?></option>
			<?php
				}
	}
?> 