<?
	session_start();
	require_once "/home/u435735/xn--80adsajtfqq.xn--80asehdb/www/cash/config.php";
	require_once "/home/u435735/xn--80adsajtfqq.xn--80asehdb/www/lib/function.php";
	require_once "/home/u435735/xn--80adsajtfqq.xn--80asehdb/www/lib/counters.php";
	if($_SESSION['login']) {$id_u = GetLogP($_SESSION['login']);} else header("Location: /Вопросы");
	if($_POST['attr']) {
		$attr = (int)$_POST['attr'];
	}
?>
<head>
	<link rel="stylesheet" href="/cash/style.css" type="text/css" />
</head>
<div class="dm-overlay w100" id="pay">
	<div class="dm-table w100">
		<div class="dm-cell">
			<div class="dm-modal w100">
				<svg onclick="del_bl('#pay')" class="closdiv cur pa hov_d trans" viewBox="0 0 612 612"><polygon fill="rgba(222,81,74,1)" points="612,36.004 576.521,0.603 306,270.608 35.478,0.603 0,36.004 270.522,306.011 0,575.997 35.478,611.397 306,341.411 576.521,611.397 612,575.997 341.459,306.011"/></svg>
				<div class='p30'>
				<p class='p10 green fwb fs14'>Обнулить очки за 99 &#8381;</p>
				<p class='p10 gray fwb fs14'>После оплаты Ваше кочество очков станет равным нулю.</p>
				<form action="https://money.yandex.ru/eshop.xml" method="post">
					<input type="hidden" name="scId" value="<?=$configs['scId']?>" >
					<input type="hidden" name="shopId" value="<?=$configs['shopId']?>" >
					<input type="hidden" name="customerNumber" value="<?=$id_u[0]['id']?>" >
					<input type="hidden" name="Sum" type="text" value="99" >
					<input type="hidden" name="paymentType" value="" >
					<div class="yamoney-pay-button yamoney-pay-button_type_fly">
						<input type="submit" value="" class="yamoney-pay-button__pay"><span class="yamoney-pay-button__text">Заплатить</span><br/><span class="yamoney-pay-button__subtext">через Яндекс</span></input>
					</div>
				</form> 
				<p class='p10 red fwb fs10'>Для корректной статистики, все ответы данные Вами ранее сохраняться.</p>
				<div class="p10"><a href="/Политика_конфиденциальности" class="tdn bb bbt green fs10 fwb">Политика конфиденциальности</a></br><a href="/Правила_пользования" class="tdn bb bbt green fs10 fwb">Правила пользования сайтом</a></div>
				</div>
			</div>
		</div>
	</div>
</div>