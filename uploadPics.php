<?php 
	
	$name = $_POST["name"];
	$image = $_POST["image"];

	$decodeImage = base64_decode("$image");
	file_put_contents("images/" . $name . ".JPG", $decodeImage);
	header('Content-Type: bitmap; charset=utf8');
	echo "success";


?>