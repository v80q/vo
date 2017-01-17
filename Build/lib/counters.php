<?php
	session_start();
	require_once "function.php"; 
	function CountVCat($id_cat=FALSE,$login=FALSE) {
		if($login) {
			$user_inf = GetInf($login);
			$ids = $user_inf['id'];	
		}
		$mysqli=connectDB();
		$sql="SELECT COUNT( * ) as count FROM v_v WHERE id>0 AND is_actual != '0' ";
		if($id_cat) {
			$sql .= " AND id_cat=".$id_cat;
		}
		if($ids) {
			$sql .= " AND id NOT IN(SELECT id_vopr FROM o_v WHERE id_user='".$ids."') ";
		}
		$result=$mysqli->query($sql);
		$row=getResult($result);
		closeDB($mysqli);
		return $row[0]['count'];
	}

	function CountVRazd($id_razd=FALSE,$login=FALSE) {
		if($login) {
			$user_inf = GetInf($login);
			$ids = $user_inf['id'];	
		}
		$mysqli=connectDB();
		$sql="SELECT COUNT( * ) as count FROM v_v WHERE id>0 AND is_actual != '0' ";
		if($id_razd) {
			$sql .= " AND id_razd=".$id_razd;
		}
		if($ids) {
			$sql .= " AND id NOT IN(SELECT id_vopr FROM o_v WHERE id_user='".$ids."') ";
		}
		$result=$mysqli->query($sql);
		$row=getResult($result);
		closeDB($mysqli);
		return $row[0]['count'];
	}

	function CountVUsOtUs($user,$login) {
		$user_inf = GetInf($login);
		$ids = $user_inf['id'];	
		$mysqli=connectDB();
		$sql="SELECT COUNT( * ) as count FROM v_v WHERE id>0 AND is_actual != '0' ";
		$sql .= " AND id_user=".$user;
		$sql .= " AND id NOT IN(SELECT id_vopr FROM o_v WHERE id_user='".$ids."') ";
		$result=$mysqli->query($sql);
		$row=getResult($result);
		closeDB($mysqli);
		return $row[0]['count'];
	}
	
	function CounOAllV($user_id) {
		$mysqli=connectDB();
		$sql="SELECT COUNT( * ) as count FROM o_v WHERE id_vopr IN(SELECT id FROM v_v WHERE id_user=".$user_id.")";
		$result=$mysqli->query($sql);
		$row=getResult($result);
		closeDB($mysqli);
		return $row[0]['count'];
	}
	
	function CountOtv($id_user=FALSE, $id_vopr=FALSE) {
		$mysqli=connectDB();
		$sql="SELECT COUNT( * ) as count FROM o_v WHERE id>0 ";
		if($id_user) {
			$sql .= " AND id_user=".$id_user." ";
		}
		if($id_vopr) {
			$sql .= " AND id_vopr=".$id_vopr." ";
		}
		$result=$mysqli->query($sql);
		$row=getResult($result);
		closeDB($mysqli);
		return $row[0]['count'];
	}
	
	function CountRazd() {
		$mysqli=connectDB();
		$sql="SELECT COUNT( * ) as count FROM r_v WHERE parent_id>0";
		$result=$mysqli->query($sql);
		$row=getResult($result);
		closeDB($mysqli);
		return $row[0]['count'];
	}
	
	function CountCat() {
		$mysqli=connectDB();
		$sql="SELECT COUNT( * ) as count FROM c_v WHERE parent_id>0";
		$result=$mysqli->query($sql);
		$row=getResult($result);
		closeDB($mysqli);
		return $row[0]['count'];
	}
	
	function ChartCV() {
		$mysqli=connectDB();	
		$sql="SELECT COUNT( * ) as count FROM v_v WHERE time_over='0'";
		$result=$mysqli->query($sql);
		$row=getResult($result);
		closeDB($mysqli);
		return $row[0]['count'];
	}
	
	function ChartCO() {
		$mysqli=connectDB();	
		$sql="SELECT COUNT( * ) as count FROM o_v WHERE id>'0'";
		$result=$mysqli->query($sql);
		$row=getResult($result);
		closeDB($mysqli);
		return $row[0]['count'];
	}
	
	function ChartCPO() {
		$mysqli=connectDB();	
		$sql="SELECT COUNT( * ) as count FROM o_v WHERE nagrada>'0'";
		$result=$mysqli->query($sql);
		$row=getResult($result);
		closeDB($mysqli);
		return $row[0]['count'];
	}

	function ChartCNPO() {
		$mysqli=connectDB();	
		$sql="SELECT COUNT( * ) as count FROM o_v WHERE nagrada<'0'";
		$result=$mysqli->query($sql);
		$row=getResult($result);
		closeDB($mysqli);
		return $row[0]['count'];
	}
	
	function ChVU($id_user) {
		$mysqli=connectDB();	
		$sql="SELECT COUNT( * ) as count FROM v_v WHERE id_user='".$id_user."' AND is_actual != '0'";
		$result=$mysqli->query($sql);
		$row=getResult($result);
		closeDB($mysqli);
		return $row[0]['count'];
	}
	function ChVUPrice($id_user) {
		$mysqli=connectDB();	
		$sql="SELECT SUM(price) as sum FROM v_v WHERE id_user='".$id_user."' AND is_actual != '0'";
		$result=$mysqli->query($sql);
		$row=getResult($result);
		if(!$row[0]['sum']) {
			$row[0]['sum']=0;
		}
		return $row[0]['sum'];	
	}

	function ChLiVUs($id_user) {
		$mysqli=connectDB();	
		$sql="SELECT COUNT( * ) as count FROM l_v WHERE id_v IN(SELECT id FROM v_v WHERE id_user='".$id_user."')";
		$result=$mysqli->query($sql);
		$row=getResult($result);
		closeDB($mysqli);
		return $row[0]['count'];
	}
	
	function ChDUs($id_user) {
		$mysqli=connectDB();	
		$sql="SELECT COUNT( * ) as count FROM j_v WHERE id_v IN(SELECT id FROM v_v WHERE id_user='".$id_user."')";
		$result=$mysqli->query($sql);
		$row=getResult($result);
		closeDB($mysqli);
		return $row[0]['count'];
	}
	
	function ChPUs($id_user) {
		$mysqli=connectDB();	
		$sql="SELECT COUNT( * ) as count FROM p_v WHERE otv_id IN(SELECT id FROM o_v WHERE id_user='".$id_user."')";
		$result=$mysqli->query($sql);
		$row=getResult($result);
		closeDB($mysqli);
		return $row[0]['count'];
	}	
	
	function ChVOPrice($id_user) {
		$mysqli=connectDB();	
		$sql="SELECT SUM(nagrada) as sum FROM o_v WHERE id_vopr IN(SELECT id FROM v_v WHERE id_user='".$id_user."') AND id_user!='".$id_user."'";
		$result=$mysqli->query($sql);
		$result=getResult($result);
		return $result[0]['sum'];
	}
	
	function ChVOPrice2($id_user) {
		$mysqli=connectDB();	
		$sql="SELECT SUM(nagrada) as sum FROM o_v WHERE id_user=".$id_user." AND id_vopr NOT IN(SELECT id FROM v_v WHERE id_user=".$id_user.")";
		$result=$mysqli->query($sql);
		$result=getResult($result);
		return $result[0]['sum'];
	}	
	
	function ChVOAVGPrice($id_user) {
		$mysqli=connectDB();	
		$sql="SELECT AVG(price) as avg FROM v_v WHERE id IN(SELECT id_vopr FROM o_v WHERE id_user='".$id_user."') AND is_actual>'0'";
		$result=$mysqli->query($sql);
		$result=getResult($result);
		return $result[0]['avg'];
	}
	
	function ChVOOtvVU($id_user) {
		$mysqli=connectDB();	
		$sql="SELECT COUNT( * ) as count FROM v_v WHERE id IN(SELECT id_vopr FROM o_v WHERE id_user='".$id_user."')";
		$result=$mysqli->query($sql);
		$result=getResult($result);
		return $result[0]['count'];
	}
	function ChVOPOtvVU($id_user) {
		$mysqli=connectDB();	
		$sql="SELECT COUNT( * ) as count FROM v_v WHERE id IN(SELECT id_vopr FROM o_v WHERE id_user='".$id_user."' AND nagrada>'0')";
		$result=$mysqli->query($sql);
		$result=getResult($result);
		return $result[0]['count'];
	}
	
	function GetChVOPrice($v_ochk, $id_u) {
		$mysqli=connectDB();
		$mysqli->query("UPDATE u_v SET v_ochk='".$v_ochk."' WHERE id='".$id_u."'");
		closeDB($mysqli);
	}

	function GetChVOPrice2($ochk, $id_u) {
		$mysqli=connectDB();
		$mysqli->query("UPDATE u_v SET ochk='".$ochk."' WHERE id='".$id_u."'");
		closeDB($mysqli);
	}
	
	function GetUspeh($id_user, $uspeh) {
		$mysqli=connectDB();
		$mysqli->query("UPDATE u_v SET uspeh='".$uspeh."' WHERE id='".$id_user."'");
		closeDB($mysqli);		
	}
	
	function GetLikeUserV($luv, $id_user) {
		$mysqli=connectDB();
		$mysqli->query("UPDATE u_v SET like_v='".$luv."' WHERE id='".$id_user."'");
		closeDB($mysqli);		
	}
	
	function GetDLikeUserV($dluv, $id_user) {
		$mysqli=connectDB();
		$mysqli->query("UPDATE u_v SET d_like_v='".$dluv."' WHERE id='".$id_user."'");
		closeDB($mysqli);		
	}
	
	function GetSlog($slog, $id_vopr, $count_o) {
		$mysqli=connectDB();
		$mysqli->query("UPDATE v_v SET slog='".$slog."' WHERE id='".$id_vopr."'");
		$mysqli->query("UPDATE v_v SET count_o='".$count_o."' WHERE id='".$id_vopr."'");
		closeDB($mysqli);		
	}
	
	function GetSlogUs($slog, $id_u) {
		$mysqli=connectDB();
		$mysqli->query("UPDATE u_v SET 	slog='".$slog."' WHERE id='".$id_u."'");
		closeDB($mysqli);
	}
	
	function ChOU($id_user) {
		$mysqli=connectDB();	
		$sql="SELECT COUNT( * ) as count FROM o_v WHERE id_user='".$id_user."' AND id_vopr NOT IN(SELECT id FROM v_v WHERE id_user='".$id_user."')";
		$result=$mysqli->query($sql);
		$row=getResult($result);
		closeDB($mysqli);
		return $row[0]['count'];
	}
	
	function ChPOU($id_user) {
		$mysqli=connectDB();	
		$sql="SELECT COUNT( * ) as count FROM o_v WHERE id_user='".$id_user."' AND nagrada>'0'";
		$result=$mysqli->query($sql);
		$row=getResult($result);
		closeDB($mysqli);
		return $row[0]['count'];
	}
	function VChVOU($id) {
		$mysqli=connectDB();	
		$sql="SELECT COUNT( * ) as count FROM o_v WHERE id_vopr='".$id."'";
		$result=$mysqli->query($sql);
		$row=getResult($result);
		closeDB($mysqli);
		return $row[0]['count'];
	}
	function VChVOUvar($id,$otv=FALSE) {
		$mysqli=connectDB();	
		$sql="SELECT COUNT( * ) as count FROM o_v WHERE id_vopr='".$id."' ";
		if($otv) {
			$sql .= " AND otv=".$otv;
		}
		$result=$mysqli->query($sql);
		$row=getResult($result);
		closeDB($mysqli);
		return $row[0]['count'];
	}
	
	function VChVPOU($id) {
		$mysqli=connectDB();	
		$sql="SELECT COUNT( * ) as count FROM o_v WHERE id_vopr='".$id."' AND nagrada>'0'";
		$result=$mysqli->query($sql);
		$row=getResult($result);
		closeDB($mysqli);
		return $row[0]['count'];
	}	
	
	function ChartUs() {
		$mysqli=connectDB();	
		$sql="SELECT COUNT( * ) as count FROM u_v WHERE id>0";
		$result=$mysqli->query($sql);
		$row=getResult($result);
		closeDB($mysqli);
		return $row[0]['count'];
	}
	
	function ChartUsIm() {
		$mysqli=connectDB();	
		$sql="SELECT COUNT( * ) as count FROM u_v WHERE image is NOT null";
		$result=$mysqli->query($sql);
		$row=getResult($result);
		closeDB($mysqli);
		return $row[0]['count'];
	}
	
	function ChartVNVik() {
		$mysqli=connectDB();	
		$sql="SELECT COUNT( * ) as count FROM v_v WHERE id_user <> 160";
		$result=$mysqli->query($sql);
		$row=getResult($result);
		closeDB($mysqli);
		return $row[0]['count'];
	}
	
	function SummOtvU($id_user) {
		$mysqli=connectDB();	
		$sql="SELECT SUM(nagrada) as sum FROM o_v WHERE id_user='".$id_user."' AND id_vopr NOT IN(SELECT id FROM v_v WHERE id_user='".$id_user."')";
		$result=$mysqli->query($sql);
		$row=getResult($result);
		if(!$row[0]['sum']) {
			$row[0]['sum']=0;
		}
		return $row[0]['sum'];		
	}
	
	function SummOtv($id_vopr) {
		$mysqli=connectDB();	
		$sql="SELECT SUM(nagrada) as sum FROM o_v WHERE id_vopr='".$id_vopr."'";
		$result=$mysqli->query($sql);
		$row=getResult($result);
		$row[0]['sum']=-$row[0]['sum'];
		if(!$row[0]['sum']) {
			$row[0]['sum']=0;
		}
		return $row[0]['sum'];		
	}
	
	function SummOtvCoauth($summa) {
		if($summa<0) {
			$coauth="red op05";
		}
		else {
			$coauth="green op05";
		}
		return $coauth;
	}
	function SummOtvCoauth2($summa) {
		if($summa<0) {
			$coauth2="потерял";
		}
		else {
			$coauth2="заработал";
		}
		return $coauth2;
	}
	
	function RatingLog($logochk) {
		$logochk=$logochk - 0.1;
		$mysqli=connectDB();	
		$sql="SELECT COUNT( * ) as count FROM u_v WHERE (nstdl IS NULL OR nstdl='0') AND id!='160' ";
		$sql .= "AND id IN(SELECT DISTINCT id_user FROM v_v WHERE is_actual != '0') ";
		$sql .= "AND id IN(SELECT DISTINCT id_user FROM o_v) ";
		$sql .=" AND ochk>".$logochk;
		$result=$mysqli->query($sql);
		$row=getResult($result);
		closeDB($mysqli);
		return $row[0]['count'];
	}
	
	function RatingLogg($id_user) {
		$logochk=ChVOPrice2($id_user)+(-ChVOPrice($id_user));
		$mysqli=connectDB();	
		$sql="SELECT COUNT( * ) as count FROM u_v WHERE nstdl='0' AND image IS NOT NULL AND id!='160' ";
		$sql .= "AND id IN(SELECT id_user FROM o_v) ";
		$sql .=" AND ochk>".$logochk;
		$result=$mysqli->query($sql);
		$row=getResult($result);
		closeDB($mysqli);
		return $row[0]['count']+1;
	}
	
	function RatingLogVK($logochk) {
		$logochk=$logochk - 0.1;
		$mysqli=connectDB();	
		$sql="SELECT COUNT( * ) as count FROM u_v WHERE id>0 AND id_vk IS NOT NULL";
		$sql .=" AND ochk>'".$logochk."' ";
		$result=$mysqli->query($sql);
		$row=getResult($result);
		closeDB($mysqli);
		return $row[0]['count'];
	}	
	
	function RatingLogOK($logochk) {
		$logochk=$logochk - 0.1;
		$mysqli=connectDB();	
		$sql="SELECT COUNT( * ) as count FROM u_v WHERE id_ok IS NOT NULL ";
		$sql .=" AND ochk>'".$logochk."' ";
		$result=$mysqli->query($sql);
		$row=getResult($result);
		closeDB($mysqli);
		return $row[0]['count'];
	}		
	
	function RatingVop($slog) {
		$slog = $slog - 0.001;
		$mysqli = connectDB();	
		$sql = "SELECT COUNT( * ) as count FROM v_v WHERE slog < '".$slog."' AND count_o>99";
		$result = $mysqli->query($sql);
		$row = getResult($result);
		closeDB($mysqli);
		return $row[0]['count'];
	}
	
	function SlogVCat($id_cat) {
		$mysqli=connectDB();	
		$sql="SELECT AVG(slog) as avg FROM v_v WHERE id_cat='".$id_cat."'";
		$result=$mysqli->query($sql);
		$result=getResult($result);
		return $result[0]['avg'];
	}
	
	function MoveUser($ochk) {
		$mysqli=connectDB();	
		$sql="SELECT COUNT( * ) as count FROM u_v WHERE (nstdl IS NULL OR nstdl = '0') AND image IS NOT NULL ";
		$sql .=" AND ochk>'".$logochk."' ";
		$result=$mysqli->query($sql);
		$row=getResult($result);
		closeDB($mysqli);
		return $row[0]['count'];
	}		
?>