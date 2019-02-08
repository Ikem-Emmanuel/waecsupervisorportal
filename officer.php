<?php 
	/**
	 * Officer Class - A class that models an Officer
	 * 
	 * @author Bunmi Ajayi
	 */
	class Officer{
		private $firstName;	
		private $lastName;
		private $officeId;
		private $username;
		private $password;	
		private $phoneNo;
		private $email;
		private $status;
		
		/**
		 * Creates an Officer
		 * 
		 * @param string $fullname Officer fullname
		 * @param string $officeId Officer office id
		 * @param string $username Officer username
		 * @param string $password Officer password
		 * @param string $email Officer email
		 * @param string $phoneNo Officer phoneNo
		 *
		 */
		public function __construct($firstName, $lastName, $officeId, $username, $password, $email, $phoneNo, $status, $level){
			$this->firstName = $firstName;
			$this->lastName = $lastName;
			$this->officeId = $officeId;
			$this->username = $username;
			$this->password = $password;	
			$this->email =$email;
			$this->phoneNo = $phoneNo;
			$this->status=$status;
			$this->level=$level;
		}
		
		/**
		 * getter for firstname variable 
		 */ 
		public function getFirstname(){
			return $this->firstName;		
		}
		/**
		 * getter for last variable 
		 */ 
		public function getLastname(){
			return $this->lastName;		
		}
		/**
		 * getter for office id variable 
		 */ 
		public function getOfficeId(){
			return $this->officeId;		
		}
		
		/**
		 * getter for username variable 
		 */ 
		public function getUsername(){
			return $this->username;		
		}
		
		/**
		 * getter for password variable 
		 */
		public function getPassword(){
			return $this->password;		
		}
		
		/**
		 * getter function for $email
		 */
		public function getEmail(){
			return $this->email;		
		}
		
		/**
		 * Getter function for phone number variable
		 */
		public function getPhoneNo(){
			return $this->phoneNo;		
		}	
		
		public function getStatus(){
			return $this->status;
			
		}
		public function getLevel(){
			return $this->level;
			
		}
		
		/**
		 * setter for the firstName variable
		 */
		public function setFirstname($newFirstname){
			$this->firstName = $newFirstname ;		
		}
		
		/**
		 * setter for the lastName variable
		 */
		public function setLastname($newLastname){
			$this->lastName = $newLastname ;		
		}
		/**
		 * setter for office id variable 
		 */ 
		public function setOfficeid($newOfficeid){
			$this->officeId = $newOfficeid ;		
		}
		
		/**
		 * setter for username variable 
		 */
		public function setUsername($newUsername){
			$this->username = $newUsername ;		
		}
		
		/**
		 * setter for password variable 
		 */
		public function setPassword($newPassword){
			$this->password = $newPassword ;		
		}
		
		/**
		 * setter function for phone number variable
		 */
		public function setPhoneno($newPhoneno){
			$this->phoneNo = $newPhoneno ;		
		}
		
		/**
		 * getter function for $email
		 */
		public function setEmail($newEmail){
			$this->email = $newEmail ;		
		}
		
		public function setStatus($newStatus){
			$this->status= $newStatus;
		}
		public function setLevel($newLevel){
			$this->level = $newLevel;		
		}
	}
?>
