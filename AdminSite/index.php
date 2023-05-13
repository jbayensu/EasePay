<?php 
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
require_once '../Connection.php';

    class User {
        private $db;
        private $connection;

        function __construct(){
            
            $this->db = new DB_Connection();
            $this->connection = $this->db->get_connection();

        }
        
        public function user_Login($email, $password){

            $query = "SELECT userid from logintb WHERE email = '$email' and password = '$password'";
            $result = mysqli_query($this->connection, $query);
           
           if(mysqli_num_rows($result)>0){
                $row = mysqli_fetch_assoc($result);
                $userid = $_SESSION['userid'] = $row['userid'];

                $query = "insert into logtb (userid, logdate, logtime, activity) values ('Admin', (select curdate()), (select curtime()),'Logged in')";
                mysqli_query($this->connection, $query);

                header('Refresh:0; main.php');


            }
            else{
                echo "Wrong email or password";
            }
        }
    }

    $User = new User();
    if(isset($_POST['loginBtn'])){
        $email = $_POST['form-username'];
        $password = $_POST['form-password'];
        if(!empty($email) && !empty($password)){
            $encrypted_password = md5($password);
            $User -> user_Login($email, $encrypted_password);
        } else {
            echo "You must fill both fields";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>EasePay Site</title>

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="css/form-elements.css">
        <link rel="stylesheet" href="css/style.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="ico/ic_epay_launcher.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="ico/ic_epay_launcher_114.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="ico/ic_epay_launcher_114.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="ico/ic_epay_launcher_72.png">
        <link rel="apple-touch-icon-precomposed" href="ico/ic_epay_launcher_57.png">

    </head>

    <body>

        <!-- Top content -->
        <div class="top-content">
        	
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <h1><strong>EasePay</strong> Login </h1>
                            <div class="description">
                            	<p>
	                            	Welcome Admin!
                            	</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                        	<div class="form-top">
                        		<div class="form-top-left">
                        			<h3>Login</h3>
                            		<p>Enter your username and password to log on:</p>
                        		</div>
                        		<div class="form-top-right">
                        			<i class="fa fa-lock"></i>
                        		</div>
                            </div>
                            <div class="form-bottom">
			                    <form role="form" action="" method="post" class="login-form">
			                    	<div class="form-group">
			                    		<label class="sr-only" for="form-username">Username</label>
			                        	<input type="text" name="form-username" placeholder="Username..." class="form-username form-control" id="form-username">
			                        </div>
			                        <div class="form-group">
			                        	<label class="sr-only" for="form-password">Password</label>
			                        	<input type="password" name="form-password" placeholder="Password..." class="form-password form-control" id="form-password">
			                        </div>
			                        <button name="loginBtn" type="submit" class="btn">Sign in!</button>
			                    </form>
		                    </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            
        </div>


        <!-- Javascript -->
        <script src="js/jquery-1.11.1.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="js/jquery.backstretch.min.js"></script>
        <script src="js/scripts.js"></script>
        
        <!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
        <![endif]-->

    </body>

</html>