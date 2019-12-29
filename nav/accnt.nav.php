<?php
session_start();

include 'class/db.php';
include 'class/user.php';
include 'class/viewuser.php';

$username = $_POST['user'];
$password = $_POST['pass'];

$login = new User();
$login->userLogin($username,$password); 


?>