<?php
    
    ob_start();
    
    require_once"connection.php";
    require_once"miscfunction.php";

    $con= new connection();
	$connection = $con->getConnection();
	$misc= new MiscFunction($connection);

	if (isset($_SESSION["officerId"])){
		$officeId= $_SESSION["officerId"];
	}	
	$result4= $misc->getOfficeName($officeId);
	
	while($row4 = $result4->fetch_assoc()){ 
	$office= $row4["Name"]; }
		
	$office = preg_replace("/[^A-Za-z0-9]+/", "_", $office);
	
	$photocard_dir = "photocard_dir";
	if (!file_exists($photocard_dir)) {
		mkdir($photocard_dir);
	}

	$photocard_parent = $photocard_dir."/".$office;
	if (!file_exists($photocard_parent)) {
		mkdir($photocard_parent);
	}

	$pix_array = array();
	$i = 0;
	
	
	$query= "select * from supervisor where OfficeId=$officeId  AND currentSchool !='' AND status=1";
	$result= $connection->query($query) or die(mysqli_error($connection));

	if(mysqli_num_rows($result) == 0) {
		$_SESSION["list_empty"]="<div class='not_found'>Please activate supervisors before you download photocards.<br /><br /><a href='' class='btn btn-primary'>Close</a></div>";
		header("location:officerindex.php");
			return;
	}
		
	while ($row= $result->fetch_assoc()){
		$supervisor_Id = $row["SupervisorId"];
		$off_Id = $row["OfficeId"];
		$FullName= $row["Fullname"];
		$Image= trim($row["Passport"]);
		$Image = str_replace("uploads/", "",$Image); 
		$pix_array[$i] = $Image;
		$i++;
		$Gender= $row["Gender"];
		$currentSchool = $row["currentSchool"];
		$lga = $row["LGA"];
		
		
		$output="
		<!DOCTYPE html>
		<html lang='en'>
		<head>
			<meta charset='utf-8'>
			<meta name='viewport'    content='width=device-width, initial-scale=1.0'>
			<meta name='description' content=''>
			<meta name='author'      content='Odofa Oluwaseun (HisRoyalWebness.com)'>
			
			<title>".$FullName." | WAEC - Supervisors' Registration Form</title>

			<link rel='shortcut icon' href='assets/images/favicon.ico'>

				<style>
					body {color:#333; font-family: Arial; font-size: 16px;}
		            #main {width:1000px; margin: 0px auto;}
		            .waec_header {width:100%; margin-top: 30px;}
		            .waec {width: 83%; color: #009; text-align: center; font-size: 28px; margin-bottom: 15px; font-weight:600;}
		            .waec_logo {float:left; width: 16%;}
		            .clearer {clear:both;}
		            .waec_address {text-align: center; color: #333; font-size: 16px; margin: 10px 0 0 0; font-weight:normal;}
		            .principal {color: #333; margin: 120px 0 60px; width: 30%; font-size: 20px;}
		            .table{width:80%; margin:0px; color: #333; padding: 0px 5px;} 
		            .table th{text-align: left; text-transform: capitalize;}
		            .table-striped > tbody > tr:nth-child(odd) > td,
					.table-striped > tbody > tr:nth-child(odd) > th {
					  background-color: #f5f5f5;
					}
					.table-hover > tbody > tr:hover > td,
					.table-hover > tbody > tr:hover > th {
		  			background-color: #f9f9f9;}
		            .col1{width:25%; padding: 0px 0px 0px 10px;}
		            .col2 {width:35%; padding: 0px 0px 0px 10px;}
		            .col3 {width:35%; text-align: right;}
		            .col3 img {border: 2px solid #333;}
		            .title{text-align:center; font-size:180%; font-weight: 600; text-decoration:underline;}
		            .intro {font-size:100%; padding: 20px 0 40px;}
		            .outro {font-size:100%; padding: 20px 0 0;}
				</style>

		</head>
		<body>

		<main id='main'>

			<div class='container'>
			<div class='waeced'>

		    <div class='waec_header'>
		            <div class='waec_logo'><img src='waec.png' width='150' /></div>
		            <div class='waec'>THE WEST AFRICAN EXAMINATIONS COUNCIL
		            <div class='waec_address'>
		21, Hussey Street, Yaba;<br />Private Mail Bag 1022, Yaba, Lagos.<br />Tel: (01) 7305150, 961016, 2136455, 8974569.<br />e-mail:hnowaeclagos@yahoo.co.uk, hnowaeclagos@waecnigeria.org
		            </div>
		            </div>
		            <div class='clearer'></div>
		            </div>

		            <table class='table table-striped'>
			            <tr>
			            <td class='col1'> Supervisor Name:</td>
			            <th class='col2'>". $FullName ."</th>
			            <td class='col3' rowspan='6'> <img src='".$Image ." ' width='230' height='190' /></td>
			            </tr>

			            <tr>
			            <td class='col1'> Supervisor ID:</td>
			            <th class='col2'>".$supervisor_Id."</th>
			            </tr>


			            <tr>
			            <td class='col1'> Gender:</td>
			            <th class='col2'> ".$Gender."</th>
			            </tr>

			            <tr>
			            <td class='col1'> Exam Diet:</td>
			            <th class='col2'> WASSCE (S.C, ".date('Y').")</th>
			            </tr>

			            <tr>
			            <td class='col1'> WAEC Registered Office:</td>
			            <th class='col2'>".$office."</th>
			            </tr>

			            <tr>
			            <td class='col1'>School:</td>
			            <th class='col2'>".$currentSchool."</th>
			            </tr>

			            <tr>
			            <td class='col1'> L.G.A:</td>
			            <th class='col2'>".$lga." </th>
			            </tr>

		            </table>
		      
					</article>
					<!-- /Article -->
					
				</div>

				</div>
			</div>	<!-- /container -->


			
		</main>

		</body>
		</html>";

		$FullName = trim($FullName);
		$photocard_filename = preg_replace("/[^A-Za-z0-9]+/","_",$FullName);

		$photocard_path = $photocard_parent."/".$photocard_filename.".html";

		$file = fopen($photocard_path, "w") or die("Unable to create photocard");
		fwrite($file, $output);
	}


							/***************zip folder***************/
	$pattern = $photocard_parent."/*.html";
	$files_arr = glob($pattern);
	
	$zip = new ZipArchive();
	$zipFile = $photocard_parent.".zip";
	$zipFilename = $office.".zip";
	$zip->open($zipFile, ZipArchive::CREATE);
	
	foreach($files_arr as $file){

		$path_parts = pathinfo($file);
		
		$zip->addFile($file, $office."/".$path_parts["basename"]);
	}
	
	$img_path = pathinfo("images/waec.png");
	$zip->addFile("images/waec.png", $office."/".$img_path["basename"]); 
	
	for ($i=0; $i<count($pix_array); $i++) {
		$pix_path = "uploads/".$pix_array[$i];
		if(file_exists($pix_path)){
			$img_path2 = pathinfo($pix_path);
		
			$zip->addFile("uploads/".$pix_array[$i], $office."/".$img_path2["basename"]);
		}
		
	} 
	
	$zip->close();
	
	//delete files after adding to archive
	foreach($files_arr as $file){
		unlink($file);
	}
	
	
					/**********************download zipped archive***********************/
	header('Content-Description: File Transfer');
	header("Content-type: application/zip");
	header("Content-Disposition: attachment; filename=\"".$zipFilename."\"");
	header('Content-Transfer-Encoding: binary');
	header("Pragma: no-cache");
	header("Expires: 0");
	header("Content-length: ".filesize($zipFile));
	
	while (ob_get_level()) {
		ob_end_clean();
	  }
	  
	readFile($zipFile);
	
	//delete zipfile and folder after download
	rmdir($photocard_parent);
	unlink($zipFile);
	
	
	exit;
	


?>