<?php include('../header.php'); ?>
<div class="container">
    <div class="card">
        <div class="card-body">
            <h2 class="card-title mb-4 font-size-24">Monthly Report</h2>
            <div class="row">
                <div class="col-md-12">
    
                <?php 

    $getData = getAttendanceByMonth(); ?>
    <table id="datatable1" class="table table-bordered dt-responsive   ">
    <thead>
        <tr>
              <th>Sno</th>
            <th>Name</th>
            <th>Department</th>
            <th>Date</th>
            <th>Day</th>
            <th>Time In</th>
            <th>Time Out</th>
            <th>Total Hours</th>


        </tr>
    </thead>
        <tbody>
                  <?php $x=1; foreach($getData as $data){ ?>

            <tr>
                <td><?php echo $data['date']; ?></td>
                <td rel='<?php echo $data["aid"]; ?>'><?php echo $data['user']; ?></td>
                <td><?php echo $data['department']; ?></td>
                <td><?php echo $data['date']; ?></td>
                <td><?php echo $data['day']; ?></td>
                <td><?php echo $data['timein']; ?></td>
                <td><?php echo $data['timeout']; ?></td>
                  <?php if($data['date'] == "31-12-2021" && $data['timein'] == "-" ){ ?>
                          <td class="thour green">Holiday</td>
                         <?php }else{ ?>

                <td><?php echo $data['totalHours'];
                $hour = strtok($data['totalHours'], " ");  ?>
                     <?php if($hour == "Absent"){ 
                        $discrepancyStatus = checkDiscrepancyStatus($data['date'] , $data['userkey']); ?>

                        <?php if($discrepancyStatus == "0"){ ?>

                             <i class="fa fa-circle red blink_me" aria-hidden="true"></i> | <a href="javascript:;" class="red">Reject</a>

                        <?php }elseif($discrepancyStatus == "1"){ ?> 

                            <i class="fa fa-circle green blink_me" aria-hidden="true"></i> | <a href="javascript:;" class="green">Approved</a>

                        <?php }elseif($discrepancyStatus == "2"){ ?>

                            <i class="fa fa-circle yellow blink_me" aria-hidden="true"></i> | <a href="javascript:;" class="yellow">Pending</a>

                        <?php }else{ ?>

                       

                            <i class="fa fa-circle red blink_me" aria-hidden="true"></i> | <a href="javascript:;" data-toggle="modal" data-target="#exampleModalLong<?php echo $x; ?>" class="red">Not Filled</a>
                        

                         <?php } ?>
                     <?php }elseif($hour >= "8"){ ?>
                            <i class="fa fa-circle green" aria-hidden="true"></i>
                        <?php }else{ ?> 

                            <?php if($data['date'] ==  $date_now = date("d-m-Y")){ ?> <?php }else{ 
                                 $discrepancyStatus = checkDiscrepancyStatus($data['date'] , $data['userkey']);
                                 ?>

                                  <?php if($discrepancyStatus == "0"){ ?>

                             <i class="fa fa-circle red blink_me" aria-hidden="true"></i> | <a href="javascript:;" class="red">Reject</a>

                        <?php }elseif($discrepancyStatus == "1"){ ?> 

                            <i class="fa fa-circle green blink_me" aria-hidden="true"></i> | <a href="javascript:;" class="green">Approved</a>

                        <?php }elseif($discrepancyStatus == "2"){ ?>

                            <i class="fa fa-circle yellow blink_me" aria-hidden="true"></i> | <a href="javascript:;" class="yellow">Pending</a>

                        <?php }else{ ?>

                            <i class="fa fa-circle yellow blink_me" aria-hidden="true"></i> | <a href="javascript:;" data-toggle="modal" data-target="#exampleModalLong<?php echo $x; ?>" class="yellow">Not Filled</a>

                         <?php } } } ?>

                </td>
            <?php } ?>
            </tr>


                <?php $x++; } ?>
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
function myAjax(url) {
    $.ajax({
           type: "POST",
           url: url,
           data:{call:'downloadreport'},
           //success:function(html) {}

    });
}
$(document).ready( function(){

    $('#datatable1').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'csv', 'excel', 'pdf', 'print'
        ],
         "columnDefs": [
            {
                "targets": [ 0 ],
                "visible": false,
                "searchable": false
            }
        ]
    } );


});
</script>

</body>
</html>