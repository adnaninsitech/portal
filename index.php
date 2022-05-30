<?php include('header.php'); ?>
	<div class="container homepage">
		<!-- start page title -->
		<!-- end page title -->

		<div class="row">
			<div class="col-xl-3">
				<div class="card overflow-hidden">
					<div class="bg-primary_ bg-soft_ text-center">
						<div class="user-card">
							<div class="theprofilepicbox">
								<a href="javascript:;" id="changeprofilepic"> <i class="fa fa-camera fa-1x"></i></a> <img src="<?php echo getUserProfilePicture($globaluserid); ?>" alt="" class="img-thumbnail rounded-circle_ " style=""> </div>
							<h5>Hello, <?php echo showUserName($globaluserid); ?></h5>
							<h6><?php echo $globalUserDetails['designation']; ?></h6>
							<div class="theicons"> <a href="javascript:;" data-toggle="tooltip" title="Coming Soon!"><i class="fa fa-dollar-sign fa-lg"></i></a> <a href="javascript:;" data-toggle="tooltip" title="Coming Soon!"><i class="fa fa-users fa-lg"></i></a> <a href="javascript:;" data-toggle="tooltip" title="Coming Soon!"><i class="fa fa-clock"></i></a> <a href="javascript:;" data-toggle="tooltip" title="Coming Soon!"><i class="fa fa-id-card fa-lg"></i></a> <a href="javascript:;" data-toggle="tooltip" title="Coming Soon!"><i class="fa fa-scroll fa-lg"></i></a> </div>
						</div>
					</div>
				</div>
			</div>
		
			
			<div class="col-xl-6">
				<div class="row">
					<div class="col-md-12">
						<div class="card leftbg mini-stats-wid noticeboard">
							<div class="card-body">
								<div class="row notice-desc">
									<div class="notice-icon"> <img src="https://cdn.dribbble.com/users/2330950/screenshots/6303019/98_4x.jpg" style="width:100%;"> </div>
									<div class="col-md-9">
										<h4 class="card-title mb-4">Notice Board</h4>
										<?php
										$getAllNotices = getAllNotices(); 
										foreach( $getAllNotices as $thisnotice){
										?>
										<div class="noticeboard-desc">
										<div>	<?php echo $thisnotice['noticetext']; ?></div>
										<div>	<?php echo $thisnotice['noticetext']; ?></div>
										</div>
										<?php } ?>
									</div>
									<div class="col-md-3"> </div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-3 rightbg theclock card">
				<div class="card-body">
				<div id="myclock"></div> 
				</div>
			</div>

			
		</div>
		<!-- end row -->


		<div class="row">
			 
			<div class="col-lg-4">
				<div class="card">
					<div class="card-body">
						<h4 class="card-title mb-4">Personal Details</h4>
						<div class="info-card">
							<div class="single-row">
								<label>Full Name:</label> <span><?php echo $globalUserDetails['name']; ?></span></div>
							<div class="single-row">
								<label>Designation:</label> <span><?php echo $globalUserDetails['designation']; ?></span></div>
							<div class="single-row">
								<label>Department:</label> <span><?php echo getDepartmentNameByKey($globalUserDetails['departmentkey']); ?></span></div>
							<div class="single-row">
								<label>Reporting To:</label> <span><?php $ra = $globalUserDetails['reportingauthority']; if($ra=='0'){ echo "N/A"; } else {
echo getusernamebykey($ra); } ?></span></div>
							<div class="single-row">
								<label>Date of Joining:</label> <span><?php echo date("jS M Y", $globalUserDetails['dateofjoining']); ?></span></div>
							<div class="single-row">
								<label>Employee Type:</label> <span><?php echo $globalUserDetails['employeetype']; ?></span></div>
							<div class="single-row d-none">
								<label>Email:</label> <span><a href="http://mail.trc.com/Mondo/lang/sys/login.aspx" target="_blank">Click Here</a></span></div>
							
							<?php /*  <div class="single-row"><label>Current Salary:</label> <span class="showhide 
							hideme"><strong>********</strong><em>PKR <?php echo number_format($globalUserDetails['currentsalary'], 0, ',', ','); ?>
								</em><b class="showhide-trigger">Show/Hide</b></span>
						</div> */ ?> </div>
				</div>
			</div>
		</div>
		<div class="col-lg-4">
			<div class="card">
				<div class="card-body pb-0">
