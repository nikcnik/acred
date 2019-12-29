<?php 
session_start();
include "class/db.php";
include "class/upload.php";

if (isset($_FILES['file']) && isset($_POST['cnt_key']) && isset($_SESSION['userId']) ) {

	$name 		= $_FILES['file']['name'];
	$tmpName 	= $_FILES['file']['tmp_name'];
	$size 		= $_FILES['file']['size'];
	$error 		= $_FILES['file']['error'];
	$type 		= $_FILES['file']['type'];

	$ext	= explode('.', $name);
	$actualExt = strtolower(end($ext));

	$allowed = array('pdf');

	if (in_array($actualExt, $allowed)) {
		if ($error === 0) {
			if ($size < 50000000) {
				$fileNameNew = uniqid('', true).".".$actualExt;

				$fileDestination = '../docu/'.$fileNameNew;
				move_uploaded_file($tmpName, $fileDestination);

				$dbContentId = $_POST['cnt_key'];
				$dbUserId	= $_SESSION['userId'];
				$dbFileName = $name;
				$dbFileNameDestination = 'docu/'.$fileNameNew;

				$upload = new upload();

				$upload->uploadFile($dbContentId , $dbUserId , $dbFileName ,$dbFileNameDestination , $name );

				

			}else{
				echo "Your file is too big!";
			}
		} else{
			echo "There was an error uploading your file!";
		}
	} else {
		echo "Cannot upload this file type!";
	}


}
?>