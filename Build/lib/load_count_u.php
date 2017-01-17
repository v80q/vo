<?
	session_start();
	require_once "function.php";
	require_once "counters.php";
	if($_POST['sName']) {
		if(mb_strlen($_POST['sName'], 'UTF-8')<4) {
			$sName=FALSE;
			$mes="Поисковый запрос текста должен содержать более 4 символов";
		}
		else {
		$sName=$_POST['sName'];
		}
	}
	if($_POST['sLogin']) {$sLogin=$_POST['sLogin'];}
	if($_POST['ochk_min']) {$ochk_min=(int)$_POST['ochk_min'];}
	if($_POST['ochk_max']) {$ochk_max=(int)$_POST['ochk_max'];}
	if($_POST['pol']) {$pol=$_POST['pol'];}
	$mysqli=connectDB();
	$sql="SELECT COUNT( * ) as count FROM u_v WHERE nstdl != '1' AND image IS NOT NULL";
	$sql2="SELECT COUNT( * ) as count FROM u_v WHERE nstdl != '0' AND image IS NOT NULL";
	if($ochk_min) {
		$sql.=" AND ochk>'".$ochk_min."' ";
		$sql2.=" AND ochk>'".$ochk_min."' ";
	}	
	if($ochk_max) {
		$sql.=" AND ochk<'".$ochk_max."' ";
		$sql2.=" AND ochk<'".$ochk_max."' ";
	}
	if($age_min) {
		$sql.=" AND age>'".$age_min."' ";
		$sql2.=" AND age>'".$age_min."' ";
	}
	if($age_max) {
		$sql.=" AND age<'".$age_max."' ";
		$sql2.=" AND age<'".$age_max."' ";
	}
	if($pol) {
		$sql.=" AND pol='".$pol."' ";
		$sql2.=" AND pol='".$pol."' ";
	}
	if($sName) {
		$sql.=" AND name='".$sName."' ";
		$sql2.=" AND name='".$sName."' ";
	}
	if($sLogin) {
		$sql.=" AND login='".$sLogin."' ";
		$sql2.=" AND login='".$sLogin."' ";
	}
	$result=$mysqli->query($sql);
	$row=getResult($result);
	$result2=$mysqli->query($sql2);
	$row2=getResult($result2);
	closeDB($mysqli);
	$kljfd2=$row2[0]['count'];
	$kljfd=$row[0]['count'];
	echo "Найдено: ".$kljfd2." (".$kljfd.")"; 
?>