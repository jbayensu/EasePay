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

		public function user_Login($email, $password){

			$query = "SELECT userid from logintb WHERE email = '$email' and password = '$password'";
			$result = mysqli_query($this->connection, $query);
			

			if(mysqli_num_rows($result)>0){
				$row = mysqli_fetch_assoc($result);
				$userid = $row['userid'];
				$json['success'] = 'Welcome'; 
				$json['userID'] = $userid;

				//check verifiedStatus
				$query = "SELECT fname, mname, lname, ActiveStatus, verifiedStatus FROM usertb WHERE id = '$userid'";
				$row = mysqli_fetch_assoc(mysqli_query($this->connection, $query));
				$verifiedStatus = $row['verifiedStatus'];
				$ActiveStatus = $row['ActiveStatus'];
				$fname =$row['fname'];
				$mname = $row['mname'];
				$lname = $row['lname'];
				

				if(!empty($mname)){
					$mname = $mname[0] . ".";
				}
				$json['user names'] = $fname . " " . $mname . " " . $lname;
		
	 			if ($verifiedStatus == 1) {

	 				$json['verified'] ='verified';
	 				if($ActiveStatus == 1){
	 					$json['active'] = 'activated';	
	 				}else{
	 					$json['not active'] = 'deactivated';	
	 				}
	 				
	 				//Set loggedstatus
					$query = "UPDATE logintb SET loggedStatus = '1' WHERE userid = '$userid'";
					mysqli_query($this->connection, $query);
				}else{
					$json['verified']='unverified';
				}

		 	} else {
		 		$json['error'] = 'Wrong email or password ';
		 	}

				echo json_encode($json);
				mysqli_close($this->connection);

		}

	}

	$User = new User();
	if(isset($_POST['email'], $_POST['password'])){
		
		$email = $_POST['email'];
		$password = $_POST['password'];
		if(!empty($email) && !empty($password)){
			$encrypted_password = md5($password);
			$User -> user_Login($email,$encrypted_password);
		} else {
			echo json_encode("You must fill all fields marked");
		}
	}




?>