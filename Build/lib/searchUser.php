<p class="sr fwb green">Поиск</p>
	<form method="POST" action="/Участники" id="search_form">
<? if($_GET['sLogin']) {
$col_arr = "arrred";
}
?>	
	<div class="ar_hov arrdown w90 ptb3 bt1px" id="arr_s1">
		<div class="arr"></div>
		<p class="fwb cur" onclick="open_search('s1')">по логину:</p>						
		<div class="mtb15 <?=$col_arr;?>" id="clser_s1">
			<input class="sn vos for_cound" id="sLogin" type="text" maxlength="29" placeholder=" от 4 до 29 символов" name="sLogin" value="<?=$_GET['sLogin'];?>"/>	  
		</div>
	</div>
<? if($_GET['sName']) {
$pol_arr = "arrdown";
$col_arr = "arrred";
}
else {
$pol_arr = "arrup";
$col_arr = "notarrred";
}
?>	
	<div class="ar_hov <?=$pol_arr;?> w90 ptb3 bt1px" id="arr_s2">
		<div class="arr"></div>
		<p class="fwb cur" onclick="open_search('s2')">по имени:</p>						
		<div class="mtb15 <?=$col_arr;?> dspn" id="clser_s2">
			<input class="sn vos for_cound" id="sName" type="text" maxlength="29" placeholder=" от 4 до 29 символов" name="sName" value="<?=$_GET['sName'];?>"/>	  
		</div>
	</div>
<? if($_GET['ochk_min'] || $_GET['ochk_max']) {
$pol_arr = "arrdown";
$col_arr = "arrred";
}
else {
$pol_arr = "arrup";
$col_arr = "notarrred";
}
?>				
	<div class="ar_hov <?=$pol_arr;?> w90 ptb3 bt1px" id="arr_s3">
		<div class="arr"></div>
		<p class="fwb cur" onclick="open_search('s3')">по очкам:</p>					
		<div class="mtb15 <?=$col_arr;?> dspn" id="clser_s3">
			<p>от<input class="sn zena for_cound gray nameuser" id="ochk_min" style="width: 50px;" type="text" name="ochk_min" value="<?=$_GET['ochk_min'];?>"/>
			<span class="nameuser">до</span><input class="sn zena for_cound gray nameuser" id="ochk_max" style="width: 50px;" type="text" name="ochk_max"  value="<?=$_GET['ochk_max'];?>"/></p>
		</div>
	</div>
<? if($_GET['pol']) {
$pol_arr = "arrdown";
$col_arr = "arrred";
}
else {
$pol_arr = "arrup";
$col_arr = "notarrred";
}
?>			
	<div class="ar_hov <?=$pol_arr;?> w90 ptb3 bb1px bt1px" id="arr_s4">
		<div class="arr"></div>
		<p class="fwb cur" onclick="open_search('s4')">по полу:</p>
		<div class="mtb15 <?=$col_arr;?> dspn" id="clser_s4">
			<p><input class="polusers for_cound" id="mug" type="radio" name="pol" value="mug" <? if($_GET['pol'] == "mug"){echo 'checked';}?>>
				<label for="mug" class="sn"><svg class="chbox" viewBox="0 0 424.113 424.113"><path class="net" d="M376.955,120.307c-6.514,0-11.807,5.286-11.807,11.807v215.593c0,22.785-18.539,41.322-41.322,41.322H64.936c-22.781,0-41.322-18.537-41.322-41.322V88.816c0-22.786,18.541-41.323,41.322-41.323h258.89c6.525,0,11.809-5.287,11.809-11.807c0-6.521-5.281-11.807-11.809-11.807H64.936C29.137,23.88,0,53.01,0,88.815v258.891c0,35.806,29.137,64.936,64.936,64.936h258.89c35.812,0,64.938-29.13,64.938-64.936V132.113C388.762,125.594,383.482,120.307,376.955,120.307z"/><path class="da" d="M420.654,14.931c-4.611-4.612-12.096-4.612-16.693,0l-237.24,237.228l-59.297-59.291c-4.611-4.611-12.084-4.611-16.695,0c-4.611,4.612-4.611,12.086,0,16.695l67.656,67.639c2.307,2.308,5.328,3.459,8.348,3.459c3.021,0,6.043-1.151,8.348-3.459c0-0.006,0-0.012,0.012-0.018L420.654,31.625C425.266,27.017,425.266,19.539,420.654,14.931z"/></svg>
				<span class="ckb">Мужской</span></label>
			</p>
			<p><input class="polusers for_cound" id="gen" type="radio" name="pol" value="gen" <? if($_GET['pol'] == "gen"){echo 'checked';}?>>
				<label for="gen" class="sn"><svg class="chbox" viewBox="0 0 424.113 424.113"><path class="net" d="M376.955,120.307c-6.514,0-11.807,5.286-11.807,11.807v215.593c0,22.785-18.539,41.322-41.322,41.322H64.936c-22.781,0-41.322-18.537-41.322-41.322V88.816c0-22.786,18.541-41.323,41.322-41.323h258.89c6.525,0,11.809-5.287,11.809-11.807c0-6.521-5.281-11.807-11.809-11.807H64.936C29.137,23.88,0,53.01,0,88.815v258.891c0,35.806,29.137,64.936,64.936,64.936h258.89c35.812,0,64.938-29.13,64.938-64.936V132.113C388.762,125.594,383.482,120.307,376.955,120.307z"/><path class="da" d="M420.654,14.931c-4.611-4.612-12.096-4.612-16.693,0l-237.24,237.228l-59.297-59.291c-4.611-4.611-12.084-4.611-16.695,0c-4.611,4.612-4.611,12.086,0,16.695l67.656,67.639c2.307,2.308,5.328,3.459,8.348,3.459c3.021,0,6.043-1.151,8.348-3.459c0-0.006,0-0.012,0.012-0.018L420.654,31.625C425.266,27.017,425.266,19.539,420.654,14.931z"/></svg>
				<span class="ckb">Женский</span></label>
			</p>
		</div>
	</div>
	<div>
		<input class="sub_search mtb5" type="submit" name="search" value="Найти"/>
	</div>
	<div class="fwb dspn green trans fs10 help" id="rty" title="Количество участнико, удовлетворяющих критерия поиска на сайте (в приложении ВКонтакте)"></div>
</form>