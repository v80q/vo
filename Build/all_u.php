<?php
	session_start();
	require_once "lib/function.php";
	require_once "lib/counters.php";
	if($_SESSION['login']) {
		$id_u = GetLogP($_SESSION['login']);
	}
	if($_GET['login_p']) {
		$login_p = $_GET['login_p'];
		$h1_c = (int)GetIdP($login_p);
		if(!$h1_c) header("Location: /ошибка");  
	}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width initial-scale=1.0">
<meta name="description" content="Участники викторины">
<title>Участники</title>
<link rel="stylesheet" type="text/css" href="/ready/css/all.css" />	
<link rel="stylesheet" type="text/css" href="/ready/css/style_users.css" />
<link rel="stylesheet" type="text/css" href="/ready/css/style_allvopr.css" />
<link rel="shortcut icon" href="images/favicon.png" />	
<script src="/ready/js/jquery-1.12.2.min.js"></script>
<script src="/ready/lib/users.js"></script>
<script src="/ready/lib/all.js"></script>
<script src="https://www.gstatic.com/charts/loader.js"></script>
<?php require_once "lib/countersm.php";?>
</head>
<? require_once "lib/main.menu.php"; ?>
<div class="uverh trans cur dspn" onclick="uvh()"><div class="strtp trans op05 pa"></div></div>
<div class="ser mob trans show_at_start">
	<svg class="sv closdivser pa cur" onclick="" viewBox="0 0 612 612"><polygon fill="rgba(222,81,74,1)" points="612,36.004 576.521,0.603 306,270.608 35.478,0.603 0,36.004 270.522,306.011 0,575.997 35.478,611.397 306,341.411 576.521,611.397 612,575.997 341.459,306.011"/></svg>
	<div class="srsr ser1">
		<svg onclick="del_bl('.ser1')" class="sv closdiv cur pa hov_d trans cur" viewBox="0 0 612 612"><polygon fill="rgba(222,81,74,1)" points="612,36.004 576.521,0.603 306,270.608 35.478,0.603 0,36.004 270.522,306.011 0,575.997 35.478,611.397 306,341.411 576.521,611.397 612,575.997 341.459,306.011"/></svg>
		<h1 class="sr">Участники</h1>
		<div class="tpa"></div>
		<h2>Зарегистрированные участники сайта</h2>
		<div class="tpa2"></div>
		<div class="podh2">
		<p>На странице представлены только самые успешные участники в порядке убывания общего количества очков.</p>
		<p>Чтобы попасть на эту страницу Вы, ответив хотя бы на 1 вопрос, и иметь фотографию профиля.</p>
		</div>
		<?if ($_SESSION['login']) {?>
		<div class="tpa2"></div>
		<div class="podh2">
		<p>Добавить или изменить свою фотографию Вы можете в <a class="tdn fwb green bb" href="/Личный_кабинет">личном кабинете</a></p>
		</div>	
		<? } ?>
		<div class="tpa2"></div>
		<div class="tpa"></div>
		<div class="tpa2"></div>
	</div>
	<div class="srsr ser2"> 
		<svg onclick="del_bl('.ser12)" class="sv closdiv cur pa hov_d trans cur" viewBox="0 0 612 612"><polygon fill="rgba(222,81,74,1)" points="612,36.004 576.521,0.603 306,270.608 35.478,0.603 0,36.004 270.522,306.011 0,575.997 35.478,611.397 306,341.411 576.521,611.397 612,575.997 341.459,306.011"/></svg>
		<?php require_once "lib/searchUser.php"; ?>
	</div>
<? if($count_opn>20 && $_SESSION['nedirect']!=1 && $id_u[0]['soglasie']!=1) { ?>
	<div class="srsr ser99">
		<a class="ser99a bb tdn gray fwb trans">Реклама</a>
		<div class="tpa99"></div>
		<svg onclick="del_bl('.ser99')" class="sv closdiv cur pa hov_d trans cur" viewBox="0 0 612 612"><polygon fill="rgba(222,81,74,1)" points="612,36.004 576.521,0.603 306,270.608 35.478,0.603 0,36.004 270.522,306.011 0,575.997 35.478,611.397 306,341.411 576.521,611.397 612,575.997 341.459,306.011"/></svg>
		<div class="direct">
		<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
		<ins class="adsbygoogle"
			 style="display:block"
			 data-ad-client="ca-pub-5970012836635368"
			 data-ad-slot="5626601130"
			 data-ad-format="auto"></ins>
		<script>
		$(document).ready(function(){(adsbygoogle = window.adsbygoogle || []).push({})});
		</script>
		</div>
	</div>	
	<? } ?>
	<div class="srsr ser3"> 
		<svg onclick="del_bl('.ser3')" class="sv closdiv cur pa hov_d trans cur" viewBox="0 0 612 612"><polygon fill="rgba(222,81,74,1)" points="612,36.004 576.521,0.603 306,270.608 35.478,0.603 0,36.004 270.522,306.011 0,575.997 35.478,611.397 306,341.411 576.521,611.397 612,575.997 341.459,306.011"/></svg>
		<?php require_once "lib/add_comment.php"; ?>
	</div>
</div>
<div class="user_block mtop">
<div class="fhg">
</div>
</div>
</html>