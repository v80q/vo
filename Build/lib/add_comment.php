	<p class="sr fwb green">Отзыв/Предложение</p>
	<div class="mtb10 bt1px">
	<p class='red fwb tdn dspn' id='req'>Все данные обязательны для заполнения</p>
	<div class="ptb3">
		<p class="fwb gray mtb5">Ваше имя:</p>
		<input class="bezotk sn w80" id="name_comment" type="text" placeholder="Ваше имя" name="name" value="<? if($_SESSION['login']) { echo $_SESSION['login']; } else echo '';?>" />
	</div>
	<div class="ptb3">
		<p class="fwb gray mtb5">Текст обращения:</p>
		<textarea class="bezotk sn w80" id="text_comment" name="text" placeholder="Ваше обращение"></textarea>
	</div>
	<div class="ptb3">
		<p class="fwb gray mtb5">Email:</p>
		<input class="bezotk sn w80" id="mail_comment" type="text" placeholder="Email для ответа" value="<? if($_SESSION['login']) { $login_p_inf = GetLogP($_SESSION['login']); echo $login_p_inf[0]['mail']; } else echo '';?>"/>
	</div>
	</div>
	<div class="ptb3 bt1px w90">
		<input id="comment_add" class="cur sub_search mtb5" type="submit" value="Отправить" onclick="send_comment()"/>
	</div>
	<a class="bb red tdn" id="pol_konf" href="/Политика_конфиденциальности" target="_blank">Политика конфиденциальности</a>