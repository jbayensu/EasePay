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

		public function Get_User_Info($id){
			$query = "SELECT fname, mname, lname, email, tel FROM usertb WHERE id = '$id'";
			$row = mysqli_fetch_assoc(mysqli_query($this->connection, $query));
			if(sizeof($row)> 0){

				$fname =$row['fname'];
				$mname = $row['mname'];
				$lname = $row['lname'];
				$email = $row['email'];
				$tel = $row['tel'];
				

				if(!empty($mname)){
					$initial = $mname[0] . ".";
				}
				$json['success'] = "success";
				$json['fname'] = $fname;
	 			$json['mname'] = $mname;
	 			$json['lname'] = $lname;
	 			$json['email'] = $email;
	 			$json['tel'] = $tel;
	 			$json['full name'] = $fname . " " . $initial . " " . $lname;
 			}else{
	 				$json['error'] = " Error";
	 		}

	 			echo json_encode($json);
				mysqli_close($this->connection);

		}
	}

	$User = new User();
	if(isset($_POST['id'])){	
		$id = $_POST['id'];
		$User -> Get_User_Info($id);
		
	}

?>