<?php 
    session_start();
	if(!isset($_SESSION["officerId"])){ header("location:login.php"); }
	if($_SESSION["level"] !=1){ header("location:login.php"); }
	
    if (isset($_SESSION["list_empty"])) {
        echo $_SESSION["list_empty"];
        unset($_SESSION["list_empty"]);
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
  
   		<?php include 'includes/top_header.php'; ?>

   			<h2>Officer Dashboard</h2>
   			
		<div class="container dashboard">

				<div class="row">
                    <div class="col-lg-6 col-md-12">
                        <div class="panel panel-black">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><a href="createsupervisor.php">Register a new supervisor</a></div>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-users fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><a href="viewsupervisors.php">List of all your registered Supervisors</a></div>
                                    </div>
                                </div>
                            </div>
                         </div>
                    </div>
                </div><br /><br />

                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <div class="panel panel-pink">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-download fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><a href="getlist.php">Download Supervisor List</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="panel panel-purple">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-image-o fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><a href="multiplephotocards.php" title="Download photocards of ONLY ACTIVE supervisors">Download Supervisor Photocards (.zip)</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

			<!--
			<div class="col-md-6 col-md-offset-2"> <b>
					<a href="createsupervisor.php">CREATE A NEW  SUPERVISOR</a><br/>
					<a href="viewsupervisors.php">VIEW COMPLETE LIST OF SUPERVISORS</a><br/>
					<a href="getlist.php">DOWNLOAD COMPLETE LIST OF SUPERVISORS IN YOUR OFFICE</a><br/>
					<a href="viewsupervisors.php">SEARCH FROM COMPLETE LIST OF SUPERVISORS</a><br/>
					<a href="multiplephotocards.php">DOWNLOAD PHOTOCARD OF ALL SUPERVISORS IN YOUR OFFICE</a><br/>
					</b>
			</div>
			-->
		
		</div>

		<?php include 'includes/footer.php'; 


?>
  	
  	</body>

</html>