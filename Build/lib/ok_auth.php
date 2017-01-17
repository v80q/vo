<?php
	session_start();
	require_once "/home/u435735/xn--80adsajtfqq.xn--80asehdb/www/lib/function.php";
	require_once "/home/u435735/xn--80adsajtfqq.xn--80asehdb/www/lib/counters.php";
	if (isset($_GET['code'])) {
		$curl = curl_init('http://api.odnoklassniki.ru/oauth/token.do');
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, 'code=' . $_GET['code'] . '&redirect_uri=' . $redirect_uri_ok . '&grant_type=authorization_code&client_id=' . $client_id_ok . '&client_secret=' . $client_secret_ok);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$s = curl_exec($curl);
		curl_close($curl);
		$auth = json_decode($s, true);
		$curl = curl_init('http://api.odnoklassniki.ru/fb.do?access_token=' . $auth['access_token'] . '&application_key=' . $public_key_ok . '&method=users.getCurrentUser&sig=' . md5('application_key=' . $public_key_ok . 'method=users.getCurrentUser' . md5($auth['access_token'] . $client_secret_ok)));
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$s = curl_exec($curl);
		curl_close($curl);
		$user = json_decode($s, true);
		$id_ok = $user['uid'];
		$fj = ProvLogOK($id_ok);
		if(ProvLogOK($id_ok)) {
			$login = $user['first_name']."_id".$fj[0]['id']; 
			UpNstdl($fj[0]['id']);
			$_SESSION['login'] = $login;
			header("Location: /Вопросы");
		}
		else {
		if($user['gender']) {
			if($user['gender'] == "MALE") {
				$pol = "mug";
			}
			if($user['gender'] == "FEMALE") {
				$pol = "gen";
			}
			else $pol = "";
		}
		$name = $user['name'];
		if($user['birthday']) {
			$bdate = explode("-",$user['birthday']);
			$age_y = (int)$bdate[0];
			$age_m = (int)$bdate[1];
			$age_d = (int)$bdate[2];
		}
		if($user['location']['countryName']) { 
			$country = $user['location']['countryName'];
			$id_country = GetCountryPoTit($country);
		}
		if($user['location']['city']) { 
			$city = $user['location']['city'];
			$id_city = GetCitiesPoTit($city);
		}
		$password =  md5($name);
		$password2 = $password;
		$gmax = gMAX();
		$gmax = $gmax[0]['MAX(id)'] + 1;
		$login = $user['first_name']."_id".$gmax;
		regOKUser($login, $mail, md5($password), $password2, $id_ok);
		imgOKUser($login, $user['pic_3']);
		regDopUser($name, $age_d, $age_m, $age_y, $id_country, $id_city, $pol, $login);
		UpNstdl($gmax);
		$_SESSION['login'] = $login;
		header("Location: /Вопросы");		
		}
	}
	else header('Location: http://www.odnoklassniki.ru/oauth/authorize?client_id=' . $client_id_ok . '&scope=VALUABLE ACCESS&response_type=code&redirect_uri=' . $redirect_uri_ok);