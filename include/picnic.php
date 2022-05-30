<?php
    
 
    global $conn;

    $sql = "SELECT * FROM picnic WHERE userkey LIKE $globaluserid";
    $result = $conn->query($sql);
    if($result->num_rows>0){


    } else {

    ?>
<script type="text/javascript">
$(document).ready( function(){

    $("#votepicnic").submit(function(e) {

e.preventDefault(); // avoid to execute the actual submit of the form.

var form = $(this);
var url = form.attr('action');
$('form#votepicnic input[type="submit"]').hide();
$.ajax({
       type: "POST",
       url: url,
       data: form.serialize(), // serializes the form's elements.
       success: function(res)
       {
        if(res=="success"){
            $(".alert1").removeClass("alert-danger").addClass("alert-success").text("Submit Successfully");
            location.reload();
          
        }else{
            $(".alert1").removeClass("alert-success").addClass("alert-danger").text("Sorry! You can vote only once!");
        }
       }
     });
});

$('.popup-overlay, .close-popup').click(function() {
                $('.showpopup').remove();
                $('.popup-overlay').remove();


});
});
</script>
<div class="showpopup picnicpopup">
<a href="javascript:;" class="close-popup"><i class="mdi mdi-close"></i></a> <img src="assets/images/picnic.jpg">
<div class="picnic-popup-desc">
<div class="picnic-form">    <h4>Dear <?php echo getusernamebykey($globalUserDetails['userkey']); ?></h4>
<p>At Tech Resource Company, we are a team of talented and accomplished professionals who work and win together. All that we do revolves around integrity, innovation, and passion to do something unique and impactful. We are always committed to providing an enviable work environment where employees not only learn and develop themselves but also enjoy as a family.
Keeping this in mind, we would like to recognize your efforts that have made it possible for us to emerge as one of the fastest growing IT companies in Pakistan. In this regard, the management has decided to plan a picnic that will strengthen our relationship and make it more fun to work together. </p>
<p>Before we move on, we would like you to share your opinion by answering the following:
What is your preference regarding the time for this picnic? </p>
<div class="popup-content">
        <form method="POST" id="votepicnic" action="<?php echo $url; ?>/include/ajaxscript.php" >
            <input type="hidden" name="call" value="votepicnic">
            <input type="hidden" value="<?php echo $globalUserDetails['userkey']; ?>" name="userkey">
            <div class="form-row row options-row">
                <span for="relax">Where do you want to relax and unwind?</span>
<div class="col-md-3"><input type="radio" value="beach" name="location" id="venue-beach" required><label for="venue-beach">Beach</label></div>
<div class="col-md-3"><input type="radio" value="farmhouse" name="location" id="venue-farmhouse" required><label for="venue-farmhouse">Farmhouse</label></div>
            </div>
            <div class="form-row row options-row">
                <span >What is your preference regarding the time for this picnic?</span>
<div class="col-md-3"> <input type="radio" value="day" name="time" id="time-day" required><label for="time-day">Day</label></div>
<div class="col-md-3">     <input type="radio" value="night" name="time" id="time-night" required><label for="time-night">Night</label></div>
            </div>
            <div class="form-row">
                    <input type="submit" class="form-control" name="submit" required>
                </div>
            <div class="alert1" role="alert"></div>


        </form>

    </div>
</div>
</div>
</div>
<div class="popup-overlay"></div>

<?php }  ?>