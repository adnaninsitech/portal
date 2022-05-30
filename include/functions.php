<?php 
error_reporting(0);
require('connection.php');
include('v2.php');
date_default_timezone_set('Asia/Karachi'); 
function get_client_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

function userkey($length_of_string)
{
    $str_result = '0123456789';
    return substr(str_shuffle($str_result),  0, $length_of_string);
}

function dateToday(){
    return strtotime(date('d-m-Y'))+28800;
}
function getUserOnlineStatus($userid){
    global $conn;
    $datetoday = dateToday();
    $yesterday = $datetoday - 86400;
    $sql = "SELECT * FROM attendance WHERE userkey LIKE '$userid' AND (datetoday LIKE '$datetoday' OR datetoday LIKE '$yesterday') order by aid desc limit 1";
    $result = $conn->query($sql);
    if($result->num_rows>0){
        $row = $result->fetch_assoc();
        $timeout = $row['timeout'];
        if($timeout>0){ return 0; } else { return 1; }
    } else {
        return false;
    }
} 

function toggleTimeIn($action, $userkey){
    global $conn;
    $datetoday = dateToday();
    $timenow = time();
    $userip = get_client_ip();
    if($action=="timein"){

        $time = date("h.i A");  
        $loginTime = $time ;

        $getusershift = "Select a.shifttimein from shift as a JOIN users as b ON a.id = b.currentshift WHERE b.userkey = '$userkey'";  

        $getshift = $conn->query($getusershift);
        $row = $getshift->fetch_assoc();
        $checkTime = $row['shifttimein'];

        $datetime1 = new DateTime($checkTime);
        $datetime2 = new DateTime($loginTime);
        $interval = $datetime1->diff($datetime2);
        $late = $interval->format('%hh');

        if($late == "1h"){
            $query = "INSERT INTO `userdiscrepancy`( `userkey`, `discrepencytype`,`approveby`, `status`) VALUES ('$userkey','Half Day','RA','1')";
            $conn->query($query);
        }

        if($late >= "2h" && $late < '8h' ){
            $query = "INSERT INTO `userdiscrepancy`( `userkey`, `discrepencytype`,`approveby`, `status`) VALUES ('$userkey','Full Day','RA','1')";
            $conn->query($query);
        }

        if($late >= "8h"){
            $query = "INSERT INTO `userdiscrepancy`( `userkey`, `discrepencytype`,`approveby`, `status`) VALUES ('$userkey','Full Day','admin','1')";
            $conn->query($query);
        }

        $sql = "INSERT INTO `attendance` (`aid`, `userkey`, `datetoday`, `timein`, `timeout`, `ip`) VALUES (NULL, '$userkey', '$datetoday', '$timenow', '', '$userip');";


    } else if($action=="timeout"){

        $gettimein = "SELECT `timein` FROM `attendance` WHERE `userkey` = '201693481630942329' AND `timeout` = '0'  ORDER BY `aid` DESC LIMIT 1";

        $response = $conn->query($gettimein);

        if($response->num_rows>0){

            $row = $response->fetch_assoc();
            $timeinn = $row['timein'];

            $totalhours = $timenow-$timeinn;

            $totalhours = gethours($totalhours);

            if($totalhours > 18){

                $updatetime = $timeinn + 192;
                $sql ="UPDATE `attendance` SET `timeout` = '$updatetime' WHERE `attendance`.`userkey` = '$userkey' ORDER BY aid DESC LIMIT 1";

                $query = "INSERT INTO `userdiscrepancy`( `userkey`, `discrepencytype`,`approveby`, `status`) VALUES ('$userkey','Time Short','RA',0')";

                $conn->query($query);

            }else{
                $sql ="UPDATE `attendance` SET `timeout` = '$timenow' WHERE `attendance`.`userkey` = '$userkey' ORDER BY aid DESC LIMIT 1";
            }
        }else{
            $sql ="UPDATE `attendance` SET `timeout` = '$timenow' WHERE `attendance`.`userkey` = '$userkey' ORDER BY aid DESC LIMIT 1";
        }


    }
    echo $result = $conn->query($sql);
}


