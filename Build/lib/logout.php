<?php
	session_start();
	unset($_SESSION['login']);
	unset($_SESSION['num_podsk']);
	unset($_SESSION['nepokaz']);
	unset($_SESSION['password']);
	session_unset();
	header("Location: /");
?>