<?php

define('hostname', 'localhost');
define('hostname2', '192.168.201.2');

define('username', 'root');

define('password', '742166jab');
define('password2', '');

define('db_name', 'easepayclientsdb');
define('db_name2', 'gogtour');

	class DB_Connection 
	{
		
		private $connect;
		private $connect2;

		function __construct()
		{
			$this -> connect = mysqli_connect(hostname, username, password, db_name) or die("DB connection error");
			$this -> connect = mysqli_connect(hostname2, username, password2, db_name2) or die("DB connection error");


		}

		public function get_connection(){
			return $this->connect;
		}

		public function get_connection2(){
			return $this->connect2;
		}
	}

	class User {
		
		private $db;
		private $connection;
		private $connection2;

		function __construct()
		{
			
			$this->db = new DB_Connection();
			$this->connection = $this->db->get_connection();
			$this->connection2 = $this->db->get_connection2();

		}

		public function Get_Amount($regId){
			$query = "SELECT totalAmount from payment where regID = '$regId'";
			$row = mysqli_fetch_assoc(mysqli_query($this->connection2, $query));
			if(sizeof($row)> 0){
				$json['amount'] = $row['totalAmount'];
			}else{
				$json['error'] = " error";
			}
		

			//header('Content-Type: application/json');
			echo json_encode($json);
			mysqli_close($this->connection2);

		}

		public function make_Payment($userid, $amount, $merchantID, $encrypted_pin, $reg){

			$query = "select pin from usertb where id = '$userid'";
			if(mysqli_query($this->connection,$query)){

				$query = "select userid from merchanttb where merchantid = '$merchantID'";
				if($result = mysqli_query($this->connection,$query)){
					$row = mysqli_fetch_assoc($result);
					$recipientID = $row['userid'];

					$query = "Update wallettb set amount = amount + '$amount' where userid = '$recipientID'";
					if(mysqli_query($this->connection,$query)){
						$query = "Update wallettb set amount = amount - '$amount' where userid = '$userid'";
						
						if(mysqli_query($this->connection, $query)){
							$query = "INSERT into transactiontb (fromUserId, toUserId, toUserName, description, paymentMethod, amount, notificationStatus, successStatus) VALUES ('$userid', '$recipientID', (select concat(fname, ' ', lname) from usertb where id = '$recipientID'), 'money transfer', 'wallet', $amount, 0, 1)";

							if(mysqli_query($this->connection, $query)){
								$query = "Update payment set PaymentStatus = '1' and PaymentDate= now() where regID = '$regId'";

								if(mysqli_query($this->connection2, $query)){
									$json['success'] = " success";
								}else{
									$json['error'] = " errorb";
								}
							}else{
								$json['error'] = " errorb";
							}
						}else{
							$json['error'] = " errora";
						}
					}
					
					}else{
						$json['error'] = " Error: Amount not transfered";
					}
			}else{
				$json['error'] = " Error: Wrong pin code";
			}
			//header('Content-Type: application/json');
			echo json_encode($json);
			mysqli_close($this->connection);
			mysqli_close($this->connection2);

			
		}	
	}

	$User = new User();

	if(isset($_POST['userid'])){
		$userid = $_POST['userid'];
	$User -> Get_Amount($userid);}

	if(isset($_POST['userID'], $_POST['amount'], $_POST['recipientID'], $_POST['pin'])){
		$userid = $_POST['userID'];
		$amount = $_POST['amount'];
		$recipientID = $_POST['recipientID'];
		$pin = $_POST['pin'];
		if(!empty($userid) && !empty($amount) && !empty($recipientID) && !empty($pin)){
			$encrypted_pin = md5($pin);
			$User -> Transfer_money($userid, $amount, $recipientID, $encrypted_pin);
		} else {
			echo json_encode("You must fill all fields");
		}
	}


?>