function getLastTimeIn($userkey){
    global $conn;
    $sql = "SELECT * FROM attendance where userkey LIKE '$userkey' order by aid DESC LIMIT 1";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row['timein'];
}

function getLastTimeOut($userkey){
    global $conn;
    $sql = "SELECT * FROM attendance where userkey LIKE '$userkey' AND timeout NOT like '0' order by aid DESC LIMIT 1";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row['timeout'];

}


function getUserDetails($userkey){
    global $conn;
    $sql = "SELECT * FROM users WHERE userkey LIKE '$userkey'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row;
}

function getUserMeta($userkey, $metakey){
    global $conn;
    $sql = "SELECT * FROM usermeta WHERE userkey LIKE '$userkey' AND metakey LIKE '$metakey'";
    $result= $conn->query($sql);
    if($result){
        if($result->num_rows>0){        
            $row = $result->fetch_assoc();
            return $row['metavalue'];
        } } else {
            return false;
        }

    }

    function getAllDepartment(){

        global $conn;
        $sql = "SELECT * FROM department WHERE status = '1'";
        $result= $conn->query($sql);
        return $result; 

    }

    function getDepartmentNameByKey($departmentkey){
        global $conn;
        $sql = "SELECT * FROM department WHERE departmentkey LIKE $departmentkey";
        $result= $conn->query($sql);
        $row = $result->fetch_assoc();
        return $row['departmentname'];
    }


    function getuserinfobykey($userkey, $info){
        global $conn;
        $sql = "SELECT $info as info FROM users WHERE userkey = $userkey";


        $result= $conn->query($sql);
        $row = $result->fetch_assoc();
        return $row['info'];

    }


    function getusernamebykey($userkey){
        global $conn;
        $sql = "SELECT * FROM users WHERE userkey = $userkey";
        $result= $conn->query($sql);
        $row = $result->fetch_assoc();
        return $row['name'];

    }

    function showUserName($userkey){
        $theUserName = getusernamebykey($userkey);
        $theUserName =  explode(" ",$theUserName);
        echo $theUserName[0]." ".$theUserName[1];  
    }
    function getUserProfilePicture($userkey){
        global $conn;

        $globalUserImage = getUserMeta($userkey, 'userimg');
        if($globalUserImage == false){
           $globalUserImage = "assets/images/users/dummy.png";
       }
       return $globalUserImage;

   }

   function getAllUsers(){
    global $conn;
    $sql = "SELECT * FROM users WHERE status LIKE 1 ORDER BY userid ASC";
    $result = $conn->query($sql);
    return $result;
}


function getAllUsersByType($type){
    global $conn;
    $sql = "SELECT * FROM users WHERE status LIKE 1 AND usertype LIKE '$type' ORDER BY userid ASC";
    $result = $conn->query($sql);
    return $result;
}

function addUser($username,$email,$password,$department,$designation,$reporting_authority,$employee_type,$salary,$joining_date, $usertype  ){

    global $conn;
    $userkey = userkey(8).time();
    $pass = md5($password);
    $dateofjoining = strtotime(date($joining_date));

    //CHECK EMAIL ALREADY EXISTS OR NOT

    $query = "SELECT * FROM `users` WHERE `email` = '$email'";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    
    if($row["userid"]){
        return "error";
    }else{

        $sql = "INSERT INTO `users`(`userkey`, `password`, `departmentkey`, `designation`, `name`, `reportingauthority`, `email`, `usertype`, `dateofjoining`, `status`, `employeetype`, `currentsalary`, `currentshift`) VALUES ('$userkey','$pass','$department','$designation','$username','$reporting_authority','$email', 'usertype', '$dateofjoining','1','$employee_type','$salary','1')";

        $result = $conn->query($sql);
        $userhash = md5($userkey);
        $sql2 = "INSERT INTO `userhash`(`userkey`, `userhash`, `status`) VALUES ('$userkey','$userhash','1')";
        $result2 = $conn->query($sql2);

        return "success";
    }

}



function totalStrength(){
    global $conn;
    $sql = "SELECT count(*) as count FROM users WHERE status LIKE 1 ORDER BY userid ASC";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row['count'];
}

