<?
	session_start();
	require_once "/home/u435735/xn--80adsajtfqq.xn--80asehdb/www/lib/function.php";
	require_once "/home/u435735/xn--80adsajtfqq.xn--80asehdb/www/lib/counters.php";
		$add=0;
		$id_u = GetLogP($_SESSION['login']);
		$user_inf = GetInf($_SESSION['login']);
		if(!$_POST['myv']) {
			$ids = $user_inf['id'];	
		}
		if($_POST['add']) {
			$add=(int)$_POST['add'];
		}
		if($_POST['log_user']) {
			$log_user=htmlspecialchars($_POST['log_user']);
			$id_user=GetIdP($log_user);
		}
		if($_POST['name_r']) {
			$name_r=$_POST['name_r'];
			$id_r=(int)GetNameRazd($name_r);
		}
		if($_POST['name_c']) {
			$name_c=$_POST['name_c'];
			$id_c=(int)GetNameCat($name_c);
		}
		if($_POST['sText']) {
			if(mb_strlen($_POST['sText'],'UTF-8')<4) {
				$sText=FALSE;
				$mes="Поисковый запрос текста должен содержать более 4 символов";
			}
			else {
			$sText=$_POST['sText'];
			}
		}
		if($_POST['minPrice']) {
			$minPrice=(int)($_POST['minPrice']);
		}
		if($_POST['maxPrice']) {
			$maxPrice=(int)($_POST['maxPrice']);
		}

		$mysqli=connectDB();
		$sql="SELECT * FROM v_v WHERE is_actual != '0'";
		if($ids) {
			$sql .= " AND id NOT IN(SELECT id_vopr FROM o_v WHERE id_user='".$ids."') ";
			$sql .= " AND id NOT IN(SELECT id FROM v_v WHERE id_user='".$ids."') ";
		}
		if($id) {
			$sql .= " AND id='".$id."' ";
		}
		if($id_user) {
			$sql .= " AND id_user='".$id_user."' ";
		}		
		if($id_r) {
			$sql .= " AND id_razd='".$id_r."' ";
		}
		if($name_c) {
			$sql .= " AND id_cat='".$id_c."' ";
		}
		if($sText) {
			$sql .= " AND MATCH(text) AGAINST('".$sText."' IN BOOLEAN MODE) ";
		}
		if($minPrice) {
			$sql .= " AND price>'".$minPrice."' ";
		}
		if($maxPrice) {
			$sql .= " AND price<'".$maxPrice."' ";
		}
		$sql .= " ORDER by date_add DESC";
		$sql .= " LIMIT ".$add.",10";
		$result=$mysqli->query($sql);
		closeDB($mysqli);
		$questions=getResult($result);
	if($questions) :?>
<?  foreach($questions as $item) :?>
<?  $CountOtvV=CountOtvV($item['id'])?>
<?  $CountPOtvV=CountPOtvV($item['id'])?>
<? 	if($CountOtvV) {
		$proz=$CountPOtvV/$CountOtvV*100;
		$proz=number_format($proz,2);
		}
	else {
		$proz=0;
		$proz=number_format($proz,2);
	}
	$pl=(int)ProvLike($item['id'],$ids);
	$pj=(int)ProvJalo($item['id'],$ids);
	if($pl != 0) {
		$pl="ect";
	}
	else $lk="";
	if($pj != 0) {
		$pj="ect";
	}
	else $lk="";
	$ChOU=ChOU($item['id_user']);
	$ChPOU=ChPOU($item['id_user']);
	if ($ChOU != 0) {
		$ChO=$ChPOU/$ChOU*100;
	}
	$ChO=number_format($ChO,2);

