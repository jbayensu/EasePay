<?php

	require_once 'Connection.php';

	class User {
		
		private $db;
		private $connection;

		function __construct()
		{
			
			$this->db = new DB_Connection();
			$this->connection = $this->db->get_connection();

		}

		public function Get_Merchants(){
			$query = "SELECT * from merchanttb where status = '1'";

			$result = mysqli_query($this->connection, $query);

			$temp_array = array();

			if(mysqli_num_rows($result)>0){
				while ($row = mysqli_fetch_assoc($result)) {
					$temp_array[] = $row;
				}
			}

			//header('Content-Type: application/json');
			echo json_encode(array("Merchants List"=>$temp_array));
			mysqli_close($this->connection);

		}

	

	}

	$User = new User();

	$User -> Get_Merchants();


?>