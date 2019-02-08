
												
											<?php 
											require_once "connection.php";
		require_once "miscfunction.php";
		require_once "officer.php";
		require_once "officerdao.php";
		require_once "notifications.php";
			
		$con= new Connection();
		$connection= $con->getConnection();
		$misc= new MiscFunction($connection);
		$notifyObject = new Notifications();
		?>
											<html>
											<head>
											 <?php include 'includes/header.php'; ?>
											</head>
											<body>
											<?php include 'includes/top_header_out.php'; 
   										
											$msg ="You are not allowed to access this page because you have been deacvtivated!!!";
											echo ($notifyObject->errorMessage($msg));
											
											include 'includes/footer.php';
											
											?>
											
	</html>
											
											
										
															
											
										
									