function totalDepartmentStrength($departmentKey){
     global $conn;
    $sql = "SELECT count(*) as count FROM `users` WHERE `departmentkey` = '$departmentKey' AND `status` = '1'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row['count'];

}


function getAllUsersByDept($departmentkey){
    global $conn;
    $sql = "SELECT * FROM users WHERE status LIKE 1 AND departmentkey LIKE '$departmentkey' ORDER BY userid ASC";
    $result = $conn->query($sql);
    return $result;
}

function getAttendanceByDate($date=NULL){
    global $conn;
    if($date==null){
        $date = dateToday();
    } else {
        $date = $date+28800;
    }
    $sql = "SELECT * FROM attendance WHERE datetoday LIKE '$date' AND userkey NOT like '' GROUP BY `userkey`";
    $result = $conn->query($sql);
    return $result;
}


function getUserRA($RA_key){
    global $conn;

    if($RA_key == "329616306678943624"){
      $sql = "SELECT * FROM `users` WHERE `departmentkey` = '268416584785425641' OR `departmentkey` ='373916321340716965' AND `status` = '1'";
    }else{
      $sql = "SELECT * FROM `users` WHERE `reportingauthority` = '$RA_key' AND `status` = '1'";  
    }
    
    $result = $conn->query($sql);
    return $result;
}

function getAttendanceByUserKey($userkey){
    global $conn;

    $sql = "SELECT * FROM `attendance` WHERE `userkey` = '$userkey' ORDER BY `aid` ASC";
    $result = $conn->query($sql);
    return $result;
}

function getAttendanceByDept($date=NULL , $dept){

    global $conn;

    if($date==null){
        $date = dateToday();
    } else {
        $date = $date+28800;
    }

    $sql = "SELECT c.* FROM `department` as a JOIN `users` as b ON a.`departmentkey` = b.`departmentkey` JOIN `attendance` as c ON b.`userkey` = c.`userkey` WHERE c.`datetoday` LIKE '$date' AND a.`departmentkey` = '$dept' ORDER BY c.`aid` DESC";

    $result = $conn->query($sql);

    return $result;

}

function changePassword($userkey, $password){
    global $conn;
    $password = md5($password);
    $sql = "UPDATE `users` SET `password`='$password' WHERE userkey LIKE '$userkey'";
    $result = $conn->query($sql);
    return $result;
}



function gettodayfood(){
   
global $conn;
$sql = "SELECT item_name, name FROM `food` as a JOIN `food_menu` as b ON a.`item_name` = b.`food_key` ORDER by a.id desc LIMIT 1";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
return $row["name"];
   
}

function foodimage(){
   
global $conn;
$sql = "SELECT item_name, name, image FROM `food` as a JOIN `food_menu` as b ON a.`item_name` = b.`food_key` ORDER by a.id desc LIMIT 1";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
return $row["image"];
   
}





function fooditemstatus(){
   
global $conn;
$sql = "SELECT `item_name` FROM `food` ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);
 $row = $result->fetch_assoc();
return $row['item_name'];
   
}



function foodstatus($fkey){
    global $conn;
    $sql = "INSERT INTO `food`(`item_name`) VALUES ($fkey)";

    echo $result = $conn->query($sql);
    return $result;
}



function changeUserStatus($userkey, $status){
    global $conn;
    $sql = "UPDATE `users` SET `status`='$status' WHERE userkey = '$userkey'";
    $result = $conn->query($sql);
    return $result;
}


function isSuperAdmin($userkey){
    global $conn;
    $sql = "SELECT * FROM superadmins WHERE userkey LIKE '$userkey'";
    $result= $conn->query($sql);
    if($result->num_rows>0){
        return true;
    } else {
        return false;
    }

}


function getOnlineUsers(){
    global $conn;
    $datetoday = datetoday();
    $sql ="SELECT * FROM `attendance` WHERE datetoday = '$datetoday' AND timeout = 0 GROUP BY userkey ORDER BY aid DESC";
    $result = $conn->query($sql);
    return $result;
}


function getPresentToday(){
    global $conn;
    $datetoday = datetoday();
    $sql ="SELECT * FROM `attendance` WHERE datetoday LIKE '$datetoday' GROUP BY userkey ORDER BY aid DESC";
    $result = $conn->query($sql);
    return $result;
}


