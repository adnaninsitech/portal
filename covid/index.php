<?php include('../header.php');

 $vaccineAlert =covidAlert($globalUserDetails['userkey']);


if($vaccineAlert == "Completed"){ ?>

    <div class="alert alert-success" role="alert">Your COVID-19 immunization records have been saved successfully.</div>

<?php }elseif($vaccineAlert == "error"){ }else{ ?>
     <div class="alert alert-danger" role="alert">Your second dose is overdue, please submit your record.</div>
<?php }


if(isset($_POST["submit"])){

    $name = $_POST["username"];
    $vaccine = $_POST["vaccine"];
    $date = $_POST["date"];
    $center = $_POST["center"];
    $userkey = $_POST["userkey"];

    if($vaccine == "cansino"){
        $dose = "2";
        $status = "0";
        $nextDose = "Completed";
    }elseif($vaccine == "pakvac"){
        $dose = "2";
        $status = "0";
        $nextDose = "Completed";
    }else{
     $dose = $_POST["dose"]; 

     if($dose == "2"){
        $status = "0";
        $nextDose = "Completed";
    }else{
        $status = "1";
        $nextDose = Date('Y-m-d', strtotime('+28 days', strtotime($date)));
    }

}

$uploaddir = 'certificate/';
$filename = time() . '-' . basename($_FILES['card']['name']);
$uploadfile = $uploaddir . $filename;

if (move_uploaded_file($_FILES['card']['tmp_name'], $uploadfile)) {
    $fileurl = $url .'/covid/certificate/'.$filename;
}

$success = addcovid($userkey , $name,$vaccine,$dose,$date,$center,$fileurl,$nextDose,$status);
}

?>
<div class="container">
    <div class="card">
        <div class="card-body">
            <h2 class="card-title mb-4 font-size-24">Covid Vaccination</h2>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">

                 <form action="" method="POST" enctype="multipart/form-data" >
                    <input type="hidden" value="<?php echo $globalUserDetails['userkey']; ?>" name="userkey">
                    <div class="form-row">
                        <label>Name</label>
                        <input type="text" name="username" value="<?php echo showUserName($globaluserid); ?>" class="form-control" readonly required>
                    </div><br>
                    <div class="form-row">
                        <label>Vaccine</label>
                        <select class="form-control vaccine" name="vaccine" required>
                            <option value="moderna">Moderna</option>
                            <option value="sinopharm">Sinopharm</option>
                            <option value="cansino">CanSino</option>
                            <option value="sinovac">Sinovac</option>
                            <option value="astrazaneca">AstraZeneca</option>
                            <option value="pfizer">PFIZER</option>
                            <option value="pakvac">PakVac</option>
                            <option value="sputnikv">Sputnik V</option>
                        </select>
                    </div><br>
                    <!-- <div class="form-row dose-opt">
                        <label>Dose</label>
                        <input type="radio" value="1" name="dose" checked required><span>1</span>
                        <input type="radio" value="2" name="dose"><span>2</span>
                    </div><br> -->
                    <div class="form-row">
                        <label>Vaccination Date</label>
                        <input type="date" class="form-control" name="date" required>
                    </div><br>
                    <div class="form-row">
                        <label>Vaccination Center</label>
                        <input type="text" class="form-control" name="center" required>
                    </div><br>

                    <?php $userDose = userCovidDose($globalUserDetails['userkey']); if($userDose == "error" ){  ?>
                    
                     <div class="form-row">
                        <input type="hidden" value="1" name="dose" >
                        <label>Vaccination Slip / Vaccine Card (First Dose)</label>
                        <input type="file" class="form-control" name="card" required>
                    </div><br>
                    <?php }else{ ?> 
                   <div class="form-row">
                        <input type="hidden" value="2" name="dose" >
                        <label>Vaccination Slip / Vaccine Card (Second Dose)</label>
                        <input type="file" class="form-control" name="card" required>
                    </div><br>

                    <?php } ?>


                    <div class="form-row">
                        <input type="submit" class="form-control" name="submit" required>
                    </div><br>
                    <?php if(isset($success)){ ?>
                        <div class="alert alert-success" role="alert">Submit Successfully</div>
                        <meta http-equiv="refresh" content="0;URL='http://192.168.10.11:85/portal/'" />    

                    <?php } ?>

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
        $('.vaccine').on('change', function() {
          var va = $(this).val();
          if(va == "cansino"){ $(".dose-opt").hide(); } else if(va == "pakvac"){ $(".dose-opt").hide(); }else{ $(".dose-opt").show(); }

      });
    });
</script>
</body>
</html>