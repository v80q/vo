<?php
	session_start();

	$client_id='5501972';
	$client_secret='WlO0fT5BpSqxEuzfkoKk';
	$redirect_uri='https://xn--80adsajtfqq.xn--80asehdb/lib/vk_auth.php';
	$url='https://oauth.vk.com/authorize';
	$params=array(
		'client_id'     => $client_id,
		'redirect_uri'  => $redirect_uri,
		'response_type' => 'code',
		'scope'			=> 'friends,notify,offline,email'
	);
	
	$client_id_ok='1247407104';
	$public_key_ok='CBANOKFLEBABABABA';
	$client_secret_ok='FE7FD87197D0C8C999F45E6E';
	$redirect_uri_ok='https://xn--80adsajtfqq.xn--80asehdb/lib/ok_auth.php';
	$url_ok='https://connect.ok.ru/oauth/authorize';
	$params_ok=array(
		'client_id'     => $client_id_ok,
		'redirect_uri'  => $redirect_uri_ok,
		'response_type' => 'code',
		'scope'			=> 'SET_STATUS'
	);

	function url_parse($url) {
		$url_p=parse_url($url);
		if($url_p[query]) {
			header("Location: /ошибка");
		}		
	}
	
	function GetCountryInVK($country) {
		$params=array(
			'country_ids'         => $country
		);
		$countryVK=json_decode(file_get_contents('https://api.vk.com/method/database.getCountriesById' . '?' . urldecode(http_build_query($params))), true);
		if (isset($countryVK['response'])) {
			$countryVK=$countryVK['response'][0]['name'];
			return $countryVK;
		}
	}
	
	function GetCitiesInVK($city) {
		$params=array(
			'city_ids'         => $city
		);
		$cityVK=json_decode(file_get_contents('https://api.vk.com/method/database.getCitiesById' . '?' . urldecode(http_build_query($params))), true);
		if (isset($cityVK['response'])) {
			$cityVK=$cityVK['response'][0]['name'];
			return $cityVK;
		}
	}
	
	function GetCitiesPoTit($cityVK) {
		$mysqli=connectDB();
		$sql="SELECT id FROM city_v WHERE city='".$cityVK."'";
		$result_set=$mysqli->query($sql);
		$id_city=GetResult($result_set);
		$id_city=(int)$id_city[0]['id'];
		return $id_city;
		closeDB($mysqli);	
	}
	
	function GetCountryPoTit($countryVK) {
		$mysqli=connectDB();
		$sql="SELECT id FROM country_v WHERE country='".$countryVK."'";
		$result_set=$mysqli->query($sql);
		$id_country=GetResult($result_set);
		$id_country=(int)$id_country[0]['id'];
		return $id_country;
		closeDB($mysqli);	
	}
	
	function connectDB() {
		$mysqli=new mysqli("90.156.143.64", "p8080q", "qwe123qwe123", "vik");
		$mysqli->query("SET NAMES utf8");
		return $mysqli; 
		//return new mysqli("90.156.143.64", "p8080q", "qwe123qwe123", "vik");
		//$mysqli->query("SET NAMES utf-8");
                //$mysqli->query("SET NAMES CP1251");
		//$mysqli->query("SET SESSION collation_connection='utf8'");
		//$mysqli->query("SET CHARACTER SET utf8");
		//$mysqli->set_charset('utf8');
		if (mysqli_connect_errno()) {
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
		}

		/* change character set to utf8 */
		if ($mysqli->set_charset("utf8")) {
			printf("Error loading character set utf8: %s\n", $mysql->error);
		} else {
			printf("Current character set: %s\n", $mysqli->character_set_name());
		}

	}
	
	function closeDB($mysqli) {
		$mysqli->close();
	}

	function ProvLogVK($id_vk) {
		$mysqli=connectDB();
		$result_log=$mysqli->query("SELECT id, login FROM u_v WHERE id_vk='".$id_vk."'");
		closeDB($mysqli);	
		return GetResult($result_log);
	}
	
	function ProvLogOK($id_ok) {
		$mysqli=connectDB();
		$result_log=$mysqli->query("SELECT id FROM u_v WHERE id_ok='".$id_ok."'");
		closeDB($mysqli);	
		return GetResult($result_log);
	}

	function gMAX() {
		$mysqli=connectDB();
		$result_log=$mysqli->query("SELECT MAX(id) FROM u_v");
		closeDB($mysqli);	
		return GetResult($result_log);
	}
	
	function GetGChartsOtvV($result) {
		$val_o=0;
		$data='{"cols":[';
		$data.='{"id":"","label":"Дата","type":"string"},';
		$data.='{"id":"","label":"Очки","type":"number"}';
		$data.='],"rows":[';
		$data.='{"c":[{"v":"Регистрация"},{"v":0}]},';
			for($i=0; mysqli_num_rows($result)>$i; $i++) {
				$row=mysqli_fetch_array($result, MYSQLI_ASSOC);
				$val_o=$val_o + $row['nagrada'];
				$nameU=gImg($row['id_user']);
				$data.='{"c":[{"v":"Дата:'.substr($row['date_add'],0,10).' Участник:'.$nameU['login'].'"},{"v":'.-$val_o.'}]},';
			}       
		$data=rtrim($data,',');
		$data.=']}';
		return $data;
	}
	function GetGChartsOtvU($result) {
		$val_o=0;
		$data='{"cols":[';
		$data.='{"id":"","label":"Дата","type":"string"},';
		$data.='{"id":"","label":"Очки","type":"number"}';
		$data.='],"rows":[';
		$data.='{"c":[{"v":"Регистрация"},{"v":0}]},';
			for($i=0; mysqli_num_rows($result)>$i; $i++) {
				$row=mysqli_fetch_array($result, MYSQLI_ASSOC);
				$val_o=$val_o + $row['nagrada'];
				if($row['id_vopr']=="0") {
					$nameU=" ОБНУЛЕНИЕ";
				} else $nameU=" Вопрос:".$row['id_vopr'];
				$data.='{"c":[{"v":"Дата:'.substr($row['date_add'],0,10).''.$nameU.'"},{"v":'.$val_o.'}]},';
			}       
		$data=rtrim($data,',');
		$data.=']}';
		return $data;
	}
	function GetGChartsOtvUO($result) {
		$val_o=0;
		$data='{"cols":[';
		$data.='{"id":"","label":"Дата","type":"string"},';
		$data.='{"id":"","label":"Очки","type":"number"}';
		$data.='],"rows":[';
		$data.='{"c":[{"v":"Регистрация"},{"v":0}]},';
			for($i=0; mysqli_num_rows($result)>$i; $i++) {
				$row=mysqli_fetch_array($result, MYSQLI_ASSOC);
				$val_o=$val_o + $row['nagrada'];
				$nameU=gImg($row['id_user']);
				$data.='{"c":[{"v":"Дата:'.substr($row['date_add'],0,10).' Участник:'.$nameU['login'].'"},{"v":'.-$val_o.'}]},';
			}       
		$data=rtrim($data,',');
		$data.=']}';
		return $data;
	}
	function GetGChartsOtvUALL($result,$user_all) {
		$val_o=0;
		$data='{"cols":[';
		$data.='{"id":"","label":"Дата","type":"string"},';
		$data.='{"id":"","label":"Очки","type":"number"}';
		$data.='],"rows":[';
		$data.='{"c":[{"v":"Регистрация"},{"v":0}]},';
			for($i=0; mysqli_num_rows($result)>$i; $i++) {
				$row=mysqli_fetch_array($result, MYSQLI_ASSOC);
				if($row['id_user']!=$user_all) {
					$nameU=gImg($row['id_user']);
					$nameU=" Участник:".$nameU['login'];
					$row['nagrada']=-$row['nagrada'];
				} else {
					$nameU=" Вопрос:".$row['id_vopr'];
					if($row['id_vopr']=="0") {
						$nameU=" ОБНУЛЕНИЕ";
					}
				}
				$val_o=$val_o + $row['nagrada'];
				$data.='{"c":[{"v":"Дата:'.substr($row['date_add'],0,10).''.$nameU.'"},{"v":'.$val_o.'}]},';
			}       
		$data=rtrim($data,',');
		$data.=']}';
		echo $data;
	}
	function GetGChartsOtvP($result) {
		$val_o=0;
		$data='{"cols":[';
		$data.='{"id":"","label":"Дата","type":"string"},';
		$data.='{"id":"","label":"Очки","type":"number"}';
		$data.='],"rows":[';
		$data.='{"c":[{"v":"Регистрация"},{"v":0}]},';
			for($i=0; mysqli_num_rows($result)>$i; $i++) {
				$row=mysqli_fetch_array($result, MYSQLI_ASSOC);
				$val_o=$val_o + $row['nagrada'];
				$data.='{"c":[{"v":"'.$row['date_add'].'"},{"v":'.$val_o.'}]},';
			}       
		$data=rtrim($data,',');
		$data.=']}';
		return $data;
	}
	
	function regVKUser($login, $mail, $password, $password2, $id_vk) {
		$mysqli=connectDB();	
		$mysqli->query("INSERT INTO u_v (`login`, `password`, `password2`, `mail`, `id_vk`) VALUES ('".$login."', '".$password."', '".$password2."', '".$mail."', '".$id_vk."')");
		closeDB($mysqli);
	}	
	
	function regOKUser($login, $mail, $password, $password2, $id_ok) {
		$mysqli=connectDB();	
		$mysqli->query("INSERT INTO u_v (`login`, `password`, `password2`, `mail`, `id_ok`) VALUES ('".$login."', '".$password."', '".$password2."', '".$mail."', '".$id_ok."')");
		closeDB($mysqli);
	}

	function isSecurity($image) {
		$filename=$image["name"];
		$filetype=$image["type"];
		$filesize=$image["size"];
		$fileblacklist=array(".php", ".phtml", ".php3", ".php4");
		foreach ($fileblacklist as $item) {
			if (preg_match ("/$item\$/i", $filename)) return false;
		}
			if (($filetype != "image/gif") && ($filetype != "image/png") && ($filetype != "image/jpg") && ($filetype != "image/jpeg")) return false;
			if ($filesize>5048576) return false;
			return true;
		}
	
	function loadImage($image, $login) {
		$filetype=$image["type"];
		$uploaddir="images/account/";
		$filename=md5(microtime()).".".substr($filetype, strlen("image/"));
		$uploadfile=$uploaddir.$filename;
		if (move_uploaded_file($image["tmp_name"], $uploadfile)) {
			setImage($login, $filename);
			return true;
		}
		else return false;
	}
	
	function loadImageV($imgvopr) {
		$filetype=$imgvopr["type"];
		$uploaddir="images/vopr/";
		$filename=md5(microtime()).".".substr($filetype, strlen("image/"));
		$uploadfile=$uploaddir.$filename;
		if (move_uploaded_file($imgvopr["tmp_name"], $uploadfile)) {
			return $filename;
		}
		else return false;
	}
	
	function setImage($login, $filename) {
		$mysqli=connectDB();
		$mysqli->query("UPDATE u_v SET image='".$filename."' WHERE login='".$login."'");
		closeDB($mysqli);
	}
	function imgVKUser($login, $photo_max) {
		$img=md5($login).".jpg";
		$path="/home/u435735/xn--80adsajtfqq.xn--80asehdb/www/images/account/".$img;
		file_put_contents($path, file_get_contents($photo_max));
		setImage($login, $img);
	}
	
	function imgOKUser($login, $photo_max) {
		$img=md5($login).".jpg";
		$path="/home/u435735/xn--80adsajtfqq.xn--80asehdb/www/images/account/".$img;
		file_put_contents($path, file_get_contents($photo_max));
		setImage($login, $img);
	}
	
	function GetInf($login) {
		$mysqli=connectDB();
		$result_set=$mysqli->query("SELECT id, name, ochk, uspeh, image FROM u_v WHERE login='".$login."'");
		$user_inf=mysqli_fetch_array($result_set, MYSQLI_ASSOC);
		closeDB($mysqli);
		return $user_inf;
	}

	function addErr($idu, $prav_o, $id_v) {
		$mysqli=connectDB();
		$sql="INSERT INTO error_v (id_user, id_vopr, text) VALUES ('".$idu."', '".$id_v."', '".$prav_o."')";
		$mysqli->query($sql);
		closeDB($mysqli);
	}

	function addTel($idu, $telefon) {
		$mysqli=connectDB();
		$sql="UPDATE u_v SET telefon='".$telefon."' WHERE id='".$idu."'";
		$mysqli->query($sql);
		closeDB($mysqli);
	}
	
	function addVopr($text, $razd, $ids, $cat, $otv1, $otv2, $otv3, $otv4, $pr_otv, $price, $filename, $promo_vopr=FALSE, $promo_href=FALSE) {
		$mysqli=connectDB();
		$sql="INSERT INTO v_v (text, id_razd, id_user, avtor, id_cat, otv1, otv2, otv3, otv4, pr_otv, price, imgvopr, promo_vopr, promo_href) VALUES ('".$text."', '".$razd."', '".$ids."', '".$ids."', '".$cat."', '".$otv1."', '".$otv2."', '".$otv3."', '".$otv4."', '".$pr_otv."', '".$price."', '".$filename."', '".$promo_vopr."', '".$promo_href."')";
		addVoprSendMail($text, $razd, $ids, $cat, $otv1, $otv2, $otv3, $otv4, $pr_otv, $price);
		$mysqli->query($sql);
		closeDB($mysqli);
	}

	function addVoprSendMail($text, $razd, $ids, $cat, $otv1, $otv2, $otv3, $otv4, $pr_otv, $price) {
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
				<tbody>
				<tr>
					<td valign='bottom '>
						<div style='padding-top:2px;color:#383434;line-height:22px;font-weight:bold;font-size:25px;font-family:&quot;PT Sans&quot;,Helvetica Neue,Helvetica,Lucida Grande,tahoma,verdana,arial,sans-serif;text-align:left;'>Викторина.Онлайн</div>
						<div style='padding-top:9px;color:#9099a3;line-height:17px;font-size:15px;font-family:&quot;PT Sans&quot;,Helvetica Neue,Helvetica,Lucida Grande,tahoma,verdana,arial,sans-serif;text-align:left;'>Быть - умным всегда модно!</div>
					</td>
					<td width='86' valign='top' style='width:86px;'>
						<a href='https://xn--80adsajtfqq.xn--80asehdb'><img alt='' width='86' height='86' style='border:0;padding:0;margin:0;display:block;' src='https://xn--80adsajtfqq.xn--80asehdb/mail/logo256х256.jpg'></a>
					</td>
				</tr>
				</tbody>
			</table>
		</div>
		<div style='text-align:center;border-top:1px solid #f0f0f0;padding:28px 0;'>
			<p style='font-size:16px'>Категория: <b>".GetIdCat($cat)."</b>&nbsp;Цена: <b>".$price."</b></p>
			<p style='font-size:16px'><b>".$text."</br></b></p>
			<p style='font-size:14px'><b>".$otv1."</br></b></p>
			<p style='font-size:14px'><b>".$otv2."</br></b></p>
			<p style='font-size:14px'><b>".$otv3."</br></b></p>
			<p style='font-size:14px'><b>".$otv4."</br></b></p>
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
		</div>";
		$headers  = "Content-type: text/html; charset=UTF-8 \r\n"; 
		$headers .= "From: viktorina.online@yandex.ru\r\n";
		$headers .= "Reply-To: viktorina.online@yandex.ru\r\n"; 
		mail($to, $subject, $message, $headers); 
	}
	
	function GetCat() {
		$mysqli=connectDB();
		$result_set=$mysqli->query("SELECT id, name, parent_id FROM c_v ORDER BY name");
		$categories=array();
		for ($i=0; mysqli_num_rows($result_set)>$i; $i++) {
			$row=mysqli_fetch_array($result_set, MYSQLI_ASSOC);
			if(!$row['parent_id']) {
				$categories[$row['id']][]=$row['name'];
			}
			else {
				$categories[$row['parent_id']]['next'][$row['id']]=$row['name'];
			}
		}
		return $categories;
		closeDB($mysqli);
	}
	
	function IdCountry() {
		$mysqli=connectDB();
		$result_set=$mysqli->query("SELECT id, country FROM country_v ORDER BY country");
		$id_country=GetResult($result_set);
		return $id_country;
		closeDB($mysqli);
	}
	
	function IdCity() {
		$mysqli=connectDB();
		$result_set=$mysqli->query("SELECT id, city FROM city_v ORDER BY city");
		$id_city=GetResult($result_set);
		return $id_city;
		closeDB($mysqli);
	}
	
	function Idmonth() {
		$mysqli=connectDB();
		$result_set=$mysqli->query("SELECT id, name FROM month_v ORDER BY id");
		$id_month=GetResult($result_set);
		return $id_month;
		closeDB($mysqli);
	}	
	
	function GetRazd() {
		$mysqli=connectDB();
		$result_set=$mysqli->query("SELECT id, name, parent_id FROM r_v ORDER BY name");
		$razd=array();
		for ($i=0; mysqli_num_rows($result_set)>$i; $i++) {
			$row=mysqli_fetch_array($result_set, MYSQLI_ASSOC);
			if(!$row['parent_id']) {
				$razd[$row['id']][]=$row['name'];
			}
			else {
				$razd[$row['parent_id']]['next'][$row['id']]=$row['name'];
			}
		}
		return $razd;
		closeDB($mysqli);
	}

	function getResult($result) {
		if(!$result) {
			exit(mysqli_error());
		}
		if(mysqli_num_rows($result) == 0) {
			return FALSE;
		}
		$row=array();
		for($i=0; mysqli_num_rows($result)>$i; $i++) {
			$row[]=mysqli_fetch_array($result, MYSQLI_ASSOC);
		}
		return $row;
	}
	
	
	function RatingAllUser() {
		$mysqli=connectDB();		
		$result_set=$mysqli->query("SELECT login, ochk FROM u_v ORDER BY ochk DESC");
		$RAllUser=array();
		for ($i=0; mysqli_num_rows($result_set)>$i; $i++) {
            $row=mysqli_fetch_array($result_set, MYSQLI_ASSOC);
            $RAllUser[$i][$row['login']]= $row['ochk'];
			}
        return $RAllUser;
		closeDB($mysqli);
	}		
	
	function GetNameCat($name_c) {
		$mysqli=connectDB();	
		$sql="SELECT id FROM c_v WHERE name='".$name_c."'";
		$result=$mysqli->query($sql);
		$row=getResult($result);
		closeDB($mysqli);
		return $row[0]['id'];	
	}
	
	function GetIdCat($id) {
		$mysqli=connectDB();	
		$sql="SELECT name FROM c_v WHERE id='".$id."'";
		$result=$mysqli->query($sql);
		$row=getResult($result);
		closeDB($mysqli);
		return $row[0]['name'];	
	}
	
	function GetNameRazd($name_r) {
		$mysqli=connectDB();	
		$sql="SELECT id FROM r_v WHERE name='".$name_r."'";
		$result=$mysqli->query($sql);
		$row=getResult($result);
		closeDB($mysqli);
		return $row[0]['id'];	
	}
	
	function addOtv($id_user, $id_vopr, $nagr, $otvet, $pdsk) {
		$mysqli=connectDB();
		$sql="INSERT INTO o_v (id_user, id_vopr, nagrada, otv, podsk) VALUES ('".$id_user."', '".$id_vopr."', '".$nagr."', '".$otvet."', '".$pdsk."')";
		$mysqli->query($sql);
		closeDB($mysqli);
	}
	
	function addNagr($id_user, $nagr) {
		$mysqli=connectDB();
		$sql="UPDATE u_v SET ochk=ochk + '".$nagr."' WHERE id='".$id_user."'";
		$mysqli->query($sql);
		closeDB($mysqli);
	}
	
	function addNagrU($id_u, $nagrU) {
		$mysqli=connectDB();
		$sql="UPDATE u_v SET ochk=ochk + '".$nagrU."' WHERE id='".$id_u."'";
		$mysqli->query($sql);
		closeDB($mysqli);
	}

	function GetLogP($login_p) {
		$mysqli=connectDB();
		$sql="SELECT * FROM u_v WHERE login='".$login_p."'";
		$result=$mysqli->query($sql);
		closeDB($mysqli);	
		return getResult($result);		
	}	
	
	function GetVR($id_vopr) {
		$mysqli=connectDB();
		$sql="SELECT * FROM v_v WHERE id='".$id_vopr."'";
		$result=$mysqli->query($sql);
		closeDB($mysqli);	
		return getResult($result);		
	}	
	
	function regDopUser($name, $age_d, $age_m, $age_y, $country, $city=FALSE, $pol, $login) {
		$mysqli=connectDB();
		$sql="UPDATE u_v SET age_d='".$age_d."', age_m='".$age_m."', age_y='".$age_y."', name='".$name."', country='".$country."', city='".$city."', pol='".$pol."' WHERE login='".$login."'";
		$result=$mysqli->query($sql);
		closeDB($mysqli);	
	}
	
	function ProvOtv($idv, $idu) {
		$mysqli=connectDB();	
		$sql="SELECT * FROM o_v WHERE id_user='".$idu."' AND id_vopr='".$idv."'";
		$result=$mysqli->query($sql);
		closeDB($mysqli);
		$row=getResult($result);	
		return $row[0];
	}

	function CountOtvV($idv) {
		$mysqli=connectDB();	
		$sql="SELECT COUNT( * ) as count FROM o_v WHERE id_vopr='".$idv."'";
		$result=$mysqli->query($sql);
		$row=getResult($result);
		closeDB($mysqli);
		return $row[0]['count'];
	}
	
	function CountPOtvV($idv) {
		$mysqli=connectDB();	
		$sql="SELECT COUNT( * ) as count FROM o_v WHERE id_vopr='".$idv."' AND nagrada>0";
		$result=$mysqli->query($sql);
		$row=getResult($result);
		closeDB($mysqli);
		return $row[0]['count'];	
	}

	function LogUserOtv($id_user) {
		$mysqli=connectDB();
		$result_log=$mysqli->query("SELECT login FROM u_v WHERE id='".$id_user."'");
		closeDB($mysqli);	
		return getResult($result_log);
	}
	
	function TextVoprOtv($id_vopr) {
		$mysqli=connectDB();
		$result_log=$mysqli->query("SELECT * FROM v_v WHERE id='".$id_vopr."'");
		closeDB($mysqli);	
		$result_log=getResult($result_log);
		return $result_log[0];
	}

	function gImg($id_user) {
		$mysqli=connectDB();
		$result=$mysqli->query("SELECT id, login, name, image, ochk, v_ochk FROM u_v WHERE id='".$id_user."'");
		$row=mysqli_fetch_array($result, MYSQLI_ASSOC);
		return $row;
	}
	
	function add_like($vopr_id) {
		$user_inf=GetInf($_SESSION["login"]);
		$mysqli=connectDB();
		$vopr_id=(int)$vopr_id;
		$user_id=(int)$user_inf['id'];
		$mysqli->query("UPDATE  v_v SET  vlike=vlike+1 WHERE  id='".$vopr_id."'");
		$mysqli->query("INSERT INTO l_v (id_v, id_u) VALUES ('".$vopr_id."', '".$user_id."')");
		closeDB($mysqli);
	}
	function add_poh($otv_id) {
		$user_inf=GetInf($_SESSION["login"]);
		$mysqli=connectDB();
		$otv_id=(int)$otv_id;
		$user_id=(int)$user_inf['id'];
		$mysqli->query("UPDATE o_v SET poh=poh+1 WHERE id='".$otv_id."'");
		$mysqli->query("INSERT INTO p_v (otv_id, user_id) VALUES ('".$otv_id."', '".$user_id."')");
		closeDB($mysqli);
	}
	function ProvLike($vopr_id, $user_id) {
		$mysqli=connectDB();
		$sql="SELECT COUNT( * ) as count FROM l_v WHERE id_u='".$user_id."' AND id_v='".$vopr_id."'";
		$result=$mysqli->query($sql);
		$row=getResult($result);
		closeDB($mysqli);
		return $row[0]['count'];
	}
	
	function CountVUs($user_id=FALSE,$login=FALSE) {
		if($login) {
			$user_inf = GetInf($login);
			$ids = $user_inf['id'];	
		}
		$mysqli=connectDB();
		$sql="SELECT COUNT( * ) as count FROM v_v WHERE id>0 AND is_actual != '0' ";
		if($user_id) {
			$sql .= " AND id_user=".$user_id;
		}
		if($ids) {
			$sql .= " AND id NOT IN(SELECT id_vopr FROM o_v WHERE id_user='".$ids."') ";
		}		
		$result=$mysqli->query($sql);
		$row=getResult($result);
		closeDB($mysqli);
		return $row[0]['count'];
	}

	function ProvPoh($otv_id, $user_id) {
		$mysqli=connectDB();
		$sql="SELECT COUNT( * ) as count FROM p_v WHERE user_id='".$user_id."' AND otv_id='".$otv_id."'";
		$result=$mysqli->query($sql);
		$row=getResult($result);
		closeDB($mysqli);
		return $row[0]['count'];
	}
	
	function likeCound($vopr_id) {
		$vopr_id=(int)$vopr_id;
		$mysqli=connectDB();		
		$result=$mysqli->query("SELECT vlike FROM v_v WHERE id='".$vopr_id."'");
		closeDB($mysqli);
		$row=getResult($result);
		return $row[0]['vlike'];
	}
	function pohCound($otv_id) {
		$otv_id=(int)$otv_id;
		$mysqli=connectDB();		
		$result=$mysqli->query("SELECT COUNT( * ) as count FROM p_v WHERE otv_id='".$otv_id."'");
		closeDB($mysqli);
		$row=getResult($result);
		return $row[0]['count'];
	}
	
	function add_jalo($vopr_id) {
		$user_inf=GetInf($_SESSION["login"]);
		$mysqli=connectDB();
		$vopr_id=(int)$vopr_id;
		$user_id=(int)$user_inf['id'];
		$mysqli->query("UPDATE  v_v SET  jalo=jalo+1 WHERE  id='".$vopr_id."'");
		$mysqli->query("INSERT INTO j_v (id_v, id_u) VALUES ('".$vopr_id."', '".$user_id."')");
		closeDB($mysqli);
	}
	
	function ProvJalo($vopr_id, $user_id) {
		$mysqli=connectDB();
		$sql="SELECT COUNT( * ) as count FROM j_v WHERE id_u='".$user_id."' AND id_v='".$vopr_id."'";
		$result=$mysqli->query($sql);
		$row=getResult($result);
		closeDB($mysqli);
		return $row[0]['count'];
	}
	
	function JaloCound($vopr_id) {
		$vopr_id=(int)$vopr_id;
		$mysqli=connectDB();		
		$result=$mysqli->query("SELECT jalo FROM v_v WHERE id='".$vopr_id."'");
		closeDB($mysqli);
		$row=getResult($result);
		return $row[0]['jalo'];
	}
	
	function GetVoprId($id_vopr) {
		$mysqli=connectDB();
		$result=$mysqli->query("SELECT id_user, pr_otv, price, id_cat FROM v_v WHERE id='".$id_vopr."'");
		$giv=mysqli_fetch_array($result, MYSQLI_ASSOC);
		closeDB($mysqli);
		return $giv;		
	}

	function GetIdVK($id) {
		$mysqli=connectDB();
		$result_log=$mysqli->query("SELECT id_vk, nstdl FROM u_v WHERE id='".$id."'");
		closeDB($mysqli);	
		return GetResult($result_log);
	}
	
	function GetNameP($id) {
		$mysqli=connectDB();
		$sql="SELECT login, name FROM u_v WHERE id='".$id."'";
		$result=$mysqli->query($sql);
		$nameUser=mysqli_fetch_array($result, MYSQLI_ASSOC);
		closeDB($mysqli);	
		return $nameUser;		
	}	
	
	function GetIdP($log_user) {
		$mysqli=connectDB();	
		$sql="SELECT id FROM u_v WHERE login='".$log_user."'";
		$result=$mysqli->query($sql);
		$id_user=mysqli_fetch_array($result, MYSQLI_ASSOC);
		closeDB($mysqli);	
		return $id_user['id'];	
	}
	
	function GetVId($id) {
		$mysqli=connectDB();
		$sql="SELECT id, text, date_add, id_razd, id_user, id_cat, otv1, otv2, otv3, otv4, pr_otv, price, vlike, jalo, imgvopr FROM v_v WHERE id='".$id."'";
		$result=$mysqli->query($sql);
		closeDB($mysqli);
		return getResult($result);
	}
	
	function RatTop() {
		$mysqli=connectDB();
		$sql="SELECT TOP(5) * FROM u_v WHERE (nstdl IS NULL OR nstdl='0') ORDER BY ochk";
		$result=$mysqli->query($sql);
		closeDB($mysqli);
		return getResult($result);
	}
	
	function RatingVU($slog=FALSE, $addu=FALSE) {
		$mysqli=connectDB();
		$sql="SELECT * FROM v_v WHERE id != 0 ";
		if($slog) {
			$sql .= " AND slog>'".$slog."' ORDER by slog ASC, date_add ASC ";
		}
		$sql .= " LIMIT '".$addu."', 5";
		$result=$mysqli->query($sql);
		closeDB($mysqli);
		return getResult($result);
	}
	
	function RatingVD($slog=FALSE, $addd=FALSE) {
		$mysqli=connectDB();
		$sql="SELECT * FROM v_v WHERE id != 0 ";
		if($slog) {
			$sql .= " AND slog <= '".$slog."' ORDER by slog DESC, date_add ASC ";
		}
		$sql .= " LIMIT '".$addd."', 6";
		$result=$mysqli->query($sql);
		closeDB($mysqli);
		return getResult($result);
	}
	
	function Pereraschet($id_user) {
		$v_ochk=-ChVOPrice($id_user);
		GetChVOPrice($v_ochk, $id_user);
		$ochk=ChVOPrice2($id_user);
		$ochk=$ochk+$v_ochk;
		GetChVOPrice2($ochk, $id_user);
	}
	
	function UpUsersInfV($id_user) {
		$v_ochk=-ChVOPrice($id_user); // подсчет количества заработанных очков с вопросов
		GetChVOPrice($v_ochk, $id_user); // обновление количества заработанных очков с вопросов
	}
	
	function UpUsersInfO($id_user) {
		$ochk=ChVOPrice2($id_user); // подсчет количества заработанных очков с ответов
		GetChVOPrice2($ochk, $id_user); // обновление количества заработанных очков с вопросов
	}
	
	function UpUsersInf($id_user) {
		$uspeh=number_format(ChPOU($id_user)/ChOU($id_user)*100, 10); // подсчет успеха участника
		GetUspeh($id_user, $uspeh); // обновление успеха участника
	}
	
	function UpVoprInf($id_vopr) {
		$count_o = CountOtvV($id_vopr); // подсчет количества ответов на вопрос
		$slog=number_format(CountPOtvV($id_vopr)/CountOtvV($id_vopr)*100, 10); // подсчет сложности вопроса
		GetSlog($slog, $id_vopr, $count_o); // обновление количества заработанных очков с вопросов
	}
	
	function UpUsersInfL($id_user) {
		$luv=ChLiVUs($id_user); // подсчет количества заработанных лайков с вопросов
		GetLikeUserV($luv, $id_user); // обновление количества заработанных лайков с вопросов
	}	
	
	function UpUsersInfD($id_user) {
		$dluv=ChDUs($id_user); // подсчет количества заработанных ДИСлайков с вопросов
		GetDLikeUserV($dluv, $id_user); // обновление количества заработанных ДИСлайков с вопросов
	}	
	
	function SlogVUs($id_user) {
		$mysqli=connectDB();	
		$sql="SELECT AVG(slog) as avg FROM v_v WHERE id_user='".$id_user."'";
		$result=$mysqli->query($sql);
		$result=getResult($result);
		return $result[0]['avg'];
	}
	function UnLoginUser($login) {
		$mysqli=connectDB();
		$sql="SELECT * FROM u_v WHERE login='".$login."'";
		$result=$mysqli->query($sql);
		$row=getResult($result);
		closeDB($mysqli);
		return $row;
	}
	function UnMailUser($mail) {
		$mysqli=connectDB();
		$sql="SELECT COUNT( * ) as count FROM u_v WHERE mail='".$mail."'";
		$result=$mysqli->query($sql);
		$row=getResult($result);
		closeDB($mysqli);
		return $row[0]['count'];
	}
	function GetCity($id) {
		$mysqli=connectDB();
		$sql="SELECT city FROM city_v WHERE id='".$id."'";
		$result=$mysqli->query($sql);
		$row=getResult($result);
		closeDB($mysqli);
		return $row;
	}
	function GetCountry($id) {
		$mysqli=connectDB();
		$sql="SELECT country FROM country_v WHERE id='".$id."'";
		$result=$mysqli->query($sql);
		$row=getResult($result);
		closeDB($mysqli);
		return $row;
	}
	function GetMonth($id) {
		$mysqli=connectDB();
		$sql="SELECT name FROM month_v WHERE id='".$id."'";
		$result=$mysqli->query($sql);
		$row=getResult($result);
		closeDB($mysqli);
		return $row;
	}	
	function GetTopUser() {
		$mysqli=connectDB();
		$sql="SELECT MAX(ochk) FROM u_v";
		$result=$mysqli->query($sql);
		$maxochk=getResult($result);
		$maxochk=$maxochk[0]['MAX(ochk)'];
		$sql="SELECT * FROM u_v WHERE (nstdl IS NULL OR nstdl='0') AND image IS NOT NULL ";
		$sql .= "AND id IN(SELECT DISTINCT id_user FROM v_v WHERE is_actual = '1') ";
		$sql .= "AND id IN(SELECT DISTINCT id_user FROM o_v) ";
		$sql .= "AND ochk <= ".$maxochk." ORDER by ochk DESC LIMIT 0, 3";
		$result=$mysqli->query($sql);	
		closeDB($mysqli);
		return getResult($result);
	}
	function GetTopVopr() {
		$mysqli=connectDB();
		$sql="SELECT MIN(slog) FROM v_v WHERE count_o>99";
		$result=$mysqli->query($sql);
		$minslog=getResult($result);
		$sql="SELECT * FROM v_v WHERE slog>=".$minslog[0]['MIN(slog)']." AND count_o>99 ORDER by slog ASC LIMIT 0,3";
		$result=$mysqli->query($sql);	
		closeDB($mysqli);
		return getResult($result);		
	}
	function GetSerSlog($id_vopr) {
		$mysqli=connectDB();
		$sql="SELECT * FROM v_v WHERE id='".$id_vopr."' AND count_o>99 ";
		$result=$mysqli->query($sql);
		closeDB($mysqli);
		$GetSerSlog=getResult($result);
		return $GetSerSlog;
	}
	function UpNstdl($id) {
		$mysqli=connectDB();
		$mysqli->query("UPDATE u_v SET nstdl=0 WHERE id=".$id." ");
		closeDB($mysqli);		
	}
	function pre_num($number) {
		if($number!=0) {
			if($number>1000000 || $number<-1000000) {
				$number=" ".number_format($number/1000000,2)."M";
				return $number;
				exit();
			}
			if($number>100000 || $number<-100000) {
				$number=" ".number_format($number/1000,0)."K";
				return $number;
				exit();
			}
			if($number>10000 || $number<-10000) {
				$number=" ".number_format($number/1000,1)."K";
				return $number;
				exit();
			}
			if($number>1000 || $number<-1000) {
				$number=" ".number_format($number/1000,2)."K";
				return $number;
				exit();
			}
		}
		return $number;
	}
	function PromoCat($id) {
		$mysqli=connectDB();
		$result=$mysqli->query("SELECT promo FROM c_v WHERE id='".$id."'");
		closeDB($mysqli);
		$result=getResult($result);
		return $result[0]['promo'];			
	}
	
	function GetMAXochk() {
		$mysqli=connectDB();
		$sql="SELECT MAX(ochk) FROM u_v";
		$result=$mysqli->query($sql);
		$maxochk=getResult($result);
		$maxochk=$maxochk[0]['MAX(ochk)'];
		$sql="SELECT ochk FROM u_v WHERE (nstdl IS NULL OR nstdl='0') AND image IS NOT NULL AND id IN(SELECT id_user FROM v_v WHERE is_actual = '1') AND ochk <= ".$maxochk." ORDER by ochk DESC LIMIT 0, 3";
		$result=$mysqli->query($sql);	
		closeDB($mysqli);
		return getResult($result);
	}
	function NewVopr($id_c=false) {
		$mysqli=connectDB();
		$sql="SELECT COUNT( * ) as count FROM v_v WHERE is_actual='1' AND date_add>CURDATE() - INTERVAL 1 DAY ";
		if($id_c) {
			$sql.="AND id_cat='".$id_c."'";
		}
		$result=$mysqli->query($sql);
		$result=getResult($result);
		$result=$result[0]['count'];
		closeDB($mysqli);
		return $result;			
	}
	
	function NewUser() {
		$mysqli=connectDB();
		$result=$mysqli->query("SELECT COUNT( * ) as count FROM u_v WHERE date_reg>CURDATE() - INTERVAL 1 DAY AND nstdl != '1'");
		$result=getResult($result);
		$result=$result[0]['count'];
		closeDB($mysqli);
		return $result;			
	}

	function LastOtv($id_user) {
		$mysqli=connectDB();
		$result=$mysqli->query("SELECT MAX(id) FROM o_v WHERE id_user='".$id_user."'");
		$result=getResult($result);
		$maxid=$result[0]['MAX(id)'];
		$result=$mysqli->query("SELECT date_add FROM o_v WHERE id='".$maxid."'");
		$result=getResult($result);
		$result=$result[0]['date_add'];
		return $result;		
	}
	
	function NewOchkV($id_user) {
		if ($_SESSION['login']) {
			$sess_id = GetLogP($_SESSION['login']);
			$mysqli=connectDB();
			$result=$mysqli->query("SELECT MAX(id) FROM o_v WHERE id_user='".$sess_id[0]['id']."'");
			$result=getResult($result);
			$maxid=$result[0]['MAX(id)'];
			$result=$mysqli->query("SELECT SUM(nagrada) as sum FROM o_v WHERE id_user='".$id_user."' AND id>'".$maxid."'");
			$result=getResult($result);
			$result=$result[0]['sum'];
			return $result;
		}
		if (!$_SESSION['login']) {
			$mysqli=connectDB();
			$result=$mysqli->query("SELECT SUM(nagrada) as sum FROM o_v WHERE id_user='".$id_user."' AND date_add>CURDATE() - INTERVAL 1 DAY");
			$result=getResult($result);
			$result=$result[0]['sum'];
			closeDB($mysqli);
			return $result;
		}
	}

	function NewOchkO($id_user) {
		if ($_SESSION['login']) {
			$sess_id = GetLogP($_SESSION['login']);
			$mysqli=connectDB();
			$result=$mysqli->query("SELECT MAX(id) FROM o_v WHERE id_user='".$sess_id[0]['id']."'");
			$result=getResult($result);
			$maxid=$result[0]['MAX(id)'];
			$result=$mysqli->query("SELECT SUM(nagrada) as sum FROM o_v WHERE id_vopr IN(SELECT id FROM v_v WHERE is_actual = '1' AND id_user='".$id_user."') AND id>'".$maxid."'");
			$result=getResult($result);
			$result=$result[0]['sum'];
			return -$result;
		}
		if (!$_SESSION['login']) {
			$mysqli=connectDB();
			$result=$mysqli->query("SELECT SUM(nagrada) as sum FROM o_v WHERE id_vopr IN(SELECT id FROM v_v WHERE is_actual = '1' AND id_user='".$id_user."') AND date_add>CURDATE() - INTERVAL 1 DAY");
			$result=getResult($result);
			$result=$result[0]['sum'];
			closeDB($mysqli);
			return -$result;	
		}			
	}
	
	function vise($id_o) {
		$mysqli = connectDB();
		$sql = "SELECT id,ochk,image FROM u_v WHERE nstdl = '0' AND image IS NOT NULL ";
		$sql .= "AND id IN(SELECT DISTINCT id_user FROM o_v) ";
		$sql .= "AND ochk > ".$id_o." ";
		$sql .= "ORDER by ochk ASC LIMIT 0,5";	
		$result = $mysqli->query($sql);
		closeDB($mysqli);
		$result=getResult($result);
		return $result;		
	}
	
	function nise($id_o) {
		$mysqli = connectDB();
		$sql = "SELECT id,ochk,image FROM u_v WHERE nstdl = '0' AND image IS NOT NULL  ";
		$sql .= "AND id IN(SELECT DISTINCT id_user FROM o_v) ";
		$sql .= "AND ochk < ".$id_o." ";
		$sql .= "ORDER by ochk DESC LIMIT 0,5";	
		$result = $mysqli->query($sql);
		closeDB($mysqli);
		$result=getResult($result);		
		return $result;
	}
?> 
