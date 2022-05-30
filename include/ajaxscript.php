<?php 

 include('functions.php');

 if($_POST["call"] == "adduser"){

$username = $_POST["username"];
$email = $_POST["email"];
$password = $_POST["password"];
$department = $_POST["department"];
$designation = $_POST["designation"];
$reporting_authority = $_POST["reporting_authority"];
$employee_type = $_POST["employee_type"];
$salary = $_POST["salary"];
$joining_date = $_POST["joining_date"];
$usertype = $_POST["employee_usertype"];

$result = addUser($username,$email,$password,$department,$designation,$reporting_authority,$employee_type,$salary,$joining_date, $usertype );

   echo $result;
}

if($_POST["call"] == "addnotice"){

$noticetext = $_POST["noticetext"];
$addedby = $_POST["addedby"];
$noticedept = $_POST["noticedept"];
$category = $_POST["category"];


$result = addNotice($noticetext,$addedby,$noticedept,$category );

echo $result;
}

if($_POST["call"] == "submitDescripency"){

   $discrepancy_date = $_POST["discrepancy_date"];
   $userkey = $_POST["userkey"];
   $reporting_authority = $_POST["reporting_authority"];
   $department_key = $_POST["department_key"];
   $discrepancy_type = $_POST["discrepancy_type"];
   $reason = $_POST["reason"];

   $result = submitDescripency($discrepancy_date,$userkey,$reporting_authority,$department_key , $discrepancy_type , $reason);
   echo $result;
}

if($_POST["call"] == "votepicnic"){
  $userkey = $_POST["userkey"];
  $location = $_POST["location"];
  $time = $_POST["time"];
  $result = votepicnic($userkey,$location,$time);
  echo $result;
}



if($_POST["call"] == "discrepancyStatus"){
  $status =  $_POST["status"];
  $id =  $_POST["id"];
  $result = upadtediscrepancyStatus($id,$status);
  echo $result;
}


if($_POST["call"] == "foodstatus"){

  $fkey = $_POST["fkey"];

  $result = foodstatus($fkey);
  echo $result;
 //echo $fkey;

}


if($_POST["call"] == "changeUserStatus"){

  $status = $_POST["status"];
  $ukey = $_POST["ukey"];

  $result = changeUserStatus($ukey,$status);
  echo $result;

}

if($_POST["call"] == "updateAccount"){

  $userKey = $_POST["userKey"];
  $info = $_POST["info"];
  $account_title = $_POST["account_title"];
  $account_number = $_POST["account_number"];
  $iban_number = $_POST["iban_number"];
  $branch = $_POST["branch"];

  $result = updateAccount($userKey,$info,$account_title,$account_number,$iban_number,$branch);

  echo $result;

}


