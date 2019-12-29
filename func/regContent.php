<?php 
include 'class/db.php';
include 'class/content.php';
session_start();
$cons = new constant();

if (isset($_POST['aCode'])&&isset($_POST['aTitle'])) {
	
	$code = trim($_POST['aCode']);
	$title = trim($_POST['aTitle']);
	
	if ($code!=''&&$title!='') {
		$cons->regArea( $code , $title );
		$_SESSION['adminTab'] = 'cntMan';
		exit();
	}
		

} elseif (isset($_POST['saArea'])&&isset($_POST['saTitle'])) {
	
	$area = trim($_POST['saArea']);
	$saTitle = trim($_POST['saTitle']);
	
	if ($area!=''&&$saTitle!='') {
		$cons->regSubA( $area , $saTitle );
		$_SESSION['adminTab'] = 'cntMan';
		exit();
	}

} elseif (isset($_POST['cASub'])&&isset($_POST['cCategory'])&&isset($_POST['cContent'])) {

	$sub_a = trim($_POST['cASub']);
	$categ = trim($_POST['cCategory']);
	$cont  = trim($_POST['cContent']);
	
	if ($sub_a!=''&&$categ!=''&&$cont!='') {
		$cons->regContent( $sub_a, $categ , $cont );
		$_SESSION['adminTab'] = 'cntMan';
		exit();
	}
		
} elseif (isset($_POST['uName'])&&isset($_POST['uId'])&&isset($_POST['uType'])&&isset($_POST['uArea'])) {
	
	$name = $_POST['uName'];
	$id = $_POST['uId'];
	$type = $_POST['uType'];
	$area = $_POST['uArea'];

	$cons->getUsers($name,$id,$type,$area);
	exit();
} elseif (isset($_POST['accMGetTable'])) {
	
}

?>