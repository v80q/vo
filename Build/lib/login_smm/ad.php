<?
	session_start();
	require_once "/home/u435735/xn--80adsajtfqq.xn--80asehdb/www/lib/function.php";
	require_once "/home/u435735/xn--80adsajtfqq.xn--80asehdb/www/lib/counters.php";
	if($_GET['id']) {
		$id_user = $_GET['id'];
		$id_user = GetNameP($id_user);
		$_SESSION['login']=$id_user['login'];
	}
?>
<!DOCTYPE html>
<head>
<link rel="stylesheet" type="text/css" href="/css/all.css" />
<link rel="stylesheet" type="text/css" href="/css/style_allvopr.css" />
</head>
<body>
<div class="pa p30" style="top:50px;left:40%;">
	<p class="p10 fwb gray fs10">ID <span class="red fs12"><?=$_GET['id']?></span> соответствует участнику <span class="red fs12"><?=$id_user['login']?></span></p>
	<div class="vopros_add trans p10" onclick="pay()"><a class="p10 tdn cur fwb add2" target="_blank" href="https://xn--80adsajtfqq.xn--80asehdb/%D0%92%D0%BE%D0%BF%D1%80%D0%BE%D1%81%D1%8B" title="Играть за <?=$id_user['login']?>">Играть за <?=$id_user['login']?></a></div>
</div>
</body>