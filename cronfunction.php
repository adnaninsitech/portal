<?php include('header.php'); 


$getData = checktimeout();

foreach($getData as $data){

        $loginTime = $data["timein"];

        $time = time();  

        $totalhours = $time-$loginTime;

        $totalhour = round($totalhours/60/60);

        $logouttime =  $loginTime + 180;

        updateTime($data["aid"],$logouttime);

}


 include('footer.php'); ?>
