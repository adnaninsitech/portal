<?php include('../header.php'); ?>
<div class="container">
    <div class="card">
        <div class="card-body">
        
            <h2 class="card-title mb-4 font-size-24">Password Reset</h2>
            <?php if(isset($_GET["e"])){ ?> 
           <div class="alert alert-warning" role="alert">
           First things first, You need to reset your password.
</div>
        <?php } ?>

            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
             <div class="password-reset">       <div class="row">
<div class="col-md-6"><div class="form-row"><label>Type your new password</label><input class="form-control" name="password" type="password"></div></div>
<div class="col-md-6"><div class="form-row"><label>Retype your new password</label><input class="form-control" name="password2" type="password"></div></div>

<a href="javascript:;"  class="col-md-5" id="changepassword">Change Password</a>
</div>
                </div></div>
            </div>
        </div>
    </div>
</div>
<?php include('../footer.php'); ?>
<?php include('../include/scripts.php'); ?>
<script type="text/javascript">
$(document).ready( function(){
    $('#changepassword').click( function(){
        $('.errornote').remove();
        var password1 = $('input[name="password"]').val();
        var password2 = $('input[name="password2"]').val();
if(password1==password2){


    if (password1.length < 8){
  $("input[name='password']").after('<div class="errornote">Password Must be atleast 8 characters.</div>');
    } else {


        $.ajax({
            type: "POST",
            url: 'include/ajax/passwordreset.php',
            data: {
                password: password1,
                userkey: '<?php echo $globaluserid; ?>'
            },
success: function(data) {
if (data == 'success') {
$('input[name="password"]').val('');
$('input[name="password2"]').val('');
$('.alert').remove();
location.replace("../portal");
$('.card-title').after('<div class="alert alert-success" role="alert">Please Wait while we redirect you to dashboard!</div>');
} else {
}
}
});

} 
} else {
$("input[name='password']").after('<div class="errornote">Passwords do not match.</div>');
}
});
});
</script>
</body>
</html>