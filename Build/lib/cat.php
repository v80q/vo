<?
	session_start();
	require_once "function.php";
	require_once "counters.php";
?>
<?	if(!$_GET['name_c']&&!$_GET['id']) {
	$mysqli=connectDB();
	$sql="SELECT id,name FROM c_v ORDER by name";	
	$result=$mysqli->query($sql);
	$categ=getResult($result);
	closeDB($mysqli);?>
<p class="sr fwb green help" title="Самые популярные категории вопросов">Популярные категории</p>
<nav itemscope itemtype="http://www.schema.org/SiteNavigationElement" class="podh2 mb3 bt1px bb1px w90" role="navigation" > 
<?	if($categ) :?>
<?  foreach($categ as $item) :?>
<?	if(CountVCat($item['id'])>5) {?>
	<a itemprop="url" role="link" title="Категория вопросов &laquo;<?=$item['name']?>&raquo;" style="display:block" class="ptb3 tdn gray fwb trans" href="/Вопросы/<?=$item['name']?>"><span class="bb bbt"><?=$item['name']?></span><span title="В популярной категории <?=$item['name']?> задано <?=CountVCat($item['id'])?> вопросов" class="fwb help green"> (<?=CountVCat($item['id'])?>)</span><?if(NewVopr($item['id'])>0){?><span title="Количество новых вопросов, добавленных за последние 24 часа" class="green fs10 help">&nbsp;+<?=NewVopr($item['id']);?></span><?}?><span title="Средний процент правильных ответов на вопроы категории" class="r_bl fwb help red fs10"><?=number_format(SlogVCat($item['id']),2)?>%<span></a>
<? } ?>
<?	endforeach; ?>
<?	endif; ?>
</nav>
	<a itemprop="url" role="link" class="fwb fs10 bb tdn green" title="Карта сайта" href="Карта_сайта">Карта сайта</a>
<? } ?>
<?	if($_GET['name_c']&&!$_GET['id']) {
	$id_cat=GetNameCat($_GET['name_c']);
	$mysqli=connectDB();
	$sql="SELECT id,text,slog FROM v_v WHERE id_cat='".$id_cat."' AND slog<'30' AND is_actual != '0' ORDER by id LIMIT 20";	
	$result=$mysqli->query($sql);
	$idvs=getResult($result);
	closeDB($mysqli);?>
<p class="sr fwb green help" title="Самые сложный вопросовы в категории">Сложные вопросы</p>
<nav itemscope itemtype="http://www.schema.org/SiteNavigationElement" class="podh2 mb3 bt1px bb1px w90" role="navigation" >  
<?	if($idvs) :?>
<?  foreach($idvs as $item) :?>
	<a itemprop="url" class="ptb3 dib tdn gray fwb trans bb bbt" title="Вопрос №<?=$item['id']?>" href="/Вопросы/<?=$_GET['name_c']?>/<?=$item['id']?>"><?=$item['id']?></a><span title="Процент правильных ответов на вопрос" class="help red fs10"> (<?=number_format($item['slog'],2)?>) </span>
<?	endforeach; ?>
<?	endif; ?>
</nav>
	<a itemprop="url" class="fwb fs10 bb tdn green" title="Карта сайта" href="/Карта_сайта">Карта сайта</a>
<? } ?>