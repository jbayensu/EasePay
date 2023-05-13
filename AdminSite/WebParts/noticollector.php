<?php
//session_start();
include('../connection.php');

//$totalNotification=0;

$query = "select count(*) from messagerecievedtb where readStatus = '0'";

$row = mysqli_fetch_assoc(mysqli_query($connection, $query));

$totalNotification= $row['count(*)'];

if($totalNotification ===0){?>
	<div id="notiData"></div>
<?php }else{ ?>
	<div id="notiData"><?php echo $totalNotification; ?></div>
<?php }

 ?>



