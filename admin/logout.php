<?php
include 'includes/config.php';
session_start();
// if ($_SESSION['user'] != '' || !empty($_SESSION['user'])) 
	$_SESSION['user'] ='';
	unset($_SESSION['user']);
	session_destroy();
	header('location:..\index.php');
	

?>