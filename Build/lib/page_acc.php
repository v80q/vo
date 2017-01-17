<?
	session_start();
	require_once "function.php";
	require_once "counters.php";
	if($_POST['login_p']) {
		$login_p = $_POST['login_p'];
		$login_p = GetLogP($login_p);
		if(!$login_p) header("Location: /ошибка");
		if(!$login_p[0]['image']) {
			$login_p[0]['image'] = "emp.svg";
		}		
	}
?>
<div class="dm-overlay w100" id="page_acc">
	<div class="dm-table w100">
		<div class="dm-cell">
			<div class="dm-modal w100 taz plrb3">
				<svg onclick="del_bl('#page_acc')" class="sv closdiv cur pa hov_d trans" viewBox="0 0 612 612"><polygon fill="rgba(222,81,74,1)" points="612,36.004 576.521,0.603 306,270.608 35.478,0.603 0,36.004 270.522,306.011 0,575.997 35.478,611.397 306,341.411 576.521,611.397 612,575.997 341.459,306.011"/></svg>
				<p class="tal p10" title="Логин участника Викторина.Онлайн. Вы можете использовать его при поиске или просто кликнуть по нему в заголовке вопроса"><span class="fs16 fwb green help"><?=$login_p[0]['login']?></span><span title="Дата последнего ответа участника" class="r_bl gray fs10 help"><?=LastOtv($login_p[0]['id'])?></span></p>
				<div class="l_bl w30 tal">
					<img class="ava2 mt3" alt="Участник <?=$login_p[0]['login']?>" src='https://викторина.онлайн/images/account/<?=$login_p[0]['image']?>' /> 
<?
	if(ChOU($login_p[0]['id'])>0 && $login_p[0]['image']) {
		$RatingLog = "<span class='lh fs14 fwb red bb'>&nbsp;".RatingLogg($login_p[0]['id'])."&nbsp;</span>";
		$t="Участник зинамает ".RatingLogg($login_p[0]['id'])." место в рейтинге Викторина.Онлайн, кликните для просмотра";
	}
	else {
		$RatingLog="<span class='lh fs14 fwb red bb' onclick='del_bl(&apos;#page_acc&apos;),show(&apos;norating_other&apos;,&apos;body&apos;)'>&nbsp;нет&nbsp;</span>";
		$t="Участник ещё не попал в рейтинг. Требуется задать минимум 1 вопрос, ответить минимум на 1 вопрос и иметь количество очков не равное нулю";
	}
?>						
					<div class="dib mt10 help" title="<?=$t?>">
						<svg class="icsv op1" viewBox="0 0 243.317 243.317"><path fill="gray" d="M242.949,93.714c-0.882-2.715-3.229-4.694-6.054-5.104l-74.98-10.9l-33.53-67.941c-1.264-2.56-3.871-4.181-6.725-4.181c-2.855,0-5.462,1.621-6.726,4.181L81.404,77.71L6.422,88.61C3.596,89.021,1.249,91,0.367,93.714c-0.882,2.715-0.147,5.695,1.898,7.688l54.257,52.886L43.715,228.96c-0.482,2.814,0.674,5.658,2.983,7.335c2.309,1.678,5.371,1.9,7.898,0.571l67.064-35.254l67.063,35.254c1.097,0.577,2.296,0.861,3.489,0.861c0.007,0,0.014,0,0.021,0c0,0,0,0,0.001,0c4.142,0,7.5-3.358,7.5-7.5c0-0.629-0.078-1.24-0.223-1.824l-12.713-74.117l54.254-52.885C243.096,99.41,243.832,96.429,242.949,93.714z M173.504,146.299c-1.768,1.723-2.575,4.206-2.157,6.639l10.906,63.581l-57.102-30.018c-2.185-1.149-4.795-1.149-6.979,0l-57.103,30.018l10.906-63.581c0.418-2.433-0.389-4.915-2.157-6.639l-46.199-45.031l63.847-9.281c2.443-0.355,4.555-1.889,5.647-4.103l28.55-57.849l28.55,57.849c1.092,2.213,3.204,3.748,5.646,4.103l63.844,9.281L173.504,146.299z"></path></svg>
