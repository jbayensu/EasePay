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

		public function does_Client_Exist($FName, $MName, $LName, $Email, $Password, $Tel)
		{

			$query = "SELECT * from clientsinfotb where email = '$Email'";
 			$result = mysqli_query($this->connection, $query );

	 		if(mysqli_num_rows($result)>0){
	 			$json['error'] = $Email.' Already exist '; 
	 			echo json_encode($json);
	 		} else {
	 			$query ="Insert into clientsinfotb (FName, MName, LName, Email, Password, Tel) values ('$FName','$MName', '$LName', '$Email', '$Password', '$Tel')";
	 			$is_inserted = mysqli_query($this->connection, $query);

	 			if($is_inserted == 1){
	 				$json['success']=' Account created, welcome '.$Email;
	 			}else{
	 				$json['error'] = ' Sorry, Account not created, try again later. ';
	 			}
	 			echo json_encode($json);
	 			mysqli_close($this->connection);
	 		}

			
		}
	}


	$Client = new Client();
	if(isset($_POST['FName'], $_POST['MName'], $_POST['LName'], $_POST['Email'], $_POST['Password'], $_POST['Tel'])){
		$FName = $_POST['FName'];
		$MName = $_POST['MName'];
		$LName = $_POST['LName'];
		$Email = $_POST['Email'];
		$Password = $_POST['Password'];
		$Tel = $_POST['Tel'];
		if(!empty($FName) && !empty($LName) && !empty($Email) && !empty($Password)){
			$encrypted_password = md5($Password);
			$Client -> does_Client_Exist($FName, $MName, $LName, $Email, $encrypted_password, $Tel);
		} else {
			echo json_encode("You must fill all fields marked");
		}
	}



?>