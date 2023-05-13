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

		public function User_Registration($fname, $mname, $lname, $email, $tel, $pin, $password)
		{
			$query = "SELECT id from dummytb";
 			$rowA = mysqli_fetch_assoc(mysqli_query($this->connection, $query ));
 			$number= $rowA['id'];
 			//$json['dummyid'] = $number; 
 			//echo json_encode($json);

 			if($number <10){
 				$id = "EP000".$number.date("y");
 				$number += 1;
 			} elseif ($number>=10 && $number <100 ){
 				$id = "EP00".$number.date("y");
 				$number += 1;
 			} elseif ($number>=100 && $number <1000 ){
 				$id = "EP0".$number.date("y");
 				$number += 1;
 			} elseif ($number>=1000 && $number <10000 ){
 				$id = "EP".$number.date("y");
 				$number += 1;
 			} else{
 				$number = 1;
 			}

 			$query = "UPDATE dummytb set id = '$number'";
 			mysqli_query($this->connection, $query);

			//check if user exist
			$query = "SELECT * from usertb where email = '$email'";
 			$result = mysqli_query($this->connection, $query );

	 		if(mysqli_num_rows($result)>0){
	 			$json['error'] = $email.' Already exist '; 
	 			echo json_encode($json);
	 		} else {
	 			//fill registration table
	 			$query ="Insert into usertb (id,fname, mname, lname, email, tel, pin) values ('$id', '$fname','$mname', '$lname', '$email', '$tel', '$pin')";
				$is_inserted = mysqli_query($this->connection, $query);

	 			if($is_inserted == 1){
	 				//fill login table
		 			$query = "Insert into logintb (userid,email, password) values ('$id', '$email', '$password')";
		 			$is_inserted = mysqli_query($this->connection, $query);
		 			if($is_inserted == 1){
		 				$query = "Insert into wallettb (userid, amount) values ('$id', '0.00')";
		 				if(mysqli_query($this->connection,$query)){
	 						$json['success']=' Account created, welcome '.$email;
	 					}
	 				}
	 			}else{
	 				$json['error'] = ' Sorry, Account not created, try again later. ';
	 			}
	 			echo json_encode($json);
	 			mysqli_close($this->connection);
	 		}
		}
	}


	$User = new User();
	if(isset($_POST['fname'], $_POST['mname'], $_POST['lname'], $_POST['email'], $_POST['password'], $_POST['tel'], $_POST['pin'])){
		
		$fname = $_POST['fname'];
		$mname = $_POST['mname'];
		$lname = $_POST['lname'];
		$email = $_POST['email'];
		$tel = $_POST['tel'];
		$pin = $_POST['pin'];
		$password = $_POST['password'];
		if(!empty($fname) && !empty($lname) && !empty($email) && !empty($password)){
			$encrypted_pin = md5($pin);
			$encrypted_password = md5($password);
			$User -> User_Registration($fname, $mname, $lname, $email, $tel, $encrypted_pin, $encrypted_password);
		} else {
			echo json_encode("You must fill all fields marked");
		}
	}

?>