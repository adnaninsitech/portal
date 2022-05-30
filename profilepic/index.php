
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="profilepic/croppie/croppie.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="profilepic/croppie/croppie.css">
<link rel="stylesheet" href="profilepic/style.css">
<script type="text/javascript" src="profilepic/upload.js"></script>

<!-- <a href="javascript:;" class="close-ppbox"><i class="mdi mdi-close"></i></a> -->
<div class="container" style="padding-top:40px; max-width:800px;">
		  	<div class="row">
	  		<div class="col-md-6 text-center">
				<div id="upload-image"></div>
	  		</div>
	  		<div class="col-md-3">
				<strong>Select Image:</strong>
				<br/>
				<input type="file" id="images">
				<br/>
				<button class="btn btn-success cropped_image" rel="<?php echo $globaluserid; ?>">Upload Image</button>
	  		
				<div class="crop_preview">
				<div id="upload-image-i"></div>
	  		</div>
		
	  </div>
	</div>	
	<br>
</div>
<?php include('footer.php');?>