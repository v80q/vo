<?
	session_start();
	include "function.php";
	include "counters.php";
	if($_POST['id']) {
		$id = $_POST['id'];
	}
?>
<div class="dm-overlay w100" id="promo02">
	<div class="dm-table w100">
		<div class="dm-cell">
			<div class="dm-modal w100">
				<svg onclick="del_bl('#promo02')" class="closdiv cur pa hov_d trans" viewBox="0 0 612 612"><polygon fill="rgba(222,81,74,1)" points="612,36.004 576.521,0.603 306,270.608 35.478,0.603 0,36.004 270.522,306.011 0,575.997 35.478,611.397 306,341.411 576.521,611.397 612,575.997 341.459,306.011"/></svg>
				<div class='p30'>
					<p class='p10 gray fwb fs14'>Мы стараемся улучшить качество ресурса, поэтому, при нахождении ошибки в вопросах на сайте Викторина.Онлайн, кликните по кнопке &laquo;<svg width="18px" height="18px" viewBox="0 0 511.999 511.999"><path fill="rgb(235,155,50)" d="M506.43,421.537L291.573,49.394c-15.814-27.391-55.327-27.401-71.147,0L5.568,421.537c-15.814,27.391,3.934,61.616,35.574,61.616h429.714C502.485,483.153,522.25,448.938,506.43,421.537z M470.856,445.51H41.142c-2.67,0-4.313-2.835-2.975-5.152L253.024,68.215c1.335-2.313,4.611-2.318,5.949,0L473.83,440.357C475.166,442.671,473.533,445.51,470.856,445.51z"/><path fill="rgb(235,155,50)" d="M255.999,184.991c-10.394,0-18.821,8.427-18.821,18.821v107.89c0,10.394,8.427,18.821,18.821,18.821s18.821-8.427,18.821-18.821v-107.89C274.821,193.418,266.394,184.991,255.999,184.991z"/><path fill="rgb(235,155,50)" d="M255.999,354.975c-10.394,0-18.821,8.427-18.821,18.821v11.239c0,10.394,8.427,18.821,18.821,18.821s18.821-8.427,18.821-18.821v-11.239C274.821,363.4,266.394,354.975,255.999,354.975z"/></svg>&raquo; и укажите ошибку.</br></br><span class="green">Благодарим за оказанную помощь!</span></p>
					<?if($_SESSION['login'] && $_POST['id']) {?> 
					<form class="p10 w100" method="POST" action="">	
					<div class="fd">
						<p class="fwb fs14">Номер вопроса</p>
						<input class="w30 help" type="text" name="id_v" value="<?=$id?>" maxlength="4" title="Укажите номер вопроса (только цифры)" placeholder=" № вопроса" required /><br>
					</div>
					<div class="fd">
						<p class="fwb fs14">Правильный вариант или комментарий</p>
						<textarea class="w80 help" autocapitalize="off" autocorrect="off" name="prav_o" value="" title="Укажите правильный вариант ответа или оставьте комментарий" placeholder=" не более 500 символов" required ></textarea>
					</div>
					<div class="fd">
						<input class="sub" type="submit" name="error" value="Отправить" title="Нашёл ошибку">
					</div>	
					</form>
					<? } ?>
					<?if(!$_SESSION['login']) {?>
						<p class="addvopr_promo"><span class="fwb" onclick="del_bl('#promo02'),show('log','body')">Авторизоваться сейчас</span></p>
						<p class='p10 fs10 gray fwb'>* только для авторизованных участников</p>
					<? } ?>
					<?if(!$_POST['id'] && $_SESSION['login']) {?>
						<a class="addvopr_promo" href="/Вопросы"><span class="fwb" >Искать ошибки</span></a>
					<? } ?>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
$(function() {
	$("#telefon_u").mask("+7(999) 999-9999");
});
</script>