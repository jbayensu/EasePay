<?php

if(isset($_POST['payerId'], $_POST['orderId'])){
	$json['success'] = "success";
	echo json_encode($json);
}else if(isset($_POST['orderId'])){
	$json['totalAmount'] = "12";
	echo json_encode($json);
}

?>