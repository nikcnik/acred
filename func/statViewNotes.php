<?php 
session_start();
include 'class/db.php';
include 'class/notes.php';

if ( isset($_POST['id']) && isset($_SESSION['userId']) ) {

	$id = $_POST['id'];
	$user = $_SESSION['userId'];

	$notes = new notes();
	echo $notes->changeNotiStat($user ,$id);	

}
