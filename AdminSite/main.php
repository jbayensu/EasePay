<?php 
require_once 'WebParts/WebControl.php';

?>

<!DOCTYPE html>
<html>
    
   <head>
        <?php require_once 'WebParts/headerlinks.php'; ?>
   </head>
   
   <body>
   <!--Start Heading/Navigation bar-->
        <?php require_once 'WebParts/navbar.php' ; ?>
        <?php require_once 'WebParts/sidebar.php' ; ?>
        
        <!--Start body-->
            <!--Start Jumbotron-->
        <div class="jumbotron">
            <div class="container" >
                <center><h1>Welcome to EasePay!</h1>
                </div>
            </div><!--End Jumbotron-->           
        </div>

        <div class="container" style="min-height: 420px; background-color: white; padding-top: 20px;">
            <div class="row">
                <div class="col-md-12 col-color">
                    <div class="form-group">
                        <div class="row" >
                            <div class="col-md-3 col-md-offset-3">
                                <a href="AddMerchant.php" class="btn btn-primary form-control" style="height: 120px; text-align: center; font-size: 25px;"><span class="glyphicon glyphicon-plus-sign"></span><br>Add Merchants</a><br/><br/>
                                <a href="ViewMerchants.php" class="btn btn-info form-control" style="height: 120px; text-align: center; font-size: 25px;"><span class="glyphicon glyphicon-eye-open"></span><br>View Merchants Lists</a><br/><br/>
                            </div>
                            <div class="col-md-3">
                                <a href="ViewUsers.php" class="btn btn-success form-control" style="height: 120px; text-align: center; font-size: 25px;"><span class="glyphicon glyphicon-user"></span><br>View Users Lists</a><br/><br/>
                                <a href="ViewTransactions.php" class="btn btn-warning form-control" style="height: 120px; text-align: center; font-size: 25px;"><span class="glyphicon glyphicon-eye-open"></span><br>View Transaction List</a><br/><br/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-md-offset-4">
                                <a href="ViewLogs.php" class="btn btn-primary form-control" style="height: 120px; text-align: center; font-size: 25px;"><span class="glyphicon glyphicon-eye-open"></span><br>View Logs</a>
                            </div> 
                        </div>
                    </div>
                </div>   
            </div>
            
        </div><!--End Body-->





        <!--Start Footer-->
       <?php require_once 'WebParts/footer.php'; ?>
        

        <!--Start About Modal-->
        <div class="modal fade" id="About" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <p>About Us</p>
                    </div>
                    <div class="modal-body">
                        <p>It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. A 2015 Production</p>
                        <p>Version 1.0</p>
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-primary" data-dismiss="modal">Close</a>
                    </div>
                </div>
            </div>        
        </div><!--End About Modal-->



    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->
        <?php require_once 'WebParts/pageScripts.php'; ?>
   </body>
    
</html>