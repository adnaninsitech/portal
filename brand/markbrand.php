<?php include('../header.php');

if(isset($_POST["submit"])){

    $userkey = $_POST["userkey"];
    $brand_id = $_POST["brand_id"];

    $result =  assignBrand($userkey,$brand_id);

}

?>
<div class="container">
    <div class="card">
        <div class="card-body">
            <h2 class="card-title mb-4 font-size-24">Mark Brand To User</h2>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
         <?php if(isset($result)){

         if($result == "error"){ ?>
         <div class="alert alert-danger" role="alert">
  Already Mark..
</div>
 <?php }else{ ?> 
<div class="alert alert-success" role="alert">
  Brand Mark Successfully..
</div>
                    <?php } } ?>
                 <form action="" method="POST" enctype="multipart/form-data" >

                    <div class="form-row">
                    <label>User</label><br>
                    <select  class="form-control select2-drop" name="userkey" required>
                        <?php $users = getAllUsers();

                        foreach($users as $user){
                         ?>
                         <option value="<?php echo $user["userkey"]; ?>"><?php echo $user["name"]; ?></option>
                        <?php } ?>
                    </select>
               
                    </div><br>

                    <div class="form-row">
                    <label>Brands</label><br>
                    <select  class="form-control select2-drop" name="brand_id" required>
                        <?php $brands = getBrands();

                        foreach($brands as $brand){
                         ?>
                         <option value="<?php echo $brand["id"]; ?>"><?php echo $brand["brand_name"]; ?></option>
                        <?php } ?>
                    </select>
               
                    </div><br>

                    <div class="form-row">
                    <input type="submit" name="submit">
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
        $('.select2-drop').select2();
    });
</script>

</body>
</html>