<?php

session_start();
include "class/db.php";
include "class/notes.php";

if (isset($_POST['notes_cnt_id']) && isset($_POST['notes_input']) && isset($_SESSION['userId'])) {
	
	$notes = new notes();
	echo $notes->inputNotes($_SESSION['userId'] , $_POST['notes_cnt_id'], $_POST['notes_input']);
	//echo $_POST['comments_cnt_id']." ".$_POST['comments_input'];	
} elseif (isset($_POST['note_cnt_id']) && isset($_SESSION['userId'])) {
	$notes = new notes();
	echo $notes->viewNotes($_SESSION['userId'] , $_POST['note_cnt_id']);
}

?>