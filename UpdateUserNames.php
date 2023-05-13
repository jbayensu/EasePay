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

		public function Update_user_Names($id, $fname, $mname, $lname){

			$query="UPDATE usertb set fname='$fname', mname='$mname', lname='$lname' WHERE id = '$id'";
			$is_updated = mysqli_query($this->connection, $query);

			if($is_updated == 1){
				$json['success'] = " Udate Successful";
			} else {
				$json['Error'] = " Udate Not Successful";
			}

			echo json_encode($json);
			mysqli_close($this->connection);
		}
	}

	
	$User = new User();
	
	if(isset($_POST['id'], $_POST['fname'], $_POST['mname'], $_POST['lname'])){	

		$id = $_POST['id'];
		$fname = $_POST['fname'];
		$mname = $_POST['mname'];
		$lname = $_POST['lname'];

		$User -> Update_user_Names($id, $fname, $mname, $lname);
		
	}


?>