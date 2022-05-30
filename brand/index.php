<?php include('../header.php');

if(isset($_POST["submit"])){

    $brand_name = $_POST["brand_name"];
    $brand_url = $_POST["brand_url"];

    $result =  addBrand($brand_name,$brand_url);

}




?>
<div class="container">
    <div class="card">
        <div class="card-body">
            <h2 class="card-title mb-4 font-size-24">Add Brand</h2>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
 <?php if(isset($result)){ ?> 
<div class="alert alert-success" role="alert">
  Brand Add Successfully..
</div>
                    <?php } ?>
                 <form action="" method="POST" enctype="multipart/form-data" >

                    <div class="form-row">
                    <label>Brand Name</label>
                    <input type="text" class="form-control" name="brand_name" required>
                    </div><br>

                    <div class="form-row">
                    <label>Brand URL (e.g. https://vurkflow.com/monsterlogodesign)</label>
                    <input type="text" class="form-control" name="brand_url" required>
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
<?php include('../include/datatables.php'); ?>
<script type="text/javascript">
    $(document).ready( function(){
 
    });
</script>

</body>
</html>