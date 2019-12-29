<?php 

include 'class/db.php';
include 'class/content.php';
session_start();
$cons = new constant();


$_SESSION['adminTab'] = 'cntMan';
if (isset($_POST['rmvT'])&&isset($_POST['rmvId'])) {
	$table = $_POST['rmvT'];
	$id    = $_POST['rmvId'];
	$cons->removeContent($table , $id);

	echo "$table";
}
?>