?>
<?if($item['id_cat']==91) {$c="shadow";} else {$c="";}?>
<div class="vopros <?=$c?>" id="<?=$item['id']?>">
	<div class="smm trans mob">
		<a id="l_vk" class="trans brad share_smm" onclick="window.open(this.href, 'Опубликовать в ВКонтакте', 'width=800,height=300,resizable=yes,toolbar=0,status=0'); return false" title="Рассказать в ВКонтакте" target="_blank" href="http://vk.com/share.php?url=https://викторина.онлайн/Вопросы/<?=GetIdCat($item['id_cat'])?>/<?=$item['id']?>"></a>
		<a id="l_ok" class="trans brad share_smm" onclick="window.open(this.href, 'Опубликовать в Одноклассники', 'width=800,height=300,resizable=yes,toolbar=0,status=0'); return false" title="Рассказать в Одноклассники" target="_blank" href="https://connect.ok.ru/offer?url=https://викторина.онлайн/Вопросы/<?=GetIdCat($item['id_cat'])?>/<?=$item['id']?>"></a>
		<a id="l_fb" class="trans brad share_smm" onclick="window.open(this.href, 'Опубликовать в Facebook', 'width=800,height=300,resizable=yes,toolbar=0,status=0'); return false" title="Рассказать в Facebook" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https://викторина.онлайн/Вопросы/<?=GetIdCat($item['id_cat'])?>/<?=$item['id']?>"></a>
	</div>
	<div class="closdiv cur pa" title="Закрыть"><svg onclick="del_bl('#<?=$item['id']?>')" class="hov_d trans mob cur" viewBox="0 0 612 612"><polygon fill="rgb(222,81,74)" points="612,36.004 576.521,0.603 306,270.608 35.478,0.603 0,36.004 270.522,306.011 0,575.997 35.478,611.397 306,341.411 576.521,611.397 612,575.997 341.459,306.011"/></svg></div>
	<div class="replyvopr mob cur" title="Развернуть"><svg onclick="open_vopr('<?=$item['id']?>')" viewBox="0 0 408.631 408.631"><path fill="rgb(64,130,109)" d="M346.631,195.316c-41-41-99-64-171-67v-63c0-15-19-25-31-13l-139,139c-8,8-7,20,0,26l139,139c12,12,31,2,31-13v-64h16c53,0,147,9,183,73c3,6,10,9,16,9c11,0,18-9,18-18C408.631,340.316,408.631,257.316,346.631,195.316zM191.631,242.316c-22,0-35,2-36,2c-9,1-17,9-17,18v37l-94-95l94-95v37c0,10,9,18,19,18c134,0,184,69,203,121C308.631,249.316,236.631,242.316,191.631,242.316z"/></svg></div>
	<div class="attention cur pa" title="Ошибка в вопросе!"><svg onclick="show_error('<?=$item['id']?>')" class="hov_d trans mob cur" viewBox="0 0 511.999 511.999"><path fill="rgb(235,155,50)" d="M506.43,421.537L291.573,49.394c-15.814-27.391-55.327-27.401-71.147,0L5.568,421.537c-15.814,27.391,3.934,61.616,35.574,61.616h429.714C502.485,483.153,522.25,448.938,506.43,421.537z M470.856,445.51H41.142c-2.67,0-4.313-2.835-2.975-5.152L253.024,68.215c1.335-2.313,4.611-2.318,5.949,0L473.83,440.357C475.166,442.671,473.533,445.51,470.856,445.51z"/><path fill="rgb(235,155,50)" d="M255.999,184.991c-10.394,0-18.821,8.427-18.821,18.821v107.89c0,10.394,8.427,18.821,18.821,18.821s18.821-8.427,18.821-18.821v-107.89C274.821,193.418,266.394,184.991,255.999,184.991z"/><path fill="rgb(235,155,50)" d="M255.999,354.975c-10.394,0-18.821,8.427-18.821,18.821v11.239c0,10.394,8.427,18.821,18.821,18.821s18.821-8.427,18.821-18.821v-11.239C274.821,363.4,266.394,354.975,255.999,354.975z"/></svg></div>
<?
if($item['vk'] == 1) {
	$nst=GetIdVK($item['id_user']);
	if($nst[0]['nstdl']==1) {
		$item['id_user']=160;
	}
}
$nameUser=GetNameP($item['id_user']);
$imgUs=gImg($item['id_user']);
if(!$imgUs['image']) {
	$ava="emp.svg";
}
else {
	$ava=$imgUs['image']; 
}
?>
	<div class="ava cur help">
		<img class="imgava ava_<?=$item['id']?>_id" onclick="show_ac('<?=$imgUs['login']?>')" title="Статистика участника <?=$imgUs['login']?>" src="https://xn--80adsajtfqq.xn--80asehdb/images/account/<?=$ava?>" />
	</div>
