<?php 
 session_start();
 
 class MiscFunction{
 	private $connection;
		
	public function __construct($connection)
	{
		$this->connection = $connection;
	} 
	
	/**
		 * downloads all registered supervisor in a particular office
		 * @param $id, officeId of the office
		 **/
		 public function download($id){
			$query = "select Name from office where OfficeId= $id";
			$result = $this->connection->query($query) or die(mysqli_error($this->connection));
			$officename = "";
			//get officename corresponding to officeId
			while($row= $result->fetch_assoc()){
			$officename = $row["Name"]; }
			
			//csv file would be saved as downloadFilename
			$downloadFilename = "SUPERVISORS_".$officename.".csv";
			
			// output headers so that the file is downloaded rather than displayed
			header('Content-Type: text/csv; charset=utf-8');
			header("Cache-Control: no-store, no-cache");
			header("Content-Disposition: attachment; filename=\"".$downloadFilename."\"");
			
			// create a file pointer connected to the output stream
			$output = fopen('php://output', 'w');
			
			//$output = fopen('ikejasupervisorlist.csv', 'w');
			
			// output the column headings
			fputcsv($output, array('LIST OF REGISTERED SUPERVISORS IN '.$officename));
			fputcsv($output, array('Full Name', 'Gender', 'Age','Qualification', 'Specialization','Grade','Experience (In Years)','Registration Office','School currently teaching','Centre Code of School','Address of School','Lga of School','State','Residential Address','Vehicle Number','Email','Phone','Alternate Phone'));

			// fetch the data
			$newQuery = "SELECT s.Fullname,s.Gender,s.Age,q.Name as Qualification,s.Specialization,g.Name as Grade,s.Experience,o.Name as Office,s.currentSchool,c.code,s.OfficeAddress, s.LGA,s.state,s.ResidentialAddress,s.VehicleNumber,s.Email,s.Phone,s.ALternatePhone
			FROM supervisor s
			JOIN office o
			ON s.`OfficeId`= o.`OfficeId`
			JOIN qualification q
			ON s.`QualificationId` = q.`id`
			JOIN grade g
			ON s.GradeId=g.id
           		LEFT JOIN centres c
            		ON s.currentSchool = c.nameOfSchool
            		where  o.`Name`='$officename'";
			$sqlResult =  $this->connection->query($newQuery) or die(mysqli_error($this->connection));
			
			// loops over the rows, outputting them
			while ($row2 = $sqlResult->fetch_assoc()) 
			fputcsv($output, $row2);
			
			fclose($output);
		} 
		
		
		/**
		 * downloads list of all registered officers
		 **/
		 public function downloadAllOfficers(){
		 	//csv file would be saved as downloadFilename
			$downloadFilename = "RegisteredOfficers.csv";
			
			// output headers so that the file is downloaded rather than displayed
			header('Content-Type: text/csv; charset=utf-8');
			header("Cache-Control: no-store, no-cache");
			header("Content-Disposition: attachment; filename=\"".$downloadFilename."\"");
			
			// create a file pointer connected to the output stream
			$output = fopen('php://output', 'w');

			// output the column headings
			fputcsv($output, array('LIST OF ALL APPROVED REGISTRATION OFFICERS'));
			fputcsv($output, array('Full Name', 'Phone Number', 'Username', 'Email','Designated Office'));

			// fetch the data
			$newQuery = "SELECT of.Fullname, of.Phone, of.Username, of.Email, f.Name
					from officer of
					join
					office f
					ON
					of.OfficeId = f.OfficeId
					where of.Username != 'waec.boto'";
			$sqlResult =  $this->connection->query($newQuery) or die(mysqli_error($this->connection));

			// loops over the rows, outputting them
			while($row2 = $sqlResult->fetch_assoc())
			fputcsv($output, $row2);
		}
		
		
		/** 
		 * Validates all inputs from the register supervisor form
		 * @return boolean $error_exist
		 **/
		public function validateField($fullname,$gender,$age,$qualification,$specialization,$grade,$experience,$officeAddress,$officeId,$schoolName,$state,$lga,$homeAddress,$vehicleNo,$email,$alternatePhone,$phoneNo,$filename){
			$error_exist = false;
			
			$fullname =filter_var($fullname,FILTER_SANITIZE_STRING);
			$gender =filter_var($gender,FILTER_SANITIZE_STRING);
			$age = filter_var($age,FILTER_SANITIZE_NUMBER_INT);
			$qualification = filter_var($qualification,FILTER_SANITIZE_NUMBER_INT);
			$specialization = filter_var($specialization,FILTER_SANITIZE_STRING);
			$grade = filter_var($grade,FILTER_SANITIZE_NUMBER_INT);
			$experience = filter_var( $experience,FILTER_SANITIZE_NUMBER_INT);
			$officeAddress = filter_var( $officeAddress,FILTER_SANITIZE_STRING);
			$officeId = filter_var($officeId,FILTER_SANITIZE_STRING);
			$lga = filter_var( $lga,FILTER_SANITIZE_STRING);
			$homeAddress = filter_var($homeAddress,FILTER_SANITIZE_STRING);
			$vehicleNo = filter_var($vehicleNo,FILTER_SANITIZE_STRING);
			$email = filter_var($email, FILTER_SANITIZE_EMAIL);
			$phoneNo = filter_var($phoneNo,FILTER_SANITIZE_NUMBER_INT);
			$alternatePhone = filter_var($alternatePhone,FILTER_SANITIZE_NUMBER_INT);
			$filename = filter_var($filename,FILTER_SANITIZE_STRING);
			
				if (self::validateStringNotEmpty($fullname)===false){
					$_SESSION["nominee_err"]="please enter nominee's fullname" ;
					$error_exist = true;
				}
				if (self::validateStringNotEmpty($specialization)===false) {
					$_SESSION["spec_err"] ="Please enter your area of Specialization" ;
					$error_exist = true;
				}
				if (self::validateStringNotEmpty($officeAddress)===false) {
					$_SESSION["office_add_err"] ="Please enter your school address" ;
					$error_exist = true;
				}
				if (self::validateStringNotEmpty($officeId)===false) {
					$_SESSION["offId_err"]="please enter your office Id" ;
					$error_exist = true;
				}
				if (self::validateStringNotEmpty($lga)===false) {
					$_SESSION["lga_err"] ="please enter your local government area" ;
					$error_exist = true;
				}
				if (self::validateStringNotEmpty($state)===false) {
					$_SESSION["name_of_state_err"] ="please select a state" ;
					$error_exist = true;
				}
				if (self::validateStringNotEmpty($schoolName)===false) {
					$_SESSION["name_of_school_err"] ="please select a school" ;
					$error_exist = true;
				}
				if (self::validateStringNotEmpty($phoneNo)===false) {
					$_SESSION["phone_err"] ="please enter your phone number" ;
					$error_exist = true;
				}
				
				if (self::validateStringNotEmpty($gender)===false) {
					$_SESSION["gender_err"] ="Gender: please select one option" ;
					$error_exist = true;
				}
				if (self::validateStringNotEmpty($age)===false) {
					$_SESSION["age_err"] ="Age: please select one option" ;
					$error_exist = true;
				}
				if (self::validateStringNotEmpty($qualification)===false) {
					$_SESSION["qual_err"] ="Qualification: please select one option" ;
					$error_exist = true;
				}
				if (self::validateStringNotEmpty($homeAddress)===false) {
					$_SESSION["homeAdd_err"] ="Please enter your Residential Address" ;
					$error_exist = true;
				}
				if (self::validateStringNotEmpty($grade)===false) {
					$_SESSION["grade_err"]="Grade: please select one option" ;
					$error_exist = true;
				}
				if (self::validateStringNotEmpty($experience)===false) {
					$_SESSION["exp_err"] ="Supervision: please select one option" ;
					$error_exist = true;
				}
				
				
				
				//email field is an optional field
				//checks if user enters any email before validating
				
				if(self::validateStringNotEmpty($email)=== true){
					if (!filter_var($email, FILTER_VALIDATE_EMAIL) === true) {
						$_SESSION["email_err"] ="please enter a valid email" ;
						$error_exist = true;
					}
				}
								
				return $error_exist;
		} 
		
		/**
		 * validateStringNotEmpty function checks whether a string is null or not
		 * @param $str, string to be checked
		 * @return boolean
		 */
		public function validateStringNotEmpty($str){
			if (trim($str) == "")return false;
			return true;
		}
		
		/**
		 * Gets the office name corresponding to a particular officeId
		 * @param $officeId
		 * @return array $result
		 */
		public function searchOffice($officeId){
			$query= "select Name from office where OfficeId=$officeId";
			$result =$this->connection->query($query);
			return $result;
		}
		
		/**
		 * Validates all inputs from the register Officer form
		 * @param $firstname
		 * @param $lastname
		 * @param $officeId
		 * @param $email
		 * @param $phone
		 * @param $username
		 * @param $userEmail
		 * @param $db_username
		 * @param $id
		 * @return boolean $InputError
		 */
		public function validateInput($firstname,$lastname,$officeId,$email,$phone,$username,$userEmail="",$db_username="",$id=""){
			$InputError = true;
			$error="";
			
			if(self::validateStringNotEmpty($firstname)===false){
				$_SESSION["fnameError"] ="please enter your first name" ;
				$InputError = false;
			}
			elseif(preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/',$firstname)){
				$_SESSION["fnameError"] ="firstname field contains special characers";
				$InputError = false;
			}
			
			if(self::validateStringNotEmpty($lastname)===false) {
					$_SESSION["lnameError"] ="please enter your last name" ;
					$InputError = false;
			}
			elseif (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/',$lastname)){
				$_SESSION["lnameError"] ="lastname field contains special characers";
				$InputError = false;
			}
			
			if(self::validateStringNotEmpty($officeId)===false) {
					$_SESSION["idError"] ="please select an office " ;
					$InputError = false;
			}
			
			if(self::validateStringNotEmpty($phone)===false){
				$_SESSION["phoneError"] ="Enter your phone number" ;
				$InputError = false;
			}
			elseif (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/',$phone)){
				$_SESSION["phoneError"] ="phone number field contains special characers";
				$InputError = false;
			}
			
			if(!filter_var($email, FILTER_VALIDATE_EMAIL) === true){
				$error .= "please enter a valid email<br/>" ;
			}
			if(preg_match('/[\'^£$%&*()}{#~?><>,|=+¬]/',$email)){
				$error .= "email field contains special characers";
			}
			if($error != ""){
				$_SESSION["mailError"] = $error;
				$InputError = false;
			}
			
			//check if email and username already exists in the database
			/*if($userEmail != ""){
				if($email !== $userEmail){ //ensures that the email the user enters is different from the old email in the database
					$sql = "select Email from officer where Id <> $id" ;
					$sqlresult = $this->connection->query($sql) or die(mysqli_error($this->connection));
					
					while($row = $sqlresult->fetch_assoc()){
						if($email === $row["Email"] ){
							$_SESSION["email_exist"]= "Email already exists for an officer";
							$InputError = false;
						}
					}
				}
			}
			else{ //search if email already exists for a new officer
				$sql_stmt = "select Email from officer where Email= '$email' " ;
				$sql_result = $this->connection->query($sql_stmt) or die(mysqli_error($this->connection));
				
				if(mysqli_num_rows($sql_result) == 1){
					$_SESSION["email_exist"]= "Email already exists for an officer";
					$InputError = false;
				}
			} */
			
			
			if($db_username != ""){
				if($username !== $db_username){ //ensures that the username is different from the old email in the database
					$query1 = "select Username from officer where Id <> $id" ;
					$result1 = $this->connection->query($query1) or die(mysqli_error($this->connection));
					while($row2 = $result1->fetch_assoc()){
						if($username === $row2["Username"] ){
							$_SESSION["username_exists"] = "Username already exists for an officer";
							$InputError = false;
						}
					}
				}
			}
			else{ //search if username already exists for a new officer
				$query2 = "select Username from officer where Username = '$username' " ;
				$result2 = $this->connection->query($query2) or die(mysqli_error($this->connection));
				
				if(mysqli_num_rows($result2) == 1){
					$_SESSION["username_exists"]= "Username already exists for an officer";
					$InputError = false;
				}
			}
									
			
			$firstname =filter_var($firstname,FILTER_SANITIZE_STRING);
			$lastname =filter_var($lastname,FILTER_SANITIZE_STRING);
			$phone =filter_var($phone,FILTER_SANITIZE_NUMBER_INT);
			$email = filter_var($email, FILTER_SANITIZE_EMAIL);
			
			return $InputError;
		}
		
		/**
		 * Checks through supervisor table for a particular Id
		 * 
		 * @param string $id - variable denoting User Id
		 * @return array $resultSet
		 */
		public function getDetails($id){
			$query= "select * from supervisor where id=$id";
			$result =$this->connection->query($query)or die(mysqli_error($connection));
			$resultSet = $result->fetch_assoc();
			return $resultSet;
		} 
		
		public function viewFullOfficerList ($start_from,$num_rec_per_page){
			$connection = $this->connection;
			$query="SELECT * FROM officer where Level !=3 LIMIT $start_from, $num_rec_per_page"; 
			 $result = $connection->query($query) or die(mysqli_error($this->connection));
			 return $result;
		}
		
		public function viewStateOfficers ($start_from,$num_rec_per_page){
			$connection = $this->connection;
			$query="SELECT * FROM officer where Level = 1 LIMIT $start_from, $num_rec_per_page"; 
			 $result = $connection->query($query) or die(mysqli_error($this->connection));
			 return $result;
		}
		
		public function getOfficerDetail($id){
			$query= "select * from officer where id=$id";
			$result =$this->connection->query($query);
			return $result;
		}
	
		public function viewOfficers(){
			$connection = $this->connection;
			$query="SELECT * FROM officer"; 
			$result = $connection->query($query) or die(mysqli_error($this->connection));
			return $result;	
		}
		
		public function viewOfficersList(){
			$connection = $this->connection;
			$query="SELECT COUNT(*) as total FROM officer WHERE Level=1";
			$result = $connection->query($query) or die(mysqli_error($this->connection));
			return $result->fetch_assoc();	
		}
		
		public function viewOfficersList2(){
			$connection = $this->connection;
			$query="SELECT COUNT(*) as total FROM officer WHERE Level != 3";
			$result = $connection->query($query) or die(mysqli_error($this->connection));
			return $result->fetch_assoc();	
		}
		
		/**
		 * function sendMail; sends username and password to the specified email
		 * 
		 */
		 public function sendMail($recipient,$username,$password){
			$to = $recipient;//officer's email
			$subject = "WAEC : Login details";
			$content= "Dear Officer \n,
						You have been successfully registered. \n
						To access your profile, please use the log-in details provided below: \n 
						username : ".$username." \n 
						Password : ".$password;
			$headers = "From:waecsupervisor.org\r\n";//sender's address

			if(mail($to,$subject,$content,$headers)){
				return true;				
			}
			else{
				return false;				
			}
		}
		
		/**
		 * function supervisorPerOffice returns the total number of registered supervisors, active supervisors and inactive supervisors in each office
		 * @param string $id
		 * @return array
		 **/
       	public function supervisorPerOffice($id){
			$query_one = "select * from supervisor where OfficeId = '$id'";
			$result_one = $this->connection->query($query_one) or die(mysqli_error($connection));
			$totalSupervisor = mysqli_num_rows($result_one);//total number of registered supervisor
			
			$query_two = "select * from supervisor where OfficeId = '$id' and status=1 ";
			$result_two = $this->connection->query($query_two) or die(mysqli_error($connection));
			$totalActive = mysqli_num_rows($result_two);//total number of active supervisor
			
			$query_three = "select * from supervisor where OfficeId = '$id' and status=0 ";
			$result_three = $this->connection->query($query_three) or die(mysqli_error($connection));
			$totalInactive = mysqli_num_rows($result_three);// total number of inactive supervisors
			
			$details_arr = array($totalSupervisor, $totalActive, $totalInactive);//save each result in an array
			
			return $details_arr;
		} 
		
		
		/**
		 * getOffices function checks and returns a list of offices and corresponding id, location et al
		 *
		 * @return string $result, result of query
		 */
		public function getOffices(){
			$query = "select * from office WHERE OfficeId !='254'";
			$result = $this->connection->query($query) or die(mysqli_error($connection));
			return $result;
		} 
		
		/**
		 * getOfficeName function checks and returns a list of offices and corresponding id, location, ...
		 *
		 * @return array $result, result of query
		 */
		public function getOfficeName($officeId){
			$query = "select Name from office where OfficeId = $officeId";
			$result = $this->connection->query($query) or die(mysqli_error($connection));
			return $result;			
		}
		
		public function getAllOffices(){
			$query = "select * from office";
			$result = $this->connection->query($query) or die(mysqli_error($connection));
			return $result;
		}
		
		/**
		 * Checks through supervisor table 
		 * @param string $search - variable denoting search  parameter 
		 * @return string $result- result of search query
		 */
		public function search($search, $officeId){
			$connection = $this->connection;
			$query= "select * from supervisor where OfficeId='$officeId' AND Fullname LIKE '%$search%' or SupervisorId LIKE '%$search%'";
			$result=$connection->query($query) or die(mysqli_error($connection));
				
			return $result;
		}
		
		/**
		 * Checks through supervisor table 
		 * @param string $officeId - variable denoting Officer's OfficeId
		 * @retun string $result- result of select query
		 */

		public function viewActiveSupervisor($officeId){
			 $connection = $this->connection;

			 $query= "select * from supervisor where status=1 and OfficeId='$officeId'";
			 $result = $connection->query($query) or die(mysqli_error($this->connection));
			 return $result;
	   }
	   
	   
		/**
		 * Checks through supervisor table 
		 * @param string $officeId - variable denoting Officer's OfficeId
		 * @retun string $result- result of select query
		 */
		public function viewInactiveSupervisor($officeId){
			 $connection = $this->connection;
			 $query= "select * from supervisor where status=0 and OfficeId='$officeId'";
			 $result = $connection->query($query) or die(mysqli_error($this->connection));
			 return $result;
		}
		
		
		/**
		 * Checks through supervisor table where the status is 0
		 * @param $start_from
		 * @param $num_rec_per_page
		 * @param string $officeId - variable denoting Officer's OfficeId
		 * @retun array $result- result of select query
		 */	   
		public function viewInactivePaginator($start_from,$num_rec_per_page,$officeId){
			 $connection = $this->connection;

			 $query= "select * from supervisor where status=0 and OfficeId='$officeId' LIMIT $start_from, $num_rec_per_page";
			 $result = $connection->query($query) or die(mysqli_error($this->connection));
			 return $result;
		}
	   
	   
		/**
		 * Checks through supervisor table where the status is 1
		 * @param $start_from
		 * @param $num_rec_per_page
		 * @param string $officeId - variable denoting Officer's OfficeId
		 * @retun array $result- result of select query
		 */   
		public function viewActivePaginator($start_from,$num_rec_per_page,$officeId){
			 $connection = $this->connection;

			 $query= "select * from supervisor where status=1 and OfficeId='$officeId' LIMIT $start_from, $num_rec_per_page";
			 $result = $connection->query($query) or die(mysqli_error($this->connection));
			 return $result;
		}
		
		/**
		 * Checks through supervisor table and returns 20 results
		 * @param $start_from
		 * @param $num_rec_per_page
		 * @param string $officeId - variable denoting Officer's OfficeId
		 * @retun array $result- result of select query
		 */
		public function viewFullList($start_from,$num_rec_per_page,$officeId){
			 $connection = $this->connection;
			 $query= "select * FROM supervisor where OfficeId='$officeId' LIMIT $start_from, $num_rec_per_page"; 
			 $result = $connection->query($query) or die(mysqli_error($this->connection));
			 return $result;
		}

	   
	   
		/** Checks through supervisor table 
		 * @param string $officeId - variable denoting Officer's OfficeId
		 * @retun array $result- result of select query
		 */
		public function viewSupervisor($officeId){
			 $connection = $this->connection;

			 $query= "select * from supervisor where $officeId=OfficeId ";
			 $result = $connection->query($query) or die(mysqli_error($this->connection));
			 return $result;
		}
		
		
		/**
		 * Generates Random passwords
		 * @param string $length - variable denoting preferred length of password
		 * @return string $randompass- randomly generated password
		 */
		 public static function getPassword($length) {
			$possible = 'abcdefghijklmnopqrstuvwxyz' . 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
			$randompass =""; 
			while(strlen($randompass) < $length) { 
					$randompass .= substr($possible, mt_rand(0, strlen($possible) -1), 1); 
			}
			return($randompass);
		}
		
		/**
		 * Checks through qualification table 
		 *
		 * @retun array $sqlresult- result of select query
		 */     
		public function getQualification(){
			$sqlstmt = "select * from qualification order by Name ASC";
			$sqlresult = $this->connection->query($sqlstmt) or die(mysqli_error($this->connection));
			return $sqlresult;
		} 
		
		
		/**
		 * Checks through grade table 
		 * @retun array $result- result of select query
		 */
		public function getGrade(){
			$query = "select * from grade";
			$result = $this->connection->query($query) or die(mysqli_error($this->connection));
			return $result;
		}
		
		/**
		 * Checks through Officer table 
		 * @retun array $result- result of select query
		 */
		public function getOfficers(){
			$query= "select * from officer";	
			$result=$this->connection->query($query) or die (mysqli_error($this->connection));
			return $result;		
		}
		
		
		/**
		 * Checks through grade table 
		 * @retun array $result- result of select query
		 */
		public function getOfficer($username,$password){
			$password= sha1($password);
			$query= "select * from officer where Username='$username' and  Password='$password'";	
			$result=$this->connection->query($query) or die (mysqli_error($this->connection));
			return $result;		
		}
		
		/**
		 * Validates input from Login form
		 * @param string $username - variable denoting Officer's Username
		 * @param string $password- variable denoting Officer's Username
		 * @return boolean 
		 */
		public function validateLogin($username, $password){			
			$error="";
			if((self::validateStringNotEmpty($username))===false){
				$error.="Username cannot be empty<br/>";
			}
			
			if((self::validateStringNotEmpty($password))===false){
				$error.="Password cannot be empty<br/>";
			} 
			
			 if(preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/',$username)){
				$error.="Username field contains special characers<br/>";
			}
			
			if(preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $password)){
				$error.="Password field contains special characters<br/>";
			}
			
			$username =filter_var($username,FILTER_SANITIZE_STRING);			
			$password =filter_var($password,FILTER_SANITIZE_STRING); 
			
			$_SESSION["login_error"]= $error;
			if ($error !==""){
				return false ;
			}
			
		}
		
		/**
		 * Validates input from Reset Password page
		 * @param string $officerId - variable denoting Officer's Office Id
		 * @param string $oldPassword - variable denoting Officer's current Password
		 * @param string $newPassword - variable denoting new Password
		 * @param string $confirmPassword
		 * @return boolean $error
		 */
		public function validateResetFields($officerId,$oldPassword,$newPassword,$confirmPassword){			
			$officerPassword= self::getOfficerPassword($officerId);
			
			$error="";
			
			if((self::validateStringNotEmpty($oldPassword)==false) ||(self::validateStringNotEmpty($newPassword)==false)||(self::validateStringNotEmpty($confirmPassword)==false)){
				$error.="Enter a valid password<br/>";
			}			
			if($newPassword !== $confirmPassword){
				$error.= "New passwords do not match<br/>";				
			}		
			if(sha1($oldPassword) !== $officerPassword){
			$error.= "Invalid Password. Try Again!<br/>";			
			}
			if (preg_match('/[\'^£$!%&*()}{@#~?><>,|=_+¬-]/', $oldPassword) || preg_match('/[\'^£$!%&*()}{@#~?><>,|=_+¬-]/', $newPassword) || preg_match('/[\'^£$%&*()}{@#~?!><>,|=_+¬-]/', $confirmPassword))
			{
				$error.="Password field contains special characters<br/>";
			}
			
			$oldPassword =filter_var($oldPassword,FILTER_SANITIZE_STRING);
			$newPassword =filter_var($newPassword,FILTER_SANITIZE_STRING);
			$confirmPassword =filter_var($confirmPassword,FILTER_SANITIZE_STRING);
			
			return $error;			
		}
		
		/**
		 * Validates input from Login form
		 * @param string $$officerId - variable denoting Officer's Office ID
		 * @return string $officerPassword
		 */
		public function getOfficerPassword($officerId){
			$query= "select Password from officer where id=$officerId";
			$result =$this->connection->query($query)or die(mysqli_error($this->connection));
			//$resultSet = $result->fetch_assoc();
			$officerPassword = "";
			while($get=$result->fetch_assoc()){
			$officerPassword = $get["Password"]; }
			return $officerPassword;
		}
		

		public function OfficerDetails(){ 
		$query= "select * from officer where id=$id";
		$result =$this->connection->query($query)or die(mysqli_error($connection));
		$resultSet = $result->fetch_assoc();
		return $resultSet;
		}
		
		/**
		 * Checks through officer table  
		 * @param $id- variable denoting officer ID
		 * @retun string $sqlresult- result of select query
		 */  
		public function getOfficerDetails($id){ 
		$query= "select * from officer where id=$id";
		$result =$this->connection->query($query)or die(mysqli_error($connection));
		$resultSet = $result->fetch_assoc();
		return $resultSet;
		}
		
		/**
		* @param $filename- variable denoting name of file
		* @return $targetfile- variable denoting file directory
		*/
		public function moveToDirectory($filename){
			$target_dir = "uploads/";
			$error = "";
			$uploadOk = 1;//uploadOk will be set to 0 if an error occurs
			
			//creates target directory if doesn't exist
			if(!file_exists($target_dir)) {
				mkdir($target_dir);
			}
			$target_file = $target_dir . $filename;
			$FileType = pathinfo($target_file,PATHINFO_EXTENSION);//gets file extension	

			$newFilename = time().".".$FileType;
			$target_file = $target_dir . $newFilename;			
		
				if(move_uploaded_file($_FILES["user_profile_pic"]["tmp_name"], $target_file)){
				//echo "The file ". basename( $_FILES["fileId"]["name"]). " has been uploaded as ". $fullname; 
				return $newFilename;	//returns file path					
				}
						 
	}
	
	/**
		 * Validates Username and email
		 * @param $userName- variable denoting USername of *officer
		 * @param $email- variable denoting officer email 
		 */  
		public function validateOfficerDetails($userName,$email){
				$error="";
				if(self::validateStringNotEmpty($userName)==false){
				$error.="Username field cannot be empty<br/>";
				}
				
				if (strlen($userName)>50){
				$error.="Username is too long";	
				}
				
				if (strlen($email)>50){
				$error.="Email is too long";	
				}
				
				if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/',$userName))
				{
					$error.="Username field contains special characers<br/>";
				}
				
				if(!self::validateStringNotEmpty($email)===false){
					if(!filter_var($email, FILTER_VALIDATE_EMAIL) === true) {
						$error.="Please Enter a valid email address <br/>";
					}
				}
				
				$userName =filter_var($userName,FILTER_SANITIZE_STRING);
				$email =filter_var($email,FILTER_SANITIZE_STRING);
				
				$_SESSION["validate_error"]= $error;
				if ($error !=""){ //error exist
					return 0;
				}
				
		}
		
		/**
		 * Validates Passwords
		 * @param $password
		 * @return string $error
		 */  
		public function validatePassword ($password){
			$error="";
		
		    if(self::validateStringNotEmpty($password)==false){
			$error.="Password field cannot be empty<br/>";
			}
			
			if (strlen($password)>20){
			$error.="Password is too long";	
			}
			
			if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/',$password))
			{
				$error.="Password field can only contain letters and numbers<br/>";
			}
			
			$password =filter_var($password,FILTER_SANITIZE_STRING);
			
			$_SESSION["validate_error"]= $error;
			if ($error !=""){
				return 0 ;
			}
		} 
		
	
		/**
		 * Checks through officer table 
		 * @param string $search - variable denoting search  parameter 
		 * @return array $result- result of search query
		 */
		public function officerSearch($search){
			$connection = $this->connection;
			$query= "select * from officer where Fullname LIKE '%$search%' AND Level =1";
			$result=$connection->query($query) or die(mysqli_error($connection));
			return $result;
		}
		
		/**
		 * Checks through officer table 
		 * @param string $search - variable denoting search  parameter 
		 * @return array $result- result of search query
		 */
		public function searchAllOfficers($search){
			$connection = $this->connection;
			$query= "select * from officer where Fullname LIKE '%$search%' AND Level !=3";
			$result=$connection->query($query) or die(mysqli_error($connection));
			return $result;
		}
		
		/**
		 * function sendtoken send a valid url to officer's email address
		 * @param $id, unique user ID of officer
		 * @param $recipient, email of the officer
		 */
		public function sendToken($id,$recipient){
			$token = bin2hex(openssl_random_pseudo_bytes(16));//Create a "unique" token.
			
			//Construct the URL.
			$url = "http://waecsupervisor.org.com/newpassword.php?t=$token&user=$id";
			 
			//Build the HTML for the link.
			$link = '<a href="' . $url . '"> </a>';
			 
			//Send the email containing the $link above.

						$to = $recipient;//officer's email
						$subject = "WAEC : Reset Password";
						$content= " Dear Officer \n,
									Please click on the link to reset your password\n 
									Link : ".$url." \n" ;
									
						$headers = "From: bunmie.esther@gmail.com"; //sender's address

						if(mail($to,$subject,$content,$headers)){
							return true;
						}
						else{
							return false;
						}
			}

		public function getStates(){
			$query = "select distinct state from centres";
			$result = $this->connection->query($query) or die(mysqli_error($this->connection));
			return $result;
		}

		public function getLga($statename){
			$lga = $this->connection->query("select distinct lga from centres where state= '$statename'") or die(mysqli_error($this->connection));
			return $lga;
		}

		public function getSchools($lga){
			$result = $this->connection->query("select distinct nameOfSchool from centres where lga='$lga' order by nameOfSchool ASC") or die(mysqli_error($this->connection));
			return $result;
		}

		public function getCurrentView($searchVal, $office_id, $start_from, $num_rec_per_page){
			$connection = $this->connection;
			$query= "select * from supervisor where OfficeId=$office_id and Fullname LIKE '%$searchVal%' LIMIT $start_from, $num_rec_per_page";
			$result=$connection->query($query) or die(mysqli_error($connection));
				
			return $result;
		}

}
?>