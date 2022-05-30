<?php include('../ajaxsession.php');
include('../functions.php');
$action = $_POST['action'];
global $globaluserid;
$globaluserid;
toggleTimeIn($action, $globaluserid);
?>