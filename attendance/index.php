<?php include('../header.php'); ?>

<div class="container">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-9"><h2 class="card-title mb-4 font-size-24"><?php if(isset($_POST["date"])){
                  $date = $_POST["date"];
                  echo date("F j, Y", strtotime($date));;
              }else{ echo date('F'); } ?> Attendance</h2></div>

              <?php if(isSuperAdmin($globaluserid)){  ?>

                <div class="col-md-3 ">
                <form action="" method="POST">
                    <input type="date" name="date">
                    <input type="submit">
                </form>
            </div>
        <?php } ?>
    </div>

    <div class="row">
        <div class="col-md-12">

            <?php 

            if(isset($_GET["uk"])){

                $userkey = $_GET["uk"];
                $getAttendanceByDate = getAttendanceByUserKey($userkey);

            }else{

            $usertype = $globalUserDetails['usertype'];

            if($usertype == '2' || $usertype == '4' || $usertype == '5' ){
                $userkey = $globalUserDetails['userkey'];
                $getAttendanceByDate = getUserAttendance($userkey);

            }else{ 
  
                if(isset($_POST["date"])){

                 $date = strtotime($_POST["date"]);
                 $getAttendanceByDate = getAttendanceByDate($date);
              
                }else{  

                  
                $getAttendanceByDate = getAttendanceByDate(); 
         
                } 

            }
        }

   ?> <BR>

   <?php  if(isset($usertype)){

   if($usertype == '2' || $usertype == "4" || $usertype == "5" ){   ?>
<table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
    <thead>
        <tr>
            <th>Date</th>
            <th>Day</th>
            <th>Time In</th>
            <th>Time Out</th>
            <th>Total Hours</th>


        </tr>
    </thead>

    <tbody>
               <?php $x=1;  foreach($getAttendanceByDate as $data){ ?>
<tr>
                        <td rel="<?php echo $data['aid']; ?>"><?php echo $data['date']; ?></td>
                        <td><?php echo $data['day']; ?></td>
                        <td><?php echo $data['timein']; ?></td>
                        <td><?php echo $data['timeout']; ?></td>
                        <?php if($data['date'] == "31-12-2021" && $data['timein'] == "-" ){ ?>
                          <td class="thour green">Holiday</td>
                         <?php }else{ ?>
                        <td class="thour"><?php echo $data['totalHours'];
                        $hour = strtok($data['totalHours'], " "); ?>
                        <?php if($hour == "Absent"){ 
                        $discrepancyStatus = checkDiscrepancyStatus($data['date'] , $globalUserDetails['userkey']); ?>

                        <?php if($discrepancyStatus == "0"){ ?>

                             <i class="fa fa-circle red blink_me" aria-hidden="true"></i> | <a href="javascript:;" class="red">Reject</a>

                        <?php }elseif($discrepancyStatus == "1"){ ?> 

                            <i class="fa fa-circle green blink_me" aria-hidden="true"></i> | <a href="javascript:;" class="green">Approved</a>

                        <?php }elseif($discrepancyStatus == "2"){ ?>

                            <i class="fa fa-circle yellow blink_me" aria-hidden="true"></i> | <a href="javascript:;" class="yellow">Pending</a>

                        <?php }else{ ?>

                            <i class="fa fa-circle red blink_me" aria-hidden="true"></i> | <a href="javascript:;" data-toggle="modal" data-target="#exampleModalLong<?php echo $x; ?>" class="red">Fill Leave</a>

                         <?php } ?>

                            

                    <!-- FULL DAY LEAVE FORM -->
                        <div class="modal fade" id="exampleModalLong<?php echo $x; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Fill Out Leave</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                  </button>
                              </div>
                              <div class="modal-body">

                                <form action="<?php echo $url; ?>/include/ajaxscript.php" method="POST" class="submitDescripency">
                                    <input type="hidden" value="<?php echo $data['date']; ?>" name="discrepancy_date">

                                    <input type="hidden" value="<?php echo $globalUserDetails['userkey']; ?>" name="userkey">

                                    <input type="hidden" value="<?php echo $globalUserDetails['reportingauthority'] ?>" name="reporting_authority">
                                    <input type="hidden" value="<?php echo $globalUserDetails['departmentkey'] ?>" name="department_key">

                                    <input type="hidden" value="Full Day" name="discrepancy_type">
                                    <input type="hidden" value="submitDescripency" name="call">

                                    <div class="form-row">
                                        <textarea name="reason" placeholder="Reason" class="form-control"></textarea>
                                    </div><br>
                                    <div class="form-row">
                                        <input type="submit" name="">

                                    </div> 
                                    <div class="alert alert-success" style="display: none;" role="alert">Discrepency Submit Successfully</div>   
                                </form>

                            </div>

                        </div>
                    </div>
                </div>

                <!-- END FULL DAY LEAVE FORM -->

                        <?php }elseif($hour >= "8"){ ?>
                            <i class="fa fa-circle green" aria-hidden="true"></i>
                        <?php }else{ ?> 

                            <?php if($data['date'] ==  $date_now = date("d-m-Y")){ ?> <?php }else{ 
                                 $discrepancyStatus = checkDiscrepancyStatus($data['date'] , $globalUserDetails['userkey']);
                                 ?>

                                  <?php if($discrepancyStatus == "0"){ ?>

                             <i class="fa fa-circle red blink_me" aria-hidden="true"></i> | <a href="javascript:;" class="red">Reject</a>

                        <?php }elseif($discrepancyStatus == "1"){ ?> 

                            <i class="fa fa-circle green blink_me" aria-hidden="true"></i> | <a href="javascript:;" class="green">Approved</a>

                        <?php }elseif($discrepancyStatus == "2"){ ?>

                            <i class="fa fa-circle yellow blink_me" aria-hidden="true"></i> | <a href="javascript:;" class="yellow">Pending</a>

                        <?php }else{ ?>

                            <i class="fa fa-circle yellow blink_me" aria-hidden="true"></i> | <a href="javascript:;" data-toggle="modal" data-target="#exampleModalLong<?php echo $x; ?>" class="yellow">Fill Leave</a>

                         <?php } ?>

                                <!-- FULL DAY LEAVE FORM -->
                    <div class="modal fade" id="exampleModalLong<?php echo $x; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Fill Out Leave</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                  </button>
                              </div>
                              <div class="modal-body">

                                <form action="<?php echo $url; ?>/include/ajaxscript.php" method="POST" class="submitDescripency">
                                    <input type="hidden" value="<?php echo $data['date']; ?>" name="discrepancy_date">

                                    <input type="hidden" value="<?php echo $globalUserDetails['userkey']; ?>" name="userkey">

                                    <input type="hidden" value="<?php echo $globalUserDetails['reportingauthority'] ?>" name="reporting_authority">
                                    <input type="hidden" value="<?php echo $globalUserDetails['departmentkey'] ?>" name="department_key">

                                    <input type="hidden" value="Half Day" name="discrepancy_type">
                                    <input type="hidden" value="submitDescripency" name="call">

                                    <div class="form-row">
                                        <textarea name="reason" placeholder="Reason" class="form-control"></textarea>
                                    </div><br>
                                    <div class="form-row">
                                        <input type="submit" name="">

                                    </div> 
                                    <div class="alert alert-success" style="display: none;" role="alert">Discrepency Submit Successfully</div>   
                                </form>

                            </div>

                        </div>
                    </div>
                </div>

                <!-- END FULL DAY LEAVE FORM -->


                               
                                <?php } } ?></td>
                              <?php } ?>
                            </tr>


                <?php  $x++; } ?>



    </tbody>

    </table>
<?php }else{  ?> 

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

            $month = date('F', $thisuserattendance['datetoday']);
            $current_month = date('F');

            if($month == $current_month ){

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
<td><?php if($globaluserid=="326716304839179062"){ ?><em><?php echo $thisuserattendance['aid']; ?></em> <?php } ?><h5 class="font-size-14 mb-0"><?php echo getUserNameByKey($thisuserattendance['userkey']); ?></h5><h6 class="font-size-10 color-teal"><?php echo getDepartmentNameByKey(getuserinfobykey($thisuserattendance['userkey'],'departmentkey')); ?></h6></td>
   <td><?php echo date('jS M', $thisuserattendance['datetoday']); ?></td>
   <td><?php echo date('H:i A', $thisuserattendance['timein']); ?></td>
   <td><?php echo $timeout; ?></td>
   <td><?php echo $totalhours; ?></td>


</tr>
<?php } } ?>     

</tbody>

</table>

<?php } }else{ ?>
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

            $month = date('F', $thisuserattendance['datetoday']);
            $current_month = date('F');

            if($month == $current_month ){

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
   <td><?php if($globaluserid=="326716304839179062"){ ?><em><?php echo $thisuserattendance['aid']; ?></em> <?php } ?><h5 class="font-size-14 mb-0"><?php echo getUserNameByKey($thisuserattendance['userkey']); ?></h5><h6 class="font-size-10 color-teal"><?php echo getDepartmentNameByKey(getuserinfobykey($thisuserattendance['userkey'],'departmentkey')); ?></h6>

</td>
   <td><?php echo date('jS M', $thisuserattendance['datetoday']); ?></td>
   <td><?php echo date('H:i A', $thisuserattendance['timein']); ?></td>
   <td><?php echo $timeout; ?></td>
   <td><?php echo $totalhours; ?></td>


</tr>
<?php } } ?>     

</tbody>

</table>

<?php } ?>

</div>
</div>
</div>
</div>
</div>
<?php include('../footer.php'); ?>
<?php include('../include/scripts.php'); ?>
<script type="text/javascript">
    $(document).ready( function(){
    $(".submitDescripency").submit(function(e) {

    e.preventDefault(); // avoid to execute the actual submit of the form.

    var form = $(this);
    var url = form.attr('action');
    
    $.ajax({
           type: "POST",
           url: url,
           data: form.serialize(), // serializes the form's elements.
           success: function(data)
           {
               location.reload();
           }
         });
        });

    });
</script>
<?php include('../include/datatables.php'); ?>


</body>
</html>