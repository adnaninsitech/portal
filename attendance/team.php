<?php include('../header.php'); ?>
<div class="container">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6"><h2 class="card-title mb-4 font-size-24"> Team Members</h2></div>

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
                    $ra_key = $globalUserDetails['userkey'];
                    $teamList = getUserRA($ra_key);
             ?> <BR>
             <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                <thead>
                    <tr>
                        <th>Name</th>


                    </tr>
                </thead>


                <tbody>
                    <?php ?>
                    <?php foreach($teamList as $team){ ?>
            <tr>
               <td><h5 class="font-size-14 mb-0"><a href="../portal/attendance?uk=<?php echo $team['userkey']; ?>"><?php echo getUserNameByKey($team['userkey']); ?></a></h5><h6 class="font-size-10 color-teal"><?php echo getDepartmentNameByKey(getuserinfobykey($team['userkey'],'departmentkey')); ?></h6></td>
              

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