<?	echo $RatingLog; ?>
					</div>
					<div class="pr dib mt10 help" title="Общее количество очков участника, сумма очков за ответы и заданные вопросы">
						<svg class="icsv op1" viewBox="0 0 297 297"><path fill="gray" d="M281.779,123.042c-1.053-10.432-1.706-23.472-7.228-34.321c-4.909-9.646-15.451-21.143-37.79-21.143h-49.258c9.147-4.603,15.44-14.073,15.44-24.992c0-15.42-12.545-27.965-27.965-27.965c-12.28,0-22.729,7.96-26.479,18.988c-3.749-11.029-14.198-18.988-26.479-18.988c-15.42,0-27.965,12.545-27.965,27.965c0,10.919,6.294,20.39,15.44,24.992H60.238c-22.339,0-32.881,11.498-37.79,21.143c-5.522,10.849-6.175,23.889-7.228,34.321C12.287,152.104,0.234,238.917,0.234,238.917c-0.007,0.062-0.014,0.126-0.02,0.188c-1.143,11.431,2.332,22.263,9.788,30.501c7.454,8.237,17.887,12.774,29.375,12.774h218.248c11.489,0,21.921-4.537,29.375-12.774c7.455-8.238,10.931-19.07,9.788-30.501c-0.006-0.062-0.013-0.126-0.02-0.188C296.766,238.917,284.713,152.104,281.779,123.042z M174.979,35.245c4.047,0,7.34,3.293,7.34,7.34s-3.293,7.34-7.34,7.34s-7.34-3.293-7.34-7.34S170.931,35.245,174.979,35.245z M122.021,35.245c4.047,0,7.34,3.293,7.34,7.34s-3.293,7.34-7.34,7.34c-4.047,0-7.34-3.293-7.34-7.34S117.974,35.245,122.021,35.245z M148.5,51.562c2.375,6.986,7.437,12.737,13.954,16.016h-27.908C141.063,64.299,146.125,58.548,148.5,51.562z M60.238,88.202h176.524c14.351,0,19.818,6.211,22.424,19.171c-5.925-2.864-12.461-4.49-19.214-4.49H57.029c-6.753,0-13.29,1.626-19.214,4.49C40.42,94.413,45.887,88.202,60.238,88.202zM271.707,255.767c-3.495,3.861-8.496,5.988-14.083,5.988H39.376c-5.587,0-10.588-2.127-14.083-5.988c-3.477-3.843-5.097-8.998-4.566-14.525l11.253-94.896c0.007-0.062,0.014-0.126,0.02-0.188c1.228-12.278,12.689-22.65,25.028-22.65h182.943c12.34,0,23.801,10.372,25.028,22.65c0.006,0.062,0.013,0.126,0.02,0.188l11.253,94.896C276.803,246.769,275.184,251.925,271.707,255.767z"></path></svg>
