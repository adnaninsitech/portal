<?php include('../header.php'); ?>
<div class="container">
    <div class="card">
        <div class="card-body">
            <h2 class="card-title mb-4 font-size-24">Add User</h2>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
    
               <form action="<?php echo $url; ?>/include/ajaxscript.php" method="POST" id="adduser" >
                <input type="hidden" value="adduser" name="call">
                    <div class="form-row">
                    <label>Name</label>
                    <input type="text" class="form-control" name="username" required>
                    </div><br>
                    <div class="form-row">
                    <label>Email</label>
                    <input type="email" class="form-control" name="email" required>
                    </div><br>
                    <div class="form-row">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password" required>
                    </div><br>
                    <div class="form-row">
                    <label>Select Department</label>
                        <select name="department" class="form-control" required>
                           <?php $dept = getAllDepartment();
                            foreach($dept as $row){ ?>
                               
                            <option value="<?php  echo $row['departmentkey']; ?>"><?php  echo $row['departmentname']; ?></option>
                            <?php } ?>
                        </select>
                    </div><br>
                    <div class="form-row">
                    <label>Designation</label>
                    <input type="text" class="form-control" name="designation" required>
                    </div><br>
                    <div class="form-row">
                    <label>Reporting Authority</label><br>
                    <select  class="form-control select2-drop" name="reporting_authority" required>
                    <?php $users = getAllUsers();

                    foreach($users as $user){
                     ?>
                     <option value="<?php echo $user["userkey"]; ?>"><?php echo $user["name"]; ?></option>
                    <?php } ?>
                </select>
               
                    </div><br>

                     <div class="form-row">
                    <label>Employee Type</label>
                        <select name="employee_type" class="form-control" required> 
                            <option value="Permanent">Permanent</option>
                            <option value="Probation">Probation</option>
                            <option value="Intern">Intern</option>
                        </select>
                    </div><br>

                    <div class="form-row">
                    <label>User Type</label>
                      <select name="employee_usertype" class="form-control" required> 

                       <?php $usertype = getUserType();

                    foreach($usertype as $type){
                     ?>
                     <option value="<?php echo $type["typeid"]; ?>"><?php echo $type["typename"]; ?></option>
                    <?php } ?>
                     </select>
                    </div><br>

                     <div class="form-row">
                    <label>Salary</label>
                        <input type="text" class="form-control" name="salary" required>
                    </div><br>

                    <div class="form-row">
                    <label>Joining Date</label>
                        <input type="date" class="form-control" name="joining_date" required>
                    </div><br>

                    <div class="form-row">
                    <input type="submit" name="submit">
                    </div><br>
                    <div class="alert" role="alert"></div>

               </form> 
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('../footer.php'); ?>

<?php include('../include/scripts.php'); ?>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript">
$(document).ready( function(){
   $('.select2-drop').select2();

   $("#adduser").submit(function(e) {

    e.preventDefault(); // avoid to execute the actual submit of the form.

    var form = $(this);
    var url = form.attr('action');
    
    $.ajax({
           type: "POST",
           url: url,
           data: form.serialize(), // serializes the form's elements.
           success: function(res)
           {

            if(res == "error"){

                $(".alert").removeClass("alert-success").addClass("alert-danger").text("Email already Exists");
              
            }else{
                 $(".alert").removeClass("alert-danger").addClass("alert-success").text("User Add Successfully");
            }
           }
         });
    });

});
</script>

</body>
</html>