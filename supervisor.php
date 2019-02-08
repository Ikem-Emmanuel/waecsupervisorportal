<?php 

	/**
	 * Supervisor class
	 * @author AjayiBunmi
	 */
	class Supervisor{
		
		private $picDetails;
		private $fullName;
		private $gender;
		private $age;
		private $qualification;
		private $specialization;
		private $grade;
		private $experience;
		private $officeId;
		private $schoolName;
		private $officeAddress;
		private $lga;
		private $homeAddress;
		private $vehicleNo;
		private $email;
		private $phoneNo;
		private $alternatePhone;
		private $status;
		private $state;
		
		/**
		 * creates a new supervisor
		 *
		 * @param string $picDetails
		 * @param string $fullName
		 * @param string $gender
		 * @param string $age
		 * @param string $qualification
		 * @param string $specialization
		 * @param string $grade
		 * @param string $experience
		 * @param string $officeId
		 * @param string $officeAddress
		 * @param string $lga
		 * @param string $homeAddress
		 * @param string $vehicleNo
		 * @param string $email
		 * @param string $phoneNo
		 * @param string $alternatePhone
		 *
		 */
		public function __construct($picDetails, $fullName, $gender, $age, $qualification, $specialization, $grade, $experience, $officeId, $state, $schoolName, $officeAddress, $lga, $homeAddress, $vehicleNo, $email, $phoneNo,$status, $alternatePhone){
			$this->fullName = $fullName;
			$this->picDetails = $picDetails;
			$this->gender = $gender;
			$this->age = $age;
			$this->qualification = $qualification;
			$this->specialization = $specialization;
			$this->grade = $grade;
			$this->experience = $experience;
			$this->officeId = $officeId;
			$this->state = $state;
			$this->schoolName = $schoolName;
			$this->officeAddress = $officeAddress;
			$this->lga = $lga;
			$this->homeAddress = $homeAddress;
			$this->vehicleNo = $vehicleNo;
			$this->email =$email;
			$this->phoneNo = $phoneNo;
			$this->alternatePhone = $alternatePhone;
			$this->status= $status;
		}
		
		/**
		 *getter for the fullname variable
		 */
		public function getFullname(){
			return $this->fullName;
		}

		/**
		 *getter for the fullname variable
		 */
		public function getState(){
			return $this->state;
		}

		/**
		 *getter funtion for school variable
		 */
		public function getSchoolName(){
			return $this->schoolName;
		}
		
		/**
		 *getter for the Picdetails variable
		 */
		public function getPicdetails(){
			return $this->picDetails;		
		}
		
		/**
		 *getter for the gender variable
		 */
		public function getGender(){
			return $this->gender;
		}
		
		/**
		 *getter for the age variable
		 */
		public function getAge(){
			return $this->age;		
		}
		
		/**
		 *getter for the qualification variable
		 */
		public function getQualification(){
			return $this->qualification;
		}
		
		/**
		 *getter for the specialization variable
		 */
		public function getSpecialization(){
			return $this->specialization;
		}
		
		/**
		 *getter for the grade variable
		 */
		public function getGrade(){
			return $this->grade;
		}
		
		/**
		 *getter for the experience variable
		 */
		public function getExperience(){
			return $this->experience;
		}
		
		/**
		 *getter for the officeId variable
		 */
		public function getOfficeid(){
			return $this->officeId;		
		}
		
		/**
		 *getter for the officeAddress variable
		 */
		public function getOfficeaddress(){
			return $this->officeAddress;		
		}
		
		/**
		 *getter for the lga variable
		 */
		public function getLga(){
			return $this->lga;		
		}
		
		/**
		 *getter for the homeAddress variable
		 */
		public function getHomeaddress(){
			return $this->homeAddress;		
		}
		
		/**
		 *getter for the vehicleNo variable
		 */
		public function getVehicleNo(){
			return $this->vehicleNo;
		}
		
		/**
		 *getter for the email variable
		 */
		public function getEmail(){
			return $this->email;		
		}
		
		/**
		 *getter for the phoneNo variable
		 */
		public function getPhoneNo(){
			return $this->phoneNo;		
		}
		
		/**
		 *getter for the alternatePhone variable
		 */
		public function getAlternatephone(){
			return $this->alternatePhone;		
		}
		
		/**
		 *getter for the status variable
		 */
		public function getStatus(){
			return $this->status;		
		}
		
		/**
		 *setter for the fullname variable
		 * @param string $newFullname
		 */
		public function setFullname($newFullname){
			$this->fullName = $newFullname ;		
		}
		
		/**
		 *getter for the status variable
		 * @param string $newStatus
		 */
		public function setStatus($newStatus){
			$this->status = $newStatus ;		
		}
		/**
		 *setter for the Picdetails variable
		 * @param string $newPicdetails
		 */
		public function setPicdetails($newPicdetails){
			$this->picDetails = $newPicdetails ;		
		}
		
		/*public function setStatus($newStatus){
			 $this->status = $newStatus;		
		}*/
		/**
		 *setter for the gender variable
		 * @param string $newGender
		 */
		public function setGender($newGender){
			$this->gender = $newGender ;		
		}
		
		/**
		 *setter for the age variable
		 * @param string $newAge
		 */
		public function setAge($newAge){
			$this->age = $newAge ;		
		}

		/**
		 *setter for the age variable
		 * @param string $newAge
		 */
		public function setState($newState){
			$this->state = $newState ;		
		}
		
		/**
		 *setter for the qualification variable
		 * @param string $newSpecialization
		 */
		public function setSpecialization($newSpecialization){
			$this->specialization = $newSpecialization ;		
		}
		
		/**
		 *setter for the specialization variable
		 * @param string $newQualification
		 */
		public function setQualification($newQualification){
			$this->qualification = $newQualification ;		
		}
		
		/**
		 *setter for the grade variable
		 * @param string $newGrade
		 */
		public function setGrade($newGrade){
			$this->grade = $newGrade ;		
		}
		
		/**
		 *setter for the experience variable
		 * @param string $newExperience
		 */
		public function setExperience($newExperience){
			$this->experience = $newExperience ;		
		}
		
		/**
		 *setter for the officeId variable
		 * @param string $newOfficeid
		 */
		public function setOfficeid($newOfficeid){
			$this->officeId = $newOfficeid ;		
		}
		
		/**
		 *setter for the officeAddress variable
		 * @param string $newOfficeaddress
		 */
		public function setofficeaddress($newOfficeaddress){
			$this->officeAddress = $newOfficeaddress ;		
		}
		
		/**
		 *setter for the lga variable
		 * @param string $newLga
		 */
		public function setLga($newLga){
			$this->lga = $newLga ;		
		}
		
		/**
		 *setter for the homeAddress variable
		 * @param string $newHomeaddress
		 */
		public function setHomeaddress($newHomeaddress){
			$this->homeAddress = $newHomeaddress ;		
		}
		
		/**
		 *setter for the vehicleNo variable
		 * @param string $newVehicleno
		 */
		public function setVehicleno($newVehicleno){
			$this->vehicleNo = $newVehicleno ;		
		}
		
		/**
		 *setter for the email variable
		 * @param string $newEmail
		 */
		public function setEmail($newEmail){
			$this->email = $newEmail ;		
		}

		/**
		 *setter function for the school variable
		 */
		public function setSchoolName($newSchoolName){
			$this->schoolName = $newSchoolName;
		}
		
		/**
		 *setter for the phoneNo variable
		 * @param string $newPhoneno
		 */
		public function setPhoneno($newPhoneno){
			$this->phoneNo = $newPhoneno ;		
		}
		
		/**
		 *setter for the alternatePhone variable
		 * @param string $newAlternatephone
		 */
		public function setAlternatephone($newAlternatephone){
			$this->alternatePhone = $newAlternatephone ;		
		}
	}
?>