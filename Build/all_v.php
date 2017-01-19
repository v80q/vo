<? 
	require_once "lib/function.php";
	require_once "lib/counters.php";
	if($_GET['my']) {
		if(!$_SESSION['login']) {
			header("Location: /ошибка");
		}
		$login_p=GetLogP($_SESSION['login']);
		if(!ChVU($login_p[0]['id'])) {
			header("Location: /ошибка");
		}
	}
	if($_SESSION['login']) {
		$id_u = GetLogP($_SESSION['login']);
		$id_vk = $id_u[0]['id_vk'];	
		Pereraschet($id_u[0]['id']);
	}
	if($_GET['id']) {
		$id_vopr = $_GET['id'];
		$h1_c = TextVoprOtv($id_vopr);
		$ogtext=GetVR($_GET['id']);
		if(!$h1_c) header("Location: /ошибка");
	}
	if($_GET['log_user']) {
		$log_user = $_GET['log_user'];
		$h1_c = (int)GetIdP($log_user);
		if(!$h1_c) header("Location: /ошибка");
		if(!ChVU(GetIdP($log_user))) header("Location: /ошибка");
	}
	if($_GET['name_c']) {
		$name_c = $_GET['name_c'];
		$h1_c = (int)GetNameCat($name_c);
		if(!$h1_c) header("Location: /ошибка");  
	}
	if($_GET['page']) {
		header("Location: /ошибка"); 
	}
	session_start();
	$url_p = $_SERVER[REQUEST_URI];
	url_parse($url_p);
	$categories	 = GetCat();
	$razdel = GetRazd();
	if (isset($_POST['vopr'])){
		$user_inf = GetInf($_SESSION["login"]);
		$ids = (int)($user_inf['id']);
		if($_POST['promo_vopr']) {
			$promo_vopr = htmlspecialchars($_POST['promo_vopr']);
		}
		if($_POST['promo_href']) {
			$promo_href = htmlspecialchars($_POST['promo_href']);
		}
		$text = htmlspecialchars($_POST['text']);
		if($_POST['id_razd']) {$razd = (int)($_POST['id_razd']);} else $razd = 24;
		if($_POST['id_cat']) {$cat = (int)($_POST['id_cat']);} else $cat = 89;
		$otv1 = htmlspecialchars($_POST['otv1']);
		$otv2 = htmlspecialchars($_POST['otv2']);
		$otv3 = htmlspecialchars($_POST['otv3']);
		$otv4 = htmlspecialchars($_POST['otv4']);
		$pr_otv = (int)($_POST['pr_otv']);
		$price = htmlspecialchars($_POST['price']);
		$imgvopr = $_FILES["imagevopr"];
		if (isSecurity($imgvopr)) $filename = loadImageV($imgvopr);
		addVopr($text, $razd, $ids, $cat, $otv1, $otv2, $otv3, $otv4, $pr_otv, $price, $filename, $promo_vopr, $promo_href);
		echo "<div class='dm-overlay2 w100' id='send_log'><div class='dm-table w100'><div class='dm-cell'><div class='dm-modal w100'><div onclick='del_bl(&apos;#send_log&apos;)'><svg class='closdiv cur pa' viewBox='0 0 612 612'><polygon points='612,36.004 576.521,0.603 306,270.608 35.478,0.603 0,36.004 270.522,306.011 0,575.997 35.478,611.397 306,341.411 576.521,611.397 612,575.997 341.459,306.011'/></svg></div><p class='p30 green fwb fs14'>Спасибо! Ваш вопрос отправлен на модерацию.</p></div></div></div></div>";
	}
	if (isset($_POST['error'])){
		$user_inf = GetInf($_SESSION["login"]);
		$idu = (int)($user_inf['id']);
		if($_POST['prav_o']) {
			$prav_o = htmlspecialchars($_POST['prav_o']);
		}
		if($_POST['id_v']) {$id_v = (int)($_POST['id_v']);}
		addErr($idu, $prav_o, $id_v);
		echo "<div class='dm-overlay2 w100' id='send_log'><div class='dm-table w100'><div class='dm-cell'><div class='dm-modal w100'><div onclick='del_bl(&apos;#send_log&apos;)'><svg class='closdiv cur pa' viewBox='0 0 612 612'><polygon points='612,36.004 576.521,0.603 306,270.608 35.478,0.603 0,36.004 270.522,306.011 0,575.997 35.478,611.397 306,341.411 576.521,611.397 612,575.997 341.459,306.011'/></svg></div><p class='p30 green fwb fs14'>Спасибо! Ваше сообщение отправлено на проверку.</p></div></div></div></div>";
	}	
