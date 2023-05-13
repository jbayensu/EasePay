<?php
	
	require_once 'Connection.php';

	class User 
	{
		private $db;
		private $connection;

		function __construct()
			{
				
				$this->db = new DB_Connection();
				$this->connection = $this->db->get_connection();

			}

		public function user_Logout($id){
			$query = "UPDATE logintb SET loggedStatus = 0 WHERE userid = '$id'";
			$is_updated = mysqli_query($this->connection, $query);
			if($is_updated == 1){
				$json['success']=' Log out successfull ';
			}
			echo json_encode($json);
 			mysqli_close($this->connection);
		}
	}


	$User = new User();
	if(isset($_POST['id'])){	
		$id = $_POST['id'];
		$User -> user_Logout($id);
		
	}

?>