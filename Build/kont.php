<?
	session_start();
	require_once "lib/function.php";
	require_once "lib/counters.php";
	$url_p = $_SERVER[REQUEST_URI];
	url_parse($url_p);
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width initial-scale=1 user-scalable=no">
	<meta name="viewport" content="height=device-height initial-scale=1 user-scalable=no">
	<meta name="keywords" content="Контакты Викторина.Онлайн">
	<meta name="description" content="Страница контактов сайта викторина">
	<title>Контакты</title>
	<link rel="stylesheet" type="text/css" href="css/all.css" />
	<link rel="stylesheet" type="text/css" href="/css/style_allvopr.css" />
	<link rel="stylesheet" type="text/css" href="/css/kont.css" />
	<script src="/js/jquery-1.12.2.min.js"></script>
	<script src="/lib/kont.js"></script>
	<script src="/lib/all.js"></script>
	<link rel="shortcut icon" href="/images/favicon.png" />
<?php require_once "lib/countersm.php";?>
</head>
<header>
</header>
<body> 
<? require_once "lib/main.menu.php"; ?>
<div class="kont">	
	<div class="text" itemscope itemtype="http://schema.org/Organization">
		<h1>Контакты</h1>
		<p><span itemprop="name">Викторина.Онлайн</span></p>
		<p>ИП Мелентьев А. С.  ОГРНИП 312547616500061</p>
		<p itemprop="address" itemscope itemtype="http://schema.org/PostalAddress"><b>Адрес:</b> <span itemprop="postalCode">630061</span> г. <span itemprop="addressLocality">Новосибирск</span>, ул. <span itemprop="streetAddress">Мясниковой, 8/2</span></p>
		<p><b>Время работы:</b> с 09:00 - 18:00 (+4 МСК) пн-пт</p>
		<p><b>Электронная почта:</b> <span itemprop="email">viktorina.online@yandex.ru</span></p>
		<br>
		<a class="police fwb tdn green" target="_blank" href="https://vk.com/viktorina.game">Мелентьев Антон</a>
	</div>
	<div class="karta">
		<script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?sid=l903O5eXYkeIJXXxLE6j6z8ftul9tnv6&width=100%&height=300&lang=ru_RU&sourceType=constructor&scroll=true"></script>	
	</div>
</div>
<div class="mail">
	<p></p>
	<div class="frm">
	<? require_once "lib/add_comment.php";?>
	</div>
	<div class="gorodgod">
		<p>Новосибирск</p>
		<p>2016</p>
	</div>
</div>
</body>
</html>