?>
<!DOCTYPE html>
<html itemscope itemtype="http://schema.org/WebPage" lang="ru" xmlns="http://www.w3.org/1999/xhtml">
<head prefix="og: http://ogp.me/ns/website#">
<? if($_GET['log_user'] || $_GET['my']) {echo "<meta name='robots' content='noindex, nofollow'/>";}?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, maximum-scale=1.0"/>
<? if(!$_GET) {?>
<meta name="keywords" content="интересные вопросы, сложные вопросы с подвохом, каверзный вопрос, научные факты, головоломки, картинки с вопросами, логические загадки, глупые, шуточные, провокационные вопросы, задать вопросы">
<meta name="description" content="Ответить на сложные, каверзные вопросы по разным категориям и отраслям науки">	
<title>Вопросы</title>
<meta property="og:title" content="Вопросы" />
<?}?>
<? if($_GET['my']) {?>
<meta name="keywords" content="Мои вопросы - <?$_SESSION['login']?>">
<meta name="description" content="Мои вопросы - <?$_SESSION['login']?>">	
<title>Мои вопросы</title>
<meta property="og:title" content="Мои вопросы" />
<?}?>
<?if($_GET['name_c']&&!$_GET['id']) {?>
<meta name="keywords" content="Интересные, сложные вопросы на тему <?=$_GET['name_c']?>">
<meta name="description" content="Вопросы на тему <?=$_GET['name_c']?>">
<title>Вопросы из категории <?=$_GET['name_c']?></title>
<meta property="og:title" content="Вопросы из категории <?=$_GET['name_c']?>" />
<?}?>
<? if($_GET['id']) {?>
<meta name="keywords" content="Вопрос № <?=$_GET['id']?> из категории <?=$_GET['name_c']?>">
<meta name="description" content="<?=$ogtext[0]['text']?>">
<title>Вопрос № <?=$_GET['id']?> на тему <?=$_GET['name_c']?></title>
<meta property="og:title" content="Вопрос № <?=$_GET['id']?> на тему <?=$_GET['name_c']?>" />
<meta property="og:description" content="<?=$ogtext[0]['text']?>"/>
<? if($ogtext[0]['imgvopr']) { ?><meta property="og:image:secure_url" content="https://xn--80adsajtfqq.xn--80asehdb/images/vopr/<?$ogtext[0]['imgvopr']?>"><? } ?>
<?}?>
<? if($_GET['log_user']) {?>
<meta name="keywords" content="Вопросы, заданные участником <?=$_GET['log_user']?>">
<meta name="description" content="Вопросы участника <?=$_GET['log_user']?>">
<title>Вопросы, заданные участником <?=$_GET['log_user']?></title>
<meta property="og:title" content="Вопросы, заданные участником <?=$_GET['log_user']?>" />
<?}?>
<meta property="og:site_name" content="Викторина.Онлайн" />
<meta property="og:locale" content="ru_RU" />
<meta property="og:type" content="website" />
<link rel="stylesheet" type="text/css" href="css/all.css" />
<link rel="stylesheet" type="text/css" href="css/style_allvopr.css" />
<link rel="stylesheet" type="text/css" href="css/podskazka.css" />
<link rel="shortcut icon" href="images/favicon.png" />
<script src="js/jquery-1.12.2.min.js"></script>
<script src="lib/action.js"></script>
<script src="lib/all.js"></script>
<script src="js/ui/jquery-ui.min.js"></script>
<script src="js/maskedinput.js"></script>
<? if(!$_GET['my']) {?>
<script src="//vk.com/js/api/openapi.js" type="text/javascript"></script>
<script type="text/javascript">$(function(){VK.init({apiId: 5501972,onlyWidgets:false});});</script>
<? } ?>
<script src="https://www.gstatic.com/charts/loader.js"></script>
</head>
<body>
<? require_once "lib/main.menu.php"; ?>
<div class="uverh trans cur dspn" onclick="uvh()"><div class="strtp trans op05 pa"></div></div>
<div class="ser mob trans show_at_start">
	<svg class="closdivser pa cur" onclick=""  viewBox="0 0 612 612"><polygon fill="rgba(222,81,74,1)" points="612,36.004 576.521,0.603 306,270.608 35.478,0.603 0,36.004 270.522,306.011 0,575.997 35.478,611.397 306,341.411 576.521,611.397 612,575.997 341.459,306.011"/></svg>
	<div id="perbl">
	<? if(!$_GET['my'] && !$_GET['log_user']) {?>
	<div class="srsr ser1">
		<svg onclick="del_bl('.ser1')" class="closdiv cur pa hov_d trans cur"  viewBox="0 0 612 612"><polygon fill="rgba(222,81,74,1)" points="612,36.004 576.521,0.603 306,270.608 35.478,0.603 0,36.004 270.522,306.011 0,575.997 35.478,611.397 306,341.411 576.521,611.397 612,575.997 341.459,306.011"/></svg>
		<div class="sr" itemscope="" itemtype="http://schema.org/BreadcrumbList"><? if(!$_GET) {?><h1 class='fwb green'><span itemprop="name">Вопросы</span></h1><?}?><?if($_GET[name_c]&&!$_GET[id]) {echo "<span itemscope='' itemprop='itemListElement' itemtype='http://schema.org/ListItem'><a itemprop='item' class='fwb bb tdn green' title='Вопросы' href='/Вопросы'><span itemprop='name'>Вопросы</span><meta itemprop='position' content='1'></a></span><span class='fwb green'> \ </span><h1 class='fwb green'>".$_GET[name_c]."</h1>";} if($_GET[id]) {echo "<span itemscope='' itemprop='itemListElement' itemtype='http://schema.org/ListItem'><a itemprop='item' class='fwb bb tdn green' title='Вопросы' href='/Вопросы'><span itemprop='name'>Вопросы</span></a><meta itemprop='position' content='1'></span><span class='fwb green'> \ </span><span itemscope='' itemprop='itemListElement' itemtype='http://schema.org/ListItem'><a itemprop='item' class='fwb bb tdn green' title='Категория ".$_GET[name_c]."' href='/Вопросы/".$_GET[name_c]."'><span itemprop='name'>".$_GET[name_c]."</span><meta itemprop='position' content='2'></a></span><span class='fwb green'> \ </span><h1 class='fwb tdn green'>Вопрос № ".$_GET[id]."</h1>";}?><? if($_GET['log_user']) { echo "<span itemscope='' itemprop='itemListElement' itemtype='http://schema.org/ListItem'><a itemprop='item' class='fwb bb tdn green' href='/Вопросы'><span itemprop='name'>Вопросы</span><meta itemprop='position' content='1'></a></span><span class='fwb green'> \ </span><h1 class='fwb green'>".$_GET['log_user']."</h1>"; }?></div>
		<div class='podh2 mb3 bt1px bb1px w90 gray'>
		<?	if(!$_GET[name_c] && !$_GET['id']) {echo PromoCat(1);}?>
		<?	if($_GET['id']) {echo "<noindex>".PromoCat((int)GetNameCat($_GET[name_c]))."</noindex>";}?>
		<?	if($_GET[name_c] && !$_GET['id']) {echo PromoCat((int)GetNameCat($_GET[name_c]));}?>
		</div>
	</div>
	<? } ?>
	<? if($_GET['log_user']) {?>
	<div class="srsr ser1">
		<svg onclick="del_bl('.ser1')" class="closdiv cur pa hov_d trans cur"  viewBox="0 0 612 612"><polygon fill="rgba(222,81,74,1)" points="612,36.004 576.521,0.603 306,270.608 35.478,0.603 0,36.004 270.522,306.011 0,575.997 35.478,611.397 306,341.411 576.521,611.397 612,575.997 341.459,306.011"/></svg>
		<div class="sr" itemscope="" itemtype="http://schema.org/BreadcrumbList"><? if(!$_GET) {?><h1 class='fwb green'><span itemprop="name">Вопросы</span></h1><?}?><?if($_GET[name_c]&&!$_GET[id]) {echo "<span itemscope='' itemprop='itemListElement' itemtype='http://schema.org/ListItem'><a itemprop='item' class='fwb bb tdn green' title='Вопросы' href='/Вопросы'><span itemprop='name'>Вопросы</span><meta itemprop='position' content='1'></a></span><span class='fwb green'> \ </span><h1 class='fwb green'>".$_GET[name_c]."</h1>";} if($_GET[id]) {echo "<span itemscope='' itemprop='itemListElement' itemtype='http://schema.org/ListItem'><a itemprop='item' class='fwb bb tdn green' title='Вопросы' href='/Вопросы'><span itemprop='name'>Вопросы</span></a><meta itemprop='position' content='1'></span><span class='fwb green'> \ </span><span itemscope='' itemprop='itemListElement' itemtype='http://schema.org/ListItem'><a itemprop='item' class='fwb bb tdn green' title='Категория ".$_GET[name_c]."' href='/Вопросы/".$_GET[name_c]."'><span itemprop='name'>".$_GET[name_c]."</span><meta itemprop='position' content='2'></a></span><span class='fwb green'> \ </span><h1 class='fwb tdn green'>Вопрос № ".$_GET[id]."</h1>";}?><? if($_GET['log_user']) { echo "<span itemscope='' itemprop='itemListElement' itemtype='http://schema.org/ListItem'><a itemprop='item' class='fwb bb tdn green' href='/Вопросы'><span itemprop='name'>Вопросы</span><meta itemprop='position' content='1'></a></span><span class='fwb green'> \ </span><h1 class='fwb green'>".$_GET['log_user']."</h1>"; }?></div>
		<div class='podh2 mb3 bt1px bb1px w90 gray'>
			<h2 class='mtb10 gray'>На странице представлены вопросы, заданные участником <span class="fwb green"><?=$_GET['log_user']?></span><?if($_SESSION['login']) {?>, <span class="fwb">на которые Вы еще не давали ответ</span><?}?>. Автором вопросов может стать любой, даже неавторизованный пользователь сайта. Все вопросы проходят модерацию не более 24 часов.</h2>
		</div>
		<div><a class="fwb fs10 bb tdn green" title="Карта сайта" href="/Карта_сайта">Карта сайта</a></div>
	</div>
	<? } ?>
	<div class="srsr ser2" role="search">
		<svg onclick="del_bl('.ser2')" class="closdiv cur pa hov_d trans cur"  viewBox="0 0 612 612"><polygon fill="rgba(222,81,74,1)" points="612,36.004 576.521,0.603 306,270.608 35.478,0.603 0,36.004 270.522,306.011 0,575.997 35.478,611.397 306,341.411 576.521,611.397 612,575.997 341.459,306.011"/></svg>
		<? require_once "lib/search.php"; ?>
	</div>
