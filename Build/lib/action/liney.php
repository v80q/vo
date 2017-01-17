<?
	session_start();
	require_once "/home/u435735/xn--80adsajtfqq.xn--80asehdb/www/lib/function.php";
	require_once "/home/u435735/xn--80adsajtfqq.xn--80asehdb/www/lib/counters.php";
	if($_SESSION['login']) {
		$id_u = GetLogP($_SESSION['login']);
		if(!$id_u[0]['image']) {
			$id_u[0]['image']='empty.png';
		}
	}
	else $id_u[0]['ochk']=0;
	$vise=vise($id_u[0]['ochk']);
	$nise=nise($id_u[0]['ochk']);
	if($vise && $nise) {
		$y=count($vise)+count($nise);
	}
?>
<div id="ttop" class="mob taz nettp trans">
	<p class="help mtb10 fwb green" title="Ваша позиция в турнирной таблице сайта Викторина.Онлайн. Показаны ближайшие участники в рейтинге.">Рейтинг</p>
	<?if($vise) {?>
	<div class="bl_t taz p10">
		<?	if(count($vise)>5) {?>
		<div id="tt0" class="w100 item"></div>
		<div id="tt1" class="w100 item"></div>
		<div id="tt2" class="w100 item"></div>
		<div id="tt3" class="w100 item"></div>
		<div id="tt4" class="w100 item"></div>
		<?} else {?>
			<?for ($x=0;$x<count($vise);$x++) {?>
				<div id="tt<?=$x?>" class="w100 item"></div>
			<?}?>
		<?}?>
	</div>
	<?}?>
	<?if($_SESSION['login']) {?>
	<div id="my_tt taz" class="w100" ><img onclick="show_ac('<?=$id_u[0]['login']?>')" title="На данный момент, Вы занимаете <?=RatingLogg($id_u[0]['id'])?> позицию в рейтинге" class="help ava_ttm" src="https://xn--80adsajtfqq.xn--80asehdb/images/account/<?=$id_u[0]['image']?>"></div>
	<?}
	else {?>
	<div id="my_tt taz" class="w100" ><img onclick="show('log','body')" title="Авторизуйтесь или зарегистрируйтесь!" class="help ava_ttm" src="https://xn--80adsajtfqq.xn--80asehdb/images/account/empty.png"></div>
	<?}?>
	<div class="bl_b taz p10">
	<?if($nise) {?>
		<?if(!$vise) {$x=0; $y=5;}?>
		<?for ($x;$x<$y;$x++) {?>
			<div id="tt<?=$x?>" class="w100 item"></div>
		<?}?>
	<?}?>
	</div>
</div>
<script>
$(function() {
	setTimeout(function(){
		$('#ttop').addClass('ttop');
	}, 2000);
	setInterval(function(){
		totop();
	}, 2000);		
});
</script>