<?	$new_o=NewOchkV($login_p[0]['id'])+NewOchkO($login_p[0]['id']);
	if($new_o>0) {$c="green";$pl="+";} else {$c="red";$pl="";}?>
						<span class="lh fs14 fwb gray">&nbsp;<?=pre_num($login_p[0]['ochk'])?></span><?if(NewOchkV($login_p[0]['id']) || NewOchkO($login_p[0]['id'])){?><span title="Количество очков, заработанных за последние 24 часа." class="pa <?=$c?> fs10 fwb newdata2 help"><?=$pl?><?=pre_num($new_o)?></span><?}?>
					</div>
				</div>
				<div class="tal w60 r_bl">
					<p class="fwb fs12 mb3 help" title="Подробная статистика вопросов">Заданные вопросы:</p>
					<div class="ptb3 bt1px">
					   <div class="dib w50"><span class="fwb gray help" title="Общее количество вопросов, которые задал участник <?=$login_p[0]['login']?><?if($_SESSION['login']) {?>, из них на <?=CountVUsOtUs($login_p[0]['id'],$_SESSION['login'])?> Вы ещё не давали ответ<?}?>">Количество:</span></div>
						<?if(ChVU($login_p[0]['id'])<1) { $c="red"; } else { $c="green"; }?>
						<?if(ChVU($login_p[0]['id'])!=0) { ?>
					   <div class="dib w50"><a <?if($login_p[0]['login']==$_SESSION['login']) {?>href="/Мои_вопросы"<?} else {?> href="/Участники/Все_вопросы/<?=$login_p[0]['login']?>"<?}?> class="tdn fwb bb cur <?=$c?>"><?=ChVU($login_p[0]['id'])?></a></div>
						<? } else echo "<div class='dib w50'><span class='tdn fwb red'>0</span></div>";?>
					</div>
					<div class="ptb3">
					   <div class="dib w50"><span class="fwb gray help" title="Средняя цена, высчитывается как среднее арифметическое значение цен вопросов, заданных <?=$login_p[0]['login']?>">Цена ср.:</span></div>
					   <div class="dib w50"><span class="fwb gray"><?if(ChVU($login_p[0]['id'])!=0) { echo number_format(ChVUPrice($login_p[0]['id'])/ChVU($login_p[0]['id']), 2); } else echo "0"?> очков</span></div>
					</div>
					<div class="ptb3">
					   <div class="dib w50"><span class="fwb gray help" title="Автор вопросов <?=$login_p[0]['login']?> заработал <?=number_format(-ChVOPrice($login_p[0]['id']), 0, ',', ' ')?> очков, за неправильные ответы других участников викторины">Заработано:</span></div>
						<?if(-ChVOPrice($login_p[0]['id'])<0) { $c="red"; } if(-ChVOPrice($login_p[0]['id'])==0) { $c="gray"; } if(-ChVOPrice($login_p[0]['id'])>0) { $c="green"; }?>
					   <div class="dib w50"><span class="fwb bb cur <?=$c?>" onclick="del_bl('#page_acc'),show_ot('user_v','<?=$login_p[0]['id']?>')"><?=number_format(-ChVOPrice($login_p[0]['id']), 0, ',', ' ')?> очков</span><?if(NewOchkO($login_p[0]['id'])){?><?if(NewOchkO($login_p[0]['id'])>0) {$c="green";$pl="+";} else {$c="red";$pl="";}?><span title="Количество очков, заработанных на заданных вопросах <?if(!$_SESSION['login']) {?>, за последние 24 часа<?}?><?if($_SESSION['login']) {?>, с момента осуществления Вами активных действий<?}?>" class="pa <?=$c?> fs10 fwb help">&nbsp;(<?=$pl?><?=pre_num(NewOchkO($login_p[0]['id']))?>)</span><?}?></div>
					</div>
					<div class="ptb3">
					   <div class="dib w50"><span class="fwb gray help" title="Средняя сложность, высчитывается так же как и средняя цена, если сложность более 50%, значит на вопросы отвечают чаще неправильно">Сложность ср.:</span></div>
						<?if(number_format(SlogVUs($login_p[0]['id']), 4)>50) { $c="red"; } if(number_format(SlogVUs($login_p[0]['id']), 4)<50) { $c="green"; }?>
					   <div class="dib w50"><span class="fwb <?=$c?>"><?=number_format(SlogVUs($login_p[0]['id']), 4)?> %</span></div>
					</div>
					<p class="mt10 mb3 fwb fs12 help" title="Подробная статистика ответов">Данные ответы:</p>
					<div class="ptb3 bt1px">
					   <div class="dib w50"><span class="fwb gray help" title="Количество ответов участника <?=$login_p[0]['login']?>">Количество:</span></div>
						<?if(ChOU($login_p[0]['id'])<1) { $c="red"; } else { $c="green"; }?>
					   <div class="dib w50"><a class="tdn fwb <?=$c?>"><?=ChOU($login_p[0]['id'])?></a></div>
					</div>
					<div class="ptb3">
					   <div class="dib w50"><span class="fwb gray help" title="Количество очков, заработанных участником <?=$login_p[0]['login']?> за свои ответы">Заработано:</span></div>
						<?if(SummOtvU($login_p[0]['id'])<0) { $c="red"; } else { $c="green"; }?>
						<?if(SummOtvU($login_p[0]['id'])) { ?>
						<div class="dib w50"><span class="fwb bb cur <?=$c?>" onclick="del_bl('#page_acc'),show_ot('user_o','<?=$login_p[0]['id']?>')"><?=number_format(SummOtvU($login_p[0]['id']), 0, ',', ' ')?> очков</span><?if(NewOchkV($login_p[0]['id'])){?><?if(NewOchkV($login_p[0]['id'])>0) {$c="green";$pl="+";} else {$c="red";$pl="";}?><span title="Количество очков, заработанных за ответы<?if(!$_SESSION['login']) {?>, за последние 24 часа<?}?><?if($_SESSION['login']) {?>, с момента осуществления Вами активных действий<?}?>" class="pa <?=$c?> fs10 fwb help">&nbsp;(<?=$pl?><?=pre_num(NewOchkV($login_p[0]['id']))?>)</span><?}?></div>
						<? } 
						else echo "<div class='dib w50'><span class='fwb red'>0 очков</span></div>";?>	   
					</div>
					<div class="ptb3">
					   <div class="dib w50"><span class="fwb gray help" title="Успешность ответов участника викторины <?=$login_p[0]['login']?>">Успех:</span></div>
						<? if($login_p[0]['uspeh']!=0) {$itog=number_format($login_p[0]['uspeh'], 4); if($itog<50) {$c="red"; } if($itog>50) { $c="green";	}} if($login_p[0]['uspeh']==0) {$c="red"; $itog="0.00";	}?>
					   <div class="dib w50"><span class="fwb <?=$c?>"><?=$itog?> %</span></div>
					</div>
<?	if($_SESSION['login']==$_POST['login_p']) {?>
					<div class="w100 bt1px">
						<span class='addvopr_promo' onclick="del_bl('#page_acc'),show('diplom','body')">Получить диплом</span><?if(ChVU($login_p[0]['id'])!=0) { ?><a class='addvopr_promo' href='/Мои_вопросы' title="Список моих вопросов">Мои вопросы</a><? } ?>
					</div>
<?	} ?>				
				</div>
			</div>
		</div>
	</div>
</div>

