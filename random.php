<?php include('header.php'); 

/*  global $conn;


$fulldayquery = "SELECT COUNT(*) as fullday FROM `discrepancy` WHERE `userkey` = '696016306839397833' AND `discrepancy_type` = 'Full Day'";

$fresponse = $conn->query($fulldayquery);

$row = $fresponse->fetch_assoc();

$fulldaycount = $row['fullday'];


$halfdayquery = "SELECT COUNT(*) as halfday FROM `discrepancy` WHERE `userkey` = '696016306839397833' AND `discrepancy_type` = 'Half Day'";

$hresponse = $conn->query($halfdayquery);

$rows = $hresponse->fetch_assoc();

$halfdaycount = $rows['halfday'] / 2;

$totalleave = $fulldaycount + $halfdaycount;

echo $totalleave;*/

// the message
$msg = "First line of text\nSecond line of text";

// use wordwrap() if lines are longer than 70 characters
$msg = wordwrap($msg,70);

// send email
mail("muzaffar@techresourcecompany.com","My subject",$msg);
?>