<?
if($item['vk'] == 1) {
	echo "<a href='https://vk.com/question.online' title='Вопрос задан участником из приложения ВКонтакте. Если участник, задавший вопрос, не прошёл авторизацию на сайте, вопросы публикуются от имени администратора'>";
	echo "<img class='ava_vk trans' alt='Приложение ВКонтакте' src='https://xn--80adsajtfqq.xn--80asehdb/images/Mezhdunarodny_logotip_VK.png' />";
	echo "</a>";
}
?>
		<div class="contentvopr" title="Кликните на текст вопроса,чтобы увидеть варианты ответа" >
			<nav class="st bb1px" itemscope itemtype="http://www.schema.org/SiteNavigationElement" role="navigation" >
				<<? if(!$_POST['myv']) {?>a itemprop="url" href="/Участники/Все_вопросы/<?=$imgUs['login']?>" title="Участник <?=$imgUs['login']?> задал <?=CountVUs(GetIdP($imgUs['login']))?> вопроса(ов). Кликните для показа вопросов только этого автора" <?} else {?>span <?}?> class="nameuser tdn gray fwb trans <? if(!$_POST['myv']) {?>bb<?}?> mob dib bbt"><?=$nameUser['login']?></<? if(!$_POST['myv']) {?>a<?} else {?>span <?}?>>
				<<? if(!$_POST['myv']) {?>a itemprop="url" href="/Вопросы/<?=GetIdCat($item['id_cat'])?>/<?=$item['id']?>" title="Вопрос №<?=$item['id']?>"<?} else {?>span <?}?> class="<? if(!$_POST['myv']) {?>bb<?}?> nameuser tdn gray fwb trans dib bbt">№<?=$item['id']?></<? if(!$_POST['myv']) {?>a<?} else {?>span <?}?>>
				<a itemprop="url" href="/Вопросы/<?=GetIdCat($item['id_cat'])?>" title="В категории &#34;<?=GetIdCat($item['id_cat'])?>&#34; задано <?=CountVCat($item['id_cat'])?> вопроса(ов). Кликните для показа вопросов только этой категории" class="bb nameuser tdn gray fwb trans dib bbt"><?=GetIdCat($item['id_cat'])?></a><?if($_SESSION["login"]) { ?><?if($item['id_cat']==89) { echo " <i class='bb nameuser tdn gray fwb trans mob' onclick='show(&apos;pr_v&apos;)'>(Задать такой вопрос за 10 &#8381;)</i>"; }?><? }?>
			</nav>
			<p class="textvopr p10 fwb bb1px" id="open_<?=$item['id']?>_s" <?if(!$_POST['myv']) {?> onclick="open_vopr('<?=$item['id']?>');"<?}?>><?=$item['text']?></p>
