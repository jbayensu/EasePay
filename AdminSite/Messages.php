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
              <h1>Messages from users</h1>
          </div>
      </div><!--End Jumbotron-->  

      <div class="container">
        <form action="" method="POST">
        <div class="row">
          <div class="col-md-7">
              <div class="panel panel-warning">
                  <div class="panel-heading">
                    <h3 class="panel-title">Messages</h3>
                  </div>
                  <div class="panel-body">

                  <div>
                     <table id="example2" class="table table-striped table-bordered table-hover">
                     <thead>
                      <tr>
                        <th>ID</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Date</th>
                        <th style="width: 10px;">Read</th>
                      </tr>
                      </thead>
                      <tbody>

<?php
  $query = "select messsageId, userid, email, subject, receivedDate, readStatus from messagerecievedtb order by receivedDate desc";
  $result = mysqli_query($connection, $query);
  $read = "";
  
  if(mysqli_num_rows($result)>0){
      while ($row = mysqli_fetch_assoc($result)) {
        if($row['readStatus'] == 0){
          $read = "UnRead";
        }else{
          $read = "read";
        }
        
?>

              <tr>
                <td><?php echo $row['userid']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><a href="messages.php?getmessageid=<?php echo $row['messsageId']?>" ><?php echo $row['subject']; ?></a></td>
                <td><?php echo $row['receivedDate']; ?></td>
                <td><?php echo $read; ?></td>
              </tr>
              
<?php
      }
    }

?>
</tbody>
</table>
                  </div>
              </div>
              </div>


                  </div>
              
<?php
  if(isset($_GET['getmessageid'])){
     $query = "UPDATE messagerecievedtb set readStatus = 1 where messsageId = '{$_GET['getmessageid']}'";
    $result = mysqli_query($connection, $query);
    $query = "select a.email, a.subject, a.message, concat(b.fname, ' ', b.mname, ' ', b.lname) 'FullName', b.tel from messagerecievedtb a join usertb b on a.userid = b.id where a.messsageId = '{$_GET['getmessageid']}'";
    $result = mysqli_query($connection, $query);
    if(mysqli_num_rows($result)>0){
     $row = mysqli_fetch_assoc($result);
   }

  }
?>

          <div class="col-md-5">
              <div class="panel panel-warning">
                  <div class="panel-heading">
                    <strong>From:&nbsp&nbsp&nbsp</strong><?php echo " " .$row['FullName'];?>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    <a class="btn btn-primary" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                      <span class="caret"></span>
                    </a><br><br>
                    <div class="collapse" id="collapseExample">
                      <div class="well">
                        <strong>Email:&nbsp&nbsp&nbsp</strong><?php echo " " .$row['email'];?></br>
                        <strong>Tel:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</strong><?php echo " " .$row['tel'];?>
                      </div>
                    </div>
                    <strong class="panel-title">Subject:&nbsp&nbsp&nbsp</strong>
                    <?php echo " ".$row['subject'];?>
                  </div>
                  
                  <div class="panel-body">
                    <h5>Message:</h5>
                    <?php echo $row['message'];?>

                  </div>
              </div>
          </div>
          </div>
          </form>
        </div>


      <?php require_once 'WebParts/footer.php'; ?>
      <?php require_once 'WebParts/pageScripts.php'; ?>
      <script src="../plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
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
      
   </body>

</html>