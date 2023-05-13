<?php

	//header('Access-Control-Allow-Origin;*');
	require_once 'Connection.php';
	//global $returnVal = false;
	class User {
		
		private $db;
		private $connection;

		function __construct()
		{
			
			$this->db = new DB_Connection();
			$this->connection = $this->db->get_connection();

		}


		public function merchant_pay_seller($userid, $amount, $recipientID){
			$query = "select * from usertb where id = '$recipientID'";

			if(mysqli_query($this->connection,$query)){
				$query = "Update wallettb set amount = amount + '$amount' where userid = '$recipientID'";
				
				if(mysqli_query($this->connection,$query)){
					$query = "Update wallettb set amount = amount - '$amount' where userid = '$userid'";
					
					if(mysqli_query($this->connection, $query)){
						$query = "INSERT into transactiontb (fromUserId, toUserId, toUserName, description, paymentMethod, amount, notificationStatus, successStatus) VALUES ('$userid', '$recipientID', (select concat(fname, ' ', lname) from usertb where id = '$recipientID'), 'payment transaction', 'wallet', $amount, 0, 1)";

						if(mysqli_query($this->connection, $query)){
							//$returnVal = true;
							echo "success";
							header('Location: http://192.168.202.2:90/oag/home/receiveditems.php');
							//$json['success'] = " success";

						}else{
							//$returnVal = false;
							echo "errorb".$userid.", ".$amount.", ".$recipientID;
							//$json['error'] = " errorb";
						}
					}else{
						//$returnVal = false;
						echo "errora";
						//$json['error'] = " errora";
					}
				
				}else{
					//$returnVal = false;
					echo "Error: Amount not transfered";
					//$json['error'] = " Error: Amount not transfered";
				}
			}
			//header('Content-Type: application/json');
			//echo json_encode($json);
			mysqli_close($this->connection);
		}	
	
}

	$User = new User();

	if(isset($_POST['payerID'], $_POST['amount'], $_POST['recipientID'])){
		$payerID = $_POST['payerID'];
		$amount = $_POST['amount'];
		$recipientID = $_POST['recipientID'];
		if(!empty($payerID) && !empty($amount) && !empty($recipientID) ){
			if($recipientID == $payerID){
				$json['error'] = "You can not send money to yourself";
				echo json_encode($json);
			} else{
				$User -> merchant_pay_seller($payerID, $amount, $recipientID);
			}
		} else {
			echo json_encode("You must fill all fields");
		}
	}


?>