<? if(!$_GET['id']) { ?>
	<div class="srsr ser99">
		<a class="ser99a bb tdn gray fwb trans">Реклама</a>
		<div class="tpa99"></div>
		<svg onclick="del_bl('.ser99')" class="closdiv cur pa hov_d trans cur"  viewBox="0 0 612 612"><polygon fill="rgba(222,81,74,1)" points="612,36.004 576.521,0.603 306,270.608 35.478,0.603 0,36.004 270.522,306.011 0,575.997 35.478,611.397 306,341.411 576.521,611.397 612,575.997 341.459,306.011"/></svg>
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
<? if(!$_GET['my'] && !$_GET['log_user'] && !$_GET['id']) {?>
	<div class="srsr ser4">
		<svg onclick="del_bl('.ser4')" class="closdiv cur pa hov_d trans cur" viewBox="0 0 612 612"><polygon fill="rgba(222,81,74,1)" points="612,36.004 576.521,0.603 306,270.608 35.478,0.603 0,36.004 270.522,306.011 0,575.997 35.478,611.397 306,341.411 576.521,611.397 612,575.997 341.459,306.011"/></svg>
<? require_once "lib/cat.php"; ?>
	</div>
<? } ?>
<? if(!$_GET['id'] && !$_GET['my']) { ?>
	<div class="srsr ser3">
		<svg onclick="del_bl('.ser3')" class="closdiv cur pa hov_d trans cur" viewBox="0 0 612 612"><polygon fill="rgba(222,81,74,1)" points="612,36.004 576.521,0.603 306,270.608 35.478,0.603 0,36.004 270.522,306.011 0,575.997 35.478,611.397 306,341.411 576.521,611.397 612,575.997 341.459,306.011"/></svg>
<? require_once "lib/add_comment.php"; ?>
	</div>
<? } ?>
	</div>
</div>
<div class="vopr_block mtop" role="main">
<div class="row dspn show_at_start" role="button"><div class="vopros_add trans" onclick="show('add_v','body')"><div class="addvoprv"><p class="addvopr fwb p10 trans" title="Добавьте вопрос и получайте очки за неправильные ответы!">+ Добавить вопрос</p></div></div></div>
<? if($_GET['id']) {include('lib/load_v_id.php');}?>
</div>
<? if(!$_SESSION['nepokaz']) {include('lib/podskazka.php');}?>
<? include('lib/action/liney.php');?>
</body>
</html>