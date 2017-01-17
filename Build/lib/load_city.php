<?php
	session_start();
	require_once "function.php";
	require_once "counters.php";
	$param = $_GET["term"];
	$mysqli = connectDB();
	$sql = "SELECT * FROM ip_city WHERE city REGEXP '^$param'";
	$result = $mysqli->query($sql);
	for ($x = 0, $numrows = mysql_num_rows($result); $x < $numrows; $x++) {
		$row = mysql_fetch_assoc($result);
 		$ip_city[$x] = array("city" => $row["city"]);		
	}

	$response = $_GET["callback"] . "(" . json_encode($ip_city) . ")";
	echo $response;
	closeDB($mysqli);
?>