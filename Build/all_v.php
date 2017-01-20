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
<link rel="stylesheet" type="text/css" href="/css/all.css" />
<link rel="stylesheet" type="text/css" href="/css/style_allvopr.css" />
<link rel="stylesheet" type="text/css" href="/css/podskazka.css" />
<link rel="shortcut icon" href="/images/favicon.png" />
<script src="/js/jquery-1.12.2.min.js"></script>
<script src="/lib/action.js"></script>
<script src="/lib/all.js"></script>
<script src="/js/ui/jquery-ui.min.js"></script>
<script src="/js/maskedinput.js"></script>
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
	<svg role="img" class="closdivser pa cur"><use xlink:href="#closdiv"></use></svg>
	<div id="perbl">
	<? if(!$_GET['my'] && !$_GET['log_user']) {?>
	<div class="srsr ser1">
		<svg onclick="del_bl('.ser1')" role="img" class="closdiv cur pa hov_d trans cur"><use xlink:href="#closdiv"></use></svg>
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
		<svg onclick="del_bl('.ser1')" role="img" class="closdiv cur pa hov_d trans cur"><use xlink:href="#closdiv"></use></svg>
		<div class="sr" itemscope="" itemtype="http://schema.org/BreadcrumbList"><? if(!$_GET) {?><h1 class='fwb green'><span itemprop="name">Вопросы</span></h1><?}?><?if($_GET[name_c]&&!$_GET[id]) {echo "<span itemscope='' itemprop='itemListElement' itemtype='http://schema.org/ListItem'><a itemprop='item' class='fwb bb tdn green' title='Вопросы' href='/Вопросы'><span itemprop='name'>Вопросы</span><meta itemprop='position' content='1'></a></span><span class='fwb green'> \ </span><h1 class='fwb green'>".$_GET[name_c]."</h1>";} if($_GET[id]) {echo "<span itemscope='' itemprop='itemListElement' itemtype='http://schema.org/ListItem'><a itemprop='item' class='fwb bb tdn green' title='Вопросы' href='/Вопросы'><span itemprop='name'>Вопросы</span></a><meta itemprop='position' content='1'></span><span class='fwb green'> \ </span><span itemscope='' itemprop='itemListElement' itemtype='http://schema.org/ListItem'><a itemprop='item' class='fwb bb tdn green' title='Категория ".$_GET[name_c]."' href='/Вопросы/".$_GET[name_c]."'><span itemprop='name'>".$_GET[name_c]."</span><meta itemprop='position' content='2'></a></span><span class='fwb green'> \ </span><h1 class='fwb tdn green'>Вопрос № ".$_GET[id]."</h1>";}?><? if($_GET['log_user']) { echo "<span itemscope='' itemprop='itemListElement' itemtype='http://schema.org/ListItem'><a itemprop='item' class='fwb bb tdn green' href='/Вопросы'><span itemprop='name'>Вопросы</span><meta itemprop='position' content='1'></a></span><span class='fwb green'> \ </span><h1 class='fwb green'>".$_GET['log_user']."</h1>"; }?></div>
		<div class='podh2 mb3 bt1px bb1px w90 gray'>
			<h2 class='mtb10 gray'>На странице представлены вопросы, заданные участником <span class="fwb green"><?=$_GET['log_user']?></span><?if($_SESSION['login']) {?>, <span class="fwb">на которые Вы еще не давали ответ</span><?}?>. Автором вопросов может стать любой, даже неавторизованный пользователь сайта. Все вопросы проходят модерацию не более 24 часов.</h2>
		</div>
		<div><a class="fwb fs10 bb tdn green" title="Карта сайта" href="/Карта_сайта">Карта сайта</a></div>
	</div>
	<? } ?>
	<div class="srsr ser2">
		<svg onclick="del_bl('.ser2')" role="img" class="closdiv cur pa hov_d trans cur"><use xlink:href="#closdiv"></use></svg>
		<? require_once "lib/search.php"; ?>
	</div>
