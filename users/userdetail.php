<?php include('../header.php');

$userKey = base64_decode($_GET["uk"]);

$userdetail = getUserDetails($userKey);

//vr_dumap($userdetail);

 ?>

    <div class="container homepage">

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">User Details</h4>
                        <div class="info-card">
                            <div class="single-row">
                                <label>Full Name:</label> <span><?php echo $userdetail["name"]; ?></span></div>

                            <div class="single-row">
                                <label>Email:</label> <span><a href="mailto:<?php echo $userdetail["email"]; ?>"><?php echo $userdetail["email"]; ?></a></span></div>
                            <div class="single-row">
                                <label>Designation:</label> <span><?php echo $userdetail['designation']; ?></span></div>
                            <div class="single-row">
                                <label>Department:</label> <span><?php echo getDepartmentNameByKey($userdetail['departmentkey']); ?></span></div>
                                 <?php if(isSuperAdmin($globaluserid)){ ?>

                            <div class="single-row">
                                <label>Reporting To:</label> <span><?php $ra = $userdetail['reportingauthority']; if($ra=='0'){ echo "N/A"; } else {
echo getusernamebykey($ra); } ?></span></div>
                            <div class="single-row">
                                <label>Date of Joining:</label> <span><?php echo date("jS M Y", $userdetail['dateofjoining']); ?></span></div>
                            <div class="single-row">
                                <label>Employee Type:</label> <span><?php echo $userdetail['employeetype']; ?></span></div>
                            <?php } ?>
                            <?php /*  <div class="single-row"><label>Current Salary:</label> <span class="showhide hideme"><strong>********</strong><em>PKR <?php echo number_format($globalUserDetails['currentsalary'], 0, ',', ','); ?>
                                </em><b class="showhide-trigger">Show/Hide</b></span>
                        </div> */ ?> </div>
                </div>
            </div>
        </div>
        </div>

    </div>

</body>
</html>