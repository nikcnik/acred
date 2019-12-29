<?php 
include 'class/db.php';
include 'class/upload.php';

if ( isset($_POST['docu_name']) ) {

	$id = $_POST['docu_name'];
	$upload = new upload();
	echo $upload->changeNotiStat($id);	

}

?>	