<?
if($item['imgvopr']) {?>
	<div class='textvopr bb1px ptb3' <?if(!$_POST['myv']) {?> onclick='open_vopr("<?=$item[id]?>");'<?}?>><img alt='Вопрос: <?=$item['text']?>' class='imgvopr' src='https://xn--80adsajtfqq.xn--80asehdb/images/vopr/<?=$item[imgvopr]?>'/></div>
<?}?>
<?
if($item['id_cat'] == 89) {?>
	<div class='textvopr p10 mob bb1px'><a class="bb tdn fwb gray" target="_blank" href="<?=$item['promo_href']?>"><?=$item['promo_vopr']?></a></div>
<? } ?>
			<div class="st">
				<div class="mt dib cur" title="Очень плохой вопрос!"><a class="mn fwb tdn" <? if($_SESSION['login']) { echo "onclick='jalo_add(&apos;".$item['id']."&apos;);'"; } else echo "onclick='show(&apos;log&apos;,&apos;body&apos;)'"?>>
					<svg class="icsv trans" style="fill-rule:evenodd; clip-rule:evenodd" viewBox="0 0 250 250"><path id="j_<?=$item['id']?>_i" class="<?=$pj?>" d="M183 51c3,0 7,1 8,3 7,7 7,24 7,33 0,8 1,21 -5,27 -3,2 -7,4 -11,4 -7,1 -14,4 -20,8 0,0 -1,1 -1,1 -9,7 -17,16 -24,24 -10,11 -21,24 -27,38 -4,11 -5,22 -4,33 0,2 1,6 0,8 0,0 -1,0 -1,0 -2,0 -5,-1 -7,-2 0,0 -1,-1 -1,-1 -8,-5 -12,-15 -13,-25 0,-6 3,-12 5,-18 4,-9 7,-18 7,-28 0,-5 -1,-10 -4,-14 -9,-17 -30,-21 -48,-23 -7,-1 -17,-2 -22,-7 -2,-2 -3,-5 -2,-8 0,-1 1,-2 2,-3 7,-5 11,-13 8,-22 0,-1 0,-3 0,-5 1,-2 4,-5 6,-6 7,-4 11,-12 9,-20 0,-1 1,-2 1,-3 1,-2 4,-4 6,-5 8,-3 13,-10 13,-18 0,-1 0,-1 1,-2 3,-3 8,-3 12,-3 12,0 43,3 54,7 5,2 9,5 13,7 6,4 13,10 20,13 7,3 13,4 19,5zm29 -1c4,0 10,0 12,3 7,7 7,24 7,33 0,8 1,21 -5,27 -3,3 -7,4 -12,4 4,-10 4,-22 4,-30 0,-12 -1,-26 -6,-37zm26 78c-10,9 -24,10 -34,10 -5,0 -10,0 -15,-1 -7,0 -14,3 -17,5 -8,7 -15,14 -22,22 -8,8 -18,21 -23,33 -3,8 -4,16 -3,24 0,6 1,11 -1,16 -3,8 -10,13 -19,13 -6,0 -13,-2 -18,-6 -13,-8 -21,-23 -22,-40 -1,-10 3,-18 6,-26 3,-7 5,-14 5,-21 0,-14 -23,-17 -35,-19 -11,-2 -23,-4 -33,-11 -7,-6 -10,-16 -8,-26 1,-7 5,-12 10,-16 -2,-6 -1,-12 1,-18 3,-6 8,-11 14,-15 -1,-5 0,-11 3,-17 4,-6 9,-11 16,-13 0,-6 2,-11 7,-15 7,-7 16,-9 26,-9 13,0 48,3 61,8 6,2 11,6 16,9 4,3 14,10 18,12 11,5 26,2 38,2 9,0 20,1 27,9 11,12 12,31 12,46 0,13 0,31 -12,41z"/></svg>
					<span id="jalo_<?=$item['id']?>_id" class="lh2 trans"><?=$item['jalo']?></span></a></div>
				<div class="mt dib cur" title="Мне нравится этот вопрос!"><a class="mn fwb tdn" <? if($_SESSION['login']) { echo "onclick='like_add(&apos;".$item['id']."&apos;);'"; } else echo "onclick='show(&apos;log&apos;,&apos;body&apos;)'"?>>
					<svg class="icsv trans" viewBox="0 0 19.5 19.5"><path id="l_<?=$item['id']?>_i" class="<?=$pl?>" d="M9.75,17.75c-0.195,0-0.391-0.057-0.561-0.172c-0.225-0.151-5.508-3.73-7.146-5.371C0.212,10.376,0,8.43,0,7.125C0,4.161,2.411,1.75,5.375,1.75c1.802,0,3.398,0.891,4.375,2.256c0.977-1.365,2.573-2.256,4.375-2.256c2.964,0,5.375,2.411,5.375,5.375c0,1.305-0.212,3.251-2.043,5.082c-1.641,1.641-6.923,5.22-7.146,5.371C10.141,17.693,9.945,17.75,9.75,17.75z M5.375,3.75C3.514,3.75,2,5.264,2,7.125c0,1.093,0.173,2.384,1.457,3.668c1.212,1.212,4.883,3.775,6.293,4.746c1.41-0.971,5.081-3.534,6.293-4.746C17.327,9.509,17.5,8.218,17.5,7.125c0-1.861-1.514-3.375-3.375-3.375S10.75,5.264,10.75,7.125c0,0.552-0.447,1-1,1s-1-0.448-1-1C8.75,5.264,7.236,3.75,5.375,3.75z"/></svg>
					<span id="like_<?=$item['id']?>_id" class="lh2 trans"><?=$item['vlike']?></span></a></div>
