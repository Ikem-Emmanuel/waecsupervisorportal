<!DOCTYPE html>
<html>
<!--<![endif]-->

	<head>
		<?php include 'includes/login_header.php'; ?>
	</head>
	

	<body>

        <div class="container">
            <div class="page-body d-flex align-items-center">
                <div class="row w-100">
                    <div class="col-lg-12">
                        <div class=" login_errors">
                            <?php
                            session_start();
                            if (isset($_SESSION["login_error"])) {
                                echo $_SESSION["login_error"];
                                unset($_SESSION["login_error"]);

                                /**$browserType = $_SERVER['HTTP_USER_AGENT'];
                                if(strpos($browserType, 'Firefox') == true) {
                                exit(); }
                                 **/
                            }
                            if (isset($_SESSION["error_msg"])) {
                                echo $_SESSION["error_msg"];
                                unset($_SESSION["error_msg"]);
                            }

                            ?>
                        </div>
                        <div class="login_container">
                            <div class=" login_row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 logo_section_login">
                                    <img class="login_logo" src="images/logo.png" alt="Weac Supervisors Logo">
                                </div>
                                <div class="hr"></div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 login_section mx-auto">
                                    <form method="POST" action="loginvalidate.php" class="login_form">
                                        <h1 class="form_header">Supervisors <span class="text_dec">Login</span> </h1>
                                        <div class="form-group row top-m">
                                            <label for="name" class="col-md-2 col-form-label text-white">Username</label>
                                            <div class="col-md-10">
                                                <input type="text" name="username" id="inputName" class="form-control" data-minlength="6" required="required" maxlength="25" value="<?php if (isset($_SESSION["loginValues"])) {
                                                    echo $_SESSION["loginValues"]['username'];
                                                } ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row top-m">
                                            <label for="password" class="col-md-2 col-form-label text-white">Password</label>
                                            <div class="col-md-10">
                                                <input type="password" name="password" data-minlength="6" class="form-control" required="required" maxlength="25" value="<?php if (isset($_SESSION["loginValues"])) {
                                                    echo $_SESSION["loginValues"]['password'];
                                                } ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row top-m">
                                            <div class="col-md-4 mx-auto">
                                                <button type="submit" name="submit" class="btn btn-login">Login</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>


<!--		<div class="container">-->
<!---->
<!--            <div class="login col-md-6 col-md-offset-3">-->
<!---->
<!--                <h4>Login to Register Supervisors</h4>-->
<!---->
<!--				<div class="row login_errors">-->
<!--					--><?php
//						session_start();
//							if(isset($_SESSION["login_error"])){
//							 echo $_SESSION["login_error"];
//							 unset($_SESSION["login_error"]);
//
//							/**$browserType = $_SERVER['HTTP_USER_AGENT'];
//							if(strpos($browserType, 'Firefox') == true) {
//							    exit(); }
//							**/
//							}
//							if(isset($_SESSION["error_msg"])){
//								echo $_SESSION["error_msg"];
//								unset($_SESSION["error_msg"]);
//
//							}
//
//					?>
<!--				</div>-->
<!---->
<!--				<form data-toggle="validator" role="form" method="post" action="loginvalidate.php" class="form-horizontal">-->
<!--					<div class="form-group">-->
<!--						<label class="sr-only" for="username">Username</label>-->
<!--						<div class="input-group">-->
<!--							<div class="input-group-addon"><i class="fa fa-user fa-2x"></i></div>-->
<!--							<input type="text" name="username" id="inputName" class="form-control" placeholder="Username" -->
<!--							data-error=" Username is invalid" data-minlength="6"  required="required" maxlength="25" -->
<!--							value="--><?php //if(isset($_SESSION["loginValues"])){ echo $_SESSION["loginValues"]['username']; }?><!--">-->
<!--						</div>-->
<!--					</div><br/>-->
<!--						-->
<!--					<div class="form-group">-->
<!--						<label class="sr-only" for="password">Password</label>-->
<!--                        <div class="input-group">-->
<!--                            <div class="input-group-addon"><i class="fa fa-lock fa-2x"></i></div>-->
<!--							<input type="password" name="password" data-minlength="6" class="form-control" -->
<!--							id="inputPassword" data-error="Password is invalid"  placeholder="Password" required="required" -->
<!--							maxlength="25"  value="--><?php //if(isset($_SESSION["loginValues"])){ echo $_SESSION["loginValues"]['password']; }?><!--">-->
<!--						</div>-->
<!--					</div><br />-->
<!---->
<!--					<span class="col-md-6"><a href="forgetpassword.php">Forgot password?</a></span> -->
<!--					 -->
<!--					<button type="submit" name="submit" class="btn btn-primary col-md-3 col-md-offset-3">Login</button>-->
<!---->
<!--				</form>-->
<!---->
<!--			</div>-->
<!---->
<!--    	</div>-->


		<?php include 'includes/footer.php'; ?>

	</body>

</html>