<? if(!$_GET['id']) { ?>
	<div class="srsr ser99">
		<a class="ser99a bb tdn gray fwb trans">Реклама</a>
		<div class="tpa99"></div>
		<svg onclick="del_bl('.ser99')" role="img" class="closdiv cur pa hov_d trans cur"><use xlink:href="#closdiv"></use></svg>
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
		<svg onclick="del_bl('.ser4')" role="img" class="closdiv cur pa hov_d trans cur"><use xlink:href="#closdiv"></use></svg>
		<? require_once "lib/cat.php"; ?>
	</div>
<? } ?>
<? if(!$_GET['id'] && !$_GET['my']) { ?>
	<div class="srsr ser3">
		<svg onclick="del_bl('.ser3')" role="img" class="closdiv cur pa hov_d trans cur"><use xlink:href="#closdiv"></use></svg>
		<? require_once "lib/add_comment.php"; ?>
	</div>
<? } ?>
	</div>
</div>
<div class="vopr_block mtop">
<div class="row dspn show_at_start"><div class="vopros_add trans" onclick="show('add_v','body')"><div class="addvoprv"><p class="addvopr fwb p10 trans" title="Добавьте вопрос и получайте очки за неправильные ответы!">+ Добавить вопрос</p></div></div></div>
<? if($_GET['id']) {include('lib/load_v_id.php');}?>
</div>
<? if(!$_SESSION['nepokaz']) {include('lib/podskazka.php');}?>
<? include('lib/action/liney.php');?>
<svg xmlns="http://www.w3.org/2000/svg">
  <symbol id="closdiv" viewBox="0 0 612 612">
    <polygon fill="rgb(222,81,74)" points="612,36.004 576.521,0.603 306,270.608 35.478,0.603 0,36.004 270.522,306.011 0,575.997 35.478,611.397 306,341.411 576.521,611.397 612,575.997 341.459,306.011"/>
  </symbol>
  <symbol id="replyvopr" viewBox="0 0 408.631 408.631">
    <path fill="#40826D" d="M346.631 195.316c-41-41-99-64-171-67v-63c0-15-19-25-31-13l-139 139c-8 8-7 20 0 26l139 139c12 12 31 2 31-13v-64h16c53 0 147 9 183 73 3 6 10 9 16 9 11 0 18-9 18-18 0-3 0-86-62-148zm-155 47c-22 0-35 2-36 2-9 1-17 9-17 18v37l-94-95 94-95v37c0 10 9 18 19 18 134 0 184 69 203 121-52-36-124-43-169-43z"/>
  </symbol>
  <symbol id="attention" viewBox="0 0 511.999 511.999">
    <path fill="#EB9B32" d="M506.43 421.537L291.573 49.394c-15.814-27.391-55.327-27.401-71.147 0L5.568 421.537c-15.814 27.391 3.934 61.616 35.574 61.616h429.714c31.629 0 51.394-34.215 35.574-61.616zm-35.574 23.973H41.142a3.416 3.416 0 0 1-2.975-5.152L253.024 68.215a3.416 3.416 0 0 1 5.949 0L473.83 440.357a3.416 3.416 0 0 1-2.974 5.153z"/>
	<path fill="#EB9B32" d="M255.999 184.991c-10.394 0-18.821 8.427-18.821 18.821v107.89c0 10.394 8.427 18.821 18.821 18.821s18.821-8.427 18.821-18.821v-107.89c.001-10.394-8.426-18.821-18.821-18.821zM255.999 354.975c-10.394 0-18.821 8.427-18.821 18.821v11.239c0 10.394 8.427 18.821 18.821 18.821s18.821-8.427 18.821-18.821v-11.239c.001-10.396-8.426-18.821-18.821-18.821z"/>
  </symbol>
  <symbol id="dislike" style="fill-rule:evenodd; clip-rule:evenodd" viewBox="0 0 250 250">
    <path d="M183 51c3 0 7 1 8 3 7 7 7 24 7 33 0 8 1 21-5 27-3 2-7 4-11 4-7 1-14 4-20 8l-1 1c-9 7-17 16-24 24-10 11-21 24-27 38-4 11-5 22-4 33 0 2 1 6 0 8h-1c-2 0-5-1-7-2l-1-1c-8-5-12-15-13-25 0-6 3-12 5-18 4-9 7-18 7-28 0-5-1-10-4-14-9-17-30-21-48-23-7-1-17-2-22-7-2-2-3-5-2-8 0-1 1-2 2-3 7-5 11-13 8-22v-5c1-2 4-5 6-6 7-4 11-12 9-20 0-1 1-2 1-3 1-2 4-4 6-5 8-3 13-10 13-18 0-1 0-1 1-2 3-3 8-3 12-3 12 0 43 3 54 7 5 2 9 5 13 7 6 4 13 10 20 13s13 4 19 5zm29-1c4 0 10 0 12 3 7 7 7 24 7 33 0 8 1 21-5 27-3 3-7 4-12 4 4-10 4-22 4-30 0-12-1-26-6-37zm26 78c-10 9-24 10-34 10-5 0-10 0-15-1-7 0-14 3-17 5-8 7-15 14-22 22-8 8-18 21-23 33-3 8-4 16-3 24 0 6 1 11-1 16-3 8-10 13-19 13-6 0-13-2-18-6-13-8-21-23-22-40-1-10 3-18 6-26 3-7 5-14 5-21 0-14-23-17-35-19-11-2-23-4-33-11-7-6-10-16-8-26 1-7 5-12 10-16-2-6-1-12 1-18 3-6 8-11 14-15-1-5 0-11 3-17 4-6 9-11 16-13 0-6 2-11 7-15 7-7 16-9 26-9 13 0 48 3 61 8 6 2 11 6 16 9 4 3 14 10 18 12 11 5 26 2 38 2 9 0 20 1 27 9 11 12 12 31 12 46 0 13 0 31-12 41z"/>
  </symbol>
  <symbol id="like" viewBox="0 0 19.5 19.5">
    <path d="M9.75 17.75a1 1 0 0 1-.561-.172c-.225-.151-5.508-3.73-7.146-5.371C.212 10.376 0 8.43 0 7.125A5.38 5.38 0 0 1 5.375 1.75c1.802 0 3.398.891 4.375 2.256a5.373 5.373 0 0 1 4.375-2.256A5.38 5.38 0 0 1 19.5 7.125c0 1.305-.212 3.251-2.043 5.082-1.641 1.641-6.923 5.22-7.146 5.371a1 1 0 0 1-.561.172zm-4.375-14A3.379 3.379 0 0 0 2 7.125c0 1.093.173 2.384 1.457 3.668 1.212 1.212 4.883 3.775 6.293 4.746 1.41-.971 5.081-3.534 6.293-4.746C17.327 9.509 17.5 8.218 17.5 7.125c0-1.861-1.514-3.375-3.375-3.375S10.75 5.264 10.75 7.125a1 1 0 1 1-2 0A3.379 3.379 0 0 0 5.375 3.75z"/>
  </symbol>
  <symbol id="graph" viewBox="0 0 282.772 282.772">
    <path d="M61.472 143.036H23.881a9 9 0 0 0-9 9v94.185a9 9 0 0 0 9 9h37.591a9 9 0 0 0 9-9v-94.185a9 9 0 0 0-9-9zm-9 94.184H32.881v-76.185h19.591v76.185zM132.238 93.194h-37.59a9 9 0 0 0-9 9V246.22a9 9 0 0 0 9 9h37.591a9 9 0 0 0 9-9V102.194c-.001-4.97-4.03-9-9.001-9zm-9 144.026h-19.591V111.194h19.591V237.22zM203.005 150.471h-37.591a9 9 0 0 0-9 9v86.749a9 9 0 0 0 9 9h37.591a9 9 0 0 0 9-9v-86.749a9 9 0 0 0-9-9zm-9 86.749h-19.591v-68.749h19.591v68.749zM273.772 96.516H236.18a9 9 0 0 0-9 9V246.22a9 9 0 0 0 9 9h37.591a9 9 0 0 0 9-9V105.516a8.999 8.999 0 0 0-8.999-9zm-9 140.704H245.18V114.516h19.591V237.22z"/><path d="M178.918 112.796a9 9 0 0 0 10.905-.246l67.269-53.682-.298 8.847a9 9 0 0 0 9.001 9.303 9 9 0 0 0 8.99-8.697l1.061-31.466a9.004 9.004 0 0 0-9.298-9.298l-31.466 1.061a9 9 0 0 0-8.692 9.298c.167 4.967 4.314 8.85 9.298 8.692l8.261-.278-59.993 47.876-68.22-49.585a8.998 8.998 0 0 0-10.117-.317L4.176 108.734a9 9 0 0 0 4.833 16.598c1.65 0 3.321-.454 4.817-1.404l96.276-61.15 68.816 50.018z"/>
  </symbol>
  <symbol id="price" viewBox="0 0 985.131 985.131">
    <path d="M254.81 196.476c-8.282-22.262-18.769-44.347-33.626-62.78-19.739-24.489-46.578-43.41-78.386-47.577-31.297-4.1-64.907 3.346-89.787 23.385C1.393 151.077-3.668 224.069 1.668 285.379c2.713 31.163 9.372 62.34 19.312 91.989l62.3-21.839a374.135 374.135 0 0 1-10.673-38.589c-5.374-28.271-7.51-57.108-6.087-85.857 1.136-13.485 3.307-26.861 7.259-39.814 2.406-6.229 5.279-12.229 8.722-17.945a91.201 91.201 0 0 1 8.628-9.993 85.594 85.594 0 0 1 10.073-6.813 91.902 91.902 0 0 1 13.577-4.708 92.935 92.935 0 0 1 14.526-.999 87.091 87.091 0 0 1 12.805 2.554 87.48 87.48 0 0 1 11.28 5.672c4.564 3.404 8.796 7.181 12.748 11.276 6.505 7.952 12.021 16.601 16.861 25.658 7.926 16.616 13.913 34.061 19.433 51.605a648.915 648.915 0 0 1 5.536 18.611L25.055 538.407l243.034 361.692h717.043V176.715H268.087l-13.277 19.761zm13.241 331.931c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm36.27-283.692h612.81V832.1h-612.81L106.979 538.407l119.96-178.528a705.694 705.694 0 0 1 5.304 109.269c-25.038 12.998-42.193 39.154-42.193 69.261 0 43.01 34.991 78 78 78s78-34.99 78-78c0-32.467-19.944-60.353-48.219-72.078 1.458-54.335-2.578-108.409-13.349-161.964a909.15 909.15 0 0 0-4.897-22.838l24.736-36.814z"/>
	<path d="M605.039 644.296h-96.465v65h96.465v38.744h65v-38.744H771.28V511.591H670.039v-67.706h94.852v-64.999h-94.852V341.38h-65v37.506h-104.08v197.705h104.078l.002 67.705zm-39.081-132.705v-67.706h39.079v67.706h-39.079zm140.322 65v67.705h-36.241v-67.705h36.241z"/>
  </symbol>
  <symbol id="kassa" viewBox="0 0 297 297">
    <path d="M281.779 123.042c-1.053-10.432-1.706-23.472-7.228-34.321-4.909-9.646-15.451-21.143-37.79-21.143h-49.258c9.147-4.603 15.44-14.073 15.44-24.992 0-15.42-12.545-27.965-27.965-27.965-12.28 0-22.729 7.96-26.479 18.988-3.749-11.029-14.198-18.988-26.479-18.988-15.42 0-27.965 12.545-27.965 27.965 0 10.919 6.294 20.39 15.44 24.992H60.238c-22.339 0-32.881 11.498-37.79 21.143-5.522 10.849-6.175 23.889-7.228 34.321C12.287 152.104.234 238.917.234 238.917l-.02.188c-1.143 11.431 2.332 22.263 9.788 30.501 7.454 8.237 17.887 12.774 29.375 12.774h218.248c11.489 0 21.921-4.537 29.375-12.774 7.455-8.238 10.931-19.07 9.788-30.501a11.982 11.982 0 0 0-.02-.188c-.002 0-12.055-86.813-14.989-115.875zm-106.8-87.797c4.047 0 7.34 3.293 7.34 7.34s-3.293 7.34-7.34 7.34-7.34-3.293-7.34-7.34 3.292-7.34 7.34-7.34zm-52.958 0c4.047 0 7.34 3.293 7.34 7.34s-3.293 7.34-7.34 7.34-7.34-3.293-7.34-7.34 3.293-7.34 7.34-7.34zM148.5 51.562a28.103 28.103 0 0 0 13.954 16.016h-27.908A28.103 28.103 0 0 0 148.5 51.562zm-88.262 36.64h176.524c14.351 0 19.818 6.211 22.424 19.171-5.925-2.864-12.461-4.49-19.214-4.49H57.029c-6.753 0-13.29 1.626-19.214 4.49 2.605-12.96 8.072-19.171 22.423-19.171zm211.469 167.565c-3.495 3.861-8.496 5.988-14.083 5.988H39.376c-5.587 0-10.588-2.127-14.083-5.988-3.477-3.843-5.097-8.998-4.566-14.525l11.253-94.896.02-.188c1.228-12.278 12.689-22.65 25.028-22.65h182.943c12.34 0 23.801 10.372 25.028 22.65l.02.188 11.253 94.896c.531 5.527-1.088 10.683-4.565 14.525z"/>
  </symbol>
  <symbol id="chbox" viewBox="0 0 424.113 424.113">
  <![CDATA[.da {fill:#fff;fill-rule:nonzero}.net:hover .da {fill:#000;fill-rule:nonzero}]]>	
    <path class="net" d="M376.955 120.307c-6.514 0-11.807 5.286-11.807 11.807v215.593c0 22.785-18.539 41.322-41.322 41.322H64.936c-22.781 0-41.322-18.537-41.322-41.322V88.816c0-22.786 18.541-41.323 41.322-41.323h258.89c6.525 0 11.809-5.287 11.809-11.807 0-6.521-5.281-11.807-11.809-11.807H64.936C29.137 23.88 0 53.01 0 88.815v258.891c0 35.806 29.137 64.936 64.936 64.936h258.89c35.812 0 64.938-29.13 64.938-64.936V132.113c-.002-6.519-5.282-11.806-11.809-11.806z"/>
	<path class="da" d="M420.654 14.931c-4.611-4.612-12.096-4.612-16.693 0l-237.24 237.228-59.297-59.291c-4.611-4.611-12.084-4.611-16.695 0-4.611 4.612-4.611 12.086 0 16.695l67.656 67.639a11.764 11.764 0 0 0 8.348 3.459c3.021 0 6.043-1.151 8.348-3.459 0-.006 0-.012.012-.018L420.654 31.625c4.612-4.608 4.612-12.086 0-16.694z"/>
  </symbol>
  <symbol id="ava_admin" viewBox="0 0 196 262">
  <![CDATA[.fil1 {fill:#087979;fill-rule:nonzero}.fil0 {fill:#5B5B5B;fill-rule:nonzero}.fil2 {fill:#B12322;fill-rule:nonzero}]]>
    <path class="fil0" d="M151 123l0 0c0,0 0,0 0,0 17,8 30,20 38,37 4,9 7,20 7,30 0,24 -11,44 -30,58 0,0 0,0 0,0 -12,8 -26,13 -41,13l-72 0c-8,0 -13,-6 -13,-13 0,0 0,0 0,-1 0,-8 7,-12 15,-13 0,0 0,0 1,0l71 0c17,0 29,-10 38,-23 3,-7 6,-14 6,-22 0,-19 -10,-32 -26,-41 -7,-3 -15,-4 -22,-4l-54 0 0 45c0,0 0,0 0,1 -1,7 -5,13 -13,13l0 0c-8,0 -12,-5 -13,-13 0,0 0,-1 0,-1l0 -57c0,0 0,0 0,0 0,-7 4,-14 12,-14l43 0c18,0 34,-5 44,-21 5,-8 7,-16 7,-25 0,-19 -10,-32 -27,-41 -7,-3 -16,-4 -23,-4l-29 0 0 45c0,0 0,0 0,1 -1,7 -5,13 -13,13l0 0c-8,0 -12,-5 -13,-13 0,0 0,-1 0,-1l0 -58c0,0 0,-1 0,-1 1,-7 5,-13 13,-13l49 0c25,0 44,12 58,32 0,0 0,0 0,0 8,12 12,26 12,40 0,20 -8,37 -21,51z"/>
    <path class="fil0" d="M14 40l0 0c8,0 12,5 13,13 0,0 0,1 0,1l0 194c0,0 0,1 0,1 -1,7 -5,13 -13,13l-1 0c-8,0 -12,-5 -13,-13 0,0 0,-1 0,-1l0 -194c0,0 0,-1 0,-1 1,-7 5,-13 13,-13z"/><path class="fil1" d="M95 33l1 0c17,0 30,9 39,28 2,6 2,11 2,14 -1,4 -3,7 -7,7l0 0c-5,0 -7,-4 -7,-12 0,-5 -3,-10 -9,-16 -7,-5 -14,-8 -22,-8 -2,-2 -4,-4 -4,-6 0,-4 3,-7 6,-7z"/>
    <path class="fil2" d="M13 0l0 0c8,0 12,5 13,13 0,0 0,1 0,1l0 4c0,0 0,1 0,1 -1,7 -5,13 -13,13l-1 0c-8,0 -12,-5 -13,-13 0,0 0,-1 0,-1l0 -4c0,0 0,-1 0,-1 1,-7 5,-13 13,-13z"/>
  </symbol>
</svg>
</body>
</html>