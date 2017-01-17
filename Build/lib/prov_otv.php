<?php
	require_once "function.php";
	require_once "counters.php";
	session_start;
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		if (isset($_POST['vopr_id'])){		
			$user_inf = GetInf($_SESSION["login"]);
			$id_user = (int)($user_inf['id']);
			$id_vopr = (int)($_POST['vopr_id']);
			$id_v=GetVR($id_vopr);
			if($id_v[0]['id_user']!=$id_user) {
				if(!ProvOtv($id_vopr, $id_user)) {
					$otvet = (int)($_POST['otv_id']);
					$giv = GetVoprId($id_vopr);
					$pr_otv = (int)($giv['pr_otv']);
					$price = (int)($giv['price']);
					$id_u = (int)($giv['id_user']);
					$id_vk = GetIdVK($id_u);
					$pdsk = $_POST['pdsk'];
					if($pr_otv==5 || $pr_otv == $otvet) {
						$res_otv = 1;
						$nagr = $price;
						$nagrU = -$price;
						addNagr($id_user, $nagr);
						addNagrU($id_u, $nagrU);
						addOtv($id_user, $id_vopr, $nagr, $otvet, $pdsk);
						UpUsersInfV($id_u);
						UpUsersInf($id_user);
						UpVoprInf($id_vopr);
						$kolotv=VChVOUvar($id_vopr);
						$var1=number_format(VChVOUvar($id_vopr,1)/$kolotv*100,2)." %";
						$var2=number_format(VChVOUvar($id_vopr,2)/$kolotv*100,2)." %";
						$var3=number_format(VChVOUvar($id_vopr,3)/$kolotv*100,2)." %";
						$var4=number_format(VChVOUvar($id_vopr,4)/$kolotv*100,2)." %";
						$user_inf = GetInf($_SESSION["login"]);
						$balans_ochk = pre_num($user_inf['ochk']);
						if(ChOU($user_inf['id'])>0 && $user_inf['image']) {
							$RatingLog = RatingLogg($user_inf['id']);
						}
						else $RatingLog="нет";
						$balans_usp = number_format($user_inf['uspeh'],2);
						echo json_encode(array('res_otv' => $res_otv, 'price' => $price, 'balans_usp' => $balans_usp, 'balans_ochk' => $balans_ochk, 'rating_log' => $RatingLog, 'id_vk' => $id_vk[0]['id_vk'], 'var1' => $var1, 'var2' => $var2, 'var3' => $var3, 'var4' => $var4));
					}
					else {
						$res_otv = 0;
						$nagr = -$price;
						$nagrU = $price;
						addNagr($id_user, $nagr);
						addNagrU($id_u, $nagrU);
						addOtv($id_user, $id_vopr, $nagr, $otvet, $pdsk);
						UpUsersInfV($id_u);
						UpUsersInf($id_user);
						UpVoprInf($id_vopr);
						$kolotv=VChVOUvar($id_vopr);
						$var1=number_format(VChVOUvar($id_vopr,1)/$kolotv*100,2)." %";
						$var2=number_format(VChVOUvar($id_vopr,2)/$kolotv*100,2)." %";
						$var3=number_format(VChVOUvar($id_vopr,3)/$kolotv*100,2)." %";
						$var4=number_format(VChVOUvar($id_vopr,4)/$kolotv*100,2)." %";
						$user_inf = GetInf($_SESSION["login"]);
						$balans_ochk = pre_num($user_inf['ochk']);
						if(ChOU($user_inf['id'])>0 && $user_inf['image']) {
							$RatingLog = RatingLogg($user_inf['id']);
						}
						else $RatingLog="нет";
						$balans_usp = number_format($user_inf['uspeh'],2);
						echo json_encode(array('res_otv' => $res_otv, 'price' => $price, 'balans_usp' => $balans_usp, 'balans_ochk' => $balans_ochk, 'rating_log' => $RatingLog, 'id_vk' => $id_vk[0]['id_vk'], 'pr_otv' => $pr_otv, 'var1' => $var1, 'var2' => $var2, 'var3' => $var3, 'var4' => $var4));
					}
				}
				else {
					$res_otv = 2;
					echo json_encode(array('res_otv' => $res_otv));
				}
			}
			else {
				$res_otv = 3;
				echo json_encode(array('res_otv' => $res_otv));
			}
		}
	}
?>