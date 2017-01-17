<?
	session_start();
	require_once "/home/u435735/xn--80adsajtfqq.xn--80asehdb/www/lib/function.php";
	require_once "/home/u435735/xn--80adsajtfqq.xn--80asehdb/www/lib/counters.php";
	$login_p_inf = GetLogP($_SESSION['login']);
?>

<div class="dm-overlay w100" id="norating">
	<div class="dm-table w100">
		<div class="dm-cell">
			<div class="dm-modal w100">
				<svg onclick="del_bl('#norating')" class="closdiv cur pa hov_d trans" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="612px" height="612px" viewBox="0 0 612 612" xml:space="preserve"><polygon fill="rgba(222,81,74,1)" points="612,36.004 576.521,0.603 306,270.608 35.478,0.603 0,36.004 270.522,306.011 0,575.997 35.478,611.397 306,341.411 576.521,611.397 612,575.997 341.459,306.011"/></svg>
				<div class='p30'>
					<p class='p10 gray fwb'>Вы еще не попали в рейтинг, так как для этого требуется выполнить несколько условий:</p>
					<div class="p10 w50 tal bt1px bb1px" style="margin:0 auto">
						<div class="dib ptb3">
							<span class="lh nameuser fwb green" href="https://vk.com/viktorina.online">иметь фотографию профиля</span>
							<div id="" class="mn trans icsv cur <? if($login_p_inf[0]['image']) { echo "is_mok";} else echo "is_n";?>" title="Вы должны иметь фотографию профиля"></div>
						</div>
						<div class="dib ptb3">
							<span class="lh nameuser fwb green" href="https://vk.com/viktorina.online">ответить на 1 вопрос</span>
							<div id="" class="mn trans icsv cur <? if(ChOU($login_p_inf[0]['id'])>0) { echo "is_mok";} else echo "is_n";?>" title="Вы должны ответить минимум на один вопрос"></div>
						</div>
					</div>
					<p class='p10 gray fwb'>Участники, попавшие в рейтинг, могут получить дипломы и участвовать в праздничных розыгрышах от спонсоров Викторина.Онлайн</p>
				</div>
			</div>
		</div>
	</div>
</div>
