<?php 
session_start();

if (isset($_SESSION['type'])) {
  if ($_SESSION['type']=='1') {
    header("Location: ../staff.php");
  }elseif($_SESSION['type']=='2'){
    header("Location: ../evaluator.php");
  }elseif($_SESSION['type']=='3'){
    header("Location: ../dean.php");
  }elseif($_SESSION['type']=='4'){
    header("Location: ../admin.php");
  }
}else{
	header("Location: ../../accred/");
}
?>