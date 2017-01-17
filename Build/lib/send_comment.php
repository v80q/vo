<?php 
if($_POST['name_comment']) {
	$name_comment=$_POST['name_comment'];
}	
if($_POST['text_comment']) {
	$text_comment=$_POST['text_comment'];
}
if($_POST['mail_comment']) {
	$mail_comment=$_POST['mail_comment'];
}
$to  = "<viktorina.online@yandex.ru>"; 
$subject = "Викторина.Онлайн"; 

$message =  "
<!DOCTYPE html>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
	<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
</head>

<div style='border:0;padding:0;margin:0;background-color:#fff;font-family:&quot;PT Sans&quot;,Helvetica Neue,Helvetica,Lucida Grande,tahoma,verdana,arial,sans-serif;text-align:center;' bgcolor='white'>
<div style='background-color:#fff;'>
<table id='wrapper2871f1b7180ec27ac0a2f656b0441263' align='center' width='100%' cellpadding='12' cellspacing='0' style='border-collapse:collapse;'>
<tbody><tr>
<td>
<div style='padding-top:16px;padding-bottom:24px;'>
	<table cellspacing='0' cellpadding='0' border='0' width='100%' style='width:100%;'>
		<tbody><tr>
			<td valign='bottom '>
				<div style='padding-top:2px;color:#383434;line-height:22px;font-weight:bold;font-size:25px;font-family:&quot;PT Sans&quot;,Helvetica Neue,Helvetica,Lucida Grande,tahoma,verdana,arial,sans-serif;text-align:left;'>Викторина.Онлайн</div>
				<div style='padding-top:9px;color:#9099a3;line-height:17px;font-size:15px;font-family:&quot;PT Sans&quot;,Helvetica Neue,Helvetica,Lucida Grande,tahoma,verdana,arial,sans-serif;text-align:left;'>Быть - умным всегда модно!</div>
			</td>
			<td width='86' valign='top' style='width:86px;'>
				<a href='https://xn--80adsajtfqq.xn--80asehdb'><img alt='' width='86' height='86' style='border:0;padding:0;margin:0;display:block;' src='https://xn--80adsajtfqq.xn--80asehdb/mail/logo256х256.jpg'></a>
			</td>
		</tr></tbody>
	</table>
</div>
<div style='text-align:center;border-top:1px solid #f0f0f0;padding:28px 0;'>
	<p>&nbsp;&nbsp;&nbsp;</p>
</div>
<div style='text-align:center;border-top:1px solid #f0f0f0;padding:28px 0;'>
	<a href='https://xn--80adsajtfqq.xn--80asehdb' target='_blank' style='display:inline-block;font-weight:normal;font-size:15px;line-height:22px;padding:10px 35px;color:#7292bd;border:1px solid #7292bd;border-radius:4px;text-decoration:none;'>Викторина.Онлайн</a>
</div>
<div style='padding-top:15px;padding-bottom:15px;border-top:1px solid #f0f0f0;margin-top:20px;'>
	<div style='padding-top:3px;color:#b3b3b1;font-family:&quot;PT Sans&quot;,Helvetica Neue,Helvetica,Lucida Grande,tahoma,verdana,arial,sans-serif;text-align:left;font-size:13px;line-height:20px;'>
		<div style='margin-top:10px;margin-bottom:10px;'>Викторина.Онлайн в социальных сетях:
		<span style='white-space:nowrap;'>      <a href='https://twitter.com/ViktorinaOnline' target='_blank' style='text-decoration:none;color:#b3b3b1;font-weight:bold;'>Twitter</a>
			<a href='https://vk.com/viktorina.online' target='_blank' style='text-decoration:none;color:#b3b3b1;font-weight:bold;'>ВКонтакте</a>
			<p><a href='https://vk.com/question.online' target='_blank' style='text-decoration:none;color:#4d7198;font-weight:bold;'>Приложение ВКонтакте</a></p>
		</span>
	</div>
	</div>
</div>
</td>
</tr>
</tbody></table>
</div>
</div>
</br><b>Имя: '".$name_comment."', Почта для ответа: '".$mail_comment."'</b></br></br><p>Текст: '".$text_comment."'</p> ";

$headers  = "Content-type: text/html; charset=UTF-8 \r\n"; 
$headers .= "From: viktorina.online@yandex.ru\r\n";
$headers .= "Reply-To: viktorina.online@yandex.ru\r\n"; 

mail($to, $subject, $message, $headers); 
?>
<div class="dm-overlay w100" id="send_com"><div class="dm-table w100"><div class="dm-cell"><div class="dm-modal w100">
<svg onclick="del_bl('#send_com')" class="sv closdiv cur pa hov_d trans" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="612px" height="612px" viewBox="0 0 612 612" xml:space="preserve"><polygon points="612,36.004 576.521,0.603 306,270.608 35.478,0.603 0,36.004 270.522,306.011 0,575.997 35.478,611.397 306,341.411 576.521,611.397 612,575.997 341.459,306.011"/></svg>
<p class="p30 green fwb fs14">Сообщение успешно отправлено!</p>
</div></div></div></div>