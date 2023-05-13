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
                <center><h1>Transaction List</h1>
            </div>
        </div><!--End Jumbotron-->  

        <div class="container">
        <form action="" method="POST">
        <div class="row">
          <div class="col-md-12">
              <div class="panel panel-warning">
                  <div class="panel-heading">
                    <h3 class="panel-title">Transactions</h3>
                  </div>
                  <div class="panel-body">

                    <div class="row table-responsive">
                      <div class="col-md-12">

                     <table id="example2" class="table table-striped table-bordered table-hover">
                     <thead>
                      <tr>
                        <th >ID</th>
                        <th >From</th>
                        <th >To</th>
                        <th >Description</th>
                        <th >Method</th>
                        <th >Amount</th>
                        <th >Date</th>
                        <th >Notified</th>
                        <th >Remark</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                        $query = "select * from transactiontb order by transactionId desc";
                        $result = mysqli_query($connection, $query);
                        
                        if(mysqli_num_rows($result)>0){
                            while ($row = mysqli_fetch_assoc($result)) {
                              
                    ?>

                        <tr>
                          <td ><?php echo $row['transactionId'] ?></td>
                          <td><?php echo $row['fromUserId']; ?></td>
                          <td><?php echo $row['toUserId'] ; ?></td>
                          <td><?php echo $row['description'] ; ?></td>
                          <td><?php echo $row['paymentMethod'] ; ?></td>
                          <td><?php echo $row['amount'] ; ?></td>
                          <td><?php echo $row['transactionDate'] ; ?></td>

                          <td><?php
                            if($row['notificationStatus'] == 1){
                             echo  "sent"; 
                            }else{
                              echo  "not sent";
                            }
                          ?></td>
                          <td><?php
                            if($row['successStatus'] == 1){
                            echo "successful" ; 
                          }else{
                            echo "failed" ; 
                          }
                          ?></td>
                                                      
                    </tbody>
                    <?php
                      }
                    }
                    ?>
                    
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