<h4 class="card-title mb-4">Attendance</h4>
<?php 
if($globaluserid=='260978141632291790' || $globaluserid=='326716304839179062'){ ?>

<div class="attendance-report">
	<table class="datatable">
		<thead>
		<tr>
			<th>Date</th>
			<th>Hours</th>
			<th>Status</th>
</tr>
</thead>
<tbody>
<?php	$getattendenceofthismonth = getattendenceofthismonth($globaluserid);
foreach($getattendenceofthismonth as $thisday){
if($thisday['datetoday'] == dateToday()){ } else {
$diff = intVal($thisday['timeout'])-intVal($thisday['timein']);
if($diff<0){
$thediff = "Forgot to timeout";
} else {
$thediff = gmdate('H:i',$diff);
}

if($diff>28800){
$status = 'normal';
$data = "<span class='daytype day-".$status."'><i class='mdi mdi-check'></i></span>";
} else if($diff<28800 && $diff>18000){
$status = "halfday";
$data = "<span class='daytype day-".$status."'><i class='mdi mdi-alert'></i></span>";
} else {
$status= "absent";
$data = "<span class='daytype day-".$status."'><i class='mdi mdi-alert'></i></span>";
}
echo "<tr><td>";
	echo date('jS M', $thisday['datetoday']);
	echo "</td><td>";
	echo  $thediff;
		echo "</td><td>";
		echo $data;
echo "</td></tr>";
}		
}

?></table> </div><?php } ?>


                    <?php if(isSuperAdmin($globaluserid)){ ?>
                        
                        <div id="attendance-chart" class="apex-charts" dir="ltr"></div>
						<a href="attendance" class="btn pull-right theattendance-link btn-primary">View Attendance</a>
					
                        <?php } else { ?>
                    <div id="overview-chart" class="apex-charts" dir="ltr"></div> <?php } ?>
				</div>
			</div>
		</div>
		<div class="col-lg-4">
			<div class="card team-members-widget">
				<div class="card-body">
					<h4 class="card-title mb-4">Team Members</h4>
					<div class="table-responsive home-team-members">
						<table class="table align-middle table-nowrap">
							<tbody>
								<?php $getAllUsers =getAllUsersByDept($globalUserDetails['departmentkey']); 
                              
                                    foreach($getAllUsers as $thisuser){  ?>
									<tr>
										<td style="width: 50px;"><img src="<?php echo getUserProfilePicture($thisuser['userkey']); ?>" class="rounded-circle avatar-xs" alt=""></td>
										<td>
											<h5 class="font-size-14 m-0"><a href="javascript: void(0);" class="text-dark"><?php  showUserName($thisuser['userkey']); ?></a></h5>
											<h6><?php echo $thisuser['designation']; ?></h6></td>
										<td>
											<div class="user-icons"> <a href="javascript: void(0);"><i class="fa fa-phone"></i></a> <a href="mailto:<?php echo $thisuser['email']; ?>"><i class="fa fa-envelope"></i></a> </div>
										</td>
									</tr>
									<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

      




	</div>
	<!-- end row -->
    <?php if(isSuperAdmin($globaluserid)){ ?>
<div class="row">
		<div class="col-lg-4">
			<?php $getOnlineUsers =getOnlineUsers(); ?><div class="card team-members-widget">
				<div class="card-body">
					<h4 class="card-title mb-4">Online Users (<?php echo $getOnlineUsers->num_rows; ?>)</h4>
					<div class="table-responsive home-team-members">
						<table class="table align-middle table-nowrap">
							<tbody>
								<?php 
                                               foreach($getOnlineUsers as $thisuser){

                                               	if($thisuser['userkey'] != NUll){
                                               ?>
									<tr>
										<td style="width: 50px;"><img src="<?php echo getUserProfilePicture($thisuser['userkey']); ?>" class="rounded-circle avatar-xs" alt=""></td>
										<td>
											<h5 class="font-size-14 m-0"><a href="javascript: void(0);" class="text-dark"><?php  showUserName($thisuser['userkey']); ?></a></h5>
											<h6><?php echo getuserinfobykey($thisuser['userkey'], 'designation'); ?></h6></td>
										<td>
											<div class="user-icons"> <a href="javascript: void(0);"><i class="fa fa-phone"></i></a> <a href="mailto:<?php echo getuserinfobykey($thisuser['userkey'], 'email'); ?>"><i class="fa fa-envelope"></i></a> </div>
										</td>
									</tr>
									<?php } } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

		<?php }  if(isSuperAdmin($globaluserid)){ ?>

	<?php ?>	 	<div class="col-lg-4">
				<?php $getDiscrepancy =getUserDiscrepancy($globaluserid); ?>

				<div class="card">
					<div class="card-body">
						<h4 class="card-title mb-4">Leaves</h4>
						<div class="info-card">

							<div class="single-row">
								<label>Total Leaves:</label> <span style="text-align: right;">15</span>
							</div>

							<div class="single-row">
								<label>Avail Leaves:</label> <span style="text-align: right;"><?php echo $getDiscrepancy; ?></span>
							</div>

							<div class="single-row">
								<label>Remaining Leaves:</label> <span style="text-align: right;"><?php echo 15 - $getDiscrepancy ; ?></span>
							</div>

							</div>
						</div>
					</div>
					</div>

<?php } ?>

<div class="col-lg-4">

					<?php $getBrands = getUserBrands($globaluserid);

				$userHashKey = getUserHashKey($globaluserid); 
				//$userHashKey = "zxYwACy7XeOkfvOYtbDXgYXATUMoRZzZ" ?>

				<div class="card">
					<div class="card-body">
						<h4 class="card-title mb-4" >Brands </h4>
						<div class="info-card">
							<?php foreach($getBrands as $brand){ ?>

						<form action="<?php echo $brand['brand_url']; ?>/login-port" class="brandlogin" target="_blank" method="GET" >
							<input type="hidden" name="user_hash" value="<?php echo $userHashKey; ?>">
							<input type="hidden" name="user_ip" value="http://192.168.10.11:85/">
								<div class="single-row">
								<h6 style="display: inline-block;"><?php echo $brand['brand_name']; ?></h6>
								<input type="submit" value="Login" >
								</div>
						</form>  
								<?php } ?>

							</div>
						</div>
					</div>
</div>
					
				
	
				
				

  <!--         <?php if(isSuperAdmin($globaluserid)){ ?>	
				<div class="col-lg-4">
					<div class="card">
					  <div class="card-body">
						<h4 class="card-title mb-4" >Today's menu</h4>
						<div class="info-card">
							
                         <div class="row">
                         	<div class="col-md-6">
                 	 		<h4><?php echo gettodayfood(); ?></h4>
                 	 	    </div>
                 	 	    <div class="col-md-6">
                 	 		<img src="backend/<?php echo foodimage(); ?>" style=width="100" height="100">
                 	 	    </div>
                 	 	</div>

						</div>
						</div>
					</div>
					</div>
			
					

				<?php } ?>-->
					
				

                




	

</div>



	</div>
	<!-- container -->
	<div class="profilepic-popup"></div>
	<?php include('footer.php'); ?>
		<?php include('include/scripts.php'); ?>
			<script src="assets/libs/metismenu/metisMenu.min.js"></script>
			<script src="assets/libs/simplebar/simplebar.min.js"></script>
			<script src="assets/libs/node-waves/waves.min.js"></script>
			<!-- apexcharts -->
			<script src="assets/libs/apexcharts/apexcharts.min.js"></script>
			<!-- dashboard init -->
			<script src="assets/js/pages/dashboard.init.js"></script>
			<script src="assets/libs/slider/slick.min.js"></script>
			<link href="assets/libs/slider/slick.css" rel="stylesheet">
			<link href="assets/libs/slider/slick-theme.css" rel="stylesheet">
			<script language="javascript" type="text/javascript" src="https://www.jqueryscript.net/demo/Customizable-Analog-Alarm-Clock-with-jQuery-Canvas-thooClock/js/jquery.thooClock.js"></script>
			<script language="javascript">
			var intVal, myclock;
			$(window).resize(function() {
				window.location.reload()
			});
			$(document).ready(function() {

				$('.close-ppbox, .pp-overlay').click(function() {
					$('.pp-overlay').hide();
					$('.profilepic-popup').empty();
					$('.profilepic-popup').hide();
				});
				$('#changeprofilepic').click(function() {
					$('.pp-overlay').show();
					$.ajax({
						type: "POST",
						url: 'include/ajax/changeprofilepic.php',
						data: {
							userkey: '<?php echo $globaluserid; ?>'
						},
						success: function(data) {
							$('.profilepic-popup').fadeIn();
							$('.profilepic-popup').html(data);
						}
					});
				});
				$('.popup-overlay, .close-popup').click(function() {
					$('.showpopup').remove();
					$('.popup-overlay').remove();
					$.ajax({
						type: "POST",
						url: 'include/ajax/closepopup.php',
						data: {
							userkey: '<?php echo $globaluserid; ?>'
						},
						success: function(data) {}
					});
				});
				$('.showhide-trigger').click(function() {
					$('.showhide').toggleClass('hideme');
					$('.showhide').toggleClass('showme');
				});
				var audioElement = new Audio("");
				//clock plugin constructor
				$('#myclock').thooClock({
					size: 160,
					secondHandColor: '#d80025',
					minuteHandColor: '#1c5c5f',
					hourHandColor: '#1c5c5f',
					onAlarm: function() {
						//all that happens onAlarm
						$('#alarm1').show();
						alarmBackground(0);
						//audio element just for alarm sound
						document.body.appendChild(audioElement);
						var canPlayType = audioElement.canPlayType("audio/ogg");
						if(canPlayType.match(/maybe|probably/i)) {
							audioElement.src = 'alarm.ogg';
						} else {
							audioElement.src = 'alarm.mp3';
						}
						// erst abspielen wenn genug vom mp3 geladen wurde
						audioElement.addEventListener('canplay', function() {
							audioElement.loop = true;
							audioElement.play();
						}, false);
					},
					showNumerals: true,
					brandText: 'TRC',
					brandText2: 'Tech Resource Company',
					onEverySecond: function() {
						//callback that should be fired every second
					},
					//alarmTime:'15:10',
					offAlarm: function() {
						$('#alarm1').hide();
						audioElement.pause();
						clearTimeout(intVal);
						$('body').css('background-color', '#FCFCFC');
					}
				});
			});
			$('#turnOffAlarm').click(function() {
				$.fn.thooClock.clearAlarm();
			});
			$('#set').click(function() {
				var inp = $('#altime').val();
				$.fn.thooClock.setAlarm(inp);
			});

			function alarmBackground(y) {
				var color;
				if(y === 1) {
					color = '#CC0000';
					y = 0;
				} else {
					color = '#FCFCFC';
					y += 1;
				}
				$('body').css('background-color', color);
				intVal = setTimeout(function() {
					alarmBackground(y);
				}, 100);
			}
			var options = {
					chart: {
						height: 175,
						type: "line",
						toolbar: {
							show: !1
						}
					},
					plotOptions: {
						bar: {
							columnWidth: "18%",
							endingShape: "rounded"
						}
					},
					dataLabels: {
						enabled: !1
					},
					series: [{
						name: "Hours",
						data: [<?php getlast7dayshours($globaluserid); ?>]
					}],
					grid: {
						yaxis: {
							lines: {
								show: !1
							}
						}
					},
					yaxis: {
						title: {
							text: "Number of hours"
						},
				
	  floating: false, tickAmount:4
					},
					xaxis: {
						labels: {
							show: false,
							rotate: -90
						},
						categories: ["1", "2", "3", "4", "5", "6", "7"],
						title: {
							text: "Last 7 Days"
						}
					},
					colors: ["#556ee6"]
				},
				chart = new ApexCharts(document.querySelector("#overview-chart"), options);
			chart.render();


<?php if(isSuperAdmin($globaluserid)){ 

$offlineusers = intVal(totalStrength())-intVal(getPresentToday()->num_rows); ?>

            var options = {
          series: [<?php echo $offlineusers; ?>, <?php echo $getOnlineUsers->num_rows; ?>],
          chart: {
          width: 295,
          type: 'pie',
        },
        labels: ['Absent', 'Present'],   theme: {
        
        },
        fill: {
  colors: ['#9c2929', '#1c5c5f']
},
legend: {
      show: true,
	  markers: {
		fillColors: ['#9c2929', '#1c5c5f'],
          useSeriesColors: true
      },
},
        responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              width: 450
            },
            legend: {
              position: 'bottom'
            }
          }
        }]
        };

        var chart = new ApexCharts(document.querySelector("#attendance-chart"), options);
        chart.render();
		<?php  } ?>


		$('.noticeboard-desc').slick({
// 			dots: false,
//   infinite: false,
//   speed: 300,
//   slidesToShow: 1,
//   slidesToScroll: 1


		});

			</script>
			<?php 
