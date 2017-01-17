<?
	session_start();
	require_once "fun.php";
	require_once "counters.php";
	if($_POST['id']) {$id=(int)$_POST['id'];}	
	$mysqli = connectDB();
	$sql = "SELECT * FROM v_v WHERE id=".$id;
	$result = $mysqli->query($sql);
	closeDB($mysqli);
	$question = getResult($result);
	echo json_encode(array('textv' => $question[0]['text'], 'own1' => $question[0]['otv1'], 'own2' => $question[0]['otv2'], 'own3' => $question[0]['otv3'], 'own4' => $question[0]['otv4']));
?>