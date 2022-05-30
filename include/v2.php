<?php
function addUserMeta($userkey, $metakey, $metavalue){
global $conn;
echo $themetakay = $metakey;
$getusermeta = getUserMeta($userkey, $themetakay);
if($getusermeta==false){
echo $sql = "INSERT INTO `usermeta` (`metaid`, `userkey`, `metakey`, `metavalue`) VALUES (NULL, '$userkey', '$themetakay', '$metavalue')";
} else {
    $sql = "UPDATE `usermeta` SET `metavalue`='$metavalue' WHERE userkey LIKE '$userkey' AND metakey LIKE '$metakey'";
}
$result = $conn->query($sql);
return $result;
}
//---------- food menu function -----------
function getFoodMenu(){
	global $conn;
	$sql = "SELECT * FROM `food_menu` ORDER BY `schedule_date` ASC";
	$result = $conn->query($sql);
	return $result;
}
function getTodaysMenu($start_time,$end_time){
    global $conn;
    $sql = "SELECT * FROM `food_menu` WHERE `schedule_date` BETWEEN '$start_time' AND '$end_time' ORDER BY `id` ASC";
    $result = $conn->query($sql);
    return $result;
}
function addFoodMenu($name,$image,$schedule_date,$will_serve,$created_by,$created_at){
    global $conn;
    $food_key = rand(11111,time());
    echo $sql = "INSERT INTO `food_menu`(`name`, `food_key`, `image`, `schedule_date`, `will_serve`, `created_by`, `created_at`) VALUES ('$name','$food_key','$image','$schedule_date','$will_serve','$created_by','$created_at')";
    $result = $conn->query($sql);
    return $conn->insert_id;
}
function deleteFoodByKey($food_key){
    global $conn;
    $sql = "DELETE FROM `food_menu` WHERE `food_key` = '$food_key'";
    $result = $conn->query($sql);
    return $result;
}
function weekOfMonth($date) {
    //Get the first day of the month.
    $firstOfMonth = strtotime(date("Y-m-01", $date));
    //Apply above formula.
    return weekOfYear($date) - weekOfYear($firstOfMonth) + 1;
}

function weekOfYear($date) {
    $weekOfYear = intval(date("W", $date));
    if (date('n', $date) == "1" && $weekOfYear > 51) {
        // It's the last week of the previos year.
        return 0;
    }
    else if (date('n', $date) == "12" && $weekOfYear == 1) {
        // It's the first week of the next year.
        return 53;
    }
    else {
        // It's a "normal" week.
        return $weekOfYear;
    }
}
//---------- food menu function -----------

?>