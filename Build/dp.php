<?
	session_start();
	require_once "/home/u435735/xn--80adsajtfqq.xn--80asehdb/www/lib/function.php";
	require_once "/home/u435735/xn--80adsajtfqq.xn--80asehdb/www/lib/counters.php";
	if($_GET['dip']) {
		$dip=$_GET['dip'];
	}
	if (file_exists("/home/u435735/xn--80adsajtfqq.xn--80asehdb/www/lib/diplom/all/".$dip.".jpg")) {
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, maximum-scale=1.0"/>
<meta name="description" content="Диплом №<?=$dip?>">
<title>Викторина.Онлайн - Диплом №<?=$dip?></title>
<meta property="og:title" content="Викторина.Онлайн - Диплом №<?=$dip?>" />
<meta property="og:locale" content="Викторина.Онлайн" />
<meta property="og:type" content="website" />
<link rel="stylesheet" type="text/css" href="/css/all.css" />
<link rel="shortcut icon" href="/images/favicon.png" />
<script src="/js/jquery-1.12.2.min.js"></script>
<script src="/lib/all.js"></script>
</head>
<? require_once "lib/main.menu.php"; ?>
<div class="w100 taz p30">
<div class='p30'>
	<img property="og:image" class="w60" src="/lib/diplom/all/<?=$dip?>.jpg">
	<div class="p10">
		<a id="l_fb" class="trans brad log_smm" onclick="window.open(this.href, 'Опубликовать в Facebook', 'width=800,height=300,resizable=yes,toolbar=0,status=0'); return false" title="Рассказать в Facebook" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https://викторина.онлайн/Диплом/<?=$dip?>&picture=https://xn--80adsajtfqq.xn--80asehdb/lib/diplom/all/<?=$dip?>.jpg" ></a>
		<a id="l_ok" class="trans brad log_smm" onclick="window.open(this.href, 'Опубликовать в Одноклассники', 'width=800,height=300,resizable=yes,toolbar=0,status=0'); return false" title="Рассказать в Одноклассники" target="_blank" href="https://connect.ok.ru/offer?url=https://викторина.онлайн/Диплом/<?=$dip?>"></a>
		<a id="l_vk" class="trans brad log_smm" onclick="window.open(this.href, 'Опубликовать в ВКонтакте', 'width=800,height=300,resizable=yes,toolbar=0,status=0'); return false" title="Рассказать в ВКонтакте" target="_blank" href="http://vk.com/share.php?url=https://викторина.онлайн/Диплом/<?=$dip?>&title=<?=urldecode("Мой диплом Викторина.Онлайн")?>&noparse=true"></a>		</div>
	</div>
</div>
<script>
$(function(){$('#diplom').fadeTo(300,1)});
</script>
	<? } 
	else header("Location: /ошибка"); 
	?>