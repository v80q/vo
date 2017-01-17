<?
	session_start();
	require_once "/home/u435735/xn--80adsajtfqq.xn--80asehdb/www/lib/function.php";
	require_once "/home/u435735/xn--80adsajtfqq.xn--80asehdb/www/lib/counters.php";
	if($_POST['img_vopr']) {
		$img_vopr = $_POST['img_vopr'];
	}
?>
<div class="dm-overlay w100" id="img_<?=$img_vopr?>">
	<div class="dm-table w100">
		<div class="dm-cell">
			<div class="dm-modal w100">
				<svg onclick="del_bl('#img_<?=$img_vopr?>')" class="closdiv cur pa hov_d trans" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="612px" height="612px" viewBox="0 0 612 612" xml:space="preserve"><polygon fill="rgba(222,81,74,1)" points="612,36.004 576.521,0.603 306,270.608 35.478,0.603 0,36.004 270.522,306.011 0,575.997 35.478,611.397 306,341.411 576.521,611.397 612,575.997 341.459,306.011"/></svg>
				<div class='p30'>
					<img class="w100" src="https://xn--80adsajtfqq.xn--80asehdb/images/vopr/<?=$img_vopr?>.jpg"/>
				</div>
			</div>
		</div>
	</div>
</div>