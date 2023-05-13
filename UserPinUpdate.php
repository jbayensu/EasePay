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

		

		public function User_Change_Pin($id, $pin, $oldPin){

			$query = "SELECT pin from usertb where id= '$id' AND pin = '$oldPin'";
			$result = mysqli_query($this->connection, $query);

			$json;

			if(mysqli_num_rows($result)>0){
				$query = "UPDATE usertb SET verifiedStatus = '1', pin = '$pin' WHERE id = '$id'";
				$is_updated = mysqli_query($this->connection, $query);

				if($is_updated == 1){
					$query = "UPDATE logintb SET loggedStatus = '1' WHERE userid = '$id'";
					mysqli_query($this->connection, $query);
				
		 			$json['success']=' Account Verified, welcome ';
		 		}
		 		else{
		 			$json['error'] = ' Sorry, Account not veridfied, try again later. ';
		 		}	 			
			}
			else{
				$json['error']=' Old Pin does not exists';
			}
 			
			echo json_encode($json);
 			mysqli_close($this->connection);
		}

	}

	$User = new User();
	if(isset($_POST['id'], $_POST['pin'], $_POST['oldPin'])){
		$oldPin = $_POST['oldPin'];
		$pin = $_POST['pin'];
		$id = $_POST['id'];
		if(!empty($id) && !empty($pin) && !empty($oldPin)){
			$encrypted_pin = md5($pin);
			$encrypted_oldPin = md5($oldPin);
			$User -> User_Change_Pin($id,$encrypted_pin, $encrypted_oldPin);
		} else {
			echo json_encode("You must fill all fields marked");
		}
	}

?>