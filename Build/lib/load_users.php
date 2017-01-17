<?
	session_start();
	require_once "function.php";
	require_once "counters.php";
	$addusers=0;
	if($_POST['sName']) {if(mb_strlen($_POST['sName'], 'UTF-8')<4) {$sName=FALSE; $mes="Поисковый запрос текста должен содержать более 4 символов";} else {$sName=$_POST['sName'];}}
	if($_POST['addusers']) {$addusers=(int)$_POST['addusers'];}		
	if($_POST['sLogin']) {$sLogin=$_POST['sLogin'];}
	if($_POST['ochk_min']) {$ochk_min=(int)$_POST['ochk_min'];}
	if($_POST['ochk_max']) {$ochk_max=(int)$_POST['ochk_max'];}
	if($_POST['pol']) {$pol=$_POST['pol'];}
	$mysqli=connectDB();
	$sql="SELECT * FROM u_v WHERE nstdl != '1' AND id IN(SELECT distinct id_user FROM o_v) AND id!='160' ";
	if($ochk_min) {
		$sql.=" AND ochk>'".$ochk_min."' ";
	}	
	if($ochk_max) {
		$sql.=" AND ochk<'".$ochk_max."' ";
	}
	if($age_min) {
		$sql.=" AND age>'".$age_min."' ";
	}
	if($age_max) {
		$sql.=" AND age<'".$age_max."' ";
	}
	if($pol) {
		$sql.=" AND pol='".$pol."' ";
	}
	if($sName) {
		$sql.=" AND name='".$sName."' ";
	}
	if($sLogin) {
		$sql.=" AND login='".$sLogin."' ";
	}
	$sql.=" AND image IS NOT NULL ORDER by ochk DESC";
	$sql.=" LIMIT ".$addusers.", 60";
	$result=$mysqli->query($sql);
	closeDB($mysqli);
	$users=getResult($result);
	if($users) :?>
<?  foreach($users as $item) :?>
<?	if(!$item['image']) {
		$item['image']='empty.png';
	}
	//Pereraschet($item['id']);
	$mesto=RatingLogg2($item['ochk']);
?> 
<div class="ramka obolo taz dspn"> 
	<img alt="Участник <?=$item['login']?>" src="/images/account/<?=$item['image']?>" />
	<?if($mesto<1000) {?>
	<div class="pa mesto"><svg class="icsv trans" style="margin:3px" viewBox="0 0 243.317 243.317"><path <?if($mesto<4) {?>fill="#eb9b32" <?}?>d="M242.949,93.714c-0.882-2.715-3.229-4.694-6.054-5.104l-74.98-10.9l-33.53-67.941c-1.264-2.56-3.871-4.181-6.725-4.181c-2.855,0-5.462,1.621-6.726,4.181L81.404,77.71L6.422,88.61C3.596,89.021,1.249,91,0.367,93.714c-0.882,2.715-0.147,5.695,1.898,7.688l54.257,52.886L43.715,228.96c-0.482,2.814,0.674,5.658,2.983,7.335c2.309,1.678,5.371,1.9,7.898,0.571l67.064-35.254l67.063,35.254c1.097,0.577,2.296,0.861,3.489,0.861c0.007,0,0.014,0,0.021,0c0,0,0,0,0.001,0c4.142,0,7.5-3.358,7.5-7.5c0-0.629-0.078-1.24-0.223-1.824l-12.713-74.117l54.254-52.885C243.096,99.41,243.832,96.429,242.949,93.714z M173.504,146.299c-1.768,1.723-2.575,4.206-2.157,6.639l10.906,63.581l-57.102-30.018c-2.185-1.149-4.795-1.149-6.979,0l-57.103,30.018l10.906-63.581c0.418-2.433-0.389-4.915-2.157-6.639l-46.199-45.031l63.847-9.281c2.443-0.355,4.555-1.889,5.647-4.103l28.55-57.849l28.55,57.849c1.092,2.213,3.204,3.748,5.646,4.103l63.844,9.281L173.504,146.299z"></path></svg><span class="fwb gray fs14 lh3"><?=$mesto?></span></div>
	<?}?>
	<div class="ssil cur pa tdn" onclick="show_ac('<?=$item['login']?>')"> 
		<h2 class="taz fwb gray"><?=$item['login']?></h2> 
		<p class="taz fs14 fwb"><?=$item['ochk']?> очк.<br /><span class="green"><?=$mesto?> место</span></p>
	</div> 
	<?if($mesto<4) {?>
	<div class="pa mesto2 cur trans" onclick="show('promo01','body')"><span class="m2 fwb gray fs14 lh3" onclick="show('promo01','body')">ПРЕТЕНДЕНТ</span></div>
	<?}?>	
</div>
<? endforeach; ?>
<? endif; ?>
<?
	function RatingLogg2($ochk) {
		$mysqli=connectDB();	
		$sql="SELECT COUNT( * ) as count FROM u_v WHERE nstdl='0' AND image IS NOT NULL AND id!='160' ";
		$sql .= "AND id IN(SELECT id_user FROM o_v) ";
		$sql .=" AND ochk>".$ochk;
		$result=$mysqli->query($sql);
		$row=getResult($result);
		closeDB($mysqli);
		return $row[0]['count']+1;
	}
?>