function seconds2human($ss) {
    $s = $ss%60;
    $m = floor(($ss%3600)/60);
    $h = floor(($ss%86400)/3600);
    $d = floor(($ss%2592000)/86400);
    $M = floor($ss/2592000);
    return "$h hours, $m minutes";
}

function gethours($ss) {
    $s = $ss%60;
    $m = floor(($ss%3600)/60);
    $h = floor(($ss%86400)/3600);
    $d = floor(($ss%2592000)/86400);
    $M = floor($ss/2592000);
    return "$h";
}


function getAllNotices($number=null){
    global $conn;
    if($number==null){
        $sql = "SELECT * FROM notices WHERE status LIKE 1 ORDER BY noticeid DESC";
    } else {
        $sql = "SELECT * FROM notices WHERE status LIKE 1";
    }
    $result = $conn->query($sql);
    return $result;
}

function addNotice($noticetext,$addedby,$noticedept,$category ){

    global $conn;
    $timenow = time();

    $notice = $conn->real_escape_string($noticetext);

    $sql = "INSERT INTO `notices` (`noticetext`, `addedby`, `noticedept`, `status`, `category`, `noticetime`) VALUES ('$notice', '$addedby', '$noticedept', '1', '$category', '$timenow')";
    echo $result = $conn->query($sql);

}

function getAllNoticeCategories(){

    global $conn;
    $sql = "SELECT * FROM  noticecategory ";
    $result= $conn->query($sql);
    return $result; 

}

function getUserType(){
    global $conn;
    $sql = "SELECT * FROM `usertype`";
    $result = $conn->query($sql);
    return $result;
}

function getUserDiscrepancy($userkey){

global $conn;

$fulldayquery = "SELECT COUNT(*) as fullday FROM `discrepancy` WHERE `userkey` = '$userkey' AND `discrepancy_type` = 'Full Day'";

$fresponse = $conn->query($fulldayquery);

$row = $fresponse->fetch_assoc();

$fulldaycount = $row['fullday'];

$halfdayquery = "SELECT COUNT(*) as halfday FROM `discrepancy` WHERE `userkey` = '$userkey' AND `discrepancy_type` = 'Half Day'";

$hresponse = $conn->query($halfdayquery);

$rows = $hresponse->fetch_assoc();

$halfdaycount = $rows['halfday'] / 2;

$totalleave = $fulldaycount + $halfdaycount;

return $totalleave;
}

function submitDescripency($discrepancy_date,$userkey,$reporting_authority,$department_key , $discrepancy_type, $reason){

   global $conn;

   $reason = $conn->real_escape_string($reason);
   $availedleaves = getUserDiscrepancy($userkey);
   $totalLeaves = 15;

   if($availedleaves <= $totalLeaves){

    
    $sql = "INSERT INTO `discrepancy`(`discrepancy_date`, `discrepancy_type`, `userkey`, `department_key`, `reporting_authority`, `reason`, `status`) VALUES ('$discrepancy_date','$discrepancy_type','$userkey','$department_key','$reporting_authority','$reason','2')";
    

   }else{

    $reporting_authority = "557816304217226547";

    $sql = "INSERT INTO `discrepancy`(`discrepancy_date`, `discrepancy_type`, `userkey`, `department_key`, `reporting_authority`, `reason`, `status`) VALUES ('$discrepancy_date','$discrepancy_type','$userkey','$department_key','$reporting_authority','$reason','2')";

   }

   $result = $conn->query($sql);
    return $result;


}

function checkDiscrepancyStatus($date,$userkey){

    global $conn;
    
    $sql = "SELECT * FROM `discrepancy` WHERE `discrepancy_date` = '$date' AND `userkey` = '$userkey'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row['status'];

}


function getfilledDiscrepancy($RAKey){

    global $conn;
   /* $sql = "SELECT * FROM `discrepancy` WHERE `reporting_authority` = '$RAKey' AND YEAR(`created_date`) = YEAR(CURRENT_DATE()) AND 
      MONTH(`created_date`) = MONTH(CURRENT_DATE()) ";*/

      $sql = "SELECT * FROM `discrepancy` WHERE `reporting_authority` = '$RAKey' ORDER BY `id` DESC ";
    $result = $conn->query($sql);
    return $result;

}

