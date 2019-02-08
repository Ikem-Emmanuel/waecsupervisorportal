<?php 
	require_once "connection.php";
	require_once "officerdao.php";
	require_once "miscfunction.php";
	include 'header.php';
		
		if(!isset($_SESSION["officerId"])){ header("location:login.php"); }
		if($_SESSION["level"] !=1){ header("location:login.php"); }

		$con= new connection();
		$connection = $con->getConnection();
		$miscfunction = new MiscFunction($connection);
		
		if(isset($_GET["id"])){
				$id = $_GET["id"];
				$row = $miscfunction->getDetails($id);
				if(!is_null($row)){
		?>

	<head>
		
		<?php include 'includes/header.php'; ?>

		<link href="css/printed.css" rel="stylesheet" type="text/css" media="screen" />
		
	</head>

   	<body>
  		<br /><br /><br /><br />

			<div id="main"> 

				<div class="container">
					
					<div class='waec_header'>
            			<div class='waec_logo'>
            				<img src='images/waec.png' width='150' />
            			</div>
            			<div class='waec'>
            				THE WEST AFRICAN EXAMINATIONS COUNCIL
            				<div class='waec_address'>
								21, Hussey Street, Yaba;<br />Private Mail Bag 1022, Yaba, Lagos.<br />Tel: (01) 7305150, 961016, 2136455, 8974569.
								<br />e-mail:hnowaeclagos@yahoo.co.uk, hnowaeclagos@waecnigeria.org
            				</div>
            			</div>
            			<div class='clearer'></div>
            		</div><br /><br />


            		<?php 
            		$currentSchool = trim($row["currentSchool"]);
            		if(!empty($currentSchool)){
            			$filepics= $row["Passport"];
						$officeId=$row["OfficeId"]; 
					?>
					<table class="table table-striped table-bordered">
						<tr>
							<td class="col1">Supervisor Name</td>
							<td class="col2"><b><?php echo $row["Fullname"]; ?></b></td>
							<td rowspan="7"  class="col3">
								<div id="pix">
									<img src="uploads/<?php if(isset($filepics)){ echo $filepics; } ?>" width="300" height="280" />
								</div>
							</td>
						</tr>	
						
						<tr>
							<td>Supervisor ID</td>
							<td><b><?php echo $row["SupervisorId"];?> </b>
							</td>
						</tr>	
						
						<tr>
							<td>Gender</td>
							<td><b><?php echo $row["Gender"]; ?></b></td>
						</tr>
						
						<tr>
							<td>Exam Diet</td>
							<td><b>WASSCE (S.C,<?php echo date('Y'); ?>)</b></td>
						</tr>
						
						
						
						<tr>
							<td>WAEC Registered Office</td>
							<td>	
							<b><?php $result= $miscfunction->getOfficeName($officeId);
							while($row2 = $result->fetch_assoc()){ 
							echo $row2["Name"]; } ?></b>
							</td>
						</tr>
						
						<tr>
							<td>School </td>
							<td><b><?php echo $row["currentSchool"]; ?></b></td>
						</tr>
						<tr>
							<td>LGA</td>
							<td><b><?php echo $row["LGA"]; ?></b></td>
						</tr>
			
					</table>
				<?php } ?>
				</div><br />

				<div class="noprint text-center">
						<button onclick="myFunction()" class="btn btn-primary">Print Photocard</button>
				</div>

			</div>			
			
		<?php } } ?>

	</body>
	<script>
		function myFunction() {
			window.print();
		}
	</script>
	
</html>