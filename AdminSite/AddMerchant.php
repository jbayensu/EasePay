
<?php 

require_once '../Connection.php';
require_once 'WebParts/WebControl.php';
include('connection.php');

        $myid = "0";
        $merchantid = "";
        $id = "";
        $name= "";
        $userid = "";
        $paymenttype= "";
        $dblink= "";
        $status = "0";
        $image = "icon-user.png";

    class User {
        private $db;
        private $connection;

        function __construct(){
            
            $this->db = new DB_Connection();
            $this->connection = $this->db->get_connection();

        }
        
        public function Add_merchant($id, $name, $paymenttype, $dblink, $status){

            $query = "INSERT into merchanttb (userid, name, paymenttype, dblink, status) values ('$id', '$name', '$paymenttype', '$dblink', '$status')";
            $is_inserted = mysqli_query($this->connection, $query);
           
           if($is_inserted == 1){
              echo "success";  
            }
            else{
                echo "error";
            }
        }

        
    }

    $User = new User();
    
    if(isset($_POST['Addbtn'], $_FILES['logo'])){
        $id = $_POST['userid'];
        $name= $_POST['merchname'];
        $paymenttype= $_POST['paymenttype'];
        $dblink= $_POST['dblink'];
        $status = $_POST['status'];
        $error = array();
        $myid = $_POST['txId'];
        
        $image_name = $_FILES['logo']['name'];
        $image_size = $_FILES['logo']['size'];
        $image_tmp = $_FILES['logo']['tmp_name'];
        $image_type = $_FILES['logo']['type'];
        $image_ext = strtolower(end(explode('.',$_FILES['logo']['name'])));

        $expensions = array("jpeg", "jpg", "png");
        

        if(!empty($name) && !empty($paymenttype) && !empty($dblink) && $paymenttype != "choose the type of payment"){
          if($myid == "0"){
            $User -> Add_merchant($id, $name, $paymenttype, $dblink, $status);

          $query = "select merchantid from merchanttb limit 1";
          $row = mysqli_fetch_assoc(mysqli_query($connection, $query));
          $imgName = $row['merchantid'];
            
                
        

        if(in_array($image_ext, $expensions)===false){
          $error[]="extention not allowed, please choose a JPEG or PNG file.";
        }

        if($image_size > 2097152){
          $error[]="file must be less or equal to 2 mb.";
        }

        if(empty($error) == true){
          move_uploaded_file($image_tmp, "../images/".$imgName.".jpg");
          echo "success";
        }else{
          print_r($error);
        }
  
        $myid = 0;
        $id = "";
        $name= "";
        $userid = "";
        $paymenttype= "";
        $dblink= "";
        $status = "0";
        $image = "icon-user.png";

  }else{
    //echo "here";
    $query = "update merchanttb set userid = '$id', name = '$name', paymenttype = '$paymenttype', dblink = '$dblink', status = '$status' where merchantid = '$myid'";
    //echo $myid . " " . $id . " " . $name . " " . $paymenttype . " " . $dblink . " " . $status . " " . $image_ext;
    
    
        if(in_array($image_ext, $expensions)===false){
          $error[]="extention not allowed, please choose a JPEG or PNG file.";
          echo $expensions;
        }

        if($image_size > 2097152){
          $error[]="file must be less or equal to 2 mb.";
        }

        if(empty($error) == true){
          move_uploaded_file($image_tmp, "../images/".$myid.".jpg");
          //echo "success";
        }else{
          print_r($error);
        }
        if(mysqli_query($connection, $query)){
      //echo "updated";
        $myid = 0;
        $id = "";
        $name= "";
        $userid = "";
        $paymenttype= "";
        $dblink= "";
        $status = "0";
        $image = "../images/icon-user.png";}else{echo "not updated";}
        header('Refresh:0; ViewMerchants.php');
    
  }

  } else {
            echo "You must fill the required fields";
        }
}


    if(isset($_GET['edit'])){
    $query = "select * from merchanttb where merchantid='{$_GET['edit']}'";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($result);
    
    $name= $row['name'];
    $id = $row['userid'];
    $paymenttype= $row['paymenttype'];
    $dblink= $row['dblink'];
    $status = $row['status'];
    $myid = $row['merchantid'];
    $image = $myid.".jpg";
    
    
  }

?>

<!DOCTYPE html>
<html>
    
   <head>

   		<?php require_once 'WebParts/headerlinks.php' ; ?>
   	
   </head>
   <body>
   		<?php require_once 'WebParts/navbar.php' ; ?>
      <?php require_once 'WebParts/sidebar.php' ; ?>
 

   		<!--Start Jumbotron-->
      <div class="jumbotron">
          <div class="container">
              <center><h1>Add Merchant to EasePay!</h1>
              <center><h5> A merchant should first be registered as regular Ease pay user</h5>
          </div>
      </div><!--End Jumbotron-->  

      <div class="container" style="min-height: 420px;">

        <form action="" method="POST" enctype="multipart/form-data">
        <div class="row">
          <div class="col-md-8">
              <div class="panel panel-warning">
                  <div class="panel-heading">
                    <h3 class="panel-title">Merchant Information</h3>

                  </div>
                      <div class="panel-body">
                          <div class="form-group">  
                              <input type="hidden" name="txId" value="<?php echo $myid; ?>"></input>                            
                              <input type="text" name="userid" class="form-control" value="<?php echo $id; ?>" placeholder="User's Id"></inp ut><br>
                              <input type="text" name="merchname" required="" class="form-control" value="<?php echo $name; ?>" placeholder="Merchant's Name"></input><br>
                              <select type="text" name="paymenttype" required="" class="form-control" value="<?php echo $paymenttype; ?>" >
                                <option>choose the type of payment</option>
                                <option>full</option>
                                <option>part</option>
                              </select><br>
                              <input type="text" name="dblink" class="form-control" value="<?php echo $dblink; ?>" placeholder="database link"></input><br>
                              <div class="checkbox" name="status">
                                  <label>
                                      <input type="hidden", name="status" value="0"/>
                                      <input type="checkbox" name="status" value="1">Active Status</input><br>
                                  </label>
                              </div>
                          </div>
                      </div>
              </div>
          </div>

          <div class="col-md-4">
              <div class="panel panel-warning">
                  <div class="panel-heading">
                    <h3 class="panel-title">Merchant Logo</h3>
                  </div>
                  <div class="panel-body" >
                    <img id="logoa" src="<?php echo "../images/" . $image?>" alt="myImage" style="margin-left:19%; width: 200px; height: 200px;"><br><br>
                    <label for="inputId" class="btn btn-warning form-control">browse</label>
                    <input id="inputId" type="file" value="<?php echo "../images/" . $image?>" name='logo' style="position: fixed; top: -100em;" ></input>
                  </div>
              </div>
                  
          </div>
          
            <input type="submit" name="Addbtn" value="Add" class="btn btn-warning form-control"></input><br>
          </div>
        </form>
    </div>


   		<?php require_once 'WebParts/footer.php'; ?>
   		<?php require_once 'WebParts/pageScripts.php'; ?>
      <script>
          function readURL(input){
            if(input.files && input.files[0]){
              var reader = new FileReader();

              reader.onload = function(e){
                $('#logoa').attr('src', e.target.result);
              }
              reader.readAsDataURL(input.files[0]);
            }
          }

          $("#inputId").change(function(){
            readURL(this);
          })
      </script>
   </body>

</html>