function upadtediscrepancyStatus($id,$status){
    global $conn;
    $updateStatus ="UPDATE `discrepancy` SET `status`='$status' WHERE `id` = '$id'";

   $result = $conn->query($updateStatus);

   return "success";

}


function addcovid($userkey,$name,$vaccine,$dose,$date,$center,$fileurl,$nextDose,$status){

    global $conn;
    $sql = "INSERT INTO `covidvaccine`(`userkey`,`username`, `vaccine`, `dose`, `vaccinedate`, `vaccinationcenter`, `vaccinationcard`,`nextdose`, `status`) VALUES ('$userkey' , '$name' , '$vaccine' , '$dose' , '$date', '$center', '$fileurl', '$nextDose', '$status')";

    $result = $conn->query($sql);

    if($result){ return "success"; }

}

function covidAlert($userkey){
    global $conn;
    $sql = "SELECT * FROM `covidvaccine` WHERE `userkey` = '$userkey' AND `nextdose` <= CURDATE() ORDER BY `id` DESC LIMIT 1";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if($result->num_rows>0){
        return $row['nextdose'];
    }else{
        return "error";   
    }
}

function userCovidDose($userkey){

     global $conn;
     $sql = "SELECT * FROM `covidvaccine` WHERE `userkey` = '$userkey' AND `nextdose` != 'Completed' AND `dose` = '1'  ORDER BY `id` DESC LIMIT 1";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if($result->num_rows>0){
        return $row['nextdose'];
    }else{
        return "error";   
    }

}

function votepicnic($userkey,$location,$time){
    global $conn;
    $sql = "SELECT * FROM picnic WHERE userkey = '$userkey'";
    $result= $conn->query($sql);
    if($result->num_rows>0){
        return "error";
    } else {
        $query = "INSERT INTO `picnic`(`userkey`, `location`, `time`, `status`) VALUES ('$userkey','$location' , '$time'  , '1')";
        $conn->query($query);
        return "success";
    }
}

function getShift(){

    global $conn;
    $sql = "SELECT * FROM shift WHERE `status` = '1'";
    $result= $conn->query($sql);
    return $result;

}

function getRAUsers($userkey){

    global $conn;

     if($userkey == "329616306678943624"){
      $sql = "SELECT * FROM `users` WHERE `departmentkey` = '268416584785425641' OR `departmentkey` ='373916321340716965' AND `status` = '1'";
    }else{
         $sql = "SELECT * FROM `users` WHERE `reportingauthority` = '$userkey' AND `status` = '1'";
    }
    

    $result= $conn->query($sql);
    return $result;
}


function updateUserShift($userKey , $shiftId){

   global $conn;
   $updateStatus ="UPDATE `users` SET `currentshift`='$shiftId' WHERE `userkey` = '$userKey'";

   $result = $conn->query($updateStatus);

   return "success";

}


