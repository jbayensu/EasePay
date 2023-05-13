<?php require_once 'WebParts/WebControl.php';?>
<!DOCTYPE html>
<html>
    
   <head>

      <?php require_once 'WebParts/headerlinks.php';?>
      <link href="../plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css"/>
    
   </head>
   <body>
      <?php require_once 'WebParts/navbar.php';?>
      <?php require_once 'WebParts/sidebar.php';?>
      <?php include('connection.php');
        
          
          if(isset($_GET['activate'])){
           $query = "UPDATE merchanttb set status = 1 where merchantid = '{$_GET['activate']}'";
           if(mysqli_query($connection, $query)){header('Refresh:0; ViewMerchants.php');}
          }else if(isset($_GET['deactivate'])){
           $query = "UPDATE merchanttb set status = 0 where merchantid = '{$_GET['deactivate']}'";
           if(mysqli_query($connection, $query)){header('Refresh:0; ViewMerchants.php');}
          }

          if(isset($_GET["page"])){$page = $_GET["page"];} else{$page = 1;};
        
    ?>
      <!--Start Jumbotron-->
        <div class="jumbotron">
            <div class="container">
                <center><h1>Registered Merchant List</h1>
                </div>
            </div><!--End Jumbotron-->  

        <div class="container">
        <form action="" method="POST">
        <div class="row">
          <div class="col-md-12">
              <div class="panel panel-warning">
                  <div class="panel-heading">
                    <h3 class="panel-title">Merchants</h3>
                  </div>
                  <div class="panel-body">
                    <div class="row table-responsive">
                      <div class="col-md-12">

                     <table id="example2" class="table table-striped table-bordered table-hover">
                     <thead>
                      <tr>
                        <th style="width: 20px;">ID</th>
                        <th style="width: 100px;">User's ID</th>
                        <th style="width: 400px;">Name</th>
                        <th style="width: 50px;">Pic</th>
                        <th style="width: 180px;">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                        $query = "select merchantid, userid, name, status from merchanttb order by if(status = '1',1,2)";
                        $result = mysqli_query($connection, $query);
                        $dir = "../images";
                        
                        if(mysqli_num_rows($result)>0){
                            while ($row = mysqli_fetch_assoc($result)) {
                            $id = $row['merchantid'];
                            $pic = $id.".JPG";
                              
                    ?>

                        <tr>
                          <td ><?php echo $id; ?></td>
                          <td><?php echo $row['userid']; ?></td>
                          <td><?php echo $row['name'] ; ?></td>
                          <td><?php echo "<img src='$dir/$pic' style='width:40px; height: 40px;'>"; ?></td>
                          <td>
                            <!--<a href="#" class="btn btn-primary" style="width: 80px;">Edit</a>-->
                            <?php 
                              if($row['status'] == 0){
                            ?>
                                <a href="ViewMerchants.php?activate=<?php echo $id?>" class="btn btn-primary" style="width: 80px;">Activate</a>
                            <?php
                              }else{
                            ?>
                                <a href="javascript:;" id="ViewMerchants.php?deactivate=<?php echo $id?>" class="btn btn-warning item-deactivate" style="width: 80px;">Deactivate</a>
                            <?php
                              }
                            ?>
                            <a href="AddMerchant.php?edit=<?php echo $id?>" class="btn btn-success" style="width: 80px;">Edit</a>
                            
                          </td>
                        </tr>
                    <?php
                      }
                    }
                    ?>
                    </tbody>
                    <tfoot>
                       <tr>
                          <th >ID</th>
                          <th >User's ID</th>
                          <th >Name</th>
                          <th >Pic</th>
                          <th >Action</th>
                        </tr>
                    </tfoot>

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

        $(function(){
          $('.item-deactivate').click(function(){
            var id=$(this).attr('id');
            if(confirm('Do you want to deactivate this user?')){

              window.location.href=id;
            }
            
          })
          
        })

 </script>
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