<?
	session_start();
	require_once "/home/u435735/xn--80adsajtfqq.xn--80asehdb/www/lib/function.php";
	require_once "/home/u435735/xn--80adsajtfqq.xn--80asehdb/www/lib/counters.php";
	$user_all=124;
	$mysqli = connectDB();
	$sql = "SELECT * FROM o_v WHERE id > 0";
	if($user_all) {
		$sql .= " AND id_vopr IN(SELECT id FROM v_v WHERE id_user='".$user_all."') OR id_user = ".$user_all;
		$sql .= " ORDER by date_add ASC";
		$result = $mysqli->query($sql);
		closeDB($mysqli);
		echo "<pre>";
		print_r($result);
		$data = GetGChartsOtvUALLadad($result,$user_all);
	}	

	function GetGChartsOtvUALLadad($result,$user_all) {
		$val_o=0;
		$data='{"cols":[';
		$data.='{"id":"","label":"Дата","type":"string"},';
		$data.='{"id":"","label":"Очки","type":"number"}';
		$data.='],"rows":[';
		$data.='{"c":[{"v":"Регистрация"},{"v":0}]},';
		$data.='</br>';
			for($i=0; mysqli_num_rows($result)>$i; $i++) {
				$row=mysqli_fetch_array($result, MYSQLI_ASSOC);
				if($row['id_user']!=$user_all) {
					$nameU=" Участник:".$row['id_user'];
					$row['nagrada']=-$row['nagrada'];
				} else 	$nameU=" Вопрос:".$row['id_vopr'];
				$val_o=$val_o + $row['nagrada'];
				$data.='{"c":[{"v":"Дата:'.substr($row['date_add'],0,10).''.$nameU.'"},{"v":'.$val_o.'}]},';
				$data.='</br>';
			}       
		$data=rtrim($data,',');
		$data.=']}';
		echo $data;
	}
	
?>