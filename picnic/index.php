<?php include('../header.php'); ?>
<div class="container">
    <div class="card">
        <div class="card-body picnic-container">
            <h2 class="card-title mb-4 font-size-24">Picnic Survey Results</h2>
            <div class="row">

            <div class="col-md-4 single-picnic-column">
             <h4>Location</h4>   
<?php $sql = "SELECT count(*) as count, location FROM picnic GROUP BY location";
$result= $conn->query($sql);
$counter =0;
foreach($result as $thisresult){
echo "<h5>".$thisresult['location']."<span>".$thisresult['count']."</span></h5>";
$counter = $counter+$thisresult['count'];
}


echo "<h5>Total <span>".$counter."</span></h5>";
?>

                </div>



                <div class="col-md-4 single-picnic-column">
             <h4>Time</h4>   
<?php $sql = "SELECT count(*) as count, time FROM picnic GROUP BY time";
$result= $conn->query($sql);
$counter =0;
foreach($result as $thisresult){
echo "<h5>".$thisresult['time']."<span>".$thisresult['count']."</span></h5>";
$counter = $counter+$thisresult['count'];
}


echo "<h5>Total <span>".$counter."</span></h5>";
?>

                </div>
            </div>
        </div>
    </div>
</div>
<?php include('../footer.php'); ?>
<?php include('../include/scripts.php'); ?>
<script type="text/javascript">
$(document).ready( function(){

});
</script>

<style>

.single-picnic-column h4 {
    background: #2a3042;
    color: #fff;
    padding: 5px 10px;
    font-size: 17px;
}

.single-picnic-column h5 {
    background: #f8f8fb;
    color: #242323;
    padding: 5px 10px;
    text-transform:capitalize;
    font-size: 14px;
}
.single-picnic-column h5 span{
    float:right;
}

</style>

</body>
</html>