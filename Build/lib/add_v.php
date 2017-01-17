<?
	session_start();
	include "function.php";
	include "counters.php";
	$categories	 = GetCat();
	$razdel = GetRazd();
?>
<div class="dm-overlay w100" id="add_v">
	<div class="dm-table w100">
		<div class="dm-cell">
			<div class="dm-modal w100">
				<svg onclick="del_bl('#add_v')" class="closdiv cur pa hov_d trans" viewBox="0 0 612 612"><polygon fill="rgba(222,81,74,1)" points="612,36.004 576.521,0.603 306,270.608 35.478,0.603 0,36.004 270.522,306.011 0,575.997 35.478,611.397 306,341.411 576.521,611.397 612,575.997 341.459,306.011"/></svg>
				<form class="p10 w100" method="POST" action="" enctype="multipart/form-data" onsubmit="spasibo()">				
					<? if(!$_SESSION["login"]) { echo '<div class="fd mob"><p class="red fwb p10">Вы не авторизованы, поэтому вопрос будет опубликован от имени администратора!</p></div>'; } ?>
					<div class="fd">
					<p class="fwb gray">Текст вопроса:</p>
						<textarea class="w80 help" autocapitalize="off" autocorrect="off" name="text" value="" oninvalid="this.setCustomValidity('Выберите текст задаваемого вопроса! Запрещается использование ненормативной лексики, скрытой рекламы и т. д. Модератор вправе корректировать текст вопроса.')" oninput="setCustomValidity('')" title="Текст вопроса должен быть максимально конкретным. Запрещается использование ненормативной лексики, скрытой рекламы и т. д. Модератор вправе корректировать текст вопроса" placeholder=" не более 500 символов" required ></textarea>
					</div>
					<div class="fd50">
						<p class="fwb gray">Вид:</p>
						<select class="w80 help" required oninvalid="this.setCustomValidity('Выберите вид задаваемого вопроса!')" oninput="setCustomValidity('')" name="id_razd" title="Модератор вправе изменить вид вопроса">
							<option value=""></option>				
							<? if (is_array($razdel)):?>
							<? foreach($razdel as $key => $item):?>
								<? if (is_array($item['next'])) foreach($item['next'] as $k => $v):?>
								<option class="fwb green" value="<?=$k?>">-&nbsp;<?=$v;?></option>
								<? endforeach;?>
							</optgroup>
							<? endforeach;?>
							<? endif;?>
						</select>
					</div>
					<div class="fd50">
						<p class="fwb gray">Категория:</p>
						<select class="w80 help" required oninvalid="this.setCustomValidity('Выберите категорию задаваемого вопроса!')" oninput="setCustomValidity('')" name="id_cat" title="Модератор вправе изменить категорию вопроса">
							<option value=""></option>
							<? if (is_array($categories)):?>
							<? foreach($categories as $key => $item):?>
								<? if (is_array($item['next'])) foreach($item['next'] as $k => $v):?>
								<? if($k!=89 && $k!=91) { ?>
								<option class="fwb green" value="<?=$k?>">-&nbsp;<?=$v;?></option>
								<? } ?>
								<? endforeach;?>
							<? endforeach;?>
							<? endif;?>
						</select>
					</div>
					<p class="fwb gray mb3">Варианты ответа:</p>
					<div class="mob ptb3"><input class="w30" type="text" name="otv1" placeholder=" отметьте правильный ->" required oninvalid="this.setCustomValidity('Требуется указать 4 варианта ответа!')" oninput="setCustomValidity('')"/>
						<input class="varrad" type="radio" id="vari1" name="pr_otv" value="1" required oninvalid="this.setCustomValidity('Требуется указать правильный вариант ответа!')" oninput="setCustomValidity('')" />
						<label for="vari1" class="dib sn variant" title="Укажите правильный вариант ответа"><svg class="chbox" viewBox="0 0 424.113 424.113"><path class="net" d="M376.955,120.307c-6.514,0-11.807,5.286-11.807,11.807v215.593c0,22.785-18.539,41.322-41.322,41.322H64.936c-22.781,0-41.322-18.537-41.322-41.322V88.816c0-22.786,18.541-41.323,41.322-41.323h258.89c6.525,0,11.809-5.287,11.809-11.807c0-6.521-5.281-11.807-11.809-11.807H64.936C29.137,23.88,0,53.01,0,88.815v258.891c0,35.806,29.137,64.936,64.936,64.936h258.89c35.812,0,64.938-29.13,64.938-64.936V132.113C388.762,125.594,383.482,120.307,376.955,120.307z"/><path class="da" d="M420.654,14.931c-4.611-4.612-12.096-4.612-16.693,0l-237.24,237.228l-59.297-59.291c-4.611-4.611-12.084-4.611-16.695,0c-4.611,4.612-4.611,12.086,0,16.695l67.656,67.639c2.307,2.308,5.328,3.459,8.348,3.459c3.021,0,6.043-1.151,8.348-3.459c0-0.006,0-0.012,0.012-0.018L420.654,31.625C425.266,27.017,425.266,19.539,420.654,14.931z"/></svg>
						<span class="fwb red ml30 vvar">Вариант ответа</span></label>
					</div>
					<div class="mob ptb3"><input class="w30" type="text" name="otv2" placeholder=" отметьте правильный ->" required oninvalid="this.setCustomValidity('Требуется указать 4 варианта ответа!')" oninput="setCustomValidity('')"/>
						<input class="varrad" type="radio" id="vari2" name="pr_otv" value="2" required oninvalid="this.setCustomValidity('Требуется указать правильный вариант ответа!')" oninput="setCustomValidity('')" />
						<label for="vari2" class="dib sn variant" title="Укажите правильный вариант ответа"><svg class="chbox" viewBox="0 0 424.113 424.113"><path class="net" d="M376.955,120.307c-6.514,0-11.807,5.286-11.807,11.807v215.593c0,22.785-18.539,41.322-41.322,41.322H64.936c-22.781,0-41.322-18.537-41.322-41.322V88.816c0-22.786,18.541-41.323,41.322-41.323h258.89c6.525,0,11.809-5.287,11.809-11.807c0-6.521-5.281-11.807-11.809-11.807H64.936C29.137,23.88,0,53.01,0,88.815v258.891c0,35.806,29.137,64.936,64.936,64.936h258.89c35.812,0,64.938-29.13,64.938-64.936V132.113C388.762,125.594,383.482,120.307,376.955,120.307z"/><path class="da" d="M420.654,14.931c-4.611-4.612-12.096-4.612-16.693,0l-237.24,237.228l-59.297-59.291c-4.611-4.611-12.084-4.611-16.695,0c-4.611,4.612-4.611,12.086,0,16.695l67.656,67.639c2.307,2.308,5.328,3.459,8.348,3.459c3.021,0,6.043-1.151,8.348-3.459c0-0.006,0-0.012,0.012-0.018L420.654,31.625C425.266,27.017,425.266,19.539,420.654,14.931z"/></svg>
						<span class="fwb red ml30 vvar">Вариант ответа</span></label>
					</div>
					<div class="mob ptb3"><input class="w30" type="text" name="otv3" placeholder=" отметьте правильный ->" required oninvalid="this.setCustomValidity('Требуется указать 4 варианта ответа!')" oninput="setCustomValidity('')"/>
						<input class="varrad" type="radio" id="vari3" name="pr_otv" value="3" required oninvalid="this.setCustomValidity('Требуется указать правильный вариант ответа!')" oninput="setCustomValidity('')" />
						<label for="vari3" class="dib sn variant" title="Укажите правильный вариант ответа"><svg class="chbox" viewBox="0 0 424.113 424.113"><path class="net" d="M376.955,120.307c-6.514,0-11.807,5.286-11.807,11.807v215.593c0,22.785-18.539,41.322-41.322,41.322H64.936c-22.781,0-41.322-18.537-41.322-41.322V88.816c0-22.786,18.541-41.323,41.322-41.323h258.89c6.525,0,11.809-5.287,11.809-11.807c0-6.521-5.281-11.807-11.809-11.807H64.936C29.137,23.88,0,53.01,0,88.815v258.891c0,35.806,29.137,64.936,64.936,64.936h258.89c35.812,0,64.938-29.13,64.938-64.936V132.113C388.762,125.594,383.482,120.307,376.955,120.307z"/><path class="da" d="M420.654,14.931c-4.611-4.612-12.096-4.612-16.693,0l-237.24,237.228l-59.297-59.291c-4.611-4.611-12.084-4.611-16.695,0c-4.611,4.612-4.611,12.086,0,16.695l67.656,67.639c2.307,2.308,5.328,3.459,8.348,3.459c3.021,0,6.043-1.151,8.348-3.459c0-0.006,0-0.012,0.012-0.018L420.654,31.625C425.266,27.017,425.266,19.539,420.654,14.931z"/></svg>
						<span class="fwb red ml30 vvar">Вариант ответа</span></label>
					</div>
					<div class="mob ptb3"><input class="w30" type="text" name="otv4" placeholder=" отметьте правильный ->" required oninvalid="this.setCustomValidity('Требуется указать 4 варианта ответа!')" oninput="setCustomValidity('')"/>
						<input class="varrad" type="radio" id="vari4" name="pr_otv" value="4" required oninvalid="this.setCustomValidity('Требуется указать правильный вариант ответа!')" oninput="setCustomValidity('')" />
						<label for="vari4" class="dib sn variant" title="Укажите правильный вариант ответа"><svg class="chbox" viewBox="0 0 424.113 424.113"><path class="net" d="M376.955,120.307c-6.514,0-11.807,5.286-11.807,11.807v215.593c0,22.785-18.539,41.322-41.322,41.322H64.936c-22.781,0-41.322-18.537-41.322-41.322V88.816c0-22.786,18.541-41.323,41.322-41.323h258.89c6.525,0,11.809-5.287,11.809-11.807c0-6.521-5.281-11.807-11.809-11.807H64.936C29.137,23.88,0,53.01,0,88.815v258.891c0,35.806,29.137,64.936,64.936,64.936h258.89c35.812,0,64.938-29.13,64.938-64.936V132.113C388.762,125.594,383.482,120.307,376.955,120.307z"/><path class="da" d="M420.654,14.931c-4.611-4.612-12.096-4.612-16.693,0l-237.24,237.228l-59.297-59.291c-4.611-4.611-12.084-4.611-16.695,0c-4.611,4.612-4.611,12.086,0,16.695l67.656,67.639c2.307,2.308,5.328,3.459,8.348,3.459c3.021,0,6.043-1.151,8.348-3.459c0-0.006,0-0.012,0.012-0.018L420.654,31.625C425.266,27.017,425.266,19.539,420.654,14.931z"/></svg>
						<span class="fwb red ml30 vvar">Вариант ответа</span></label>
					</div>
					<div class="fd">
						<p class="fwb gray">Цена вопроса</p>
						<input class="w30 help" type="text" name="price" value="" maxlength="2" title="Цена вопроса (в очках). Высокая цена не всегда приносит большой доход" placeholder=" не более 99" required oninvalid="this.setCustomValidity('Требуется указать цену вопроса (единица измерения - очки)!')" oninput="setCustomValidity('')"/><br>
					</div>
					<div class="fd">
						<label class="sub_search cur">
							<input class="dspn" type='file' name='imagevopr' title="Внимание: У любого контента есть законный правообладатель. Пользователь не имеет права загружать, передавать или публиковать контент на сайте Викторина.Онлайн, если он не обладает соответствующими правами на совершение таких действий, приобретенными или переданными ему в соответствии с законодательством Российской Федерации."/>
							<span class="white plr15">Добавить фото</span>
						</label>
					</div>
					<div class="fd">
						<input class="sub sub_search" type="submit" name="vopr" value="Добавить" title="Отправить вопрос на модерацию (не более 24 часов)">
					</div>
					</form>
			</div>
		</div>
	</div>
</div>		
<script>
$('.varrad').change(function(){
  if($(this).prop('checked')) {
  	$('.vvar').html('Вариант ответа')
  	$(this).next('.variant').children('.vvar').text('Правильный ответ');
  }
  else {
  	$(this).next('.variant').children('.vvar').text('Вариант ответа');
  }
});
</script>
<style>

</style>