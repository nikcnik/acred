<?php 

include 'class/db.php';
include 'class/user.php';
session_start();

if (isset($_POST['name']) && isset($_POST['user']) && isset($_POST['utype']) ) {
	
	$name = $_POST['name'];
	$user = $_POST['user'];
	$type = $_POST['utype'];
	$area = $_POST['area'];

	$reg = new User();
	$reg->regUser ( $name , $user , $type , $area );
	$_SESSION['adminTab'] = 'accReg';
}else{
	header("Location: ../admin.php?kulang");
}

?>