/*function getAttendanceByMonth(){

    global $conn;
    $timenow = time();
    $userip = get_client_ip();
    $time = date("h.i A");  
    $loginTime = $time ;

    $user = "SELECT * FROM `users` WHERE `userkey` = '242016309324734238' ";

    $userData = $conn->query($user);

    foreach($userData as $user){

        $userkey = $user["userkey"];
        $department = getDepartmentNameByKey($user["departmentkey"]);

         $date = "October 2021";


    while (strtotime($date) <= strtotime('2021-11' . '-' . date('t', strtotime($date)))) {
        $day_num = date('j', strtotime($date));//Day number
        $day_name = date('l', strtotime($date));//Day name
        $dates = date('d-m-Y', strtotime($date));
        $datM = date('m', strtotime($date));
        $datMonth = date('M', strtotime($date));
        $date = date("Y-m-d", strtotime("+1 day", strtotime($date)));

        $dated = new DateTime($dates);
        $currentDate = $dated->getTimestamp()+28800;

        $date_now = date("d-m-Y");
        $date_now_M = date("m");

        if($datM <= $date_now_M){

        $getAttendanceData = "SELECT * FROM `attendance` WHERE `userkey` = '$userkey' AND `datetoday` = '$currentDate'  ";


            $getData = $conn->query($getAttendanceData);

            $row_cnt = $getData->num_rows;
            if($row_cnt > 0){

                foreach($getData as $row){

                    $timeIn = $row["timein"];
                    $timeout = $row["timeout"];
                    $userkey = $row["userkey"]; 
                    $attendance_id = $row["aid"];
                    if($timeout){


                        $totalhours = $timeout-$timeIn;

                        if($totalhours>0){
                         $totalhours = seconds2human($totalhours);

                     } else {
                        $totalhours = time()-$timeIn;
                        $totalhours = seconds2human($totalhours);
                    }

                    $array1[] = array(
                        'aid' => $attendance_id, 
                        'user' => getusernamebykey($userkey), 
                        'date' => $dates, 
                        'department' => $department, 
                        'day' => $day_name, 
                        'month' => $datMonth , 
                        'timein' => date('H:i A', $timeIn) , 
                        'timeout' => date('H:i A', $timeout) , 
                        'totalHours' => $totalhours);
                }else{
                    $array1[] = array(
                        'aid' => $attendance_id, 
                        'user' => getusernamebykey($userkey), 
                        'date' => $dates, 
                        'department' => $department, 
                        'day' => $day_name, 
                        'month' => $datMonth , 
                        'timein' => date('H:i A', $timeIn) , 
                        'timeout' => "-" , 
                        'totalHours' => "-");

                }

            }
        }else{

            if($day_name == "Saturday" || $day_name == "Sunday" || $userkey == "426816304037853587" || $userkey == "557816304217226547"  ){
            }else{


                $array2[] = array(
                    'user' => getusernamebykey($userkey), 
                    'date' => $dates, 
                    'department' => $department, 
                    'month' => $datMonth , 
                    'day' => $day_name, 
                    'timein' => '-' , 
                    'timeout' => '-' , 
                    'totalHours' => 'Absent');

            }
        }

    }

}

}

$array3 = array_merge($array1,$array2);

return $array3;
}*/


function getAttendanceByMonth(){

    global $conn;
    $timenow = time();
    $userip = get_client_ip();
    $time = date("h.i A");  
    $loginTime = $time ;

    $user = "SELECT * FROM `users` WHERE `status` = '1' ORDER BY `userid`";


    $userData = $conn->query($user);

    foreach($userData as $user){

        $userkey = $user["userkey"];
        $department = getDepartmentNameByKey($user["departmentkey"]);

    //$date = date("F Y");//Current Month Year
         $date = "December 2021";


    while (strtotime($date) <= strtotime('2021-12' . '-' . date('t', strtotime($date)))) {
        $day_num = date('j', strtotime($date));//Day number
        $day_name = date('l', strtotime($date));//Day name
        $dates = date('d-m-Y', strtotime($date));
        $datM = date('m', strtotime($date));
        $date = date("Y-m-d", strtotime("+1 day", strtotime($date)));

        $dated = new DateTime($dates);
        $currentDate = $dated->getTimestamp()+28800;

        $date_now = date("d-m-Y");
/*if($datM != date('m')){*/

        $getAttendanceData = "SELECT * FROM `attendance` WHERE `userkey` = '$userkey' AND `datetoday` = '$currentDate'  ";


            $getData = $conn->query($getAttendanceData);

            $row_cnt = $getData->num_rows;
            if($row_cnt > 0){

                foreach($getData as $row){

                    $timeIn = $row["timein"];
                    $timeout = $row["timeout"];
                    $userkey = $row["userkey"]; 
                    $attendance_id = $row["aid"];
                    if($timeout){


                        $totalhours = $timeout-$timeIn;

                        if($totalhours>0){
                         $totalhours = seconds2human($totalhours);

                     } else {
                        $totalhours = time()-$timeIn;
                        $totalhours = seconds2human($totalhours);
                    }

                    $array1[] = array(
                        'aid' => $attendance_id, 
                        'user' => getusernamebykey($userkey), 
                        'userkey' => $userkey, 
                        'date' => $dates, 
                        'department' => $department, 
                        'day' => $day_name, 
                        'timein' => date('H:i A', $timeIn) , 
                        'timeout' => date('H:i A', $timeout) , 
                        'totalHours' => $totalhours);
                }else{
                    $array1[] = array(
                        'aid' => $attendance_id, 
                        'user' => getusernamebykey($userkey), 
                        'userkey' => $userkey, 
                        'date' => $dates, 
                        'department' => $department, 
                        'day' => $day_name, 
                        'timein' => date('H:i A', $timeIn) , 
                        'timeout' => "-" , 
                        'totalHours' => "-");

                }

            }
        }else{

            if($day_name == "Saturday" || $day_name == "Sunday" || $userkey == "426816304037853587" || $userkey == "557816304217226547"  ){
            }else{


                $array2[] = array(
                    'user' => getusernamebykey($userkey), 
                    'userkey' => $userkey, 
                    'date' => $dates, 
                    'department' => $department, 
                    'day' => $day_name, 
                    'timein' => '-' , 
                    'timeout' => '-' , 
                    'totalHours' => 'Absent');

            }
      }

    /*}*/

}

}

$array3 = array_merge($array1,$array2);

return $array3;
}
function getlast7dayshours($userkey){
    global $conn;
    $sql = "select timeout, timein, timeout-timein as difference from attendance WHERE userkey = '$userkey' ORDER BY aid DESC limit 7";
    $result = $conn->query($sql);
    $i=0;
    foreach($result as $thisresult){
    $thedifference =  $thisresult['difference'];
    if($thedifference>0){
    echo round($thedifference/3600, 2);
    } else {
        echo 0;
    }
    if($i<6){ echo ", "; }$i++;
    }
}

    
function getattendenceofthismonth($userkey){
global $conn;
$startofmonth = strtotime( 'first day of ' . date( 'F Y'))+28800;
$endofmonth = strtotime( 'last day of ' . date( 'F Y'))+28800;
$sql = "select * from attendance WHERE userkey LIKE '$userkey' AND (datetoday BETWEEN $startofmonth AND $endofmonth) ORDER BY aid ASC";
$result = $conn->query($sql);
$i=0;
return $result;
}


