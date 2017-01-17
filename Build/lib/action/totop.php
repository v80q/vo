<?
	session_start();
	require_once "/home/u435735/xn--80adsajtfqq.xn--80asehdb/www/lib/function.php";
	require_once "/home/u435735/xn--80adsajtfqq.xn--80asehdb/www/lib/counters.php";
	if($_SESSION['login']) {
		$id_u = GetLogP($_SESSION['login']);
	}
	else $id_u[0]['ochk']=0;
	$mysqli = connectDB();
	$sql = "SELECT id,login,ochk,image FROM u_v WHERE nstdl = '0' AND image IS NOT NULL ";
	$sql .= "AND id IN(SELECT DISTINCT id_user FROM o_v) ";
	$sql .= "AND ochk > ".$id_u[0]['ochk']." ";
	$sql .= "ORDER by ochk ASC LIMIT 0,5";	
	$result = $mysqli->query($sql);
	closeDB($mysqli);
	$result=getResult($result);
	if($result) {
		for ($x=0;$x<count($result);$x++) {
			$result[$x] += ['pos'=>RatingLogg($result[$x]['id'])];
		}
		$userUp = array_reverse($result, true);
	}
	$mysqli = connectDB();
	$sql2 = "SELECT id,login,ochk,image FROM u_v WHERE nstdl = '0' AND image IS NOT NULL  ";
	$sql2 .= "AND id IN(SELECT DISTINCT id_user FROM o_v) ";
	$sql2 .= "AND ochk < ".$id_u[0]['ochk']." ";
	$sql2 .= "ORDER by ochk DESC LIMIT 0,5";	
	$result2 = $mysqli->query($sql2);
	closeDB($mysqli);
	$userD = getResult($result2);
	if($userD) {
		for ($x=0;$x<count($userD);$x++) {
			$userD[$x] += ['pos'=>RatingLogg($userD[$x]['id'])];
		}
	}
	if($userD && $userUp) {
		$resultat=array_merge($userUp,$userD);
	}
	if($userD && !$userUp) {
		$resultat=$userD;
	}
	if(!$userD && $userUp) {
		$resultat=$userUp;
	}		
	echo json_encode(array($resultat));
?>