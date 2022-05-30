<?php include('../header.php'); ?>
<div class="container">
    <div class="card">
        <div class="card-body">
            <h2 class="card-title mb-4 font-size-24">Add Notice</h2>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
        
               <form action="<?php echo $url; ?>/include/ajaxscript.php" method="POST" id="addnotice" >
                   <input type="hidden" value="addnotice" name="call">
                   <input type="hidden" value="<?php echo $globaluserid;  ?>" name="addedby">
                    <div class="form-row">
                    <label>Name</label>
                    <textarea  name="noticetext" class="form-control" required></textarea>
                    </div><br>
                    <div class="form-row">
                    <label>Select Department</label>
                        <select name="noticedept" class="form-control" required>
                           <?php $dept = getAllDepartment();
                            foreach($dept as $row){ ?>
                               
                            <option value="<?php  echo $row['departmentkey']; ?>"><?php  echo $row['departmentname']; ?></option>
                            <?php } ?>
                        </select>
                    </div><br>
                     <div class="form-row">
                    <label>Select Category</label>
                        <select name="category" class="form-control" required>
                           <?php $dept = getAllNoticeCategories();
                            foreach($dept as $row){ ?>
                               
                            <option value="<?php  echo $row['catid']; ?>"><?php  echo $row['categoryname']; ?></option>
                            <?php } ?>
                        </select>
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


<script type="text/javascript">
$(document).ready( function(){

   $("#addnotice").submit(function(e) {

    e.preventDefault(); // avoid to execute the actual submit of the form.

    var form = $(this);
    var url = form.attr('action');
    
    $.ajax({
           type: "POST",
           url: url,
           data: form.serialize(), // serializes the form's elements.
           success: function(res)
           {
             $(".alert").addClass("alert-success").text("Notice Add Successfully");
           }
         });
    });

});
</script>

</body>
</html>