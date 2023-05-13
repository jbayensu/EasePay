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

		public function Get_Ballance($userid){
			$query = "SELECT amount from wallettb where userid = '$userid'";
			$row = mysqli_fetch_assoc(mysqli_query($this->connection, $query));
			if(sizeof($row)> 0){
				$json['amount'] = $row['amount'];
			}else{
				$json['error'] = " error";
			}
		

			//header('Content-Type: application/json');
			echo json_encode($json);
			mysqli_close($this->connection);

		}

		public function Transfer_money($userid, $amount, $recipientID, $encrypted_pin){
			$query = "select * from usertb where id = '$recipientID'";
			if(mysqli_query($this->connection,$query)){
				
				$query = "select pin from usertb where id = '$userid'";
				if(mysqli_query($this->connection,$query)){

					$query = "Update wallettb set amount = amount + '$amount' where userid = '$recipientID'";
					if(mysqli_query($this->connection,$query)){
						$query = "Update wallettb set amount = amount - '$amount' where userid = '$userid'";
						
						if(mysqli_query($this->connection, $query)){
							$query = "INSERT into transactiontb (fromUserId, toUserId, toUserName, description, paymentMethod, amount, notificationStatus, successStatus) VALUES ('$userid', '$recipientID', (select concat(fname, ' ', lname) from usertb where id = '$recipientID'), 'money transfer', 'wallet', $amount, 0, 1)";

							if(mysqli_query($this->connection, $query)){
								$json['success'] = " success";
							}else{
								$json['error'] = " errorb";
							}
						}else{
							$json['error'] = " errora";
						}
					
					}else{
						$json['error'] = " Error: Amount not transfered";
					}
				}else{
					$json['error'] = " Error: Wrong pin code";
				}
			}else{
					$json['error'] = " Error: Recipient Id does not exists";
				}
			//header('Content-Type: application/json');
			echo json_encode($json);
			mysqli_close($this->connection);

			
		}	
	}

	$User = new User();

	if(isset($_POST['userid'])){
		$userid = $_POST['userid'];
	$User -> Get_Ballance($userid);}

	if(isset($_POST['userID'], $_POST['amount'], $_POST['recipientID'], $_POST['pin'])){
		$userid = $_POST['userID'];
		$amount = $_POST['amount'];
		$recipientID = $_POST['recipientID'];
		$pin = $_POST['pin'];
		if(!empty($userid) && !empty($amount) && !empty($recipientID) && !empty($pin)){
			if($recipientID == $userid){
				$json['error'] = "You can not send money to yourself";
				echo json_encode($json);
			} else{
				$encrypted_pin = md5($pin);
				$User -> Transfer_money($userid, $amount, $recipientID, $encrypted_pin);
			}
		} else {
			$json['error'] = "You must fill all fields";
			echo json_encode($json);
		}
	}


?>