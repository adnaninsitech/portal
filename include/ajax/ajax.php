<?php 
if(!isset($_SESSION)){
	session_start();
}
include "../functions.php";
if(isset($_POST['add_food'])){
	$created_by = $_SESSION['sessionuser'];
	$created_at = time();
	$num = 0;
	foreach ($_POST['files'] as  $value) {
		$name = $_POST['food_name'][$num];
		$image = $_POST['files'][$num];
		$schedule_date = strtotime($_POST['schedule_date'][$num]);
		$will_serve = '1';
		addFoodMenu($name,$image,$schedule_date,$will_serve,$created_by,$created_at);
		$num++;
	}
}
if(isset($_POST['del_food'])){
	$food_key = $_POST['key'];
	$deleteFoodByKey = deleteFoodByKey($food_key);
	if($deleteFoodByKey === TRUE){
		echo "success";
	}else{
		echo "error";
	}
}
?>