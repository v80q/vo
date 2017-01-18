<?	
	session_start();
	include('lib/function.php');
	include('lib/counters.php');
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
<meta name="openstat-verification" content="cfef942ea53193c4c1de81d2422fb9750188ea23" />
<meta name="google-site-verification" content="5YJskvLvruK9wQ_tTm9RNDMXmN_O95T_lPu6JnEAMGI" />
<meta name="msvalidate.01" content="59160E97CE1E7171F42872CD78D31347" />
<meta name="cypr-verification" content="356d6b0697d18e09e32333075ddaca54"/>
<meta name="yandex-verification" content="48826449dc52bc20" />
<meta name='wmail-verification' content='2fc18abc4832a6e68fada98e2ecf58a5' />
<meta name="description" content="Интеллектуальная игра онлайн без регистрации, сложные, каверзные вопросы с подвохом, научные факты, головоломки, картинки с вопросами, логические загадки, а иногда и глупые, шуточные, провокационные вопросы" />
<meta name="keywords" content="Интеллектуальная игра онлайн без регистрации, интересные вопросы, сложные вопросы с подвохом, каверзный вопрос, научные факты, головоломки, картинки с вопросами, логические загадки, глупые, шуточные, провокационные вопросы, задать вопросы">
<title>викторина.онлайн - портал вопросов и ответов</title>
<meta property="og:title" content="Интеллектуальная игра Викторина.Онлайн" />
<meta property="og:type" content="website" />
<meta property="og:url" content="https://xn--80adsajtfqq.xn--80asehdb/" />
<meta property="og:image" content="https://xn--80adsajtfqq.xn--80asehdb/images/account/admin.jpg" />
<link rel="stylesheet" href="css/odometer-theme-default.css" />
<link rel="stylesheet" href="css/supersized.css" type="text/css" />
<link rel="stylesheet" href="css/start.css" />
<link rel="shortcut icon" href="images/favicon.png" />
<? require_once "lib/countersm.php";?>
</head>
<nav itemscope itemtype="http://www.schema.org/SiteNavigationElement" id="page-menu" class="taz mob w100" role="navigation" >
	<a itemprop="url" class="tdn trans fwb gray fs18" href="Вопросы" title="Вопросы">Вопросы<noindex><span title="Количество новых вопросов, добавленных за последние 24 часа" class="pa green fs10 newdata help">+<?echo NewVopr();?></span></noindex></a>
	<a itemprop="url" class="tdn trans fwb gray fs18" href="Участники" title="Участники">Участники<?if(NewUser()){?><noindex><span title="Количество новых участников, зарегистрировавшихся за последние 24 часа" class="pa green fs10 newdata help">+<?echo NewUser();?></span></noindex><?}?></a>
	<a itemprop="url" class="tdn trans fwb gray fs18" href="Контакты" title="Контакты">Контакты</a>
</nav>
<div class="p w100 taz">
	<h1 class="p30">Викторина Онлайн</h1>
	<noindex><a class="b dib cur tdn trans fs18 gray brad" title="Играть" href="Вопросы">Играть</a></noindex>
	<? if(!$_SESSION['login']) { ?>
	<noindex><a class="b dib cur tdn trans fs18 gray brad" title="Авторизация" onclick="show('log','body')">Авторизация</a></noindex>
	<? } ?>
	<h2 class="gray fs12 mob p30">
		Представляем вам интеллектуальную игру онлайн без регистрации. Здесь вы&nbsp;найдете много интересного: научные факты, головоломки,</br> логические загадки и&nbsp;сложные вопросы с&nbsp;подвохом. На&nbsp;нашем сайте вы&nbsp;можете обнаружить и&nbsp;шуточные, провокационные задания.</br>На&nbsp;каждый каверзный вопрос даны четыре варианта ответа, из&nbsp;которых требуется выбрать лишь один, правильный.</br>Задать свои вопросы и&nbsp;проверить чужие ответы может любой участник!
	</h2>
	<div class="fs20 fwb mob">
		<span class="dib green">Участники викторины дали&nbsp;</span>
			<div class="odometer red">10000</div>
		<span class="dib green">&nbsp;ответов!</span>
	</div>
	</div>
<div class="w100 mob pa taz">
	<div class="l_bl p30">
		<p class="name fs16 fwb gray">&copy;Викторина.Онлайн 2016</p>
		<a class="map trans cur tdn fwb gray" title="Карта сайта" href="Карта_сайта">Карта сайта</a>
	</div>
	<div class="r_bl p30">
		<a id="l_fb" class="trans brad" title="Группа в Facebook" target="_blank" href="https://www.facebook.com/viktorina.online/"></a>
		<a id="l_ok" class="trans brad" title="Группа в Одноклассники" target="_blank" href="https://ok.ru/group/52718353252445"></a>
		<a id="l_vk" class="trans brad" title="Группа в ВКонтакте" target="_blank" href="https://vk.com/viktorina.online"></a>
	</div>
</div>
<script src="js/jquery-1.12.2.min.js"></script>
<script src="lib/start.js"></script>
<script src="js/supersized.3.2.7.min.js"></script>
<script src="js/odometer.js"></script>
<script>$(function($){if($(document).width()>999){setTimeout(function(){$('.odometer').html('<?echo CountOtv();?>')},500)}});</script>