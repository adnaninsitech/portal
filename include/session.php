<?php
global $globaluserid;
 $globaluserid = $_SESSION['sessionuser'];
global $siteurl;
 $siteurl =  "https://" . $_SERVER['SERVER_NAME']; 
?>