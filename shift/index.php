<?php include('../header.php');

if(isset($_POST["submit"])){

    $userkey = $_POST["userkey"];
    $shiftId = $_POST["shift"];

    $result = updateUserShift($userkey , $shiftId);

} ?>
<div class="container">
    <div class="card">
        <div class="card-body">
            <h2 class="card-title mb-4 font-size-24">Mark User Shift</h2>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">

                    <?php if(isset($result)){ ?> 
<div class="alert alert-success" role="alert">
  Shift Change Successfully..
</div>
                    <?php } ?>
    
               <form method="POST" >
                
                 <div class="form-row">
                    <label>Name</label>
                    <?php 
                    $users = getRAUsers($globalUserDetails['userkey']); ?>
                    <select name="userkey" required>
                        <option value="">Select</option>
                        <?php
                    foreach($users as $user){ ?> 

                        <option value="<?php echo $user["userkey"]; ?>"><?php echo $user["name"]; ?></option>

                    <?php } ?>
                    </select>
                    </div><br>
                    <div class="form-row">
                    <label>Shift</label>
                    <?php 
                    $shifts = getShift(); ?>
                    <select name="shift" required>
  <option value="">Select</option>
                    <?php
                    foreach($shifts as $shift){ ?> 

                        <option value="<?php echo $shift["id"]; ?>"><?php echo $shift["shifttimein"] . ' - ' . $shift["shifttimeout"]; ?></option>

                    <?php } ?>
                    </select>
                    </div><br>
                    <div class="form-row">
                        <input type="submit" value="Submit" name="submit">
                    </div><br>

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
 

});
</script>

</body>
</html>