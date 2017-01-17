<?php
	session_start();
	require_once "function.php";
	require_once "counters.php";
	if($_POST['selector']){$selector=$_POST['selector'];}
	if($_POST['id']){$id=(int)$_POST['id'];}
?>
<div class="dm-overlay w100" id="page_otv">
	<div class="dm-table w100">
		<div class="dm-cell">				
			<div class="dm-modal w100 taz plrb3">
				<svg onclick="del_bl('#page_otv')" class="sv closdiv cur pa hov_d trans" viewBox="0 0 612 612"><polygon fill="rgba(222,81,74,1)" points="612,36.004 576.521,0.603 306,270.608 35.478,0.603 0,36.004 270.522,306.011 0,575.997 35.478,611.397 306,341.411 576.521,611.397 612,575.997 341.459,306.011"/></svg>
				<div class="p10 green fwb ">Динамика набора очков <?if($selector!="user_all") {?><?if($selector=="user") {?>за ответы<?}?><?if($selector=="user_v") {?>за вопросы<?}?><?}?></span></div>
				<div id="chart_div">
					<img class="ptb3" id="loadImg_o" alt="Загрузка" src="https://xn--80adsajtfqq.xn--80asehdb/images/ajax-loader.gif" />
				</div>
				<?	if($selector=='vopr') {
						$id_vopr=$_POST['id'];
						$vopr=GetVR($id_vopr);
						$user=gImg($vopr[0]['id_user']);
				?>				
				<div class="p10 green fwb ">На вопрос <span class="fs14 gray">№<?=$id_vopr?></span> ответило <span class="fs14 gray"><?=$vopr[0]['count_o']?></span> участника(ов)</div>
				<div class="p10 fs10 gray fwb ">* На этом вопросе участник <span class="green"><?=$user['login']?></span> заработал <span class="green" title="<?=number_format(SummOtv($vopr[0]['id']), 0, ',', ' ')?>"><?=pre_num(SummOtv($vopr[0]['id']))?></span> очков.</div>
				<? } ?>
				<?	if($selector=='user_o') {
						$id_user=$_POST['id'];
						$user=gImg($id_user)
				?>				
				<div class="p10 green fwb ">За свои ответы участник <span class="fs14 gray"><?=$user['login']?></span> заработал <span class="fs14 gray"><?=SummOtvU($id_user)?></span> очков*</div>
				<?if(ChVU($id_user)) {?><div class="p10 fs10 gray fwb ">* Так же участник <span class="green"><?=$user['login']?></span> задал <span class="green"><?=ChVU($id_user)?></span> вопрос, на который(е) дано <span class="green"><?=number_format(CounOAllV($id_user), 0, ',', ' ')?></span> ответов . На вопросах заработано <span class="green" title="<?=number_format(ChVOPrice($id_user), 0, ',', ' ')?>"><?=pre_num(-ChVOPrice($id_user))?></span> очков</div><?}?>
				<? } ?>
				<?	if($selector=='user_v') {
						$id_user=$_POST['id'];
						$user=gImg($id_user)
				?>				
				<div class="p10 green fwb ">За свои вопросы участник <span class="fs14 gray"><?=$user['login']?></span> заработал <span class="fs14 gray"><?=pre_num(-ChVOPrice($id_user))?></span> очков*</div>
				<?if(ChVU($id_user)) {?><div class="p10 fs10 gray fwb ">* Так же участник <span class="green"><?=$user['login']?></span> ответил на <span class="green"><?=ChOU($id_user)?></span> вопрос(ов).</div><?}?>
				<? } ?>
				<?	if($selector=='user_all') {
						$id_user=$_POST['id'];
						$user=gImg($id_user)
				?>				
				<div class="p10 green fwb ">На ответах <?if(ChVU($id_user)) {?>и вопросах <?}?>участник <span class="fs14 gray"><?=$user['login']?></span> заработал <span class="fs14 gray"><?=pre_num(-ChVOPrice($id_user)+SummOtvU($id_user))?></span> очков</div>
				<? } ?>				
				<div class="trans">
				<?$id_c=GetVR($id);?>
					<a id="l_vk" class="trans brad share_smm" onclick="window.open(this.href, 'Опубликовать в ВКонтакте', 'width=800,height=300,resizable=yes,toolbar=0,status=0'); return false" title="Рассказать в ВКонтакте" target="_blank" href="http://vk.com/share.php?url=https://викторина.онлайн/Вопросы/<?=GetIdCat($id_c[0]['id_cat'])?>/<?=$id?>"></a>
					<a id="l_ok" class="trans brad share_smm" onclick="window.open(this.href, 'Опубликовать в Одноклассники', 'width=800,height=300,resizable=yes,toolbar=0,status=0'); return false" title="Рассказать в Одноклассники" target="_blank" href="https://connect.ok.ru/offer?url=https://викторина.онлайн/Вопросы/<?=GetIdCat($id_c[0]['id_cat'])?>/<?=$id?>"></a>
					<a id="l_fb" class="trans brad share_smm" onclick="window.open(this.href, 'Опубликовать в Facebook', 'width=800,height=300,resizable=yes,toolbar=0,status=0'); return false" title="Рассказать в Facebook" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https://викторина.онлайн/Вопросы/<?=GetIdCat($id_c[0]['id_cat'])?>/<?=$id?>"></a>
				</div>				
			</div>
		</div>
	</div>
</div>
<script>
$(function(){GetChart()});
function GetChart(){google.charts.load('current',{'packages':['corechart']});google.charts.setOnLoadCallback(drawChart)}
function drawChart() {
	jsonData=$.post({url:"/lib/chart_otv.php",dataType:"json",data:{'<?=$selector?>':<?=$id?>}}).done(function(jsonData){var data=new google.visualization.DataTable(jsonData);var chart=new google.visualization.SteppedAreaChart(document.getElementById('chart_div'));
	var options={
		tooltip:{
			isHtml: true,
			textStyle:{
				color:'black',
				fontName:'Verdana',
				bold:true,
			}
		},
		chartArea:{
			height:'90%'
		},
		backgroundColor:{
			fill:'transparent'
		},
		colors:['gray'],
		curveType:'1',
		enableInteractivity:true,
		legend:'none',
	};chart.draw(data,options)})}
</script>
