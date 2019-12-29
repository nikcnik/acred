<?php 	
if (isset($_POST['tab'])) {
	
	session_start();
	
	$tab = $_POST['tab'];

	if ($tab == '#reg-area') {
		$_SESSION['adminTab'] = 'accReg';		
	}elseif ($tab == '#accnt-mngr-area') {
		$_SESSION['adminTab'] = 'accMan';		
		
	}elseif ($tab == '#contnt-area') {
		$_SESSION['adminTab'] = 'cntMan';		
		
	}

}
?>