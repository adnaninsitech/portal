<?php include('../header.php'); ?>
<div class="container">
    <div class="card">
        <div class="card-body">
            <h2 class="card-title mb-4 font-size-24">All Users</h2>
            <div class="row">
                <div class="col-md-12">


                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Designation</th>
                                <th>Department</th>
                                  <?php if(isSuperAdmin($globaluserid)){ ?>
                                <th>Reporting Authority</th>
                              
                                    <th>Status</th>
                                <?php } ?>
                                <th></th>
                            </tr>
                        </thead>


                        <tbody>
                            <?php
                            if(isset($_GET["k"])){
                                $getAllUsers = getAllUsersByDept($_GET["k"]);
                            }else{
                              $getAllUsers = getAllUsers();  
                          }


                          ?>
                          <?php foreach($getAllUsers as $thisuser){

                             ?>
                             <tr>
                                <td><?php echo $thisuser['name']; ?> <?php $online = getUserOnlineStatus($thisuser['userkey']); if($online == "1"){ ?>
                                    <i class="fa fa-circle green" aria-hidden="true"></i> <?php }else{ ?>
                                        <i class="fa fa-circle red" aria-hidden="true"></i> <?php } ?></td>
                                        <td><?php echo $thisuser['designation']; ?></td>
                                        <td><?php echo getDepartmentnamebykey($thisuser['departmentkey']); ?></td>
                                        <?php if(isSuperAdmin($globaluserid)){ ?>
                                        <td><?php $ra = $thisuser['reportingauthority']; if($ra=='0'){ echo "N/A"; } else {
                                            echo getusernamebykey($ra); } ?></td>
                                        <?php } ?>

                                            <?php if(isSuperAdmin($globaluserid)){ ?>
                                                <th><select class="select" rel="<?php echo $thisuser['userkey']; ?>"><option value="1">Active</option><option value="0">Deactive</option></select></th>
                                            <?php } ?>

                                            <td><a href="../portal/users/userdetail.php?uk=<?php echo base64_encode($thisuser['userkey']); ?>">View Details</a></td>
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
    
                $(document).on('change','.select',function(e){
                    
                    e.preventDefault();
                    var status = $(this).val();
                    var ukey = $(this).attr("rel");



                    var url = "<?php echo $url . '/include/ajaxscript.php'; ?>";
                    var data = { status: status, ukey: ukey, call: "changeUserStatus" } ;

                    $.ajax({
                    type: "POST",
                    url: url,
                    data: data, // serializes the form's elements.
                        success: function(data)
                        {
                            ///alert(data);
                            location.reload();
                        }
                    });


                });
          
        </script>

    </body>
    </html>