function getUserHashKey($userkey){
    global $conn;
    $sql = "SELECT * FROM `userhash` WHERE `userkey` = '$userkey' AND `status` = '1'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row['userhash'];
}

function getUserAttendance($userkey){

    global $conn;
    $timenow = time();
    $time = date("h.i A");  
    $loginTime = $time ;
    //$userkey = "201693481630942329";

    $user = "SELECT * FROM `users` WHERE `userkey` = '$userkey' AND  `status` = '1' ORDER BY `userid`";

    $userData = $conn->query($user);

    foreach($userData as $user){

        $userkey = $user["userkey"];
        $department = getDepartmentNameByKey($user["departmentkey"]);

    //$date = date("F Y");//Current Month Year
    $date = "December 2021";

    //while (strtotime($date) <= strtotime(date('Y-m') . '-' . date('t', strtotime($date)))) {

   while (strtotime($date) <= strtotime('2022-01' . '-' . date('t', strtotime($date)))) {
        $day_num = date('j', strtotime($date));//Day number
        $day_name = date('l', strtotime($date));//Day name
        $dates = date('d-m-Y', strtotime($date));
        $dateds = date('Y-m-d', strtotime($date));
        $datM = date('m', strtotime($date));
        $date = date("Y-m-d", strtotime("+1 day", strtotime($date)));

        $dated = new DateTime($dates);
        $currentDate = $dated->getTimestamp()+28800;

         $date_now = date("Y-m-d");

 /*   if($datM != date('m')){*/
        if($date_now >= $dateds){

            $getAttendanceData = "SELECT * FROM `attendance` WHERE `userkey` = '$userkey' AND `datetoday` = '$currentDate'  ";

            $getData = $conn->query($getAttendanceData);

            $row_cnt = $getData->num_rows;
            if($row_cnt > 0){

                foreach($getData as $row){

                    $timeIn = $row["timein"];
                    $timeout = $row["timeout"];
                    $userkey = $row["userkey"]; 

                    if($timeout){
                        $timeout = $row["timeout"];
                    }else{
                        $timeout = "0";
                    }

                  
                    $totalhours = $timeout-$timeIn;


                    if($totalhours>0){
                        $totalhours = seconds2human($totalhours);

                    } else {
                        $totalhours = time()-$timeIn;
                        $totalhours = seconds2human($totalhours);
                    }

                    if($timeout){
                        $timeout = date('H:i A', $timeout);
                    }else{
                        $timeout = "-";
                    }

                    

                    $array1[] = array(
                        'aid' => $row['aid'],
                        'user' => getusernamebykey($userkey), 
                        'date' => $dates, 
                        'department' => $department, 
                        'day' => $day_name, 
                        'timein' => date('H:i A', $timeIn) , 
                        'timeout' => $timeout , 
                        'totalHours' => $totalhours);
                

            }
        }else{

            if($day_name == "Saturday" || $day_name == "Sunday"   ){
            }else{


                $array2[] = array(
                    'aid' => $datM,
                    'user' => getusernamebykey($userkey), 
                    'date' => $dates, 
                    'department' => $department, 
                    'day' => $day_name, 
                    'timein' => '-' , 
                    'timeout' => '-' , 
                    'totalHours' => 'Absent');

            }
        }

        /*}*/

    }

}

}

if(isset($array2)){

    if(empty($array1)){
        $array3 = array_merge($array2);
    }else{
$array3 = array_merge($array1,$array2);
    }

}else{
$array3 = $array1;
}

return $array3;

}


