<?php include('../header.php'); ?>
 <?php if(!isSuperAdmin($globaluserid)){ 

    ?>
     <meta http-equiv="refresh" content="0;url=http://192.168.10.11:85/portal/">
    <?php 
  } ?>
<div class="container">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6"><h2 class="card-title mb-4 font-size-24"><?php if(isset($_POST["date"])){

                  $date = $_POST["date"];
                  $dept = $_POST["dept"];

                  if($date != "" && $dept == "" ){
                    echo date("F j, Y", strtotime($date));;
                }elseif($date == "" && $dept != ""){
                   echo  getDepartmentNameByKey($dept); 
               }else{
                if($dept != ""){
                    echo  getDepartmentNameByKey($dept); 
                }else{
                   echo  "Today's";
               }

           }

       }else{ ?> Today's  <?php } ?> Attendance</h2></div>

        <?php if(isSuperAdmin($globaluserid)){  ?>

       <div class="col-md-6 ">
        <form action="" method="POST">
            <select name="dept">
                <option value="">Select Department</option>
                <?php $dept = getAllDepartment();
                foreach($dept as $row){ ?>
                    <option value="<?php echo $row["departmentkey"]; ?>"><?php echo $row["departmentname"]; ?></option>
                <?php } ?>

            </select>
            <input type="date" name="date">
            <input type="submit">
        </form>
    </div>
<?php } ?>
</div>

<div class="row">
    <div class="col-md-12">
        <?php  if(isset($_POST["date"])){
         $date = strtotime($_POST["date"]);
         $dept = $_POST["dept"];
         if($date != "" && $dept == "" ){
            $getAttendanceByDate = getAttendanceByDate($date);
        }elseif($date == "" && $dept != ""){
         $getAttendanceByDate = getAttendanceByDept(NULL , $dept);
     }else{
        if($dept != "" && $date != ""){
         $getAttendanceByDate = getAttendanceByDept($date , $dept);
     }else{
       $getAttendanceByDate = getAttendanceByDate(); 
   }
}
}else{

   $getAttendanceByDate = getAttendanceByDate(); 
} 

?> <BR>
<table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
    <thead>
        <tr>
            <th>Name</th>
            <th>Date</th>
            <th>Time In</th>
            <th>Time Out</th>
            <th>Total Hours</th>


        </tr>
    </thead>


    <tbody>
        <?php ?>
        <?php foreach($getAttendanceByDate as $thisuserattendance){
         $timeout = $thisuserattendance['timeout'];
         $userOnlineStatus = getUserOnlineStatus($thisuserattendance['userkey']);

         $totalhours = $thisuserattendance['timeout']-$thisuserattendance['timein'];
         if($totalhours>0){
           $totalhours = seconds2human($totalhours);

       } else {
        $totalhours = time()-$thisuserattendance['timein'];
        $totalhours = seconds2human($totalhours);
    }
    if($userOnlineStatus=="1"){ 
        $userOnlineStatus="online";
    } else {
     $userOnlineStatus = "offline";
 }
 if($timeout=="0"){
     $timeout = "-";
 } else {
    $timeout =date('H:i A', $thisuserattendance['timeout']);
}
?>
<tr>
   <td><h5 class="font-size-14 mb-0"><?php echo getUserNameByKey($thisuserattendance['userkey']); ?></h5><h6 class="font-size-10 color-teal"><?php echo getDepartmentNameByKey(getuserinfobykey($thisuserattendance['userkey'],'departmentkey')); ?></h6></td>
   <td><?php echo date('jS M', $thisuserattendance['datetoday']); ?></td>
   <td><?php echo date('H:i A', $thisuserattendance['timein']); ?></td>
   <td><?php echo $timeout; ?></td>
   <td><?php echo $totalhours; ?></td>


</tr>
<?php } ?>     

</tbody>

</table>


</div>
</div>
</div>
</div>
</div>
<?php include('../footer.php'); ?>
<?php include('../include/scripts.php'); ?>
<?php include('../include/datatables.php'); ?>
<script type="text/javascript">
    $(document).ready( function(){

    });
</script>

</body>
</html>