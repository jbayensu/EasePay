<?php 
	
	require_once 'DbConfig.php';


	/**
	* 
	*/
	class DB_Connection 
	{
		
		private $connect;

		function __construct()
		{
			$this -> connect = mysqli_connect(hostname, username, password, db_name) or die("DB connection error");

		}

		public function get_connection(){
			return $this->connect;
		}
	}







?>