<?
	session_start();
	require_once "/home/u435735/xn--80adsajtfqq.xn--80asehdb/www/lib/function.php";
	require_once "/home/u435735/xn--80adsajtfqq.xn--80asehdb/www/lib/counters.php";
?>
<p class="sr fwb green help" title="Используйте поиск для отображения вопросов по Вашим критериям">Поиск<?if($_GET['my']) {?><span id="myv"> по моим вопросам</span><?}?></p>
<form method="POST" action="/Вопросы" id="search_form">
<? if($_GET['name_c'] || $_GET['id'] || $_GET['log_user'] || $_GET['sText'] || $_GET['minPrice'] || $_GET['maxPrice']) {
$pol_arr="arrup";
$dspn="dspn";
}
else {
$pol_arr="arrdown";
$dspn="";
}
?>	
	<div class="ar_hov <?=$pol_arr?> w90 ptb3 bt1px" id="arr_1">
	<div class="arr"></div>
	<p class="fwb cur" onclick="open_search('1')" title="Вы можете выбрать вид вопросов">по виду вопроса:</p>
		<div class="mtb15 <?=$dspn?>" id="clser_1">
			<? if (is_array($razdel)):?>
			<? foreach($razdel as $key => $item):?>
			<? if (is_array($item['next'])) foreach($item['next'] as $k => $v):?>
			<p><input id="<?=$k?>" class="dspn name_r for_cound" type="radio" name="name_r" value="<?=$v?>" <? if($_GET['name_r'] == $v){echo 'checked';}?>>
				<label for="<?=$k?>" class="sn"><svg class="chbox" viewBox="0 0 424.113 424.113"><path class="net" d="M376.955,120.307c-6.514,0-11.807,5.286-11.807,11.807v215.593c0,22.785-18.539,41.322-41.322,41.322H64.936c-22.781,0-41.322-18.537-41.322-41.322V88.816c0-22.786,18.541-41.323,41.322-41.323h258.89c6.525,0,11.809-5.287,11.809-11.807c0-6.521-5.281-11.807-11.809-11.807H64.936C29.137,23.88,0,53.01,0,88.815v258.891c0,35.806,29.137,64.936,64.936,64.936h258.89c35.812,0,64.938-29.13,64.938-64.936V132.113C388.762,125.594,383.482,120.307,376.955,120.307z"/><path class="da" d="M420.654,14.931c-4.611-4.612-12.096-4.612-16.693,0l-237.24,237.228l-59.297-59.291c-4.611-4.611-12.084-4.611-16.695,0c-4.611,4.612-4.611,12.086,0,16.695l67.656,67.639c2.307,2.308,5.328,3.459,8.348,3.459c3.021,0,6.043-1.151,8.348-3.459c0-0.006,0-0.012,0.012-0.018L420.654,31.625C425.266,27.017,425.266,19.539,420.654,14.931z"/></svg>
				<span class="ckb gray nameuser" <? if(!$_GET['my']) {?> title="В категории <?=$v?> задано <?=CountVRazd($k)?> вопросов<?if($_SESSION['login']) {?>, на <?=CountVRazd($k,$_SESSION['login'])?> Вы ещё не давали ответ<?}?>"<? } ?>><?=$v?></span></label>
			</p>
			<? endforeach?>
			<? endforeach?>
			<? endif?>
		</div>
	</div>
<? if($_GET['name_c']) {
$pol_arr = "arrdown";
}
else {
$pol_arr = "arrup";
}
?>		
	<div class="ar_hov <?=$pol_arr?> w90 ptb3 bt1px" id="arr_2">
	<div class="arr"></div>
	<p class="fwb cur" onclick="open_search('2')" title="Вы можете выбрать категорию вопросов">по категории:</p>
		<div id="clser_2" class="<?if(!$_GET['name_c']) { ?>dspn<?}?> mtb15">						
			<select class="sn for_cound fwb gray nameuser w80" id="name_c" name="name_c">
				<? if (is_array($categories)):?>
				<? foreach($categories as $key => $item):?>
				<option label=""></option>
				<? if (is_array($item['next'])) foreach($item['next'] as $k => $v):?>
				<option <? if(!$_GET['my']) {?> title="В категории <?=$v?> задано <?=CountVCat($k)?> вопросов<?if($_SESSION['login']) {?>, на <?=CountVCat($k,$_SESSION['login'])?> Вы ещё не давали ответ<?}?>" <? } ?> class="gray nameuser" value="<?=$v?>" <? if($_GET['name_c'] == $v){echo 'selected';}?> >-&nbsp;<?=$v?>&nbsp;</option>
				<? endforeach?>
				<? endforeach?>
				<? endif?>
			</select>
		</div>
	</div>	
