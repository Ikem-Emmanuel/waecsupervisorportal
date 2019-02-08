<?php
require_once "supervisor.php";
require_once "miscfunction.php";

	/**
	 * Supervisor data access object Class - performs database related functions
	 * 
	 * @author Bunmi Ajayi
	 */
	class SupervisorDao{
		private $connection;

		/**
		* constructor
		* @param string $connection
		*/
		public function __construct($connection){

		$this->connection = $connection;
		}

		
		/**
		* Updates supervisor, inserts updated details into the database
		* 
		* @param string $supervisorObject - an instance of the supervisor class
		*
		* @param string $id- variable denoting User Id
		*/
		public function updateSupervisor($supervisorObject, $id, $Officer_Id){
			$picture = addslashes($supervisorObject->getPicdetails());
			$fullname = addslashes(strtoupper($supervisorObject->getFullname()));
			$gender = addslashes($supervisorObject->getGender());
			$age = addslashes($supervisorObject->getAge());
			$qualification = addslashes($supervisorObject->getQualification());
			$specialization = addslashes($supervisorObject->getSpecialization());
			$grade = addslashes($supervisorObject->getGrade());
			$experience = addslashes($supervisorObject->getExperience());
			$state = addslashes($supervisorObject->getState());
			$schoolName = addslashes(trim($supervisorObject->getSchoolName()));
			$officeAddress= addslashes($supervisorObject->getOfficeaddress());
			$officeid= addslashes(trim($supervisorObject->getOfficeid()));
			$lga = addslashes($supervisorObject->getLga());
			$homeAddress = addslashes($supervisorObject->getHomeaddress());
			$vehicleNo = addslashes($supervisorObject->getVehicleNo());
			$email = addslashes($supervisorObject->getEmail());
			$phoneNo = addslashes($supervisorObject->getPhoneno());
			$status = addslashes($supervisorObject->getStatus());
			$alternatePhone = addslashes($supervisorObject->getAlternatephone());

			if ($picture==""){
				$query = "update supervisor set OfficeId='$officeid',Fullname='$fullname',Gender='$gender',Age=$age,QualificationId=$qualification, Specialization='$specialization',GradeId=$grade,Experience=$experience,state='$state',currentSchool='$schoolName',OfficeAddress='$officeAddress',LGA='$lga',ResidentialAddress='$homeAddress',VehicleNumber='$vehicleNo',Email='$email',Phone='$phoneNo',AlternatePhone='$alternatePhone',RegistrationDate=now(),Officer_Id='$Officer_Id' where Id= $id";	
				$result = $this->connection->query($query) or die(mysqli_error($this->connection));
				return $result;
			}
			else {
				$query = "update supervisor set OfficeId='$officeid',Fullname='$fullname',Gender='$gender',Age=$age,QualificationId=$qualification, Specialization='$specialization',GradeId=$grade,Experience=$experience,state='$state',currentSchool='$schoolName',OfficeAddress='$officeAddress',LGA='$lga',ResidentialAddress='$homeAddress',VehicleNumber='$vehicleNo',Email='$email',Phone='$phoneNo',AlternatePhone='$alternatePhone', Passport='$picture',RegistrationDate=now(),Officer_Id='$Officer_Id' where Id= $id";
				$result = $this->connection->query($query) or die(mysqli_error($this->connection));
				return $result;
			}
		}
		

		/**
		* Creates a new supervisor, inserts supervisor details into the database
		* 
		* @param string $supervisorObject - an instance of the supervisor class
		*/
		public function createSupervisor($supervisorObject, $Officer_Id){
			$picture = addslashes($supervisorObject->getPicdetails());
			$fullName = addslashes(strtoupper($supervisorObject->getFullname()));
			$gender = addslashes($supervisorObject->getGender());
			$age = addslashes($supervisorObject->getAge());
			$qualification = addslashes($supervisorObject->getQualification());
			$specialization = addslashes($supervisorObject->getSpecialization());
			$grade = addslashes($supervisorObject->getGrade());
			$experience = addslashes($supervisorObject->getExperience());
			$state = addslashes($supervisorObject->getState());
			$schoolName = addslashes(trim($supervisorObject->getSchoolName()));
			$officeAddress= addslashes($supervisorObject->getOfficeaddress());
			$officeId= addslashes(trim($supervisorObject->getOfficeId()));
			$lga = addslashes($supervisorObject->getLga());
			$homeAddress = addslashes($supervisorObject->getHomeaddress());
			$vehicleNo = addslashes($supervisorObject->getVehicleNo());
			$email = addslashes($supervisorObject->getEmail());
			$phoneNo = addslashes($supervisorObject->getPhoneno());
			$alternatePhone = addslashes($supervisorObject->getAlternatephone());
			$status = $supervisorObject->getStatus();
			$supervisorId = self::getLastId($officeId);

			$newquery = "insert into supervisor values(null,'$supervisorId','$officeId','$fullName','$gender',$age,$qualification, '$specialization',$grade,$experience,'$state','$schoolName','$officeAddress','$lga','$homeAddress','$vehicleNo','$email','$phoneNo','$alternatePhone', '$picture',1, now(),'$Officer_Id')";
			
			$newresult = $this->connection->query($newquery) or die(mysqli_error($this->connection));
			return $newresult;
		}

		public function getLastId($officeid){
			$sql = "SELECT SupervisorId FROM supervisor where OfficeId='$officeid' ORDER BY Id DESC LIMIT 1";
			$sqlresult = $this->connection->query($sql) or die(mysqli_error($this->connection));
			$lastId ;
			
			//sqlresult will return null if officer is registering supervisor for the first time
			if(mysqli_num_rows($sqlresult) > 0 ){
				while($row = $sqlresult->fetch_assoc()){
				$lastId = $row["SupervisorId"] ; }

				$newId = intval($lastId) + 1;
				return $newId;
				
			}
			else{
				$returnval = "4".$officeid."0001"; 
				return $returnval; }
		}
	}
?>