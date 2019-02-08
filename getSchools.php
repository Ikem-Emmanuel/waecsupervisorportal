<?php
	if(isset($_GET['lga'])){
		require_once "connection.php";
		require_once "miscfunction.php";

		$con= new connection();
	    $connection = $con->getConnection();
		$miscfunction = new MiscFunction($connection);

		
			$lga = $_GET['lga'];
			$result =  $miscfunction->getSchools($lga); ?>

			<option value="">Select a school</option>
			<?php 
				while($row = $result->fetch_assoc()){ ?>
					<option value="<?php echo $row['nameOfSchool'];?>"><?php echo $row['nameOfSchool']; ?></option>
			<?php
				}
	}
?> 