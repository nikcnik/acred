<?php 
session_start();
include "class/db.php";
include "class/upload.php";

if ( isset($_POST['cnt_key']) && isset($_SESSION['userId']) ) {
	
	$upload = new upload();
	$content = $_POST['cnt_key'];
	$user = $_SESSION['userId'];
	$user_type = $_SESSION['type'];

	//echo $content." ".$user;
	if ($user_type == '1') {
		$upload->uploadViewStaff($content);
	}elseif ($user_type == '2') {
		$upload->uploadViewEvaluator($content);
	}elseif ($user_type == '3') {
		$upload->uploadViewDean($content);
	}

}


?>