<?php 
session_start();
include "class/db.php";
include "class/upload.php";

if ( isset($_POST['new']) && isset($_POST['docu_id']) && isset($_POST['docu_state']) ) {
	if ($_POST['new'] == 'new') {
		$upload = new upload();
		echo $upload->switchStatus($_POST['docu_id'] , $_POST['docu_state'] , 'new');	
	}
}elseif ( isset($_POST['docu_id']) && isset($_POST['docu_state']) ) {
	
	$upload = new upload();
	echo $upload->switchStatus($_POST['docu_id'] , $_POST['docu_state']);
	//echo $_POST['docu_id']." ".$_POST['docu_state'];
	
}

?>