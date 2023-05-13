<?php
	$connect = mysqli_connect('192.168.201.1', 'root', '', 'oag') or die("Erro connection...");

	$query = "Select * from ordertable";
	$row = mysqli_fetch_assoc(mysqli_query($connect, $query));
	$json['product id'] = $row['product_id'];

	echo json_encode($json);
	mysqli_close($connect);
?>