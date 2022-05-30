<?php include('../header.php'); ?>
<div class="container">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6"><h2 class="card-title mb-4 font-size-24"> <?php if(isset($_POST["date"])){
                    echo date("F j, Y", strtotime($_POST["date"]));;
                }else{ ?> Today's  <?php } ?> Attendance</h2></div>

                <div class="col-md-6 text-right">
                    <form action="" method="POST">
                        <input type="date" name="date">
                        <input type="submit">
                    </form>
                </div>

            </div>

            <div class="row">
                <div class="col-md-12">
                    <?php  
                    $dept = $globalUserDetails['departmentkey'];
                    if(isset($_POST["date"])){
                        $date = strtotime($_POST["date"]);

                        $getAttendanceByDate = getAttendanceByDept($date , $dept);

                    }else{
                     $getAttendanceByDate = $getAttendanceByDate = getAttendanceByDept(NULL , $dept);
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
                   if($thisuserattendance['timeout'] == ""){
               $timeout= "0"; 
            }else{
                $timeout = $thisuserattendance['timeout'];
            }
                     $userOnlineStatus = getUserOnlineStatus($thisuserattendance['userkey']);

                     $totalhours = $timeout-$thisuserattendance['timein'];
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
               <td rel="<?php echo $thisuserattendance['aid'] ?>"><h5 class="font-size-14 mb-0"><a href="../portal/attendance?uk=<?php echo $thisuserattendance['userkey']; ?>"><?php echo getUserNameByKey($thisuserattendance['userkey']); ?></a></h5><h6 class="font-size-10 color-teal"><?php echo getDepartmentNameByKey(getuserinfobykey($thisuserattendance['userkey'],'departmentkey')); ?></h6></td>
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