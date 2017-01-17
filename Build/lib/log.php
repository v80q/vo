<?
	session_start();
	require_once "function.php";
	require_once "counters.php";
?>
<div class="dm-overlay w100 dspn" id="log"><div class="dm-table w100"><div class="dm-cell"><div class="dm-modal w100 brad">
<svg onclick="del_bl('#log')" class="sv closdiv cur pa hov_d trans" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 612 612" xml:space="preserve"><polygon fill="rgba(222,81,74,1)" points="612,36.004 576.521,0.603 306,270.608 35.478,0.603 0,36.004 270.522,306.011 0,575.997 35.478,611.397 306,341.411 576.521,611.397 612,575.997 341.459,306.011"/></svg>
<div class="cd-form">
<p class="fwb fs16 green">Авторизуйтесь с помощью одной из соцсетей</p>
<p class="gray fs12 fwb p10">Отвечая на вопросы, каждый участник зарабатывает очки. Авторизация требуется для идентификации участника и размещения его в рейтинге победителей</p>
<p class="soc w100">
<a id="l_vk" class="trans log_smm" title="Авторизация через ВКонтакте" href="<?echo $url.'?'.urldecode(http_build_query($params));?>"></a>
<a id="l_ok" class="trans log_smm" title="Авторизация через Одноклассники" href="<?echo $url_ok.'?'.urldecode(http_build_query($params_ok));?>"></a>
<a id="l_fb" class="trans log_smm" title="Авторизация через Facebook временно недоступна"></a>
</p>
<div class="p10"><a href="/Политика_конфиденциальности" class="tdn bb bbt green fs10 fwb">Политика конфиденциальности</a></br><a href="/Правила_пользования" class="tdn bb bbt green fs10 fwb">Правила пользования сайтом</a></div></div></div></div></div></div>