<?php 
    session_start();
	if(!isset($_SESSION["officerId"])){ header("location:login.php"); }
	if($_SESSION["level"] == 1){ header("location:login.php"); }
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
  	
   		<?php include 'includes/top_header_admin.php'; ?>
   	
   			<h2>Admin Dashboard</h2>

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
                                        <div class="huge"><a href="registerofficer.php">Create a new officer account</a></div>
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
                                        <div class="huge"><a href="viewofficers.php">List of all registered officers</a></div>
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
                                        <i class="fa fa-bar-chart fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><a href="viewstatistics.php">Statistics of all approved Offices</a></div>
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
                                        <i class="fa fa-search-plus fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><a href="viewofficers.php">Search for Officers</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

		</div>

  		<?php include 'includes/footer.php'; 


?>
  	
  

  	</body>

</html>