<?
	session_start();
	include "function.php";
	include "counters.php";
	if($_POST['num']) {
		$num = $_POST['num'];
	}
	if(!$_POST['num']) {
		$num = 0;
	}
?>
<div class='dm-overlay w100' id='sh_rat'>
	<div class='dm-table w100'>
		<div class='dm-cell'>
			<div class='dm-modal w100'>
				<svg onclick="del_bl('#sh_rat')" class='closdiv cur pa' version='1.1' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' x='0px' y='0px' width='612px' height='612px' viewBox='0 0 612 612' xml:space='preserve'><polygon points='612,36.004 576.521,0.603 306,270.608 35.478,0.603 0,36.004 270.522,306.011 0,575.997 35.478,611.397 306,341.411 576.521,611.397 612,575.997 341.459,306.011'/></svg>
				<p class='p30 gray fwb'>На данный момент невозможно показать подробную статистику вопроса, так как на него ответило недостаточное количество участников.</br>
				Как только на вопрос будет дано <span class='fs16 green'>100</span> необходимых ответов, кнопка станет зелёной (&nbsp;<svg class="sv cur" viewBox="0 0 282.772 282.772"><path fill="rgb(64,130,109)" d="M61.472,143.036H23.881c-4.971,0-9,4.029-9,9v94.185c0,4.971,4.029,9,9,9h37.591c4.971,0,9-4.029,9-9v-94.185C70.472,147.065,66.443,143.036,61.472,143.036z M52.472,237.22H32.881v-76.185h19.591V237.22z"></path><path fill="rgb(64,130,109)" d="M132.238,93.194H94.648c-4.971,0-9,4.029-9,9V246.22c0,4.971,4.029,9,9,9h37.591c4.971,0,9-4.029,9-9V102.194C141.238,97.224,137.209,93.194,132.238,93.194z M123.238,237.22h-19.591V111.194h19.591V237.22z"></path><path fill="rgb(64,130,109)" d="M203.005,150.471h-37.591c-4.971,0-9,4.029-9,9v86.749c0,4.971,4.029,9,9,9h37.591c4.971,0,9-4.029,9-9v-86.749C212.005,154.5,207.976,150.471,203.005,150.471z M194.005,237.22h-19.591v-68.749h19.591V237.22z"></path><path fill="rgb(64,130,109)" d="M273.772,96.516H236.18c-4.971,0-9,4.029-9,9V246.22c0,4.971,4.029,9,9,9h37.591c4.971,0,9-4.029,9-9V105.516C282.772,100.545,278.742,96.516,273.772,96.516z M264.772,237.22H245.18V114.516h19.591V237.22z"></path><path fill="rgb(64,130,109)" d="M178.918,112.796c3.276,2.381,7.739,2.28,10.905-0.246l67.269-53.682l-0.298,8.847c-0.167,4.968,3.724,9.131,8.692,9.298c0.104,0.003,0.206,0.005,0.309,0.005c4.831,0,8.826-3.833,8.99-8.697l1.061-31.466c0.083-2.491-0.869-4.905-2.631-6.667c-1.762-1.763-4.184-2.719-6.667-2.631l-31.466,1.061c-4.968,0.167-8.859,4.331-8.692,9.298c0.167,4.967,4.314,8.85,9.298,8.692l8.261-0.278l-59.993,47.876l-68.22-49.585c-2.988-2.172-7-2.298-10.117-0.317L4.176,108.734c-4.196,2.665-5.437,8.227-2.772,12.422c1.715,2.7,4.628,4.176,7.605,4.176c1.65,0,3.321-0.454,4.817-1.404l96.276-61.15L178.918,112.796z"></path></svg>&nbsp;).</p>
				<p class='p10 gray fwb'>Сейчас: <span class='fs16 red'><?=$num?></span> ответ(ов)</p>
				<?if($num>100) {?><p class='p10 gray fwb'>Извините, станица на доработке 31.12.2016 г.</p><?}?>
			</div>
		</div>
	</div>
</div>
