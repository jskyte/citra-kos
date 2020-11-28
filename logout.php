<?php
	session_start();
	$_SESSION['idUser']; 

	unset($_SESSION['idUser']);
	
	session_unset();
	session_destroy();
	
	header("location:login.php")
?>