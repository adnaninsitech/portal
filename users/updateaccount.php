<?php include('../header.php'); ?>
<style type="text/css">
    #regForm {
  background-color: #ffffff;
  margin: 100px auto;
  padding: 40px;
  width: 70%;
  min-width: 300px;
}

h1 {
  text-align: center;  
}

input {
  padding: 10px;
  width: 100%;
  font-size: 17px;
  border: 1px solid #aaaaaa;
}

/* Mark input boxes that gets an error on validation: */
input.invalid {
  background-color: #ffdddd;
}

/* Hide all steps by default: */
.tab {
  display: none;
}

button {
  background-color: #04AA6D;
  color: #ffffff;
  border: none;
  padding: 10px 20px;
  font-size: 17px;
  cursor: pointer;
}

button:hover {
  opacity: 0.8;
}

#prevBtn {
  background-color: #bbbbbb;
}

/* Make circles that indicate the steps of the form: */
.step {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbbbbb;
  border: none;  
  border-radius: 50%;
  display: inline-block;
  opacity: 0.5;
}

.step.active {
  opacity: 1;
}

/* Mark the steps that are finished and valid: */
.step.finish {
  background-color: #04AA6D;
}
</style>
<?php 


$bankDetail = getUserbankAccountDetail($globalUserDetails['userkey']);

foreach($bankDetail as $bd){

  $account_title = $bd["account_title"];
  $account_number = $bd["account_number"];
  $iban_number = $bd["iban_number"];
  $branch = $bd["branch"];
}

 ?>

<div class="container">
<form id="regForm" action="<?php echo $url; ?>/include/ajaxscript.php" method="POST">
    <input type="hidden" name="call" value="updateAccount">
    <input type="hidden" name="userKey" value="<?php echo $globalUserDetails['userkey']; ?>">
  <h1><?php echo $globalUserDetails['name']; ?> - Update Profile</h1>
  <!-- One "tab" for each step in the form: -->
  <div class="tab">Personal Detail:
    <p><input placeholder="CNIC" value="<?php echo getUserMetaValueByKey($globalUserDetails['userkey'] , 'cnic'); ?>" oninput="this.className = ''" name="info[cnic]"></p>
    <p><input placeholder="Phone Number" value="<?php echo getUserMetaValueByKey($globalUserDetails['userkey'] , 'phone_number'); ?>" oninput="this.className = ''" name="info[phone_number]"></p>
    <p><input placeholder="Address" value="<?php echo getUserMetaValueByKey($globalUserDetails['userkey'] , 'address'); ?>" oninput="this.className = ''" name="info[address]"></p>
    <p><input placeholder="Next of Kin" value="<?php echo getUserMetaValueByKey($globalUserDetails['userkey'] , 'next_of_kin'); ?>" oninput="this.className = ''" name="info[next_of_kin]"></p>
    <p><input placeholder="Spouse" value="<?php echo getUserMetaValueByKey($globalUserDetails['userkey'] , 'spouse'); ?>" oninput="this.className = ''" name="info[spouse]"></p>
  </div>
  <div class="tab">Emergency Contact:
    <p><input placeholder="Name" value="<?php echo getUserMetaValueByKey($globalUserDetails['userkey'] , 'emergency_name'); ?>" oninput="this.className = ''" name="info[emergency_name]"></p>
    <p><input placeholder="Phone Number" value="<?php echo getUserMetaValueByKey($globalUserDetails['userkey'] , 'emergency_phone_number'); ?>" oninput="this.className = ''" name="info[emergency_phone_number]"></p>
    <p><input placeholder="Relation" value="<?php echo getUserMetaValueByKey($globalUserDetails['userkey'] , 'emergency_relation'); ?>" oninput="this.className = ''" name="info[emergency_relation]"></p>
  </div>
  <div class="tab">Bank Account Information:
    <p><input placeholder="Account Title" value="<?php echo $account_title; ?>" oninput="this.className = ''" name="account_title"></p>
    <p><input placeholder="Account Number" value="<?php echo $account_number; ?>" oninput="this.className = ''" name="account_number"></p>
    <p><input placeholder="IBAN Number" value="<?php echo $iban_number; ?>" oninput="this.className = ''" name="iban_number"></p>
    <p><input placeholder="Branch" value="<?php echo $branch; ?>" oninput="this.className = ''" name="branch"></p>
  </div>

  <div style="overflow:auto;">
    <div style="float:right;">
      <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
      <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
    </div>
  </div>
  <!-- Circles which indicates the steps of the form: -->
  <div style="text-align:center;margin-top:40px;">
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
  </div>
</form>
</div>

<?php include('../footer.php'); ?>

<?php include('../include/scripts.php'); ?>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript">

 $(document).on('click', '.submit', function() { 
   // alert("hello");
    var form = $( "#regForm" ).serialize();
    var url = $( "#regForm" ).attr('action');
    
    $.ajax({
           type: "POST",
           url: url,
           data: form, // serializes the form's elements.
           success: function(data)
           {
  

              var url = window.location.href;

              alert(url);
              url = url.slice( 0, url.indexOf('?') );
              window.location.href += "?s=success";
           }
         });
    return false;
     });



  var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
  // This function will display the specified tab of the form...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  //... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "inline";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "Submit";
  
  } else {
    document.getElementById("nextBtn").innerHTML = "Next";
  }
  //... and run a function that will display the correct step indicator:
  fixStepIndicator(n)
}


function nextPrev(n) {

  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form...
  if (currentTab >= x.length) {
    // ... the form gets submitted:
    //document.getElementById("regForm").submit();
      $("#nextBtn").addClass("submit");
      return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "") {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false
      valid = false;
    }
  }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class on the current step:
  x[n].className += " active";
}


</script>

</body>
</html>