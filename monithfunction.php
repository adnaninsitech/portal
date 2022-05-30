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
         $date = "October 2021";


    while (strtotime($date) <= strtotime('2021-11' . '-' . date('t', strtotime($date)))) {
        $day_num = date('j', strtotime($date));//Day number
        $day_name = date('l', strtotime($date));//Day name
        $dates = date('d-m-Y', strtotime($date));
        $datM = date('m', strtotime($date));
        $date = date("Y-m-d", strtotime("+1 day", strtotime($date)));

        $dated = new DateTime($dates);
        $currentDate = $dated->getTimestamp()+28800;

        $date_now = date("d-m-Y");

        /*if($date_now >= $dates){*/

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
                    'day' => $day_name, 
                    'timein' => '-' , 
                    'timeout' => '-' , 
                    'totalHours' => 'Absent');

            }
        /*}*/

    }

}

}

$array3 = array_merge($array1,$array2);

/*if(isset($array2)){
$array3 = array_merge($array1,$array2);
}else{
$array3 = $array1;
}*/

return $array3;
}