<?
	session_start();
	require_once "/home/u435735/xn--80adsajtfqq.xn--80asehdb/www/lib/function.php";
	require_once "/home/u435735/xn--80adsajtfqq.xn--80asehdb/www/lib/counters.php";
	$categories	 = GetCat();
	$razdel = GetRazd();
?>
<div class="dm-overlay w100" id="pr_v">
	<div class="dm-table w100">
		<div class="dm-cell">
			<div class="dm-modal w100">
				<div class="p10">
					<svg onclick="del_bl('#pr_v')" class="closdiv cur pa hov_d trans" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="612px" height="612px" viewBox="0 0 612 612" xml:space="preserve"><polygon fill="rgba(222,81,74,1)" points="612,36.004 576.521,0.603 306,270.608 35.478,0.603 0,36.004 270.522,306.011 0,575.997 35.478,611.397 306,341.411 576.521,611.397 612,575.997 341.459,306.011"/></svg>
					<p class="green fwb">Стоимость рекламного вопроса: 10 &#8381;</p>
					<p class="p10 fwb">С 10 августа 2016 года на сайте Викторина.Онлайн появилась возможность задавать рекламные вопросы!</p>
					<p class="p10 fwb">Вопроса может содержать указание на Ваш продукт или организацию. Вопросы проходят премодерацию в приоритетном режиме!</p>
					<a class="addvopr_promo" onclick="del_bl('#pr_v'), show('pr_v_add','body')">Задать рекламный вопрос за 10 &#8381;</a>
				</div>
			</div>
		</div>
	</div>
</div>