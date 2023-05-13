<?php 

	require_once 'Connection.php';
	

	class Client {
		
		private $db;
		private $connection;

		function __construct()
		{
			
			$this->db = new DB_Connection();
			$this->connection = $this->db->get_connection();

		}

		public function does_Client_Exist($email, $password)
		{

			$query = "SELECT * from clientsinfotb where email = '$email' and password = '$password'";
 			$result = mysqli_query($this->connection, $query );

	 		if(mysqli_num_rows($result)>0){
	 			$json['success'] = ' Welcome '.$email; 
	 		} else {
	 			$json['error'] = ' Wrong email or password ';
	 		}

			echo json_encode($json);
			mysqli_close($this->connection);
		}
	}


	$Client = new Client();
	if(isset($_POST['email'], $_POST['password'])){
		$email = $_POST['email'];
		$password = $_POST['password'];
		if(!empty($email) && !empty($password)){
			$encrypted_password = md5($password);
			$Client -> does_Client_Exist($email, $encrypted_password);
		} else {
			echo json_encode("You must fill both fields");
		}
	}


	




?>