<?php
	
	$target_dir = "../images/";
	$target_file = $target_dir.basename($_FILES['filetoupload']['name']);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENTION);

	//Check if image file is an actual image of fake image.

	$Check = getimagesize($_FILES['filetoupload']['tmp_name']);
	if($Check != false){
		echo "File is an image - ".$Check['mime'].".'";
		$uploadOk = 1;
	} else{
		echo "File is not an image.";
		$uploadOk = 0;
	}	

	//check if file already exists.
	if(file_exists($target_file)){
		echo "Sorry, file already exists.";
		$uploadOk = 0;
	}

	//check file size
	if($_FILES['filetoupload']['size']>500000){
		echo "Sorry, your file is too large.";
		$uploadOk = 0;
	}

	//Allow a certain file formats
	if($imageFileType !='jpg' && $imageFileType != 'png' && $imageFileType!='jpeg' &&$imageFileType!='gif'){
		echo "sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		$uploadOk = 0;
	}

	//check if uploadOk is set to 0 by an error
	if($uploadOk == 0){
		echo "Sorry your file was not uploaded.";
	}else{
		if(move_uploaded_file($_FILES['filetoupload']['tmp_name'], $target_file)){
			echo "the file ". basename($_FILES['filetoupload']['name']). " has been uploaded.";
		}else{
			echo "Sorry, there was an error uploading your file.";
		}
	}


?>