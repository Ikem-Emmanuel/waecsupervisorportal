<?php 
    session_start();
	if(!isset($_SESSION["officerId"])){ header("location:login.php"); }
	if($_SESSION["level"] == 1){ header("location:login.php"); }
?>

<!DOCTYPE html>
<html>

	<head>
		
		<?php include 'includes/header.php'; ?>

	</head>

   	<body id="page-top">
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include 'includes/top_header_admin.php'; ?>
                <!-- Begin Page Content -->
                <div class="container">
                    <div class="page-body">
                        <div class="row">
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-bottom-success shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-3">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    <a href="registerofficer.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                                                        <i class="fas fa-download fa-sm text-white-50"></i>Create a new officer account</a>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-bottom-info shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-3">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    <a href="viewofficers.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                                                        <i class="fas fa-download fa-sm text-white-50"></i>View registered officers</a>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-bottom-info shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-3">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    <a href="viewstatistics.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                                                        <i class="fas fa-download fa-sm text-white-50"></i>View approved offices</a>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-bottom-info shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-3">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    <a href="viewofficers.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                                                        <i class="fas fa-download fa-sm text-white-50"></i>View and Search officers</a>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
  	

   	
<!--   			<h2>Admin Dashboard</h2>-->
<!---->
<!--   		<div class="container dashboard">-->
<!---->
<!--				<div class="row">-->
<!--                    <div class="col-lg-6 col-md-12">-->
<!--                        <div class="panel panel-black">-->
<!--                            <div class="panel-heading">-->
<!--                                <div class="row">-->
<!--                                    <div class="col-xs-3">-->
<!--                                        <i class="fa fa-user fa-5x"></i>-->
<!--                                    </div>-->
<!--                                    <div class="col-xs-9 text-right">-->
<!--                                        <div class="huge"><a href="registerofficer.php">Create a new officer account</a></div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div> -->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="col-lg-6 col-md-12">-->
<!--                        <div class="panel panel-green">-->
<!--                            <div class="panel-heading">-->
<!--                                <div class="row">-->
<!--                                    <div class="col-xs-3">-->
<!--                                        <i class="fa fa-users fa-5x"></i>-->
<!--                                    </div>-->
<!--                                    <div class="col-xs-9 text-right">-->
<!--                                        <div class="huge"><a href="viewofficers.php">List of all registered officers</a></div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                         </div>-->
<!--                    </div>-->
<!--                </div><br /><br />-->
<!---->
<!--                <div class="row">-->
<!--                    <div class="col-lg-6 col-md-12">-->
<!--                        <div class="panel panel-pink">-->
<!--                            <div class="panel-heading">-->
<!--                                <div class="row">-->
<!--                                    <div class="col-xs-3">-->
<!--                                        <i class="fa fa-bar-chart fa-5x"></i>-->
<!--                                    </div>-->
<!--                                    <div class="col-xs-9 text-right">-->
<!--                                        <div class="huge"><a href="viewstatistics.php">Statistics of all approved Offices</a></div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="col-lg-6 col-md-12">-->
<!--                        <div class="panel panel-purple">-->
<!--                            <div class="panel-heading">-->
<!--                                <div class="row">-->
<!--                                    <div class="col-xs-3">-->
<!--                                        <i class="fa fa-search-plus fa-5x"></i>-->
<!--                                    </div>-->
<!--                                    <div class="col-xs-9 text-right">-->
<!--                                        <div class="huge"><a href="viewofficers.php">Search for Officers</a></div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!---->
<!--		</div>-->
<!---->
        <?php include 'includes/footer.php'; ?>
  	
  

  	</body>

</html>