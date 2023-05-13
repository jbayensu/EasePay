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
      <?php include('connection.php');
        $limit = 8;
        if(isset($_GET["page"])){$page = $_GET["page"];} else{$page = 1;};
        $start_from = ($page - 1) * $limit;
      ?>

   		<!--Start Jumbotron-->
        <div class="jumbotron">
            <div class="container">
                <center><h1>Activities Logs</h1>
                </div>
            </div><!--End Jumbotron-->  

        <div class="container">
        <form action="" method="POST">
        <div class="row">
          <div class="col-md-12">
              <div class="panel panel-warning">
                  <div class="panel-heading">
                    <h3 class="panel-title">Logs</h3>
                  </div>
                  <div class="panel-body">
                    <div class="row table-responsive">
                      <div class="col-md-12">

                     <table id="example2" class="table table-striped table-bordered table-hover">
                      <thead>
                        <tr>
                          <!--<th>Log ID</th>-->
                          <th>User ID</th>
                          <th>Date</th>
                          <th>Time</th>
                          <th>Activity</th>
                        </tr>
                      </thead>
                      <tbody>
  <?php
    $query = "select * from logtb order by logid DESC";
    $result = mysqli_query($connection, $query);
    
    if(mysqli_num_rows($result)>0){
        while ($row = mysqli_fetch_assoc($result)){
          
  ?>

              <tr>
                <!--<td><?php echo $row['logid'];?></td>-->
                <td><?php echo $row['userid'];?></td>
                <td><?php echo $row['logdate'];?></td>
                <td><?php echo $row['logtime'];?></td>
                <td><?php echo $row['activity'];?></td>
              </tr>
<?php } } ?>
</tbody>
<tfoot>
<tr>
    <th>User ID</th>
    <th>Date</th>
    <th>Time</th>
    <th>Activity</th>
  </tr>
  
</tfoot>
                      </table>
                      <nav>
                      <ul class="pagination">
<?php
  /*$query = "select count(logid) from logtb";
  $result = mysqli_query($connection, $query);
  $row = mysqli_fetch_assoc($result);
  $total_records = $row['count(logid)'];
  $total_pages = ceil($total_records / $limit);
  if($total_pages>0){
  for($i=0; $i<=$total_pages; $i++){
*/?>

    
        <!--<li><a href="viewLogs.php?page=<?php echo $i+1;?>"><?php echo $i+1;?></a></li>-->
    

<?php
  /*}
}*/
?>
  
</ul>
</nav>
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