<?php 
require('connection.php');

function addBrand($brand_name,$brand_url){

    global $conn;
    $sql = "INSERT INTO `brand`(`brand_name`,`brand_url`, `status`) VALUES ('$brand_name' , '$brand_url' , '1')";
    $result = $conn->query($sql);
    if($result){ return "success"; }

} 


function getBrands(){

	global $conn;
    $sql = "SELECT * FROM brand WHERE status = 1 ";
    $result = $conn->query($sql);
    return $result;
}

function assignBrand($userkey,$brand_id){

	global $conn;

	$check = "SELECT * FROM assignbrand WHERE `brand_id` = '$brand_id' AND `userkey` = '$userkey' ";

	$status = $conn->query($check);

	$row_cnt = $status->num_rows;
    if($row_cnt > 0){
 return "error"; 
    }else{

    $sql = "INSERT INTO `assignbrand`(`brand_id`,`userkey`, `status`) VALUES ('$brand_id' , '$userkey' , '1')";
    $result = $conn->query($sql);
    if($result){ return "success"; }

	}

}



function getUserBrands($userkey){

	global $conn;
	$sql = "SELECT * FROM `assignbrand` as a JOIN `brand` as b ON a.`brand_id` = b.`id` WHERE a.`userkey` = '$userkey'";
	$result = $conn->query($sql);
    return $result;

} 

function getAllBrandAssignee(){

    global $conn;
    $sql = "SELECT `users`.*,`brand`.`brand_name` AS 'brand', `assignbrand`.`id` AS 'assign_id'  FROM `users`
            INNER JOIN `assignbrand` ON `users`.`userkey` = `assignbrand`.`userkey` 
            INNER JOIN `brand` ON `assignbrand`.`brand_id` = `brand`.`id`";
    $result = $conn->query($sql);
    return $result;

} 