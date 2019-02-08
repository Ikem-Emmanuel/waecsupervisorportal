<?php
require_once "connection.php";
require_once "miscfunction.php";

	if(!isset($_SESSION["officerId"])){ header("location:login.php"); }
	if($_SESSION["level"] !=1){ header("location:login.php"); }	
	
	if(isset($_SESSION["Officer_Id"])){ $Officer_Id = $_SESSION["Officer_Id"]; }
	 
	$con= new connection();
    $connection = $con->getConnection();
	$miscfunction = new MiscFunction($connection);
	$states =  $miscfunction->getStates();

	// intialize variables
	if(isset($_GET["id"])){
		$id = $_GET["id"];
		$row = $miscfunction->getDetails($id);
		$officeId=$row["OfficeId"];
		$full_name=$row["Fullname"];
		$gender	=$row["Gender"];
		$age=$row["Age"];
	    $qualifications=$row["QualificationId"];
		$grade=$row["GradeId"]; 
		$experience=$row["Experience"];
		$specialization=$row["Specialization"];
		$state = $row["state"];
		$currentSchool = $row["currentSchool"];
		$officeAddress=$row["OfficeAddress"]; 
		$lga=$row["LGA"]; 
		$email=$row["Email"];
		$homeAddress=$row["ResidentialAddress"];
		$vehicleNo=$row["VehicleNumber"]; 
		$phoneNo=$row["Phone"]; 
		$alternatePhone=$row["AlternatePhone"];
		$filePics=$row["Passport"];
		$RegistrationDate=$row["RegistrationDate"];    
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

		<div class="container creator">
			<form name="supervisor" id="supervisor" data-toggle="validator" role="form" method="post" action="validatesupervisor.php" enctype="multipart/form-data" class="form-horizontal">
			
			<div class="row">
				<fieldset class="fieldset"><legend> Personal Details</legend>
					<div class="col-md-6">
				
					<div class="form-group">
						<label class="col-md-4 control-label">Upload Passport</label>
						<div class="col-md-8">
							<input id="user_profile_pic" name="user_profile_pic" type="file" <?php if (!isset($id)) echo 'required="required" '?> data-error="Please upload a valid image" />
						</div>
						<p class="pic-info">(Only JPG, JPEG, GIF and PNG files allowed only. Not more than 1MB)</p>
						<div class="help-block with-errors create_error"></div>
					</div>

			
					<div class="form-group">
						<div class="input-field col-md-11 col-md-offset-1">
						 <i class="material-icons md-24 prefix">account_circle</i>
							<!-- Form field values are saved in an associative array, $_SESSION["inputFieldValues"], when the form is submitted.
								 Each index in the array contains user's input from each field which is echoed in thier respective positions if there is an error on the form
							-->
							<input type="text" name="fullName" id="fullname" class="form-control fullname" required="required" maxlength="50" data-error="Enter nominee's full name"
							value="<?php if(isset($_SESSION["inputFieldValues"]['fullname'])) { echo $_SESSION["inputFieldValues"]['fullname']; }
							elseif(isset($full_name)){ echo $full_name; } ?>" />

							<?php if(isset($_SESSION["nominee_err"])){ echo $_SESSION["nominee_err"]; unset($_SESSION["nominee_err"]); } ?>		
							<label for="fullname" class="control-label" >Nominee's fullname *</label> 
						</div>
						

						<div class="create_error">
							<?php if(isset($_SESSION["nominee_err"])){ echo $_SESSION["nominee_err"]; unset($_SESSION["nominee_err"]); } ?>
						</div>
						
						<div class="help-block with-errors create_error"></div>
					</div>

					<div class="form-group ">
						<div class="input-field col-md-11 col-md-offset-1">
							<i class="material-icons md-24 prefix">home</i>
							<input type="text" id="residence" name="homeAddress" maxlength="90" class="form-control"  data-error="please enter your Residential address" required="required"
							value="<?php if(isset($_SESSION["inputFieldValues"])){ echo $_SESSION["inputFieldValues"]['homeAddress']; }
								elseif(isset($homeAddress)){ echo $homeAddress; } ?>" >
							<label for="residence" class="control-label">Residential Address * </label>
						</div>

						<div class="create_error">
							<?php if(isset($_SESSION["homeAdd_err"])){ echo $_SESSION["homeAdd_err"]; unset($_SESSION["homeAdd_err"]); } ?>
						</div>

						<div class="help-block with-errors create_error"></div>
					</div>

					<div class="form-group ">
						 
						<div class="input-field col-md-11 col-md-offset-1">
							<i class="fa fa-envelope prefix"></i>
							<input type="email" id="inputEmail" data-error="Email address is invalid" name="email" class="form-control" maxlength="30"  value="<?php 
								 if(isset($_SESSION["inputFieldValues"])){ echo $_SESSION["inputFieldValues"]['email']; }
								elseif(isset($email)){ echo $email;  } ?>">
							<label for="inputEmail" class="control-label">Email Address </label>
						</div>

						<div class="create_error">
							<?php if(isset($_SESSION["email_err"])){ echo $_SESSION["email_err"]; unset($_SESSION["email_err"]); } ?>
						</div>

						<div class="help-block with-errors create_error"></div>
					</div>

					
					<div class="form-group ">
						<div class="input-field col-md-11 col-md-offset-1">
							<i class="material-icons md-24 prefix">phone</i>
							<input type="number" id="phoneNo" name="phoneNo" class="form-control" maxlength="11"  data-error="please enter a valid phone number" required="required" maxlength="12" 
							value="<?php if(isset($_SESSION["inputFieldValues"])){ echo $_SESSION["inputFieldValues"]['phoneNo']; }
									elseif(isset($phoneNo)){ echo $phoneNo; }  ?>" >
							<label for="phoneNo" class="control-label">Phone number * </label> 
						</div>

						<div class="create_error">
							<?php if(isset($_SESSION["phone_err"])){ echo $_SESSION["phone_err"]; unset($_SESSION["phone_err"]); } ?>
						</div>

						<div class="help-block with-errors create_error"></div>
					</div>

					
					

					<div class="form-group">
						<div class="col-md-11 col-md-offset-1">
							<i class="material-icons md-24 prefix">wc</i>
							<label class="control-label">Gender*</label>
							<select name="gender" required="required" class="form-control col-md-6" data-error="Select a Gender">
								<option value="" selected="selected">Make a Selection</option>
								<option value="Male" <?php if((isset($_SESSION["inputFieldValues"]['gender'])) && (($_SESSION["inputFieldValues"]['gender']) === "Male")){ echo "selected"; }
								elseif(isset($gender) && ($gender === "Male")) { echo "selected"; } ?>> Male </option>
								<option value="Female"<?php if((isset($_SESSION["inputFieldValues"]['gender'])) && (($_SESSION["inputFieldValues"]['gender']) === "Female")){ echo  "selected"; }
								elseif (isset($gender) && ($gender === "Female")) {echo " selected"; } ?>>Female</option>
							</select>
							
						</div>

						<div class="create_error">
							<?php if(isset($_SESSION["gender_err"])){ echo $_SESSION["gender_err"]; unset($_SESSION["gender_err"]); } ?>
						</div>
						<div class="help-block with-errors create_error"></div>
					</div>

				</div>

				<div class="col-md-5 col-md-offset-1">
			
					<div class="col-md-11 col-md-offset-1" id="imagePreview">
						<?php if(isset($filePics)){ ?>
						<div id="pix" class="nominee_photo"> <img src="uploads/<?php  echo $filePics; ?>" height="240" /> </div>
						<?php } ?>
					</div><br/><br/>

					<div class="form-group ">
						<div class="input-field col-md-11 col-md-offset-1">
							<i class="material-icons md-24 prefix">directions_car</i>
							<input type="text" name="vehicleNo" class="form-control"   maxlength="10" value="<?php 
								if(isset($_SESSION["inputFieldValues"])){ echo $_SESSION["inputFieldValues"]['vehicleNo']; } 
								elseif(isset($vehicleNo)){ echo $vehicleNo; } ?>">
							<label class="control-label">Vehicle Number </label> 
						</div>
					</div>

					<div class="form-group">
						<div class="input-field col-md-11 col-md-offset-1">
							<i class="material-icons prefix">phone</i>
							<input type="number" id="alternatePhone" pattern="[0-9]{11}" name="alternatePhone" data-error="please enter a valid phone number" class="form-control" maxlength="12" value="<?php if(isset($_SESSION["inputFieldValues"])){ echo $_SESSION["inputFieldValues"]['alternatePhone']; } 
								elseif (isset($alternatePhone)) { echo $alternatePhone; }  ?>" >
							<label for="alternatePhone" class="control-label"> Alternate Phone Number </label>
						</div>
						<div class="help-block with-errors create_error"></div>
					</div>

					<div class="form-group">
					<div class="col-md-11 col-md-offset-1">
						<i class="material-icons md-24 prefix">date_range</i>
						<label class="control-label">Age *</label> 
							<select name="age" required="required" class="form-control" data-error="Please make a selection">
								<option value="" selected="selected">Make a selection</option>
									<?php 
										for($count=18; $count<=60; $count++){ ?>
											<option value="<?php echo $count ?>"
												<?php if((isset($_SESSION["inputFieldValues"]['age'])) && (($_SESSION["inputFieldValues"]['age']) == $count)){echo "selected";}
												elseif(isset($age) && ($age == $count)) {echo "selected";}  ?>>
												<?php echo $count; ?>
											</option>
											<?php	 } ?>				
							</select>
					</div>
					<div class="create_error">
						<?php if(isset($_SESSION["age_err"])){ echo $_SESSION["age_err"]; unset($_SESSION["age_err"]); } ?>
					</div>
					<div class="help-block with-errors create_error"></div>
					</div>
				</div>
			</fieldset>
		</div><br/><br/><br/>


		<div class="row">
			<fieldset class="fieldset">
				<legend>Nominee's Educational Qualification</legend>
				<div class="col-md-6">
					<div class="form-group ">
						<div class="input-field col-md-11 col-md-offset-1">
							<i class="material-icons md-24 prefix">work</i>
							<input type="text" name="specialization" id="spec" class="form-control" data-error="Please enter your area of specialization" required="required"
							value="<?php if(isset($_SESSION["inputFieldValues"])){ echo $_SESSION["inputFieldValues"]['specialization']; }
							elseif(isset($specialization)){echo $specialization; } ?>" >
							<label for="spec" class="control-label">Area Of Specialization * </label>
						</div>
						 
						<div class="create_error">
							<?php if(isset($_SESSION["spec_err"])){ echo $_SESSION["spec_err"]; unset($_SESSION["spec_err"]); } ?>
						</div>
						<div class="help-block with-errors create_error"></div>
					</div><br/>

					<div class="form-group">
						<div class="col-md-11 col-md-offset-1">
						<i class="material-icons">format_line_spacing</i>
						<label class="control-label">Grade / Level *</label> 
							<select name="grade" required="required" class="form-control" data-error="Please make a selection">
								<option value="" selected="selected">Make a selection</option>
									<?php
										$grades = $miscfunction->getGrade();
										while($row = $grades->fetch_assoc()){
									?>						
										<option value="<?php echo $row["id"]; ?>"
									<?php if((isset($_SESSION["inputFieldValues"]['grade'])) && (($_SESSION["inputFieldValues"]['grade']) === $row["id"])){echo "selected";}
									elseif (isset($grade) && ($grade === $row["id"])) {echo " selected";} ?> >
										<?php  echo $row["Name"]; ?> </option>
									<?php } ?>					
							</select>
						</div>
						<div class="create_error">
							<?php if(isset($_SESSION["grade_err"])){ echo $_SESSION["grade_err"]; unset($_SESSION["grade_err"]); } ?>
						</div>
						<div class="help-block with-errors create_error"></div>
					</div>

				</div><br/>

				<div class="col-md-5 col-md-offset-1">
					<div class="form-group">
						<div class="col-md-11 col-md-offset-1">
						<i class="material-icons">assignment</i>
						<label class="control-label">Highest Qualification *</label> 
							<select name="qualification" required="required" class="form-control" data-error="Please make a selection">
								<option value="" selected="selected">Make a selection</option>					
									<?php 
										$qualification = $miscfunction->getQualification();							
											while($row = $qualification->fetch_assoc()){ ?>
												<option value="<?php echo $row["id"]; ?>" 
										<?php if((isset($_SESSION["inputFieldValues"]['qualification'])) && (($_SESSION["inputFieldValues"]['qualification']) == $row["id"])){echo "selected";}
										elseif (isset($qualifications) && ($qualifications == $row["id"])) {echo "selected"; } ?> >
										<?php echo $row["Name"]; ?> </option>
											<?php } ?>
							</select>
						</div>

						<div class="create_error">
							<?php if(isset($_SESSION["qual_err"])){ echo $_SESSION["qual_err"]; unset($_SESSION["qual_err"]); } ?>
						</div>
						<div class="help-block with-errors create_error"></div>
					</div>

					<div class="form-group">
						<div class="col-md-11 col-md-offset-1">
						<i class="material-icons">chrome_reader_mode</i>
						<label class="control-label">Supervision Experience *</label> 
							<select name="experience" required="required" class="form-control" data-error="Please make a selection">
								  <option value="" selected="selected">Make a selection</option>
								  <option value="0" <?php if((isset($_SESSION["inputFieldValues"]['experience'])) && (($_SESSION["inputFieldValues"]['experience']) == 0)){echo "selected";}
								  if (isset($experience) && ($experience == 0)) {echo " selected";}  ?>>None</option>
										<?php 
											for($i=1; $i<=10; $i++){ ?>
												<?php if($i===1){ ?>
													<option value="<?php echo $i ?>"
													<?php if((isset($_SESSION["inputFieldValues"]['experience'])) && (($_SESSION["inputFieldValues"]['experience']) == $i )){echo "selected";}
														elseif(isset($experience) && ($experience == $i)) {echo " selected";}  ?> >
														<?php echo $i." year"; ?>
													</option>
												<?php } 
												elseif($i <= 9) { ?>
													<option value="<?php echo $i ?>"
													<?php if((isset($_SESSION["inputFieldValues"]['experience'])) && (($_SESSION["inputFieldValues"]['experience']) == $i )){echo "selected";}
													elseif(isset ($experience) && ($experience == $i)) {echo " selected";}  ?>>
													 <?php echo $i." years"; ?>
													</option>
												<?php }
												else if($i > 9){ ?>
													<option value="<?php echo $i ?>"<?php if((isset($_SESSION["inputFieldValues"]['experience'])) && (($_SESSION["inputFieldValues"]['experience']) == $i )){echo "selected";}
													elseif(isset( $experience) && ($experience == $i)){ echo " selected"; } ?>>
													<?php echo $i."+ years"; ?>
													</option>
												<?php }
											} ?>			
							</select>
						</div>
						<div class="create_error">
							<?php if(isset($_SESSION["exp_err"])){ echo $_SESSION["exp_err"]; unset($_SESSION["exp_err"]); } ?>
						</div>
						<div class="help-block with-errors create_error"></div>
					</div>
				</div>
				</fieldset>
			</div>


			<div class="row">
				<fieldset class="fieldset">
					<legend>Work Details</legend>
					<div class="row col-md-12 work">
					<div class="form-group col-md-4">
						<i class="material-icons md-24 prefix">place</i>
						<label class="control-label">State </label>
						<select name="name_of_state" id="nameOfState" required="required" class="form-control" data-error="Please make a selection">
							<option value="" selected="selected">Select a state *</option>
							<?php 
								while ($row = $states->fetch_assoc()) { ?>
									<option value="<?php echo $row['state']; ?>" <?php if((isset($_SESSION["inputFieldValues"]['state'])) && (($_SESSION["inputFieldValues"]['state']) == $row['state'])){echo "selected";}
									elseif(isset($state) && $state==$row['state']) {echo "selected";} ?> > <?php echo $row["state"]; ?>
									</option>
							<?php } ?>
						</select>
						<div class="create_error">
							<?php if(isset($_SESSION["name_of_state_err"])) { echo $_SESSION["name_of_state_err"]; unset($_SESSION["name_of_state_err"]); } ?>
						</div>
						<div class="help-block with-errors create_error"></div>
					</div>


					<div class="form-group col-md-4">
						<i class="material-icons md-24 prefix">place</i>
						<label class="control-label">L.G.A * </label> 
							<select name="lga" class="form-control" id="lga" data-error="please enter your local government area" required="required">
								<option value="" selected="selected"> select your local government *</option>
								<?php if(isset($_SESSION["inputFieldValues"]['lga'])){ ?>
									<option value="<?php echo $_SESSION['inputFieldValues']['lga'];?>" selected="selected"> <?php echo $_SESSION['inputFieldValues']['lga'];?> </option>
								<?php }elseif(isset($lga)){ ?>
									<option value="<?php echo $lga; ?>" selected="selected"> <?php echo $lga;?> </option>
							<?php	} ?>
							</select>
						<div class="create_error">
							<?php if(isset($_SESSION["lga_err"])){ echo $_SESSION["lga_err"]; unset($_SESSION["lga_err"]); } ?>
						</div>		

						<div class="help-block with-errors create_error"></div>
					</div>
					
					<div class="form-group col-md-4">
						<i class="material-icons md-24 prefix">school</i><label class="control-label"> Name of School *</label>
						<select name="name_of_school" required="required" class="form-control" id="nameOfSchool" data-error="Please make a selection">
							<option value="">select a school *</option>
							<?php if(isset($_SESSION["inputFieldValues"]['schoolName'])){ ?>
									<option value="<?php echo $_SESSION['inputFieldValues']['schoolName'];?>" selected="selected"> <?php echo $_SESSION['inputFieldValues']['schoolName'];?> </option>
								<?php }
									elseif(isset($currentSchool)) { ?>
										<option value="<?php echo $currentSchool; ?>" selected="selected"> <?php echo $currentSchool;?> </option>
								<?php } ?>
						</select>
						<div class="create_error">
							<?php if(isset($_SESSION["name_of_school_err"])) { echo $_SESSION["name_of_school_err"]; unset($_SESSION["name_of_school_err"]); } ?>
						</div>
						<div class="help-block with-errors create_error"></div>
					</div>
					</div><br>
			
					<div class="row form-group col-md-6">
						<div class="input-field ">
							<i class="material-icons prefix">account_balance</i>
							<input type="text" id="schoolAdd" name="officeAddress" required="required" class="form-control" maxlength="80" 
							value="<?php if(isset($_SESSION["inputFieldValues"])){ echo $_SESSION["inputFieldValues"]['officeAddress']; }
									elseif (isset($officeAddress)){ echo $officeAddress; } ?>"/>
							<label for="schoolAdd" class="control-label">School Address *</label>
						</div>
						<div class="create_error">
							<?php if(isset($_SESSION["office_add_err"])) { echo $_SESSION["office_add_err"]; unset($_SESSION["office_add_err"]); } ?>
						</div>
						<div class="help-block with-errors create_error"></div>
					</div>
					<br/>
				</fieldset>
			</div>

			<div class="form-group">		
				<div class="col-md-8 col-md-offset-4">
					<button type="submit" name="submit" class="btn btn-primary" id="submit">
						<?php if (isset($id)) {echo "Update Supervisor Record"; } else {echo "Create Supervisor";}?>
					</button>

					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

					<button type="reset" name="clear" class="btn btn-danger">
						Reset Form
					</button>
				</div>
			</div>

			
					<?php if (isset($id)){ ?> 
					<input type = "hidden" name="issent" value="<?php if (isset($id)) echo $id ?>" />
					<?php } ?> 
					<?php if (isset($filePics)){ ?> 
					<input type = "hidden" name="file_Pics" value="<?php if (isset($filePics)) echo $filePics ?>" />
					<?php } ?>
					<?php if (isset($Officer_Id)){ //OfficerId of a logged in officer; used to identify which officer registers a supervisor ?> 
						<input type = "hidden" name="loggedin_Officer" value="<?php if (isset($Officer_Id)) echo $Officer_Id ?>" />
					<?php } ?>		
					<?php if(isset($_SESSION["inputFieldValues"])) unset($_SESSION["inputFieldValues"]); ?>
	</form>			
				</div>

		
		
			<!-- <script type="text/javascript" src="js/quoterotator.js"></script>
			<script type="text/javascript" src="js/jquery.form.min.js"></script> -->

			<?php include 'includes/footer.php'; ?>

			<script language="JavaScript" src="js/validateme.js" type="text/javascript"> </script>
			<script language="JavaScript" type="text/javascript" xml:space="preserve"></script>
			<script>
				$("document").ready(function(){
					
				$("#user_profile_pic").change(function() {
					
							$("#pix").hide();
				});
				
				$("#user_profile_pic").change(function() {
					var val = $(this).val();
				   
					switch(val.substring(val.lastIndexOf('.') + 1).toLowerCase()){
					
						case 'gif': case 'jpg': case 'png':
						  
							//alert("an image");
							$(":submit").attr("disabled", false)
							break;
						default:
							$(this).val('');
							// error message here
							
							alert("not an image");
							//$("#submit").hide();
							$(":submit").attr("disabled", true)
							 
							break;
						}
					});
					
				
					
				 $("#user_profile_pic").on("change", function()
				{
					 var files = !!this.files ? this.files : [];
					if (!files.length || !window.FileReader) {
						$(":submit").attr("disabled", true);
						return; // no file selected, or no FileReader support
					}
					if (/^image/.test( files[0].type)){ // only image file
						if (!checkFileSize(this)) {
							alert("Maximum file size of 1MB exceeded"); 
							$(this).val('');
							$(":submit").attr("disabled", true);
							return;
							
						}
						if (!checkFileExtension(this)){ //validate file extension
							alert("only jpeg, gif and png allowed allowed"); 
							$(this).val('');
							$(":submit").attr("disabled", true);
							return;
						}
						var reader = new FileReader(); // instance of the FileReader
						reader.readAsDataURL(files[0]); // read the local file
			 
						reader.onloadend = function(){ // set image data as background of div
							$("#imagePreview").html("");
							$("#imagePreview").css("background-image", "url("+this.result+")");
							//$("#imagePreview").css("border", "2px solid red");
						   
							}
							$(":submit").attr("disabled", false);
						} 
						
						
						//alert("ok");
					}); 
				
			});
				function checkFileExtension($fileReference) {
					var files = !!$fileReference.files ? $fileReference.files : [];
					
					if (!( /^image\/jpeg/.test( files[0].type) || /^image\/png/.test( files[0].type) || /^image\/gif/.test( files[0].type))){
						
						return false;
					}else{
						return true;
					}
				}
				
				function checkFileSize($fileReference) {
					//var imageFiles = document.getElementById("user_profile_pic");
					
					var photo = $fileReference.files[0];
					//alert(photo.size);
					if (photo.size > 1024*1024){
						return false;
					}else{
						return true;
					}
				}
				</script>
  	
  	</body>

</html>  