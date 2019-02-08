<?php
	require_once "connection.php";

	$con = new connection();
	$connection = $con->getConnection();

	$query = "select * from supervisor";
	$result = $connection->query($query) or die(mysqli_error($connection));
	while ($row = $result->fetch_assoc()) {
		$id = $row["Id"];
		$SupervisorId= $row["SupervisorId"];
		$OfficeId = $row["OfficeId"];
		$newSupervisorId = "4".$OfficeId.$SupervisorId;

		$updateSql = $connection->query("Update supervisor set SupervisorId = '$newSupervisorId' where Id=$id");
	}
	echo "DONE";
?>