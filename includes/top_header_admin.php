<div id="wrapper"><!-- start wrapper ID, finish it inside footer -->
    
    <div id="header"><!-- start CSS header ID -->

<!-- Header starts here -->
    <nav class="navbar navbar-inverse" role="navigation">
        <div class="container">
            <!-- Logo and Navigation gets grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand navbar-collapse collapse" href="index.php"><img src="images/logo.png" /></a>

                <a class="navbar-brand navbar-toggle" data-toggle="collapse" href="index.php">WAEC Supervisors' E-Registration Portal</a>
            </div>

            <!-- Collect the Navigation link and Login Form for toggling -->
            <div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="resetpassword.php">Change Password</a>
                    </li>
                    <li>
                        <a href="logout.php">Logout</a>
                    </li>
                </ul>
            </div> <!-- /.navbar-collapse -->
        </div> <!-- /.container -->
    </nav>

    <div class="top_spacer"></div>
    <!-- header ends here -->

        <div class="titler">
            <div class="container">
                <?php
					if (isset($_SESSION["fullname"])){
					echo "Hi Admin ". $_SESSION["fullname"];
					}
				?> 
            </div>
        </div>


    </div> <!-- end CSS header ID -->

    <div id="content"><!-- start CSS content ID, finish it inside footer -->