$showpopup = getUserMeta($globaluserid, 'showpopup');
if($showpopup==false){
?>
				<div class="showpopup"><a href="javascript:;" class="close-popup"><i class="mdi mdi-close"></i></a> <img src="assets/images/popup-bg.jpg">
					<div class="popup-desc">
						<h1>Say Hello to our new Portal!</h1>
						<div class="popup-content">
							<p>We have got a new look, full of features and customized solutions to meet all of your self-service needs.</p>
							<ul>
								<li> Timely attendance (clock-in and clock-out)</li>
								<li> Review your daily attendance</li>
								<li> File discrepancies</li>
								<li> Organizational Notices</li>
								<li> And much more...</li>
						</div>
					</div>
				</div>
				<div class="popup-overlay"></div>
				<?php
    
    
} else {
// echo "noshow";
}
?>



					<div class="pp-overlay"></div>

<?php if(isSuperAdmin($globaluserid)){ ?>
	
	<style>
.slick-arrow {
    position: absolute;
    font-size:12px;
    font-weight:600;
    top: -50px;
    color:#1c5c5f;
    background:transparent;
    border:0;
    padding:5px 0px;
    left: 180px;
}

.slick-arrow.slick-prev{
    top: -50px;
    left: 120px !important;
}

	</style>
	<?php } else { ?>
<style>
.slick-arrow{
	display:none;
}



</style> <?php } ?>

