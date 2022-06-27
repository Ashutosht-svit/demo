<?php
require_once "connect.php";

$type = $_POST['type'];
if($type == 'state' && isset($_POST['country_id'])){
	$country_id = $_POST['country_id'];
	$sql_state = "SELECT * FROM state where c_id = $country_id";
	$result = mysqli_query($conn,$sql_state);
	$res = array();
	if(mysqli_num_rows($result) > 0){
		while ($row = mysqli_fetch_assoc($result)) {
			$res[] = $row;
		}
	}
	header("Content-Type: application/json");
	echo json_encode($res);
	return $res;
}
if($type == 'city' && isset($_POST['state_id'])){
	$state_id = $_POST['state_id'];
	$sql_city = "SELECT * FROM city where city_id = $state_id";
	$result = mysqli_query($conn,$sql_city);
	$res = array();
	if(mysqli_num_rows($result) > 0){
		while ($row = mysqli_fetch_assoc($result)) {
			$res[] = $row;
		}
	}
	header("Content-Type: application/json");
	echo json_encode($res);
	return $res;
}
?>