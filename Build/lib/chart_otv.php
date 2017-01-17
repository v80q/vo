<?
	require_once "function.php";
	require_once "counters.php";
	if($_POST['vopr']) {
		$vopr_id=(int)$_POST['vopr'];
	}
	if($_POST['user_o']) {
		$user_o=(int)$_POST['user_o'];
	}
	if($_POST['user_v']) {
		$user_v=(int)$_POST['user_v'];
	}
	if($_POST['user_all']) {
		$user_all=(int)$_POST['user_all'];
	}
	$mysqli = connectDB();
	$sql = "SELECT * FROM o_v WHERE id > 0";
	if($vopr_id) {
		$sql .= " AND id_vopr = ".$vopr_id." ";
		$sql .= " ORDER by date_add ASC";
		$result = $mysqli->query($sql);
		closeDB($mysqli);
		$data = GetGChartsOtvV($result);
	}
	if($user_o) {
		$sql .= " AND id_vopr NOT IN(SELECT id FROM v_v WHERE id_user='".$user_o."') AND id_user = ".$user_o;
		$sql .= " ORDER by date_add ASC";
		$result = $mysqli->query($sql);
		closeDB($mysqli);
		$data = GetGChartsOtvU($result);
	}
	if($user_v) {
		$sql .= " AND id_vopr IN(SELECT id FROM v_v WHERE id_user='".$user_v."') ";
		$sql .= " ORDER by date_add ASC";
		$result = $mysqli->query($sql);
		closeDB($mysqli);
		$data = GetGChartsOtvUO($result);
	}
	if($user_all) {
		$sql .= " AND id_vopr IN(SELECT id FROM v_v WHERE id_user='".$user_all."') OR id_user = ".$user_all;
		$sql .= " ORDER by date_add ASC";
		$result = $mysqli->query($sql);
		closeDB($mysqli);
		$data = GetGChartsOtvUALL($result,$user_all);
	}
	echo $data;
?>
