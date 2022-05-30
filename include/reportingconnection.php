<?php
$theservername = "vurkflow.com:3306";
$theusername = "vurkflow_reporting";
$thepassword = "KQaKHX@DAss~";
$thedb = "vurkflow_reporting";
global $conn2;
$conn2 = new mysqli($theservername, $theusername, $thepassword, $thedb);
if ($conn2->connect_error) {
	die("Connection failed: " . $conn2->connect_error);
}