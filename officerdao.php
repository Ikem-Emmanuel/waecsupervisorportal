<?php
require_once "officer.php";

	/**
	 * Supervisor data access object Class - performs database related functions
	 * 
	 * @author Bunmi Ajayi
	 */
	class OfficerDao{
		public function __construct($connection){
			$this->connection = $connection;
		}
		
		/**
		 * Creates a new supervisor, inserts supervisor details into the database
		 * 
		 * @param string $supervisorObject - an instance of the supervisor class
		 */
		public function createOfficer($officerObject){
			$fullname = ucfirst($officerObject->getFirstname())." ".ucfirst($officerObject->getLastname());
				$officeId = $officerObject->getOfficeId();
				$username = $officerObject->getUsername();
				$password = $officerObject->getPassword();
				$password= sha1($password);
				$email = $officerObject->getEmail();
				$phoneNo = $officerObject->getPhoneNo();
				$status= $officerObject->getStatus();
				$level= $officerObject->getLevel();
				$Officer_Id = self::getLastId();
				
			//check if $row_exist is set to true by any error
				$query = "insert into officer values(null,'$officeId','$fullname','$username','$password','$Officer_Id','$phoneNo','$email', $status, $level)";				
				$result = $this->connection->query($query) or die(mysqli_error($this->connection));
				return false;
		}
		
		public function updateOfficer($officerObject, $id){
			$fullname = ucfirst($officerObject->getFirstname())." ".ucfirst($officerObject->getLastname());
			$officeId = $officerObject->getOfficeId();
			$username = $officerObject->getUsername();
			$password = $officerObject->getPassword();
			$email = $officerObject->getEmail();
			$phoneNo = $officerObject->getPhoneNo();
			
			$query= "update officer set OfficeId='$officeId', Fullname='$fullname', Username='$username', Phone='$phoneNo', Email='$email' where Id='$id' ";
				$result = $this->connection->query($query) or die(mysqli_error($this->connection));
		}

		public function changePassword($newPassword, $officerId){
			$newPassword= sha1($newPassword);
			$query= "update officer SET Password ='$newPassword' where Id=$officerId";
			$result = $this->connection->query($query) or die(mysqli_error($this->connection));
		}

		public function getLastId(){
			$sql = "SELECT Officer_Id FROM officer ORDER BY Officer_Id DESC LIMIT 1";
			$sqlresult = $this->connection->query($sql) or die(mysqli_error($this->connection));
			$lastId="" ;
			
			//sqlresult will return null if officer is registering supervisor for the first time
			if(mysqli_num_rows($sqlresult)==1){
				while($row = $sqlresult->fetch_assoc()){
					$lastId = $row["Officer_Id"] ; 
				}

				$newId = intval($lastId) + 1;

				if($newId<10){
					return "000".$newId;  
				}
				elseif($newId >=10 && $newId < 100){
					return "00".$newId;
				}
				elseif($newId >= 100){
					return "0".$newId;
				}
			}
			else{
				return "0001"; 
			}
		}
	}
?>