<?php include('../header.php'); ?>

<?php if(!isSuperAdmin($globaluserid)){ 
 /*   ?>
    <meta http-equiv="refresh" content="0;url=http://192.168.10.11:85/portal/">
    <?php 
*/ } ?>
<div class="container">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-9">
                    <h2 class="card-title mb-4 font-size-24"> Discrepancies</h2>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">

                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Date</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Fill</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $userkey = $globalUserDetails['userkey'];
                            $getUserDiscrepencies = getUserDiscrepancy($userkey); ?>
                            <?php $x=1; foreach($getUserDiscrepencies as $getUserDiscrepency){

                            $status = $getUserDiscrepency['status']; ?>
                                <tr>
                                   <td><h5 class="font-size-14 mb-0"><?php echo getUserNameByKey($getUserDiscrepency['userkey']); ?></h5><h6 class="font-size-10 color-teal"><?php echo getDepartmentNameByKey(getuserinfobykey($getUserDiscrepency['userkey'],'departmentkey')); ?></h6></td>
                                   <td><?php echo date("d-m-Y",strtotime($getUserDiscrepency['created_date'])); ?></td>
                                   <td><?php echo $getUserDiscrepency['discrepencytype']; ?></td>
                                   <td id="disstatus<?php echo $getUserDiscrepency['id']; ?>"><?php if($status == '1'){ echo "Pending"; }elseif( $status == '2'){ echo "Filled"; }elseif( $status == '3'){ echo "Approved"; }else{ echo "Reject"; } ?></td>
                                   <td>
                                    <?php if($status == '1'){ ?><a href="javascript:;" data-toggle="modal" class="btn-dis<?php echo $getUserDiscrepency['id']; ?>" data-target="#exampleModalLong<?php echo $x; ?>" >Fill</a><?php } else{ ?>--<?php } ?></td>
                               </tr>

                               <!-- Modal -->
                               <div class="modal fade" id="exampleModalLong<?php echo $x; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                      </button>
                                  </div>
                                  <div class="modal-body">

                                    <form action="<?php echo $url; ?>/include/ajaxscript.php" method="POST" class="submitDescripency">
                                        <input type="hidden" value="<?php echo $getUserDiscrepency['id']; ?>" name="discrepancy_id">

                                        <input type="hidden" value="<?php echo $userkey ?>" name="userkey">

                                    <input type="hidden" value="<?php echo $globalUserDetails['reportingauthority'] ?>" name="reportingauthority">

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


                    <?php $x++; } ?>     

                </tbody>

            </table>

        </div>
    </div>

</div>
</div>
</div>


<?php include('../footer.php'); ?>
<?php  include('../include/scripts.php'); ?>
<?php include('../include/datatables.php'); ?>

<script type="text/javascript">
    $(document).ready(function(){



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
               $(".alert").show(); // show response from the php script.
                 $(".btn-dis"+data).text("--");
                 $("#disstatus"+data).text("Filled");
           }
         });
        });

    })
</script>

</body>
</html>