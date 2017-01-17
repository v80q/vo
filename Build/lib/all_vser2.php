<?
	session_start();
	require_once "/home/u435735/xn--80adsajtfqq.xn--80asehdb/www/lib/function.php";
	require_once "/home/u435735/xn--80adsajtfqq.xn--80asehdb/www/lib/counters.php";
	$id_u = GetLogP($_SESSION['login']);
?>
	<div id="ser_2" class="mob">
	<div class="vopros_add trans" onclick="show('add_v','body')"><p class="p10 fwb add2" title="Добавьте вопрос и получайте очки за неправильные ответы!">+ Добавить вопрос</p></div>
	<div class="srsr ser5">
		<svg onclick="del_bl('.ser5')" class="closdiv cur pa hov_d trans cur" viewBox="0 0 612 612"><polygon fill="rgba(222,81,74,1)" points="612,36.004 576.521,0.603 306,270.608 35.478,0.603 0,36.004 270.522,306.011 0,575.997 35.478,611.397 306,341.411 576.521,611.397 612,575.997 341.459,306.011"/></svg>
		<p class="sr fwb green">Часто задаваемые вопросы</p>
		<div class="ar_hov arrup w90 ptb3 bt1px" id="arr_faq3">
			<div class="arr"></div>
			<p class="cur fwb" id="opser_faq3_s" onclick="open_search('faq3')">как посмотреть статистику?</p>
			<div class="mtb10 dspn" id="clser_faq3">
				<svg class="icsv p151 cur" viewBox="0 0 297 297"><path d="M281.779,123.042c-1.053-10.432-1.706-23.472-7.228-34.321c-4.909-9.646-15.451-21.143-37.79-21.143h-49.258c9.147-4.603,15.44-14.073,15.44-24.992c0-15.42-12.545-27.965-27.965-27.965c-12.28,0-22.729,7.96-26.479,18.988c-3.749-11.029-14.198-18.988-26.479-18.988c-15.42,0-27.965,12.545-27.965,27.965c0,10.919,6.294,20.39,15.44,24.992H60.238c-22.339,0-32.881,11.498-37.79,21.143c-5.522,10.849-6.175,23.889-7.228,34.321C12.287,152.104,0.234,238.917,0.234,238.917c-0.007,0.062-0.014,0.126-0.02,0.188c-1.143,11.431,2.332,22.263,9.788,30.501c7.454,8.237,17.887,12.774,29.375,12.774h218.248c11.489,0,21.921-4.537,29.375-12.774c7.455-8.238,10.931-19.07,9.788-30.501c-0.006-0.062-0.013-0.126-0.02-0.188C296.766,238.917,284.713,152.104,281.779,123.042z M174.979,35.245c4.047,0,7.34,3.293,7.34,7.34s-3.293,7.34-7.34,7.34s-7.34-3.293-7.34-7.34S170.931,35.245,174.979,35.245z M122.021,35.245c4.047,0,7.34,3.293,7.34,7.34s-3.293,7.34-7.34,7.34c-4.047,0-7.34-3.293-7.34-7.34S117.974,35.245,122.021,35.245z M148.5,51.562c2.375,6.986,7.437,12.737,13.954,16.016h-27.908C141.063,64.299,146.125,58.548,148.5,51.562z M60.238,88.202h176.524c14.351,0,19.818,6.211,22.424,19.171c-5.925-2.864-12.461-4.49-19.214-4.49H57.029c-6.753,0-13.29,1.626-19.214,4.49C40.42,94.413,45.887,88.202,60.238,88.202zM271.707,255.767c-3.495,3.861-8.496,5.988-14.083,5.988H39.376c-5.587,0-10.588-2.127-14.083-5.988c-3.477-3.843-5.097-8.998-4.566-14.525l11.253-94.896c0.007-0.062,0.014-0.126,0.02-0.188c1.228-12.278,12.689-22.65,25.028-22.65h182.943c12.34,0,23.801,10.372,25.028,22.65c0.006,0.062,0.013,0.126,0.02,0.188l11.253,94.896C276.803,246.769,275.184,251.925,271.707,255.767z"/></svg>
				<p class="gray">кликнув на иконку внутри блока вопроса, вы увидите ответы всех участников.</p>
			</div>
		</div>
		<div class="ar_hov arrdown w90 ptb3 bt1px" id="arr_faq5">
			<div class="arr"></div>
			<p class="cur fwb" id="opser_faq5_s" onclick="open_search('faq5')">Игры в соц.сетях?</p>
			<div class="mtb10 pl10" id="clser_faq5">
			<div class="dib w80 ptb3">
				<a class="lh bb tdn nameuser fwb gray op1" target="_blank" title="Приложение ВКонтакте" href="https://vk.com/question.online">ВКонтакте
				<img src="/images/Mezhdunarodny_logotip_VK.png" class="mn trans icsv cur l_vk op1"></a>
			</div>
			</div>
		</div>
<?	if($_SESSION['login']) { ?>
<?	if(!$id_u[0]['image'] || $id_u[0]['ochk']==0) { ?>		
		<div class="ar_hov arrdown w90 ptb3 bt1px" id="arr_faq6">
			<div class="arr"></div>
			<p class="cur fwb" id="opser_faq6_s" onclick="open_search('faq6')" title="Участники, попавшие в рейтинг Викторина.Онлайн, получают дополнительные преимущества">как попасть в рейтинг?</p>
			<div class="mtb10 pl10" id="clser_faq6">
				<div class="dib w80 ptb3">
					<span class="lh ml15 fwb gray help" href="https://vk.com/viktorina.online" title="Вы должны ответить минимум на один вопрос">1 ответ</span>
					<div id="" class="mn trans icsv cur <? if(ChOU($id_u[0]['id'])) { echo "is_mok";} else echo "is_n";?>"></div>
				</div>
				<div class="dib w80 ptb3">
					<span class="lh ml15 fwb gray help" href="https://vk.com/viktorina.online" title="Вы должны иметь фотографию профиля">фотография</span>
					<div id="" class="mn trans icsv cur <? if($id_u[0]['image']) { echo "is_mok";} else echo "is_n";?>"></div>
				</div>
			</div>
		</div>
<?	} ?>
<?	} ?>
		<div class="ar_hov arrup w90 ptb3 bt1px bb1px" id="arr_faq7">
			<div class="arr"></div>
			<p class="cur fwb" id="opser_faq7_s" onclick="open_search('faq7')">Как получить диплом? <span class="fs10 red">(new!!!)<span></p>
			<div class="mtb10 dspn" id="clser_faq7">
			<div class="dib w80 ptb3">
				<span class="lh bb nameuser fwb gray" title="Приложение ВКонтакте" <?if($_SESSION['login']) {echo "id='".$item['id']."_otv1' onclick='show(&apos;diplom&apos;,&apos;body&apos;)'";} else echo "onclick='show(&apos;log&apos;,&apos;body&apos;)'"?>>Получить диплом</span>
				<img src="/images/dip.svg" class="mn trans icsv cur" />
			</div>
			</div>
		</div>	
	</div>
	</div>
<? if($_SESSION['login'] && $id_u[0]['soglasie']!=1){ ?>
<script>
$(function() {
	isMember('<?=$id_u[0]['id_vk']?>');
});
</script>
<? } ?>