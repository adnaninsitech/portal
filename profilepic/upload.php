<?php
include('../include/ajaxsession.php');
include('../include/functions.php');
$theuserid = $globaluserid;
$imagename = $globaluserid."_".time();
$croped_image = $_POST['image'];
list($type, $croped_image) = explode(';', $croped_image);
list(, $croped_image)      = explode(',', $croped_image);
$croped_image = base64_decode($croped_image);
$image_name = $imagename.'.png';
$thefilelink = "profilepic/upload/".$image_name;
// upload cropped image to server 
file_put_contents('upload/'.$image_name, $croped_image);
echo 'Cropped image uploaded successfully.';
addUserMeta($theuserid,'userimg', $thefilelink);
?>