<style>

	
/* Temporary vaccination CSS Starts Here  */
.vaccinationbox *{
	color: #000;
}
.vaccinationbox p span, .vaccinationbox p u{
	color :#d80025;
}
.vaccinationbox {
    box-shadow: 0 0 5px #cbcbcb;
    position: relative;
    border-radius: 4px;
	overflow:hidden;
    top: 0;
    left: 0;
	background:  #bfe1fe;  width: 100%;
    height: auto;
	margin:0 0 40px 0;
    background-size: auto 100%;
    padding: 5px 40px 15px 20px;
    color: #000;
    text-align: center;
}
.vaccinationbox:before{

	background:url('https://image.freepik.com/free-vector/flat-hand-drawn-coronavirus-vaccine-background_52683-56307.jpg');
content:"";
width:100%;
height:100%;
opacity:0.1;
position:absolute;
z-index:0;
}

.vaccinationbox p {
    font-size: 13px;
	position:relative;
	z-index:4;
    text-align: left;
    color: #000;
    line-height: 17px;
    margin: 10px 40px 10px 0;
    font-weight: 600;
}
.vaccinationbox p strong{
	color:#d80025;
}
.vaccinationbox h4{
    text-align:left;
    font-weight: 800;
    color: #d80025;
    margin:20px 0 4px 0;
    font-size: 28px;
}
.vaccinationbox h6 span {
    background: #d80025;
    color: #fff;
    padding: 0 10px;
}
a.covid-form:hover {
    background: #fff;
    color: #269d5f;
    border: 2px solid;
}

a.covid-form {
    display: inline-block;
    background: #269d5f;
    border: 2px solid #269d5f;
    color: #fff;
    float: left;
    font-weight: 600;
    padding: 7px 20px;
    border-radius: 3px;
}
.vaccinationbox h6 {
    font-weight: 600;
    color: #d80025;
    line-height: 17px;
    width: 100%;
    margin: 0;
    font-size: 12px;
    margin: 0;
    bottom: -22px;
    text-align: left;
    position: absolute;
    left: 20px;
    padding: 0 0px;
}
/* Temporary Vaccination CSS Ends here */
</style>
<?php //include('include/picnic.php'); ?>
				</body>

					</html>
