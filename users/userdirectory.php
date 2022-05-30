<?php include('../header.php'); ?>
<div class="container">
    <div class="card">
        <div class="card-body">
            <h2 class="card-title mb-4 font-size-24">All Users</h2>
            <div class="row">
                <div class="col-md-12">
             
             
                <table id="datatable1" class="table table-bordered dt-responsive  nowrap w-100">
                                            <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Designation</th>
                                                <th>Department</th>
                                                <th>Email</th>
                                                <th>Sip</th>
                                            </tr>
                                            </thead>
        
        
                                            <tbody>
                                            <?php $getAllUsers = getAllUsers();

                                             ?>
                <?php foreach($getAllUsers as $thisuser){
                 
                 ?>
                   <tr>
                                                <td><?php echo $thisuser['name']; ?></td>
                                                <td><?php echo $thisuser['designation']; ?></td>
                                                <td><?php echo getDepartmentnamebykey($thisuser['departmentkey']); ?></td>
                                                <td><?php echo $thisuser['email']; ?></td>
                                                <td><?php echo $thisuser['Sip']; ?></td>
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
    $("#datatable1").datatable();
});
</script>

</body>
</html>