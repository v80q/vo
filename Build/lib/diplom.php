<?php
	session_start();
	require_once "function.php";
	require_once "counters.php";
	$login_inf = GetLogP($_SESSION['login']);
	$img="/home/u435735/xn--80adsajtfqq.xn--80asehdb/www/lib/diplom/diplo.jpg";
	$pic = ImageCreateFromjpeg($img);
	$color=ImageColorAllocate($pic, 52, 61, 77);
	$color2=ImageColorAllocate($pic, 222,81,74);
	$color3=ImageColorAllocate($pic, 64,130,109);
	$file=time();
	$h = 1620;
	$font="/home/u435735/xn--80adsajtfqq.xn--80asehdb/www/lib/diplom/Arial-Bold_.ttf";
	$bbox = imagettfbbox(70, 0, $font, $login_inf[0]['name']);
	$l=(imagesx($pic)-($bbox[2]-$bbox[0]))/2;
	$l2=1680;
	ImageTTFtext($pic, 70, 0, $l, $h, $color3, $font, $login_inf[0]['name']);


	if(ChVU($login_inf[0]['id'])>0 && ChOU($login_inf[0]['id'])>0 && $login_inf[0]['ochk'] != 0) {
		$RatingLog = RatingLogg($login_inf[0]['id']);
	}
	else {
		$RatingLog="нет";
	}

	$bbox = imagettfbbox(30, 0, $font, date("F j, Y, g:i a"));
	$l=(imagesx($pic)-($bbox[2]-$bbox[0]))/2;
	ImageTTFtext($pic, 30, 0, $l, 390, $color, $font, date("F j, Y, g:i a"));
	
	$bbox = imagettfbbox(70, 0, $font, $RatingLog);
	$l=(imagesx($pic)-($bbox[2]-$bbox[0]))/2;
	ImageTTFtext($pic, 70, 0, $l, $h+260, $color2, $font, $RatingLog);
	
	$bbox = imagettfbbox(50, 0, $font, number_format($login_inf[0]['ochk'], 0, ',', ' '));
	ImageTTFtext($pic, 40, 0, $l2, $h+502, $color, $font, number_format($login_inf[0]['ochk'], 0, ',', ' '));
	
	$bbox = imagettfbbox(50, 0, $font, CountOtv($login_inf[0]['id']));
	ImageTTFtext($pic, 40, 0, $l2, $h+701, $color, $font, CountOtv($login_inf[0]['id']));

	if($login_inf[0]['uspeh']!=0) {$itog=number_format($login_inf[0]['uspeh'], 2);} if($login_inf[0]['uspeh']==0) {$itog="0.00";}
	$bbox = imagettfbbox(50, 0, $font, $itog);
	ImageTTFtext($pic, 40, 0, $l2, $h+760, $color, $font, $itog);

	$bbox = imagettfbbox(50, 0, $font, ChVU($login_inf[0]['id']));
	ImageTTFtext($pic, 40, 0, $l2, $h+958, $color, $font, ChVU($login_inf[0]['id']));

	$bbox = imagettfbbox(50, 0, $font, number_format(SlogVUs($login_inf[0]['id']),2));
	ImageTTFtext($pic, 40, 0, $l2, $h+1018, $color, $font, number_format(SlogVUs($login_inf[0]['id']),2));

	ImageTTFtext($pic, 30, 0, 100, 3485, $color, $font, $file);
	
	Imagejpeg($pic,"/home/u435735/xn--80adsajtfqq.xn--80asehdb/www/lib/diplom/all/".$file.".jpg");
	ImageDestroy($pic);
?>
<div class="dm-overlay w100" id="diplom">
	<div class="dm-table w100">
		<div class="dm-cell">
			<div class="dm-modal w100">
				<svg onclick="del_bl('#diplom')" class="closdiv cur pa hov_d trans" viewBox="0 0 612 612"><polygon fill="rgba(222,81,74,1)" points="612,36.004 576.521,0.603 306,270.608 35.478,0.603 0,36.004 270.522,306.011 0,575.997 35.478,611.397 306,341.411 576.521,611.397 612,575.997 341.459,306.011"/></svg>
				<div class='p30'>
					<img property="og:image" class="w50" src="/lib/diplom/all/<?=$file?>.jpg">
					<div class="p10">
						<a id="l_fb" class="trans brad share_smm" onclick="window.open(this.href, 'Опубликовать в Facebook', 'width=800,height=300,resizable=yes,toolbar=0,status=0'); return false" title="Рассказать в Facebook" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https://xn--80adsajtfqq.xn--80asehdb/%D0%94%D0%B8%D0%BF%D0%BB%D0%BE%D0%BC/<?=$file?>&picture=https://xn--80adsajtfqq.xn--80asehdb/lib/diplom/all/<?=$file?>.jpg" ></a>
						<a id="l_ok" class="trans brad share_smm" onclick="window.open(this.href, 'Опубликовать в Одноклассники', 'width=800,height=300,resizable=yes,toolbar=0,status=0'); return false" title="Рассказать в Одноклассники" target="_blank" href="https://connect.ok.ru/offer?url=https://xn--80adsajtfqq.xn--80asehdb/%D0%94%D0%B8%D0%BF%D0%BB%D0%BE%D0%BC/<?=$file?>"></a>
						<a id="l_vk" class="trans brad share_smm" onclick="window.open(this.href, 'Опубликовать в ВКонтакте', 'width=800,height=300,resizable=yes,toolbar=0,status=0'); return false" title="Рассказать в ВКонтакте" target="_blank" href="http://vk.com/share.php?url=https://<?=urldecode("викторина.онлайн/Диплом/")?><?=$file?>&title=<?=urldecode("Мой диплом Викторина.Онлайн")?>&noparse=true"></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
