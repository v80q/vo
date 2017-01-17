<?php
	include "function.php"; 
	session_start();
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		if($_SESSION["login"]) {	
			if($_SESSION['login']){
				$user_inf = GetInf($_SESSION["login"]);
				$user_id = (int)$user_inf['id'];
				if (isset($_POST['vopr_id'])) {
					$vopr_id = $_POST['vopr_id'];
					$prlk = (int)ProvLike($vopr_id, $user_id);
					if($prlk != 0) {
						echo "Вы уже голосовали!";
					} else {
						add_like($vopr_id);
						echo "success";
					}
				}
			}
		}
	}
?>