<?if($item['id_cat']!=91) {?>					
<?
if($item['slog']>50) {$c="green";} else $c="red";
if($item['count_o']<100) {$cur="not";} else $cur="cur";
?>				
				<div class="mt dib mob <?=$cur?>" title="На вопрос дано <?=number_format($item['slog'],2)?> % правильных ответов (из <?=$item['count_o']?> ответов - <?=VChVPOU($item['id'])?> правильных)"><a class="mn fwb tdn" onclick="sh_rat('<?=$item['count_o']?>')">
					<? if($item['count_o']>99) { $c="fill='rgb(64,130,109)'"; } else $c="";?>
					<svg class="icsv trans" viewBox="0 0 282.772 282.772"><path <?=$c?> d="M61.472,143.036H23.881c-4.971,0-9,4.029-9,9v94.185c0,4.971,4.029,9,9,9h37.591c4.971,0,9-4.029,9-9v-94.185C70.472,147.065,66.443,143.036,61.472,143.036z M52.472,237.22H32.881v-76.185h19.591V237.22z"/><path <?=$c?> d="M132.238,93.194H94.648c-4.971,0-9,4.029-9,9V246.22c0,4.971,4.029,9,9,9h37.591c4.971,0,9-4.029,9-9V102.194C141.238,97.224,137.209,93.194,132.238,93.194z M123.238,237.22h-19.591V111.194h19.591V237.22z"/><path <?=$c?> d="M203.005,150.471h-37.591c-4.971,0-9,4.029-9,9v86.749c0,4.971,4.029,9,9,9h37.591c4.971,0,9-4.029,9-9v-86.749C212.005,154.5,207.976,150.471,203.005,150.471z M194.005,237.22h-19.591v-68.749h19.591V237.22z"/><path <?=$c?> d="M273.772,96.516H236.18c-4.971,0-9,4.029-9,9V246.22c0,4.971,4.029,9,9,9h37.591c4.971,0,9-4.029,9-9V105.516C282.772,100.545,278.742,96.516,273.772,96.516z M264.772,237.22H245.18V114.516h19.591V237.22z"/><path <?=$c?> d="M178.918,112.796c3.276,2.381,7.739,2.28,10.905-0.246l67.269-53.682l-0.298,8.847c-0.167,4.968,3.724,9.131,8.692,9.298c0.104,0.003,0.206,0.005,0.309,0.005c4.831,0,8.826-3.833,8.99-8.697l1.061-31.466c0.083-2.491-0.869-4.905-2.631-6.667c-1.762-1.763-4.184-2.719-6.667-2.631l-31.466,1.061c-4.968,0.167-8.859,4.331-8.692,9.298c0.167,4.967,4.314,8.85,9.298,8.692l8.261-0.278l-59.993,47.876l-68.22-49.585c-2.988-2.172-7-2.298-10.117-0.317L4.176,108.734c-4.196,2.665-5.437,8.227-2.772,12.422c1.715,2.7,4.628,4.176,7.605,4.176c1.65,0,3.321-0.454,4.817-1.404l96.276-61.15L178.918,112.796z"/></svg>
					<span class="lh2 bb tdn <?=$c?> trans"><?=number_format($item['slog'],2)?> %</span></a></div>
				<div class="mt dib help" title="Цена вопроса,кликните чтобы узнать подробнее"><a class="mn fwb tdn" onclick="show('price_dm','body')">
					<svg class="icsv trans" viewBox="0 0 985.131 985.131"><path d="M254.81,196.476c-8.282-22.262-18.769-44.347-33.626-62.78c-19.739-24.489-46.578-43.41-78.386-47.577c-31.297-4.1-64.907,3.346-89.787,23.385C1.393,151.077-3.668,224.069,1.668,285.379c2.713,31.163,9.372,62.34,19.312,91.989l62.3-21.839c-4.249-12.674-7.804-25.543-10.673-38.589c-5.374-28.271-7.51-57.108-6.087-85.857c1.136-13.485,3.307-26.861,7.259-39.814c2.406-6.229,5.279-12.229,8.722-17.945c2.641-3.537,5.506-6.875,8.628-9.993c3.196-2.513,6.553-4.777,10.073-6.813c4.404-1.926,8.928-3.491,13.577-4.708c4.819-0.712,9.658-1.047,14.526-0.999c4.335,0.535,8.602,1.379,12.805,2.554c3.901,1.615,7.653,3.514,11.28,5.672c4.564,3.404,8.796,7.181,12.748,11.276c6.505,7.952,12.021,16.601,16.861,25.658c7.926,16.616,13.913,34.061,19.433,51.605c1.943,6.175,3.779,12.382,5.536,18.611L25.055,538.407l243.034,361.692h717.043V176.715H268.087L254.81,196.476z M268.051,528.407c5.514,0,10,4.486,10,10s-4.486,10-10,10c-5.514,0-10-4.486-10-10S262.537,528.407,268.051,528.407z M304.321,244.715h612.81V832.1h-612.81L106.979,538.407l119.96-178.528c4.583,36.218,6.375,72.759,5.304,109.269c-25.038,12.998-42.193,39.154-42.193,69.261c0,43.01,34.991,78,78,78c43.009,0,78-34.99,78-78c0-32.467-19.944-60.353-48.219-72.078c1.458-54.335-2.578-108.409-13.349-161.964c-1.536-7.64-3.168-15.252-4.897-22.838L304.321,244.715z"/><path d="M605.039,644.296h-96.465v65h96.465v38.744h65v-38.744H771.28V511.591H670.039v-67.706h94.852v-64.999h-94.852V341.38h-65v37.506H500.959v197.705h104.078L605.039,644.296L605.039,644.296z M565.958,511.591v-67.706h39.079v67.706H565.958zM706.28,576.591v67.705h-36.241v-67.705H706.28z"/></svg>
					<span class="lh2 bb" id="price_<?=$item['id']?>"><?=$item['price']?><span class="mob trans">&nbsp;очк.</span></span></a></div>
<?
$summa=SummOtv($item['id']);
$coauth=SummOtvCoauth($summa);
$coauth2=SummOtvCoauth2($summa);
?>
<?if($item['count_o']<1) {$cur="not";} else $cur="cur";?>
				<div class="mt dib mob <?=$cur?>" title="На вопрос ответило <?=$item['count_o']?> участников, автор вопроса <?=$coauth2?> <?=number_format($summa, 0, ',', ' ')?> очков"><a class="mn fwb trans tdn" <?if($item['count_o']>0) {?> onclick="show_ot('vopr','<?=$item['id']?>')"<?}?>>
					<svg class="icsv trans" viewBox="0 0 297 297"><path d="M281.779,123.042c-1.053-10.432-1.706-23.472-7.228-34.321c-4.909-9.646-15.451-21.143-37.79-21.143h-49.258c9.147-4.603,15.44-14.073,15.44-24.992c0-15.42-12.545-27.965-27.965-27.965c-12.28,0-22.729,7.96-26.479,18.988c-3.749-11.029-14.198-18.988-26.479-18.988c-15.42,0-27.965,12.545-27.965,27.965c0,10.919,6.294,20.39,15.44,24.992H60.238c-22.339,0-32.881,11.498-37.79,21.143c-5.522,10.849-6.175,23.889-7.228,34.321C12.287,152.104,0.234,238.917,0.234,238.917c-0.007,0.062-0.014,0.126-0.02,0.188c-1.143,11.431,2.332,22.263,9.788,30.501c7.454,8.237,17.887,12.774,29.375,12.774h218.248c11.489,0,21.921-4.537,29.375-12.774c7.455-8.238,10.931-19.07,9.788-30.501c-0.006-0.062-0.013-0.126-0.02-0.188C296.766,238.917,284.713,152.104,281.779,123.042z M174.979,35.245c4.047,0,7.34,3.293,7.34,7.34s-3.293,7.34-7.34,7.34s-7.34-3.293-7.34-7.34S170.931,35.245,174.979,35.245z M122.021,35.245c4.047,0,7.34,3.293,7.34,7.34s-3.293,7.34-7.34,7.34c-4.047,0-7.34-3.293-7.34-7.34S117.974,35.245,122.021,35.245z M148.5,51.562c2.375,6.986,7.437,12.737,13.954,16.016h-27.908C141.063,64.299,146.125,58.548,148.5,51.562z M60.238,88.202h176.524c14.351,0,19.818,6.211,22.424,19.171c-5.925-2.864-12.461-4.49-19.214-4.49H57.029c-6.753,0-13.29,1.626-19.214,4.49C40.42,94.413,45.887,88.202,60.238,88.202zM271.707,255.767c-3.495,3.861-8.496,5.988-14.083,5.988H39.376c-5.587,0-10.588-2.127-14.083-5.988c-3.477-3.843-5.097-8.998-4.566-14.525l11.253-94.896c0.007-0.062,0.014-0.126,0.02-0.188c1.228-12.278,12.689-22.65,25.028-22.65h182.943c12.34,0,23.801,10.372,25.028,22.65c0.006,0.062,0.013,0.126,0.02,0.188l11.253,94.896C276.803,246.769,275.184,251.925,271.707,255.767z"/></svg>
					<span class="lh2 <?=$coauth?> bb tdn trans" id="pay_<?=$item['id']?>"><?=pre_num($summa)?>&nbsp;очк.</span></a></div>
<?} ?>
				<div id="skazka_<?=$item['id']?>" class="mt dib"></div>
			</div>
		</div>
		<div <? if(!$_POST['myv']) {?>class="dspn"<?}?> id="close_<?=$item['id']?>">
			<div class='contentvopr'>
				<div class="textvopr bt1px p10" id='block_<?=$item['id']?>'>
