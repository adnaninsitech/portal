<?php include('../header.php'); ?>
<div class="container">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6"><h2 class="card-title mb-4 font-size-24"> Discrepancies </h2></div>

                <div class="col-md-6 text-right">
                    <form action="" method="POST">
                        <input type="date" name="date">
                        <input type="submit">
                    </form>
                </div>

            </div>

            <div class="row">
                <div class="col-md-12">

            <?php $userkey = $globalUserDetails['userkey']; 
            $getDiscrepancy = getfilledDiscrepancy($userkey);

           // var_dump($getAttendanceByDate) ?> <BR>
           <input type="hidden" id="url" value="<?php echo $url; ?>/include/ajaxscript.php" name="">
             <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Date</th>
                        <th>Type</th>
                        <th>Reason</th>
                        <th>Status</th>


                    </tr>
                </thead>


                <tbody>

        <?php foreach($getDiscrepancy as $row){

         $discrepancyStatus = $row['status'];
          ?>
             
            <tr>
                <td><h5 class="font-size-14 mb-0"><?php echo getUserNameByKey($row['userkey']); ?></h5><h6 class="font-size-10 color-teal"><?php echo getDepartmentNameByKey(getuserinfobykey($row['userkey'],'departmentkey')); ?></h6></td>
                <td><?php echo $row['discrepancy_date']; ?></td>
                <td><?php echo $row['discrepancy_type']; ?></td>
                <td><?php echo $row['reason']; ?></td>
                <td class="thour">
                    <?php if($discrepancyStatus == "2"){ ?>
                    <select class="status" rel="<?php echo $row['id']; ?>">
                        <option>Select Status</option>
                        <option value="1">Approve</option>
                        <option value="0">Reject</option>
                    </select>
                <?php }elseif($discrepancyStatus == "0"){
                    echo "Reject"; ?>
                    <i class="fa fa-circle red" aria-hidden="true"></i>
                <?php }else{ echo "Approved"; ?> 
            <i class="fa fa-circle green" aria-hidden="true"></i>
        <?php  } ?>
                </td>
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
<script type="text/javascript">
    $(document).ready( function(){

        $('.status').on('change', function() {

            var status = $(this).val();
            var id = $(this).attr("rel");
            var url = $("#url").val();
            var data = { call : 'discrepancyStatus', status : status , id : id };
        
        $.post(url,data,
          function(data, status){
            location.reload();
          });
    });

});
</script>
<?php include('../include/datatables.php'); ?>


</body>
</html>