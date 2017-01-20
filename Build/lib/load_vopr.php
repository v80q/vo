<?
	session_start();
	require_once "function.php";
	require_once "counters.php";
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
	<svg onclick="del_bl('#<?=$item['id']?>')" role="img" class="pa closdiv hov_d trans mob cur"><use xlink:href="#closdiv"></use></svg>
	<svg onclick="open_vopr('<?=$item['id']?>')" role="img" class="replyvopr hov_d trans mob cur"><use xlink:href="#replyvopr"></use></svg>
	<svg onclick="show_error('<?=$item['id']?>')" role="img" class="pa attention hov_d trans mob cur"><use xlink:href="#attention"></use></svg>
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
	<?if($item['id_user']!=160) {?>
		<img class="imgava ava_<?=$item['id']?>_id" onclick="show_ac('<?=$imgUs['login']?>')" title="Статистика участника <?=$imgUs['login']?>" src="https://xn--80adsajtfqq.xn--80asehdb/images/account/<?=$ava?>" />
	<?} else {?>
		<svg role="img" class="imgava ava_<?=$item['id']?>_id"><use xlink:href="#ava_admin"></use></svg>
	<?}?>
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
					<svg role="img" class="icsv trans"><use xlink:href="#dislike"></use></svg>
					<span id="jalo_<?=$item['id']?>_id" class="lh2 trans"><?=$item['jalo']?></span></a></div>
				<div class="mt dib cur" title="Мне нравится этот вопрос!"><a class="mn fwb tdn" <? if($_SESSION['login']) { echo "onclick='like_add(&apos;".$item['id']."&apos;);'"; } else echo "onclick='show(&apos;log&apos;,&apos;body&apos;)'"?>>
					<svg role="img" class="icsv trans"><use xlink:href="#like"></use></svg>
				<span id="like_<?=$item['id']?>_id" class="lh2 trans"><?=$item['vlike']?></span></a></div>
<?if($item['id_cat']!=91) {?>					
<?
if($item['slog']>50) {$c="green";} else $c="red";
if($item['count_o']<100) {$cur="not";} else $cur="cur";
?>				
				<div class="mt dib mob <?=$cur?>" title="На вопрос дано <?=number_format($item['slog'],2)?> % правильных ответов (из <?=$item['count_o']?> ответов - <?=VChVPOU($item['id'])?> правильных)"><a class="mn fwb tdn" onclick="sh_rat('<?=$item['count_o']?>')">
					<svg role="img" class="icsv trans"><use xlink:href="#graph"></use></svg>
					<span class="lh2 bb tdn <?=$c?> trans"><?=number_format($item['slog'],2)?> %</span></a></div>
				<div class="mt dib help" title="Цена вопроса,кликните чтобы узнать подробнее"><a class="mn fwb tdn" onclick="show('price_dm','body')">
					<svg role="img" class="icsv trans"><use xlink:href="#price"></use></svg>
					<span class="lh2 bb" id="price_<?=$item['id']?>"><?=$item['price']?><span class="mob trans">&nbsp;очк.</span></span></a></div>
<?
$summa=SummOtv($item['id']);
$coauth=SummOtvCoauth($summa);
$coauth2=SummOtvCoauth2($summa);
?>
<?if($item['count_o']<1) {$cur="not";} else $cur="cur";?>
				<div class="mt dib mob <?=$cur?>" title="На вопрос ответило <?=$item['count_o']?> участников, автор вопроса <?=$coauth2?> <?=number_format($summa, 0, ',', ' ')?> очков"><a class="mn fwb trans tdn" <?if($item['count_o']>0) {?> onclick="show_ot('vopr','<?=$item['id']?>')"<?}?>>
					<svg role="img" class="icsv trans"><use xlink:href="#kassa"></use></svg>
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