<?	if($_POST['myv']) {
		$kolotv=VChVOUvar($item['id']);
		if($kolotv!=0) {
			$var1=number_format(VChVOUvar($item['id'],1)/$kolotv*100,2)."%";
			$var2=number_format(VChVOUvar($item['id'],2)/$kolotv*100,2)."%";
			$var3=number_format(VChVOUvar($item['id'],3)/$kolotv*100,2)."%";
			$var4=number_format(VChVOUvar($item['id'],4)/$kolotv*100,2)."%";
		}
		else $var1=$var2=$var3=$var4=0;
	}
?>	
					<div <?if($_POST['myv']) {?> style="background: linear-gradient(to left, rgba(64,130,109,1) 0%,#fff <? echo $var1;?>)"<?}?> class="otvop cur fwb dib trans" <? if(!$_POST['myv']) {?><?if($_SESSION['login']) {echo "id='".$item['id']."_otv1' onclick='otv_get(&apos;".$item['id']."&apos;,1)'";} else echo "onclick='show(&apos;log&apos;,&apos;body&apos;)'"?><? } ?>>A.<span class="io" itemprop="text"><?=$item['otv1']?></span><div class="varpoz fs10 gray help <? if(!$_POST['myv']) {echo "dspn";}?>" id="v<?=$item['id']?>_o1" title="Процент участников, выбравших данный вариант ответа"><? if($_POST['myv']) {echo $var1;}?></div></div>
					<div <?if($_POST['myv']) {?> style="background: linear-gradient(to left, rgba(64,130,109,1) 0%,#fff <? echo $var2;?>)"<?}?> class="otvop cur fwb dib trans" <? if(!$_POST['myv']) {?><?if($_SESSION['login']) {echo "id='".$item['id']."_otv2' onclick='otv_get(&apos;".$item['id']."&apos;,2)'";} else echo "onclick='show(&apos;log&apos;,&apos;body&apos;)'"?><? } ?>>B.<span class="io" itemprop="text"><?=$item['otv2']?></span><div class="varpoz fs10 gray help <? if(!$_POST['myv']) {echo "dspn";}?>" id="v<?=$item['id']?>_o2" title="Процент участников, выбравших данный вариант ответа"><? if($_POST['myv']) {echo $var2;}?></div></div>
					<div <?if($_POST['myv']) {?> style="background: linear-gradient(to left, rgba(64,130,109,1) 0%,#fff <? echo $var3;?>)"<?}?> class="otvop cur fwb dib trans" <? if(!$_POST['myv']) {?><?if($_SESSION['login']) {echo "id='".$item['id']."_otv3' onclick='otv_get(&apos;".$item['id']."&apos;,3)'";} else echo "onclick='show(&apos;log&apos;,&apos;body&apos;)'"?><? } ?>>C.<span class="io" itemprop="text"><?=$item['otv3']?></span><div class="varpoz fs10 gray help <? if(!$_POST['myv']) {echo "dspn";}?>" id="v<?=$item['id']?>_o3" title="Процент участников, выбравших данный вариант ответа"><? if($_POST['myv']) {echo $var3;}?></div></div>
					<div <?if($_POST['myv']) {?> style="background: linear-gradient(to left, rgba(64,130,109,1) 0%,#fff <? echo $var4;?>)"<?}?> class="otvop cur fwb dib trans" <? if(!$_POST['myv']) {?><?if($_SESSION['login']) {echo "id='".$item['id']."_otv4' onclick='otv_get(&apos;".$item['id']."&apos;,4)'";} else echo "onclick='show(&apos;log&apos;,&apos;body&apos;)'"?><? } ?>>D.<span class="io" itemprop="text"><?=$item['otv4']?></span><div class="varpoz fs10 gray help <? if(!$_POST['myv']) {echo "dspn";}?>" id="v<?=$item['id']?>_o4" title="Процент участников, выбравших данный вариант ответа"><? if($_POST['myv']) {echo $var4;}?></div></div>
				</div>
			</div>
		</div>
