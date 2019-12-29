<?php 
session_start();
include "class/db.php";
include "class/user.php";

$user = new User();

if (isset($_POST['name']) && isset($_POST['valCode']) && isset($_SESSION['userId']) ) {
	$name = trim($_POST['name'],' ');
	$code = trim($_POST['valCode'],' ');
	$uId  = $_SESSION['userId'];
	if (!empty($name) && !empty($code) ) {
		echo $user->editName($uId,$name,$code);
	}
} elseif (isset($_POST['username']) && isset($_POST['valCode']) && isset($_SESSION['userId']) ) {
	$uname = trim($_POST['username'],' ');
	$code = trim($_POST['valCode'],' ');
	$uId  = $_SESSION['userId'];
	if (!empty($uname) && !empty($code) ) {
		echo $user->editUname($uId,$uname,$code);
	}
} elseif (isset($_POST['npassword']) && isset($_POST['rnpassword']) && isset($_POST['valCode']) && isset($_SESSION['userId']) ) {
	if (strlen($_POST['npassword'])>=6 && strlen($_POST['rnpassword'])>=6) {
		if ($_POST['npassword']==$_POST['rnpassword']) {
			$pass = password_hash( $_POST['npassword'] , PASSWORD_DEFAULT); //HASH PASSWORD
			$code = trim($_POST['valCode'],' ');
			$uId  = $_SESSION['userId'];
			if (!empty($code) ) {
				echo $user->editPass($uId,$pass,$code);
			}
		} else {
			echo 3;
		}
	} else{ echo 2;}

} elseif (isset($_POST['contact']) && isset($_POST['valCode']) && isset($_SESSION['userId']) ) {
	$contact = trim($_POST['contact'],' ');
	$code = trim($_POST['valCode'],' ');
	$uId  = $_SESSION['userId'];
	if (!empty($contact) && !empty($code) ) {
		echo $user->editContact($uId,$contact,$code);
	}
} elseif (isset($_POST['email']) && isset($_POST['valCode']) && isset($_SESSION['userId']) ) {
	$email = trim($_POST['email'],' ');
	$code = trim($_POST['valCode'],' ');
	$uId  = $_SESSION['userId'];
	if (!empty($email) && !empty($code) ) {
		echo $user->editEmail($uId,$email,$code);
	}
}