<?php
    include('connection.php');

    if(isset($_POST['logoutbtn'])){
        $query = "insert into logtb (userid, logdate, logtime, activity) values ('Admin', (select curdate()), (select curtime()),'Logged out')";
        mysqli_query($connection, $query);
        logout();
    }
    function logout(){
        unset($_SESSION['userid']);
        header("Location:../AdminSite/index.php");
    }
?>
        
<form action="" method="POST" enctype="multipart/form-data">
        <nav class="navbar navbar-default navbar-fixed-top no-margin no-padding" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navHeaderCollapse">
                        <span class="sr-only">toggle navigation</span>
                        <span class="glyphicon glyphicon-envelope"></span>
                    </button>
                    <a id="menu-toggleMb" href="#" class="btn btn-default startButton"><span class="glyphicon glyphicon-menu-hamburger"></span></a>
                    <img alt="Brand" src="ico/ic_epay_launcher.png" style="margin-left:50px;">
                    
                </div>
                
                <div class="collapse navbar-collapse navHeaderCollapse">
                    <ul class="nav navbar-nav navbar-right" style="margin-right: 40px; color:white;">
                    <li>
                        <a href="Messages.php" style="color:white; text-decoration: none;">
                            <span class="glyphicon glyphicon-envelope"  ></span>
                            <span id="message-menu" class="label label-success"></span> 
                        </a> </li>
                        <li>
                        <button type="submit" name="logoutbtn" class="btn btn-warning" style="color: white; margin-top: 10px;">Logout</button>
                    </li>
                    </ul>
                </div>
            </div>
            <div id="allMyMessages" class="hidden"></div>
        </nav><!--End Heading/Navigation bar-->
        </form>