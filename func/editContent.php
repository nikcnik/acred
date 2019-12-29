<?php 
include 'class/db.php';
include 'class/content.php';

session_start();
$cons = new constant();

if (isset($_POST['area'])&&isset($_POST['type'])&&isset($_POST['userId'])&&isset($_POST['name'])) {
	$area 	= $_POST['area'];
	$type 	= $_POST['type'];
	$userId = $_POST['userId'];
	$name	= $_POST['name'];	
	$cons->editAreaUser( $area, $type, $userId, $name);
	$_SESSION['adminTab'] = 'accMan';
	exit();
} elseif (isset($_POST['cmdEdit'])) {
	$cons->accountManager();
	exit();
}

?>