<? if($_GET['id']) {
$pol_arr = "arrdown";
}
else {
$pol_arr = "arrup";
}
?>
	<div class="ar_hov <?=$pol_arr?> w90 ptb3 bt1px" id="arr_3" title="Вы можете выбрать вопросов, указав его номер">
	<div class="arr"></div>
	<p class="fwb cur" onclick="open_search('3')">по номеру:</p>
		<div id="clser_3" class="<?if(!$_GET['id']) { ?>dspn<?}?> mtb15">
			<input class="sn vos nomer for_cound gray nameuser w80" type="text" placeholder="№ вопроса" name="id" value="<?=$_GET['id']?>" title="У каждого вопроса есть свой порядковый номер, присваеваемый после модерации" />	  
		</div>
	</div>
<? 
if($_GET['log_user'] || $_GET['my']) {
	$pol_arr = "arrdown";
	if($_GET['log_user']) {
		$log_user = $_GET['log_user'];
	}
	if($_GET['my']) {
		$log_user = $_SESSION['login'];
	}
}
else {
$pol_arr = "arrup";
}
?>
	<div class="ar_hov <?=$pol_arr?> w90 ptb3 bt1px" id="arr_4" title="Вы можете выбрать автора вопросов">
	<div class="arr"></div>
		<p class="fwb cur" onclick="open_search('4')">по логину:</p>
			<div id="clser_4" class="<?if(!$log_user) { ?>dspn<?}?> mtb15">
				<input class="sn vos log_user for_cound gray nameuser w80" type="text" placeholder="введите логин автора" name="log_user" value="<?=$log_user?>" title="Вы должны знать логин автора" />	  
			</div>
	</div>			
<? if($_GET['sText']) {
$pol_arr = "arrdown";
}
else {
$pol_arr = "arrup";
}
?>
	<div class="ar_hov <?=$pol_arr?> w90 ptb3 bt1px" id="arr_5" title="Введите текст, который должен содержаться в вопросе">
	<div class="arr"></div>
		<p class="fwb cur" onclick="open_search('5');">по тексту:</p>
			<div id="clser_5" class="<?if(!$_GET['sText']) { ?>dspn<?}?> mtb15">
				<input class="sn vos sText for_cound gray nameuser w80" type="text" placeholder="не менее 4-х символов" name="sText" value="<?=$_GET['sText']?>" title="Для корректного поиска требуется вводить более 4 символов"/>	  
			</div>
	</div>
<? if($_GET['minPrice'] || $_GET['maxPrice']) {
$pol_arr = "arrdown";
}
else {
$pol_arr = "arrup";
}
?>
	<div class="ar_hov w90 ptb3 bb1px bt1px" id="arr_6">
	<div class="arr <?=$pol_arr?>"></div>
		<p class="fwb cur" onclick="open_search('6');">по цене:</p>
			<div id="clser_6" class="<?if(!$_GET['minPrice'] || !$_GET['maxPrice']) { ?>dspn<?}?> mtb15">
				<p>от<input class="sn zena minPrice for_cound gray nameuser" placeholder="0" type="text" name="minPrice" maxlength="2" value="<?=$_GET['minPrice']?>"/>
				<span class="nameuser">до</span><input class="sn zena maxPrice for_cound gray nameuser" placeholder="99" type="text" name="maxPrice" maxlength="2" value="<?=$_GET['maxPrice']?>"/></p>
			</div>
	</div>
	<div class="ptb3">
		<input id="but_search" class="sub_search mtb5" type="submit" name="search" value="Показать" title="Применить критерия поиска вопросов" />
	</div>	
	<div class="ptb3 fwb dspn green trans fs10 help" id="rty" title="Количество вопросов, удовлетворяющих критериям поиска, на которые Вы еще не давали ответ (вопросы в очереди на модерацию)"></div>
</form>