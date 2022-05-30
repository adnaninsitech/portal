<?php include('header.php'); ?>

<body class="innerbody">
<div class="main-container">
<?php if(isset($_GET['unit'])){
echo "show unit data";

}  else {
include('allunits.php'); 
}?>
<?php include('footer.php'); ?> 