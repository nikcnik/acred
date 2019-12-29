<?php 
session_start();
include "class/db.php";
include "class/rate.php";

if (isset($_POST['self_rate']) && isset($_POST['s_cnt_id'])) {
	$newRate = new rate();

	$newRate->self_rate($_POST['s_cnt_id'],$_POST['self_rate']);

}elseif (isset($_POST['eval_rate']) && isset($_POST['e_cnt_id'])) {
	$newRate = new rate();

	$newRate->eval_rate($_POST['e_cnt_id'],$_POST['eval_rate']);
}

?>