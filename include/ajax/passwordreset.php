<?php include('../ajaxsession.php');
include('../functions.php');
$userkey = $_POST['userkey'];
$password = $_POST['password'];
$changepassword = changePassword($userkey, $password);
if($changepassword=='1'){
    echo "success";
}
?>