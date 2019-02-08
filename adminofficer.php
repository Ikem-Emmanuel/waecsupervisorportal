<?php
	/**
	 * AdminOfficer Class - A class that models an AdminOfficer
	 * 
	 * @author Bunmi Ajayi
	 */
	class AdminOfficer{
		private $username;
		private $password;
		
		/**
		 * Class' constructor; creates an AdminOfficer when an object is created
		 *
		 *@param string $username, AdminOfficer's username
		 *@param string $password 
		 *
		 */
		public function __construct($username, $password){
			$this->username = $username;
			$this->password = $password;
		}
		
		/**
		 *getter for the username variable
		 *@return string
		 */
		public function getUsername(){
			return $this->username;
		}
		
		/**
		 *getter for the password variable
		 *@return string
		 */
		public function getPassword(){
			return $this->password;
		}
		
		/**
		 *setter for the username variable
		 *@param string $newusername, sets variable username to newusername
		 *@return string
		 */
		public function setUsername($newUsername){
			$this->username = $newUsername;
		}
		
		/**
		 *setter for the password variable
		 *@param string $newPassword, sets variable password to newpassword
		 *@return string
		 */
		public function setPassword($newPassword){
			$this->password = $newPassword;
		}
	}
?>