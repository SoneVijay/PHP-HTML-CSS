<?php
//start session
session_start();

//check session
if(!isset($_SESSION['username'])){
	header('location:log_in.php');
}

?>
