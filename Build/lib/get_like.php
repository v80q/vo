<?php
	include "function.php";
	session_start();

	if($_SERVER["REQUEST_METHOD"] == "POST") {
		if($_SESSION["login"]) {	
			if (isset($_POST['vopr_id'])) {
				$vopr_id = $_POST['vopr_id'];
				echo likeCound($vopr_id);
			}
		}
	}
?>