function checktimeout(){

    global $conn;

    $previous_date = strtotime(date('d-m-Y',strtotime("-1 days")))+28800;

    $sql = "SELECT * FROM `users` as a JOIN `attendance` as b ON a.`userkey` = b.`userkey` WHERE b.`timeout` = '' AND  `datetoday` = '$previous_date ' ";

    $result = $conn->query($sql);

    return $result;

}


function updateTime($id,$time){

    global $conn;

    $updateStatus ="UPDATE `attendance` SET `timeout`='$time' WHERE `aid` = '$id'";

    $result = $conn->query($updateStatus);

    return "success";

}

function insertUserMeta($userKey,$metaKey,$metavalue){

    global $conn;

    $sql = "SELECT * FROM usermeta WHERE userkey = '$userKey' AND metakey = '$metaKey'";

    $result = $conn->query($sql);

    if($result->num_rows>0){

        $query = "UPDATE `usermeta` SET `metavalue`='$metavalue' WHERE userkey = '$userKey' AND metakey = '$metaKey'";

    }else{

        $query = "INSERT INTO `usermeta`(`userkey`, `metakey`, `metavalue`) VALUES ('$userKey','$metaKey','$metavalue')";

    }

    $conn->query($query);

}

function insertUserAccount($userKey,$account_title,$account_number,$iban_number,$branch){

    global $conn;

    $sql = "SELECT * FROM userbankdetail WHERE userkey = '$userKey' ";

    $result = $conn->query($sql);

    if($result->num_rows>0){

        $query = "UPDATE `userbankdetail` SET `account_title`='$account_title' , `account_number` = '$account_number', `iban_number` = '$iban_number', `branch` = '$branch'  WHERE userkey = '$userKey' ";

    }else{

        $query = "INSERT INTO `userbankdetail`(`userkey`, `account_title`, `account_number`, `iban_number`, `branch`, `status`) VALUES ('$userKey','$account_title','$account_number' , '$iban_number' , '$branch' , '1')";

    }

    $conn->query($query);

}

function updateAccount($userKey,$info,$account_title,$account_number,$iban_number,$branch){

    global $conn;

    foreach($info as $x => $val) {
        insertUserMeta($userKey,$x,$val);
    }

    insertUserAccount($userKey,$account_title,$account_number,$iban_number,$branch);

        return "success";

}

function getUserMetaValueByKey($userKey,$metaKey){

    global $conn;

    $sql = "SELECT * FROM `usermeta` WHERE `userkey` = '$userKey' AND `metakey` = '$metaKey'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row['metavalue'];

}

function getUserbankAccountDetail($userKey){

    global $conn;

    $sql = "SELECT * FROM `userbankdetail`  WHERE `userkey` = '$userKey' ";

    $result = $conn->query($sql);

    return $result;

}

?>
