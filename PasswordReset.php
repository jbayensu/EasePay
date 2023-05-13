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

		

		public function verification($email, $pin){

			$query="SELECT id from usertb WHERE email = '$email' and pin = '$pin'";
			$result = mysqli_query($this->connection, $query);
			if(mysqli_num_rows($result)>0){
				$row = mysqli_fetch_assoc($result);
				$json['userId'] = $row['id'];
			}else{
				$json['error'] = " Invalid Email or pin code";
			}

			echo json_encode($json);
			mysqli_close($this->connection);
		}

		public function resetPassword($userId, $password){
			$query = "UPDATE  logintb set password = '$password' WHERE userid = '$userId'";
			if(mysqli_query($this->connection, $query)){
				$json['success'] = " Password changed successfully!";
			}else{
				$json['error'] = " Password change failed!";
			}
			echo json_encode($json);
			mysqli_close($this->connection);
		}
	}

	
	$User = new User();
	if(isset($_POST['email'], $_POST['pin'])){
		$email = $_POST['email'];
		$pin = $_POST['pin'];
		if(!empty($email) && !empty($pin)){
			$encryptedPin = md5($pin);
			$User -> verification($email, $encryptedPin);
		}else{
			$json['error'] = "Email or pin can not be empty";
			echo json_encode($json);
		}
		
	}

	if(isset($_POST['userId'], $_POST['password'])){
		$userId = $_POST['userId'];
		$password = $_POST['password'];
		if(!empty($password)){
			$encryptedPassword = md5($password);
			$User -> resetPassword($userId, $encryptedPassword);
		}else{
			$json['error'] = "you must provide new password";
			echo json_encode($json);
		}
		
	}
?>