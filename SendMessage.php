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

		

		public function send_Message($email, $subject, $message){

			$query="SELECT id from usertb WHERE email = '$email'";
			$row = mysqli_fetch_assoc(mysqli_query($this->connection, $query));
			$id = $row['id'];


			$query="INSERT into messagerecievedtb (userid, email, subject, message) values ('$id', '$email', '$subject', '$message')";
			$is_inserted = mysqli_query($this->connection, $query);

			if($is_inserted == 1){
				$json['success'] = " Message sent";
			}else{
				$json['error'] = " Message not sent";
			}

			echo json_encode($json);
			mysqli_close($this->connection);
		}
	}

	
	$User = new User();
	if(isset($_POST['email'], $_POST['subject'], $_POST['message'])){
		$email = $_POST['email'];
		$subject = $_POST['subject'];
		$message = $_POST['message'];
		if(!empty($subject) && !empty($message)){
			$User -> send_Message($email, $subject, $message);
		}else{
			$json['error'] = "Provide subject and message please";
			echo json_encode($json);
		}
		
	}
?>