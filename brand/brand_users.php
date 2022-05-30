<?php include('../header.php'); ?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<div class="container">
    <div class="card">
        <div class="card-body">
            <h2 class="card-title mb-4 font-size-24">Monthly Report</h2>
            <div class="row">
                <div class="col-md-12">
<table id="example" class="table table-bordered dt-responsive   ">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Brand</th>
            <th>Designation</th>
            <th>Department</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody>
        <?php $getAllBrandAssignee = getAllBrandAssignee();
            $num = 1;?>
    <?php foreach($getAllBrandAssignee as $thisuser){?>
        <tr>
            <td><?php echo $num; ?></td>
            <td asgn="<?php echo $thisuser['assign_id']; ?>"><?php echo $thisuser['name']; ?></td>
            <td><?php echo $thisuser['brand']; ?></td>
            <td><?php echo $thisuser['designation']; ?></td>
            <td><?php echo getDepartmentnamebykey($thisuser['departmentkey']); ?></td>
            <td><?php echo $thisuser['email']; ?></td>
        </tr>
    <?php $num++;} ?>     
    </tbody>
</table>

                </div>
            </div>
        </div>
    </div>
</div>

<?php include('../footer.php'); ?>

<?php include('../include/scripts.php'); ?>

<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">
function myAjax(url) {
    $.ajax({
           type: "POST",
           url: url,
           data:{call:'downloadreport'},
           //success:function(html) {}

    });
}
$(document).ready(function() {
    $('#example').DataTable();
} );
</script>

</body>
</html>