<?php require_once 'WebParts/WebControl.php';?>

<!DOCTYPE html>
<html>
    
   <head>

   		<?php require_once 'WebParts/headerlinks.php' ; ?>
      <link href="../plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css"/>
   	
   </head>
   <body>
   		<?php require_once 'WebParts/navbar.php' ; ?>
      <?php require_once 'WebParts/sidebar.php' ; ?>
      <?php include('connection.php');?>
   		<!--Start Jumbotron-->
        <div class="jumbotron">
            <div class="container">
                <center><h1>Registered Users List</h1>
                </div>
            </div><!--End Jumbotron-->  

        <div class="container">
        <form action="" method="POST">
        <div class="row">
          <div class="col-md-12">
              <div class="panel panel-warning">
                  <div class="panel-heading">
                    <h3 class="panel-title">Users</h3>
                  </div>
                  <div class="panel-body">
                    <div class="row table-responsive">
                      <div class="col-md-12">

                     <table id="example2" class="table table-striped table-bordered table-hover">
                     <thead>
                      <tr>
                        <th>ID</th>
                        <th>Full Name</th>
                        <th>Phone Number</th>
                        <th>Email</th>
                        <th>Pic</th>
                        <th>Action</th>
                      </tr>
                      </thead>
                      <tbody>

<?php
    $query = "select id, fname, mname, lname, tel, email, ActiveStatus from usertb order by if(ActiveStatus = '1',1,2)";
    $result = mysqli_query($connection, $query);
    $dir = "../images";
    
    if(mysqli_num_rows($result)>0){
        while ($row = mysqli_fetch_assoc($result)) {
        $pic = $row['id'].".JPG";
        $id = $row['id'];
          
  ?>

              <tr>
                <td><?php echo $id; ?></td>
                <td><?php echo $row['fname'] . " " . $row['mname'] . " " . $row['lname']; ?></td>
                <td><?php echo $row['tel']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo "<img src='$dir/$pic' style='width:40px; height: 40px;'>"; ?></td>
                <td>
                  <!--<a href="#" class="btn btn-primary" style="width: 80px;">Edit</a>-->
                  <?php 
                    if($row['ActiveStatus'] == 0){
                      echo '<a href="ViewUsers.php?activate='. $id. '" class="btn btn-primary" style="width: 80px;">Activate</a>';
                    }else{
                      echo '<a href="javascript:;" id="ViewUsers.php?deactivate='. $id. '" class="btn btn-warning item-deactivate" style="width: 80px;">Deactivate</a>';
                    }
                  ?>
                  
                </td>
              </tr>
<?php
      }
    }

    if(isset($_GET['activate'])){
       $query = "UPDATE usertb set ActiveStatus = 1 where id = '{$_GET['activate']}'";
       $result = mysqli_query($connection, $query);
    }else if(isset($_GET['deactivate'])){
       $query = "UPDATE usertb set ActiveStatus = 0 where id = '{$_GET['deactivate']}'";
       $result = mysqli_query($connection, $query);
    }

  

?></tbody>

              </table>
                  </div>
              </div>
          </div>
        </div>
</div>
</div>
</form>
</div>




      <?php require_once 'WebParts/footer.php'; ?>
      <?php require_once 'WebParts/pageScripts.php'; ?><script src="../plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
      <script src="../plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
      <script>
        $(function() {
                $("#example1").dataTable({
                    
                });
                $('#example2').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": true,
                    "bSort": false,
                    "bInfo": true,
                    "bAutoWidth": true
                });
        });
      </script>
      <script>

        $(function(){
          $('.item-deactivate').click(function(){
            var id=$(this).attr('id');
            if(confirm('Do you want to deactivate this user?')){

              window.location.href=id;
            }
            
          })
          
        })

 </script>
   </body>

</html>