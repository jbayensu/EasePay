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

		

		public function User_Change_Password($id, $password, $oldPassword){

			$query="UPDATE logintb set password = '$password' WHERE userid = '$id' and password = '$oldPassword'";
			mysqli_query($this->connection, $query);
			if(mysqli_affected_rows($this->connection)>0){
				$json['success'] = " Update Successful";
			} else {
				$json['error'] = " Update Not Successful, Old Password does not exist";
			}

			echo json_encode($json);
			mysqli_close($this->connection);
		} 
	}

	$User = new User();
	if(isset($_POST['id'], $_POST['password'], $_POST['oldPassword'])){
		$oldPassword = $_POST['oldPassword'];
		$password = $_POST['password'];
		$id = $_POST['id'];
		if(!empty($id) && !empty($password) && !empty($oldPassword)){
			$encrypted_password = md5($password);
			$encrypted_oldPassword = md5($oldPassword);
			$User -> User_Change_Password($id,$encrypted_password, $encrypted_oldPassword);
		} else {
			$json['error'] = " You must fill all fields marked";
			echo json_encode($json);
		}
	}


?>