</div>
<? endforeach; ?>
<? endif; ?>
<? if(count($questions)<10) { ?>
<div class="vopros">
	<div class="row">
	<div class="bv">
		<div id="netvoprosov" class="taz bt1px bb1px">
			<? if($name_c && !$id && !$_POST['myv']) { echo "<p class='fwb p13'>В категории &laquo;".$name_c."&raquo; найдено <span class='green fs14'>".CountVCat(GetNameCat($name_c),$_SESSION['login'])."</span> вопроса(ов), на которые Вы еще не ответили.</p><a class='addvopr_promo' href='/Вопросы'>Вопросы из всех категорий</a>"; } ?>
			<? if($log_user && !$id && !$_POST['myv']) { echo "<p class='fwb p13'>Участник <span class='green fs14'>".$log_user."</span> задал <span class='green fs14'>".CountVUs(GetIdP($log_user),$_SESSION['login'])."</span> вопроса(ов), на которые Вы еще не ответили.</p><a class='addvopr_promo' href='/Вопросы'>Вопросы всех участников</a>"; } ?>
		</div>
	</div>
	</div>
</div>
<? if(!$log_user && !$name_c && !$id) { echo "<div class='row'><div class='vopros_add trans' onclick='show(&apos;add_v&apos;,&apos;body&apos;)'><div class='addvoprv'><p class='addvopr fwb p10 trans' title='Добавьте вопрос и получайте очки за неправильные ответы!'>+ Добавить вопрос</p></div></div></div>"; } ?>
<? } ?>
<? if(count($questions)>5) { ?>
<? $direct=$direct+1; ?>
<div class="vopros" id="d_<?=$direct?>_d">
<div class="row">
<div class="bv">
<a class="nameuser bb tdn gray fwb trans">Реклама</a>
<div class="tp"></div>
<div class="direct">
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-5970012836635368"
     data-ad-slot="5626601130"
     data-ad-format="auto"></ins>
<script>
(adsbygoogle=window.adsbygoogle || []).push({});
</script>
</div>
</div>
</div>
</div>
<? } ?>
<img id="loadImg" class="trans dspn" alt="Загрузка" src="https://xn--80adsajtfqq.xn--80asehdb/images/ajax-loader.gif" />