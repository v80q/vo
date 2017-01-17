<?
	session_start();
	require_once "function.php";
	require_once "counters.php";
?>
<div class="dm-overlay w100" id="pr_v_add"><div class="dm-table w100"><div class="dm-cell"><div class="dm-modal w100">
<svg onclick="del_bl('#pr_v_add')" class="closdiv cur pa hov_d trans" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="612px" height="612px" viewBox="0 0 612 612" xml:space="preserve"><polygon fill="rgba(222,81,74,1)" points="612,36.004 576.521,0.603 306,270.608 35.478,0.603 0,36.004 270.522,306.011 0,575.997 35.478,611.397 306,341.411 576.521,611.397 612,575.997 341.459,306.011"/></svg>
	<form class="p10" method="POST" action="https://demomoney.yandex.ru/eshop.xml">
	<input type="hidden" name="shopId" value="70335">
	<input type="hidden" name="scid" value="540691">
	<div class="fd">
		<p class="fwb">Идентификатор клиента:</p>
		<input class="selrk2" type="text" name="customerNumber" size="64" value="<?=$_SESSION['login'];?>" placeholder=" Идентификатор клиента:" required /><br>
	</div>
	<div class="fd">
		<p class="fwb">Цена покупки (&#8381;):</p>
		<input  class="selrk2" type="text" name="sum" size="64" value="10"><br>
	</div>	
	<input name="paymentType" value="" type="radio" checked="checked" /><p class="fwb">Выбор платежного метода на стороне Яндекс.Кассы "Умный платеж"</p>
	<div class="fd" id="cher">
		<input class="sub" type="submit" value="Оплатить">
	</div>
	</form>
</div></div></div></div>				