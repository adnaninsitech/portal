<?php session_start(); ?>
<!DOCTYPE html>
<html lang="zxx" >
<?php
  if (isset($_SESSION['sessionkey'])) {
global $siteurl;
		$siteurl =  "https://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']; 
		?>
		 <meta http-equiv="refresh" content="0;URL='../'" />    
		
		<?php
 // header("location: ".$siteurl."dashboard"); /// your code here
    } else { ?>
     <head>
  <!-- Basic Page Needs
  ================================================== -->
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Mobile Specific Metas
  ================================================== -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <!-- For Search Engine Meta Data  -->
  <meta name="description" content="" />
  <meta name="keywords" content="" />
  <meta name="author" content="" />
	
  <title>Insitech</title>

  <!-- Favicon -->
  <link rel="shortcut icon" type="image/icon" href="favicon-16x16.png"/>
   
  <!-- Main structure css file -->
  <link  rel="stylesheet" href="style.css">
  
  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if IE]>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
 
  </head>
  
  <style>
      .brand-logo img {
    position: relative;
    left: -38px;
}
  </style>
  
 

    <body style="background-image:url('<?php echo rand(1,7) ?>.jpg')"> <!-- Start Preloader -->
    <div id="preload-block">
      <div class="square-block"></div>
    </div>
    <!-- Preloader End -->
    
    <div class="container-fluid">
      <div class="row">
        <div class="authfy-container col-xs-12 col-sm-10 col-md-8 col-lg-6 col-sm-offset-1 col-md-offset-2 col-lg-offset-3">
          <div class="col-sm-5 authfy-panel-left" style="background:#011947;">
            <div class="brand-col">
              <div class="headline">
                <!-- brand-logo start -->
                <div class="brand-logo">
                  <img src="brand-logo-white.png" width="200" alt="brand-logo">
                </div><!-- ./brand-logo -->
             
                <!-- social login buttons start -->
                <div class="row social-buttons">
                  <div class="col-xs-4 col-sm-4 col-md-12">
                    <a href="https://insitech.ae" target="_blank" class="btn btn-block"  style="background:#008080;">
                    <i class="fa fa-link"></i>  <span class="hidden-xs hidden-sm">insitech.ae</span>
                    </a>
                  </div>
                  <div class="col-xs-4 col-sm-4 col-md-12">
                    <a href="javascript:;" class="btn btn-block"  style="background:#008080;">
                    <i class="fa fa-list-alt"></i>    <span class="hidden-xs hidden-sm">Policies & Procedures</span>
                    </a>
                  </div>
                  <div class="col-xs-4 col-sm-4 col-md-12">
                    <a href="javascript:;" class="btn btn-block" style="background:#008080;">
                      <i class="fa fa-exclamation-triangle"></i> <span class="hidden-xs hidden-sm">Forget Password?</span>
                    </a>
                  </div>
                </div><!-- ./social-buttons -->
              </div>
            </div>
          </div>
          <div class="col-sm-7 authfy-panel-right">
            <!-- authfy-login start -->
            <div class="authfy-login">
              <!-- panel-login start -->
              <div class="authfy-panel panel-login text-center active">
                <div class="authfy-heading">
                  <h3 class="auth-title">Login to your account</h3>
                  <p>Use your official email address to sign in</p>
                </div>
                <div class="row">
                  <div class="col-xs-12 col-sm-12">
                    <form name="loginForm" id="portallogin" autocomplete="off" class="loginForm" action="http://insitechprojects.com/portal" method="POST">
                      <div class="form-group">
                        <input type="text" class="form-control email" name="username" placeholder="Email address" required>
                        <span class="fixed-overlay">@insitech.com</span>
                      </div>
                      <div class="form-group">
                        <div class="pwdMask">
                          <input type="password" class="form-control password" name="password" placeholder="Password" required>
                          <span class="fa fa-eye-slash pwd-toggle"></span>
                        </div>
                      </div>
                  
                      <div class="form-group">
                        <button class="btn btn-lg btn-primary btn-block" type="submit" style="background:#008080; border:0;">Continue</button>
                      </div>
                      <div id="error"></div> </form>
                  </div>
                </div>
              </div> <!-- ./panel-login -->
              <div class="authfy-panel panel-forgot">
                <div class="row">
                  <div class="col-xs-12 col-sm-12">
                    <div class="authfy-heading">
                      <h3 class="auth-title">Recover your password</h3>
                      <p>Fill in your e-mail address below and we will send you an email with further instructions.</p>
                    </div>
                    <form name="forgetForm" class="forgetForm" action="#" method="POST">
                      <div class="form-group">
                        <input type="email" class="form-control" name="username" placeholder="Email address">
                      </div>
                      <div class="form-group">
                        <button class="btn btn-lg btn-primary btn-block" type="submit">Recover your password</button>
                      </div>
                      <div class="form-group">
                        <a class="lnk-toggler" data-panel=".panel-login" href="#">Already have an account?</a>
                      </div>
                      <div class="form-group">
                        <a class="lnk-toggler" data-panel=".panel-signup" href="#">Don’t have an account?</a>
                      </div>
                  
                  </form>
                  </div>
                </div>
              </div> <!-- ./panel-forgot -->
            </div> <!-- ./authfy-login -->
          </div>
        </div>
      </div> <!-- ./row -->
    </div> <!-- ./container -->
    
    <!-- Javascript Files -->

    <!-- initialize jQuery Library -->
    <script src="jquery-2.2.4.min.js"></script>
  
    <!-- for Bootstrap js -->
    <script src="bootstrap.min.js"></script>
  
    <!-- Custom js-->
    <script src="custom.js"></script>
  
    <script type="text/javascript">
$(document).ready( function(){
$('input[name="username"]').change( function(){
var str = $(this).val();
var name = str.split("@")[0];
$('input[name="username"]').val(name);
});
});
</script>

<script>
    $('#portallogin').on('keydown', function() {
        $('#error').hide();
    });
    $('#portallogin').submit(function(e) {
    e.preventDefault();
    $('#error').html("Please Wait");
    $('#error').fadeIn();
    $('.loading, .loginLoaderOverLay').fadeIn();
        var thisname = $('input[name="username"]').val();
        var thispassword = $('input[name="password"]').val();
        $.ajax({
            type: "POST",
            url: 'login.php',
            data: {
                email: thisname,
                password: thispassword
            },
            success: function(data) {
                
                if (data == 'success') {

                  if(thispassword == "12345678"){
location.replace('../password?e=1');
                 }else{
                    location.replace('../');
                  }
       } else {
  $('#error').slideDown();
                  $('#error').html("If you are logging in for the first time, <BR> please try <strong>12345678</strong>");   
}
            }
        });
});
        
  // Place Holder Animation      
 var $inputItem = $(".js-inputWrapper");
$inputItem.length && $inputItem.each(function() {
    var $this = $(this),
        $input = $this.find(".formRow--input"),
        placeholderTxt = $input.attr("placeholder"),
        $placeholder;
    
    $input.after('<span class="placeholder">' + placeholderTxt + "</span>"),
    $input.attr("placeholder", ""),
    $placeholder = $this.find(".placeholder"),
    
    $input.val().length ? $this.addClass("active") : $this.removeClass("active"),
        
    $input.on("focusout", function() {
        $input.val().length ? $this.addClass("active") : $this.removeClass("active");
    }).on("focus", function() {
        $this.addClass("active");
    });
});       
        
        
    </script>
    <?php } ?>
  </body>	

  
</html>
