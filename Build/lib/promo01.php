<?
	session_start();
?>
<div class="dm-overlay w100" id="promo01">
	<div class="dm-table w100">
		<div class="dm-cell">
			<div class="dm-modal w100">
				<svg onclick="del_bl('#promo01')" class="closdiv cur pa hov_d trans" viewBox="0 0 612 612"><polygon fill="rgba(222,81,74,1)" points="612,36.004 576.521,0.603 306,270.608 35.478,0.603 0,36.004 270.522,306.011 0,575.997 35.478,611.397 306,341.411 576.521,611.397 612,575.997 341.459,306.011"/></svg>
				<div class='p30'>
					<p class='red fwb fs14'>КОНКУРС</p>
					<p class='p10 gray fwb fs14'>Участники, занявшие первые <span class="green fs16">3</span> места получат денежный приз!</p>
					<p class='p10 gray fwb fs14'>Общий призовой фонд - <span class="green">5 000</span> рублей РФ: </p>
					<p class='gray fwb fs14'>1 место - <span class="green">3000</span> рублей РФ</p>
					<p class='gray fwb fs14'>2 место - <span class="green">1500</span> рублей РФ</p>
					<p class='gray fwb fs14'>3 место - <span class="green">500</span> рублей РФ</p>
					<p class='p10 gray fwb fs14'>Выплата осуществляется переводом на Яндекс.Деньги или Киви. Дата объявления результатов и вручение приза: <span class="red">01.02.2017 г.</span></p>
					<p class='p10'><a class="fs12 fwb tdn green bb bbt" target="_blank" href="https://vk.com/viktorina.online?w=wall-92432572_271">подробнее</a></p>
					<?if(!$_SESSION['login']) {?>
						<p class="addvopr_promo"><span class="fwb" onclick="del_bl('#promo01'),show('log','body')">Авторизоваться сейчас</span></p>
						<p class='p10 fs10 gray fwb'>* только для авторизованных участников</p>
					<? } ?>	
				</div>
			</div>
		</div>
	</div>
</div>