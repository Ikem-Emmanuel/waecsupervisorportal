<?php
require_once "miscfunction.php";
require_once "connection.php";
if(!isset($_SESSION["officerId"])){ header("location:login.php"); }
if($_SESSION["level"] ==1){ header("location:login.php"); }

$officerLevel = $_SESSION["level"];
$con = new connection();
$connection = $con->getConnection();
$miscfunction = new MiscFunction($connection);

if (isset($_GET["id"])) {
    $id= $_GET["id"];

    $row = $miscfunction->getofficerDetails($id);

    $office_Id= $row["OfficeId"];
    $fullname= $row["Fullname"];
    $username= $row["Username"];
    $phone=    $row["Phone"];
    $email=    $row["Email"];

    $firstname="";
    $lastname="";
    list($firstname,$lastname)= explode(".", $username);
}

if($officerLevel == 3){
    $offices = $miscfunction->getAllOffices();
}else{
    $offices = $miscfunction->getOffices();
}
?>

<!DOCTYPE html>
<html>

	<head>
		
		<?php include 'includes/header.php'; ?>
		
	</head>

   	<body>
  
   		<?php include 'includes/top_header_admin.php'; ?>

		<div class="container">
            <div class="page-body">
                <div class="row">
                    <div class="creator col-lg-8 col-md-8 mx-auto">
                        <div class="row text-center mx-auto mb-3 text-danger align-self-center"><b>
                                <?php
                                if(isset($_SESSION["username_exists"])){ echo $_SESSION["username_exists"];
                                    unset($_SESSION["username_exists"]);
                                    echo "<br/>";
                                    /**$browserType = $_SERVER['HTTP_USER_AGENT'];
                                    if(strpos($browserType, 'Firefox') === true) {
                                    exit(); }**/
                                }
                                if(isset($_SESSION["email_exist"])){
                                    echo $_SESSION["email_exist"];
                                    unset($_SESSION["email_exist"]);
                                }
                                ?> </b>
                        </div>
                        <div class="card b-shadow mb-5">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-white-20">Basic Card Example</h6>
                            </div>
                            <div class="card-body">
                                <form data-toggle="validator" role="form" method="post" action="validateofficer.php">
                                    <div class="form-group col-md-12">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4">First Name *</label>
                                                <input type="text" name="fName" class="form-control capitalize" data-error="Enter Officer's first name" required="required" maxlength="20"
                                                       value="<?php if(isset($_SESSION["inputFieldValues"]['firstName'])){ echo $_SESSION["inputFieldValues"]['firstName']; }
                                                       elseif (isset($fullname)) { echo $firstname; } ?>"  />
                                                <div class="create_error">
                                                    <?php if(isset($_SESSION["fnameError"])){ echo $_SESSION["fnameError"]; unset($_SESSION["fnameError"]); } ?>
                                                </div>
                                                <div class="help-block with-errors create_error text-danger"></div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputPassword4">Last Name*</label>
                                                <input type="text" name="lName" class="form-control capitalize" data-error="Enter Officer's last name" required="required" maxlength="20"
                                                       value="<?php if(isset($_SESSION["inputFieldValues"]['lastname'])){ echo $_SESSION["inputFieldValues"]['lastname']; }
                                                       elseif (isset($fullname)) { echo $lastname;  } ?>" />
                                                <div class="create_error">
                                                    <?php if(isset($_SESSION["lnameError"])){ echo $_SESSION["lnameError"]; unset($_SESSION["lnameError"]); } ?>
                                                </div>

                                                <div class="help-block with-errors create_error text-danger"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="selectState">Select Office</label>
                                        <select name="officeId" required="required" data-error="please select one option" class="form-control">
                                            <option value="" selected="selected">Make a selection</option>
                                            <?php while($row = $offices->fetch_assoc()){ ?>
                                                <option value="<?php echo $row["OfficeId"]; ?>" <?php
                                                if((isset($_SESSION["inputFieldValues"]['officeId'])) && (($_SESSION["inputFieldValues"]['officeId']) === $row["OfficeId"])){echo "selected";}
                                                elseif(isset($office_Id) && ($office_Id === $row["OfficeId"])) {echo "selected";}   ?>>
                                                    <?php  echo $row["Name"];?>
                                                </option>
                                            <?php	} ?>
                                        </select>
                                        <div class="create_error">
                                            <?php if(isset($_SESSION["idError"])){ echo $_SESSION["idError"]; unset($_SESSION["idError"]); } ?>
                                        </div>

                                        <div class="help-block with-errors create_error text-danger"></div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4">Email <sup>*</sup> </label>
                                                <input type="email" name="email" class="form-control" required="required" data-error="Enter a valid email" required="required"
                                                       value="<?php
                                                       if(isset($_SESSION["inputFieldValues"]['email'])){ echo $_SESSION["inputFieldValues"]['email']; }
                                                       elseif(isset($email)) { echo $email;  }  ?>"  />
                                                <div class="create_error">
                                                    <?php if(isset($_SESSION["mailError"])){ echo $_SESSION["mailError"]; unset($_SESSION["mailError"]); }
                                                    ?>
                                                </div>
                                                <div class="help-block with-errors create_error text-danger"></div>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="inputPassword4">Phone <sup>*</sup></label>
                                                <input type="number" name="phone" pattern="[0-9]{11}" title="enter a valid phone number!" data-error="Enter a valid phone number"  class="form-control"
                                                       value="<?php if(isset($_SESSION["inputFieldValues"])){ echo $_SESSION["inputFieldValues"]['phone']; }
                                                       elseif(isset($phone)) { echo $phone;  } ?>" required="required" />
                                                <div class="create_error">
                                                    <?php if(isset($_SESSION["phoneError"])){ echo $_SESSION["phoneError"]; unset($_SESSION["phoneError"]); } ?>
                                                </div>
                                                <div class="help-block with-errors create_error text-danger"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if (isset($id)){ ?>
                                        <input type = "hidden" name="issent" value="<?php if (isset($id)) echo $id ?>" />
                                    <?php } ?>
                                    <?php if(isset($_SESSION["inputFieldValues"])) unset($_SESSION["inputFieldValues"]); ?>
                                    <div class="col-md-12">
                                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		</div>
		<?php include 'includes/footer.php'; ?>
  	</body>

</html>  