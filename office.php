<?php 
	/**
	 * Class Office - A class that models an Office
	 * 
	 * @author Bunmi Ajayi
	 */
	class Office{
		/** Represents an office id*/
		private $officeId;
		/**Ofiice Name */
		private $officeName;
		private $officeAddress;
		private $location;
		
		/**
		 * Class constructor; creates an Office when the class is instantiated
		 *
		 * @param string $officeId
		 * @param string $officeName
		 * @param string $officeAddress
		 * @param string $Location
		 *
		 */
		public function __construct($officeId, $officeName, $officeAddress, $location){
			$this->officeId = $officeId;
			$this->officeName = $officeName;
			$this->officeAddress = $officeAddress;
			$this->location = $location;
		}
		
		/**
		 * getter for the officeid variable
		 * @return string
		 */
		public function getOfficeid(){
			return $this->officeId;
		}
		
		/**
		 * getter for the officename variable
		 * @return string
		 */
		public function getOfficename(){
			return $this->officeName;
		}
		
		/**
		 * getter for the officeaddress variable
		 * @return string
		 */
		public function getOfficeaddress(){
			return $this->officeAddress;
		}
		
		/**
		 * getter for the location variable
		 * @return string
		 */
		public function getLocation(){
			return $this->location;
		}
		
		/**
		 * setter for the officeid variable
		 * @param string $newOfficeId
		 * @return string
		 */
		public function setOfficeid($newOfficeId){
			$this->officeId = $newOfficeId;		
		}
		
		/**
		 * setter for the officename variable
		 * @param string $newOfficeName
		 * @return string
		 */
		public function setOfficename($newOfficeName){
			$this->officeId = $newOfficeName;		
		}
		
		/**
		 * setter for the officeAddress variable
		 * @param string $newOfficeAddress
		 * @return string
		 */
		public function setOfficeaddress($newOfficeAddress){
			$this->officeId = $newOfficeAddress;		
		}
		
		/**
		 * setter for the location variable
		 * @param string $newLocation
		 * @return string
		 */
		public function setLocation($newLocation){
			$this->officeId = $newLocation;		
		}		
	}
?>
