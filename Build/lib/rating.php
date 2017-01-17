<?php
	session_start();
	require_once "function.php";
	require_once "counters.php";
	if($_GET['login']) {
		$login_p_inf = GetLogP($_GET['login']);
		if($login_p_inf) {
			if(ChVU($login_p_inf[0]['id'])>0 && ChOU($login_p_inf[0]['id'])>0 && $login_p_inf[0]['ochk'] != 0) {
				$tlt="участников";
			}
			else header("Location: /ошибка"); 
		}
		else header("Location: /ошибка");
	}
	if($_GET['id_vopr']) {
		$id_v_slog=GetVR($_GET['id_vopr']);
		if($id_v_slog) {
			if($id_v_slog[0]['count_o']>99) {
				$tlt="вопросов";
			}
			else header("Location: /ошибка");
		}
		else header("Location: /ошибка");
	}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width initial-scale=1.0">
	<meta name='robots' content='noindex, nofollow'/>
	<meta name="description" content="Турнирная таблица <?=$tlt?> викторины">
	<title>Рейтинг <?=$tlt?></title>
	<link rel="stylesheet" type="text/css" href="/css/all.css" />
	<link rel="stylesheet" type="text/css" href="/css/style_rat.css" />
	<link rel="shortcut icon" href="/images/favicon.png" />
	<script src="/js/jquery-1.12.2.min.js"></script>
	<script src="/lib/rat.js"></script>
	<script src="/lib/all.js"></script>
	<script src="https://www.gstatic.com/charts/loader.js"></script>
<?php require_once "lib/countersm.php";?>	
</head>
<? require_once "lib/main.menu.php"; ?>
<div class="uverh trans cur dspn" onclick="uvh()"><div class="strtp trans op05 pa"></div></div>
<? if($_GET['login']) { ?>
<div class="rat_block">
	<h1 class="fs16 green taz">Рейтинг участников</h1>
	<div class="p30">
		<div class="w100 nt"><div class="no dib an fwb taz">О</div> - <div class="no dib sp gray">Итоговое количество очков участника (вычисляется по формуле ОО + ОВ);</div></div>
		<div class="w100 nt"><div class="no dib an fwb taz">ОО</div> - <div class="no dib sp gray">Очки, заработанные за ответы на вопросы других участников;</div></div>
		<div class="w100 nt"><div class="no dib an fwb taz">ОВ</div> - <div class="no dib sp gray">Очки, заработанные за ответы на вопросы, автором которых является участник;</div></div>
		<div class="w100 nt"><div class="no dib an fwb taz">ВС</div> - <div class="no dib sp gray">Средняй процент правильных ответов на вопрос, автором которых является участник;</div></div>
		<div class="w100 nt"><div class="no dib an fwb taz">ОТУ</div> - <div class="no dib sp gray">Процент правильных ответов участника;</div></div>
		<div class="w100 nt"><div class="no dib an fwb taz">ОТК</div> - <div class="no dib sp gray">Количество ответов участника;</div></div>
		<div class="w100 nt"><div class="no dib an fwb taz">ВК</div> - <div class="no dib sp gray">Количество вопросов, автором которых является участник;</div></div>
		<div class="w100 nt"><div class="no dib an fwb taz">ВН</div> - <div class="no dib sp gray">Количество оценок 'Мне нравится вопрос' на вопросы, автором которых является участник;</div></div>
		<div class="w100 nt"><div class="no dib an fwb taz">ПО</div> - <div class="no dib sp gray">Количество оценок за ответы;</div></div>
		<div class="w100 nt"><div class="no dib an fwb taz">ВП</div> - <div class="no dib sp gray">Количество оценок 'Очень плохой вопрос' на вопросы, автором которых является участник;</div></div>
	</div>
	<div class="taz">
		<div class="bb2px">
			<div class="mt_r" title="Позиция">
				<span class="fwb gray">Позиция</span>
			</div>
			<div class="mt_n" title="Логин участника">
				<span class="fwb gray">Логин</span>
			</div>
			<div class="mt_r" title="Итоговое количество очков (вычесляется по формуле ОО + ОВ)">
				<span class="fwb gray o">О</span>
			</div>
			<div class="mt_r" title="Очки, заработанные за ответы на вопросы других участников">
				<span class="fwb gray">ОО</span>
			</div>
			<div class="mt_r" title="Очки, заработанные за неправильные ответы на вопросы, автором которых является участник">
				<span class="fwb gray">ОВ</span>
			</div>
			<div class="mt_r" title="Средняя сложность вопросов, автором которых является участник">
				<span class="fwb gray">ВС</span>
			</div>
			<div class="mt_r" title="Процент правильных ответов участника">
				<span class="fwb gray">ОТУ</span>
			</div>
			<div class="mt_r" title="Количество ответов участника">
				<span class="fwb gray">ОТК</span>
			</div>
			<div class="mt_r" title="Количество вопросов, автором которых является участник">
				<span class="fwb gray">ВК</span>
			</div>
			<div class="mt_r" title="Количество оценок 'Мне нравится вопрос' на вопросы, автором которых является участник">
				<span class="fwb gray">ВН</span>
			</div>
			<div class="mt_r" title="Количество оценок за ответы">
				<span class="fwb gray">ПО</span>
			</div>
			<div class="mt_rl" title="Количество оценок 'Очень плохой вопрос' на вопросы, автором которых является участник">
				<span class="fwb gray">ВП</span>
			</div>
		</div>
		<? require_once "lib/rating/user_top.php"; ?>
		<div id="up_cont"><? require_once "lib/rating/user_up.php"; ?></div>
		<div id="down_cont"><? require_once "lib/rating/user_down.php"; ?></div>
	</div>
</div>
<script>
$(function(){up=5;down=6});
</script>
<? } ?>



