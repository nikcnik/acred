<?php 
include 'class/db.php';
include 'class/upload.php';

if (isset($_POST['id'])) {
	$id = $_POST['id'];

	$upload = new upload();
	$upload->rmvUpload($id);
}

?>