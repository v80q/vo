<?
	session_start();
	require_once "function.php";
	require_once "counters.php";
	if (isset($_GET['code'])) {
		$result = false;
		$params = array(
			'client_id' => $client_id,
			'client_secret' => $client_secret,
			'code' => $_GET['code'],
			'redirect_uri' => $redirect_uri
		);
		$token = json_decode(file_get_contents('https://oauth.vk.com/access_token' . '?' . urldecode(http_build_query($params))), true);
		if (isset($token['access_token'])) {
			if($token['email']) { $mail = $token['email']; }
			$params = array(
				'uids'         => $token['user_id'],
				'fields'       => 'uid,first_name,last_name,screen_name,sex,city,country,bdate,photo_max,domain',
				'access_token' => $token['access_token']
			);
			$userInfo = json_decode(file_get_contents('https://api.vk.com/method/users.get' . '?' . urldecode(http_build_query($params))), true);
			if (isset($userInfo['response'][0]['uid'])) {
				$userInfo = $userInfo['response'][0];
				$result = true;
			}
		}
		if ($result) {
			$id_vk = $userInfo['uid'];
			$fj = ProvLogVK($id_vk);
			if(ProvLogVK($id_vk)) {
				$login = $userInfo['first_name']."_id".$fj[0]['id']; 
				UpNstdl($fj[0]['id']);
				$_SESSION['login'] = $login;
				header("Location: /Вопросы");
			}
			else {
			if($userInfo['sex']) {
				if($userInfo['sex'] == "2") {
					$pol = "mug";
				}
				if($userInfo['sex'] == "1") {
					$pol = "gen";
				}
				if($userInfo['sex'] == "0") {
					$pol = "";
				}
			}
			$name = $userInfo['last_name']." ".$userInfo['first_name'];
			if($userInfo['bdate']) {
				$bdate = explode(".",$userInfo['bdate']);
				$age_d = (int)$bdate[0];
				$age_m = (int)$bdate[1];
				$age_y = (int)$bdate[2];
			}
			if($userInfo['country']) { 
				$country = $userInfo['country'];
				$countryVK = GetCountryInVK($country);
				$id_country = GetCountryPoTit($countryVK);
			}
			if($userInfo['city']) { 
				$city = $userInfo['city'];
				$cityVK = GetCitiesInVK($city);
				$id_city = GetCitiesPoTit($cityVK);
			}
			$password =  md5($name);
			$password2 = $password;
			$gmax = gMAX();
			$gmax = $gmax[0]['MAX(id)'] + 1;
			$login = $userInfo['first_name']."_id".$gmax;
			regVKUser($login, $mail, md5($password), $password2, $id_vk);
			imgVKUser($login, $userInfo['photo_max']);
			regDopUser($name, $age_d, $age_m, $age_y, $id_country, $id_city, $pol, $login);
			UpNstdl($gmax);
			$_SESSION['login'] = $login;
			header("Location: /Вопросы");
		}
		}
	}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Авторизация ВКонтакте</title>
	<link rel="shortcut icon" href="/images/favicon.png" />
</head>