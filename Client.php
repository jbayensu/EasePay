<?php
require_once 'Connection.php';

class Client {
		
		private $db;
		private $connection;

		private $ID;
		private $FName;
		private $MName;
		private $LName;
		private $Email;
		private $Password;
		private $Tel;
		private $wallet_Amount;

		function __construct()
		{
			
			$this->db = new DB_Connection();
			$this->connection = $this->db->get_connection();

		}

		//check if user exists
		public function is_Exist($Email, $Password){

			$query = "SELECT * from clientsinfotb where email = '$Email' and password = '$Password'";
 			$result = mysqli_query($this->connection, $query );

	 		if(mysqli_num_rows($result)>0){
	 			$answer = true;
	 		} else {
	 			$answer = false;
	 		}

			mysqli_close($this->connection);
			return $answer;
		}

		//fetch information about user
		public function display_Info($ID){
			$query = "SELECT * from clientsinfotb where ID = $ID";
			$result = mysqli_query(this->connection, $query);

			$temp_array = array();

			if(mysqli_num_rows($result)>0){
				while ($row = mysqli_fetch_assoc($result)) {
					$temp_array[] = $row;
				}
			}

			echo json_encode(array("My Info"=>$temp));
			mysqli_close($this->connection);
		}


		//Register new user
		public function register($FName, $MName, $LName, $Email, $Password, $Tel){

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


	

		//add amount to existing amount in wallet
		public function set_Wallet_Amount($ID, $wallet_Amount){
			$query ="UPDATE wallet_Detail_Tb set wallet_Amount = wallet_Amount + $wallet_Amount where ID = $ID";
	 			$is_updated = mysqli_query($this->connection, $query);

	 			if($is_updated == 1){
	 				$json['success']=' Amount saved '.$Email;
	 			}else{
	 				$json['error'] = ' Sorry, amount not created, try again later. ';
	 			}
	 			echo json_encode($json);
	 			mysqli_close($this->connection);

		}

		//fetch wallet balance
		public function get_Wallet_Amount($ID){

			$query = "SELECT * from wallet_Detail_Tb where ID = $ID";
			$result = mysqli_connect(this->connection, $query);

			$temp_array = array();

			if(mysqli_num_rows($result)>0){
				while ($row = mysqli_fetch_assoc($result)) {
					$temp_array[] = $row;
				}
			}

			echo json_encode(array("My Wallet"=>$temp));
			mysqli_close($this->connection);

		}

}

?>