<? if($_GET['id_vopr']) { ?>

<div class="rat_block">
	<h1 class="fs16 green taz">Рейтинг вопросов</h1>
	<div class="p30">
		<div class="w100 nt"><div class="no dib an fwb taz">Ц</div> - <div class="no dib sp gray">Цена;</div></div>
		<div class="w100 nt"><div class="no dib an fwb taz">ВО</div> - <div class="no dib sp gray">Очки, заработанные автором за ответы других участников;</div></div>
		<div class="w100 nt"><div class="no dib an fwb taz">ВС</div> - <div class="no dib sp gray">Процент правильных ответов;</div></div>
		<div class="w100 nt"><div class="no dib an fwb taz">ОК</div> - <div class="no dib sp gray">Количество ответов участника;</div></div>
		<div class="w100 nt"><div class="no dib an fwb taz">ОП</div> - <div class="no dib sp gray">Количество правильных ответов участника;</div></div>
		<div class="w100 nt"><div class="no dib an fwb taz">ВН</div> - <div class="no dib sp gray">Количество оценок 'Мне нравится вопрос' на вопрос;</div></div>
		<div class="w100 nt"><div class="no dib an fwb taz">ВП</div> - <div class="no dib sp gray">Количество оценок 'Очень плохой вопрос' на вопрос;</div></div>
	</div>
	<div class="taz">
		<div class="bb2px">
			<div class="mt_r" title="Позиция">
				<span class="fwb gray">Позиция</span>
			</div>
			<div class="mt_n" title="Логин автора">
				<span class="fwb gray">Автор</span>
			</div>
			<div class="mt_n" title="Категория">
				<span class="fwb gray">Категория</span>
			</div>		
			<div class="mt_r" title="Номер вопроса">
				<span class="fwb gray">№</span>
			</div>
			<div class="mt_r" title="Цена">
				<span class="fwb gray">Ц</span>
			</div>				
			<div class="mt_r" title="Очки, заработанные автором за ответы других участников">
				<span class="fwb gray">ВО</span>
			</div>		
			<div class="mt_r" title="Сложность вопроса">
				<span class="fwb gray">ВС</span>
			</div>
			<div class="mt_r" title="Количество ответов участника">
				<span class="fwb gray">ОК</span>
			</div>
			<div class="mt_r" title="Количество правильных ответов участника">
				<span class="fwb gray">ОП</span>
			</div>
			<div class="mt_r" title="Количество оценок 'Мне нравится вопрос' на вопрос">
				<span class="fwb gray">ВН</span>
			</div>
			<div class="mt_rl" title="Количество оценок 'Очень плохой вопрос' на вопрос">
				<span class="fwb gray">ВП</span>
			</div>
		</div>
		<div id="up_cont"><?require_once "lib/rating/vopr_up.php"; ?></div>
		<?require_once "lib/rating/vopr_mid.php"; ?>
		<div id="down_cont"><?require_once "lib/rating/vopr_down.php"; ?></div>		
	</div>
</div>
<script>
$(function(){up=5;down=5;load_top()});
function load_top(){$.post({url: '/lib/rating/vopr_top.php',success: function(data){$('.bb2px').after(data)}})}
</script>
<? } ?>
</br></br></br></br></br>
</html>