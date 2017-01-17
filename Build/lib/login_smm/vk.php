<?	
	session_start();
	require_once $_SERVER['DOCUMENT_ROOT']."/lib/function.php";
	require_once $_SERVER['DOCUMENT_ROOT']."/lib/counters.php";
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name=viewport content="width=device-width, initial-scale=1, user-scalable=no">
<title>Викторина онлайн</title>
<link rel="stylesheet" type="text/css" href="../css/all.css" />
<link rel="stylesheet" type="text/css" href="../css/style_allvopr.css" />
<script src="../js/jquery-1.12.2.min.js"></script>
<script src="../lib/all.js"></script>
<link rel="shortcut icon" href="../images/favicon.png" />
<? require_once "/home/u435735/xn--80adsajtfqq.xn--80asehdb/www/lib/countersm.php";?>
</head>
<div class="dm-overlay w100" id="logVK"><div class="dm-table w100"><div class="dm-cell"><div class="dm-modal w100 brad">
<a href="/Вопросы"><svg onclick="del_bl('#logVK')" class="sv closdiv cur pa hov_d trans" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 612 612" xml:space="preserve"><polygon fill="rgba(222,81,74,1)" points="612,36.004 576.521,0.603 306,270.608 35.478,0.603 0,36.004 270.522,306.011 0,575.997 35.478,611.397 306,341.411 576.521,611.397 612,575.997 341.459,306.011"/></svg></a>
<div class="cd-form">
<p class="fwb fs16 green">Вы перешли из приложения Вконтакте на основной сайт</p>
<p class="gray fs12 fwb p10">Подтвердите свою учетную запись для сохранения баланса и статистики</p>
<p class="soc w100">
<a class='trans addvopr_promo' href="<?=$url.'?'.urldecode(http_build_query($params));?>">Подтвердить аккаунт</a>
</p>
</div></div></div></div></div>
<script>
$(function() {
	$('#logVK').fadeTo(300,1);			
});
</script>