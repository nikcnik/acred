<?php 
session_start();

include "class/db.php";
include "class/user.php";

$newUser = new User();

if (isset($_POST['verCode'])&&isset($_POST['userId'])) {
	$id   = $_POST['userId'];
	$code = trim($_POST['verCode']);
	if ($code!='') {
		$result = $newUser->verCode($id,$code);
		if ($result=='ok') {
			$_SESSION['userStat'] = 2;
		}

		exit();
	}
}elseif (isset($_POST['id'])&&isset($_POST['user'])&&isset($_POST['nPass'])&&isset($_POST['rnPass'])&&isset($_POST['address'])&&isset($_POST['contact'])&&isset($_POST['email'])) {
	
	$id 		= $_POST['id'];
	$user 		= $_POST['user'];
	$nPass 		= $_POST['nPass'];
	$rnPass 	= $_POST['rnPass'];
	$address 	= $_POST['address'];
	$contact 	= $_POST['contact'];
	$email 		= $_POST['email'];

	$result = $newUser->preRegNewData($id, $user, $nPass, $rnPass, $address, $contact, $email);
	if ($result=='success') {
		$_SESSION['userStat']=1;
	}
	echo $result;
}

?>