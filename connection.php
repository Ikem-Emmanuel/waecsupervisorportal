<?php

/**
 * Connection Class 
 * 
 * @author Bunmi Ajayi
 * @contributor Ikem Emmanuel
 */
class connection
{
	private $host;
	private $user;
	private $pass;
	private $db;


	/**
	 *constructor - initialize class variables
	 */
	public function __construct()
	{
		$this->host = "localhost";
		$this->user = "root";
		$this->pass = "";
		$this->db = "botolink_supssce";
	}


	/**
	 * creates valid connection for accessing the database
	 * 
	 * @return object
	 */
	public function getConnection()
	{
		$mysqli = new Mysqli($this->host, $this->user, $this->pass, $this->db);
		if (mysqli_connect_errno()) {
			//echo ;
			exit("Failed to connect to MySQL: " . mysqli_connect_error());
		}

		return $mysqli;
	}
}
