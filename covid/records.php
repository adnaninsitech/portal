<?php include('../header.php'); ?>
<div class="container">
    <div class="card">
        <div class="card-body">
            <h2 class="card-title mb-4 font-size-24">Covid Vaccination</h2>
            <div class="row">
              <div class="col-md-8">
<table class="table"><?php 
$fully=0;
$partial =0;
global $conn;
$sql = "SELECT distinct(userkey) FROM `covidvaccine`";
$result = $conn->query($sql);
foreach($result as $thisresult){
    $thestatus = covidAlert($thisresult['userkey']);

    if($thestatus=="Completed"){
$mystatus = "Fully Vaccinated";
        $fully++;
    } else {
        $mystatus="Partially Vaccinated";
        $partial++;
   }

   $thisuserkey = $thisresult['userkey'];


   $sql2 = "SELECT vaccinationcard FROM covidvaccine WHERE userkey LIKE $thisuserkey ORDER BY id DESC limit 1";
   $result2 = $conn->query($sql2);
   foreach($result2 as $thisone){
$link = $thisone['vaccinationcard'];
   }
   
?>
<tr>
<td><?php echo getusernamebykey($thisresult['userkey']); ?></td>
<td><?php echo getDepartmentNameByKey(getuserinfobykey($thisresult['userkey'], 'departmentkey')); ?></td>
<td><?php echo $mystatus; ?></td>
<td><a  class="viewfile" href="<?php echo $link; ?>" target="_blank" >View File</a></td>
</tr>
<?php } ?>
</table>


                 
            </div>



            <div class="col-md-4 ratio-box">
            
<div class="single-row-ratio"><label>Total Employees</label> <span><?php echo $totalstrength = getAllUsers()->num_rows; ?></span></div>
<div class="single-row-ratio"><label>Fully Vaccinated</label> <span><?php echo $fully; ?></span></div>
<div class="single-row-ratio"><label>Partially Vaccinated</label> <span><?php echo $partial; ?></span></div>
<div class="single-row-ratio"><label>Unvaccinated</label> <span><?php echo $unvaccinated = $totalstrength -$fully - $partial; ?></span></div>

<?php $width = ($unvaccinated*100)/$totalstrength; 
$width = round($width, 2);
$width = 100-$width;
?>

<div class="single-row-ratio"><label>Completion Ratio</label> <span><?php echo $width; ?>%</span></div>
<div class="vaccinationmeter"><h4>Vaccination Meter <span> (<?php echo $width; ?>%) </span></h4>
<div id="vmeter"><span style="width:<?php echo $width; ?>%"></span></div>
</div>




</div>
        </div>
    </div>
</div>
</div>



<?php include('../footer.php'); ?>
<?php include('../include/scripts.php'); ?>
<?php include('../include/datatables.php'); ?>


        <!-- lightbox init js-->
        <script src="assets/js/pages/lightbox.init.js"></script>

<script type="text/javascript">
    $(document).ready( function(){
        $('.vaccine').on('change', function() {
          var va = $(this).val();
          if(va == "cansino"){ $(".dose-opt").hide(); } else if(va == "pakvac"){ $(".dose-opt").hide(); }else{ $(".dose-opt").show(); }

      });
    });
</script>

<style>
    .vaccinationmeter h4 span {
    color: #07a165;
}
.vaccinationmeter{
    max-width:280px;
    margin:20px 0 0 0;
}
div#vmeter {
    background: #2a3042;
    width: 100%;
    display: block;
    height: 20px;
    border-radius: 100px;
}

div#vmeter span{
    background: #07a165;
    display: block;
    height: 20px;
    border-radius: 100px;
}

.vaccinationmeter {background: #eee;padding: 10px 16px;}

.vaccinationmeter h4 {
    font-size:14px; 
    }
    </style>
</body>
</html>