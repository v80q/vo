<?
	session_start();
	require_once "function.php";
	require_once "counters.php";
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		$user_inf = GetInf($_SESSION['login']);
		if(!$_POST['myv']) {
			$ids = $user_inf['id'];	
		}
		if($_POST['id']) {
			$id=(int)$_POST['id'];
		}
		if($_POST['name_r']) {
			$name_r=$_POST['name_r'];
			$id_r=(int)GetNameRazd($name_r);
		}
		if($_POST['log_user']) {
			$log_user=htmlspecialchars($_POST['log_user']);
			$id_user=GetIdP($log_user);
		}	
		if($_POST['name_c']) {
			$name_c=$_POST['name_c'];
			$id_c=(int)GetNameCat($name_c);
		}
		if($_POST['minPrice']) {
			$minPrice=(int)($_POST['minPrice']);
		}
		if($_POST['maxPrice']) {
			$maxPrice=(int)($_POST['maxPrice']);
		}
		if($_POST['sText']) {
			if(mb_strlen($_POST['sText'], 'UTF-8')<4) {
				$sText=FALSE;
				echo "> 4 символов";
				exit();
			}
			else {
			$sText=$_POST['sText'];
			}
		}
		$mysqli=connectDB();
		$sql="SELECT COUNT( * ) as count FROM v_v WHERE is_actual !='0' ";
		$sql2="SELECT COUNT( * ) as count FROM v_v WHERE is_actual !='1' ";
		if($ids) {
			$sql .= " AND id NOT IN(SELECT id_vopr FROM o_v WHERE id_user='".$ids."') ";
			$sql2 .= " AND id NOT IN(SELECT id_vopr FROM o_v WHERE id_user='".$ids."') ";
		}
		if($id) {
			$sql .= " AND id='".$id."' ";
			$sql2 .= " AND id='".$id."' ";
		}
		if($id_r) {
			$sql .= " AND id_razd='".$id_r."' ";
			$sql2 .= " AND id_razd='".$id_r."' ";
		}
		if($id_user) {
			$sql .= " AND id_user='".$id_user."' ";
			$sql2 .= " AND id_user='".$id_user."' ";
		}	
		if($name_c) {
			$sql .= " AND id_cat='".$id_c."' ";
			$sql2 .= " AND id_cat='".$id_c."' ";
		}
		if($minPrice) {
			$sql .= " AND price > '".$minPrice."' ";
			$sql2 .= " AND price > '".$minPrice."' ";
		}
		if($maxPrice) {
			$sql .= " AND price < '".$maxPrice."' ";
			$sql2 .= " AND price < '".$maxPrice."' ";
		}
		if($sText) {
			$sql .= " AND MATCH(text) AGAINST('".$sText."' IN BOOLEAN MODE) ";
			$sql2 .= " AND MATCH(text) AGAINST('".$sText."' IN BOOLEAN MODE) ";
		}
		$result=$mysqli->query($sql);
		$result2=$mysqli->query($sql2);
		$row=getResult($result);
		$row2=getResult($result2);
		closeDB($mysqli);
		$kljfd=$row[0]['count'];
		$kljfd2=$row2[0]['count'];
		echo "Найдено: ".$kljfd." (".$kljfd2.")";
	}
?>