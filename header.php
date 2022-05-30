<?php session_start(); ?>

<?php if (isset($_SESSION['sessionkey'])) {
include('include/session.php');
 include('include/functions.php');
 include('include/brandfunctions.php');
} else {
global $siteurl;

//echo 'aa';
$siteurl =  "https://" . $_SERVER['SERVER_NAME']; 
?>
<meta http-equiv="refresh"  content="0; url=http://insitechprojects.com/portal/login/">
<?php die();
//header("location: ".$siteurl."/crm"); /// your code here

    }

global $url;
$url =  "http://insitechprojects.com/portal";

 ?>
<!DOCTYPE html>
<html lang="en">

    <head>
    <base href="http://insitechprojects.com/portal/">

        <meta charset="utf-8" />
<title>Insitech | Attendance Management System</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- App favicon -->
<link rel="shortcut icon" href="assets/images/favicon.ico">
<!-- Bootstrap Css -->
<link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
<!-- Icons Css -->
<link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
<!-- App Css-->
<link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
<link href="assets/css/common.css?v=<?php echo time(); ?>" id="app-style" rel="stylesheet" type="text/css" />
<link href="assets/css/software.css?v=<?php echo time(); ?>" id="app-style" rel="stylesheet" type="text/css" />
<?php if($globaluserid=='326716304839179062' || $globaluserid == '432577545312479865' || $globaluserid=='648916304840661853' || 1==1){ ?>
<link href="assets/css/v2.css?v=<?php echo time(); ?>" id="app-style" rel="stylesheet" type="text/css" />
<?php } ?>
<style>

.get-vaccinated {
    background: #d80025;
    color: #fff;
    padding: 20px;
    position: absolute;
    top: 0;
    z-index: 9999;
    height: 100%;
    display:flex;
    opacity:0.95;
    align-content: stretch;
    justify-content: center;
    align-items: center;
}

.time-in-out {
    position: relative;
}
    </style>
</head>
<body data-sidebar="dark">

<?php $globalUserDetails = getUserDetails($globaluserid);
?>
<!-- Begin page -->
<div id="layout-wrapper">

            <header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
            <a href="../portal" class="logo logo-dark">
                                    <span class="logo-lg">
                        <img src="assets/images/logo-light.png" alt="" height="29">
                    </span>
                </a>

                <a href="../portal"  class="logo logo-light">
                    
                    <span class="logo-lg">
                        <img src="assets/images/logo-light.png" alt="" height="29">
                    </span>
                </a>
            </div>

            <!-- <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button> -->

            <?php if(isSuperAdmin($globaluserid)){  ?>
           <form class="app-search d-none d-lg-block">
                <div class="position-relative">
                    <input type="text" class="form-control" id="thesearchbox" placeholder="Search...">
                    <span class="bx bx-search-alt"></span>
                </div>
            </form>
            <?php } ?>

            
        </div>

        <div class="d-flex">

            <div class="dropdown d-inline-block d-lg-none ms-2">
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="mdi mdi-magnify"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                    aria-labelledby="page-header-search-dropdown">
        
                    <form class="p-3">
                        <div class="form-group m-0">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

          

           
            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user" src="<?php echo getUserProfilePicture($globaluserid); ?>"
                        alt="Header Avatar">
                    <span class="d-none d-xl-inline-block ms-1" key="t-henry"><?php echo $globalUserDetails['name']; ?>  </span>
                </button>
              </div>
          
<?php /* 
         <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-notifications-dropdown"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bx bx-bell bx-tada"></i>
                    <span class="badge bg-danger rounded-pill">3</span>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                    aria-labelledby="page-header-notifications-dropdown">
                    <div class="p-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="m-0" key="t-notifications"> Notifications </h6>
                            </div>
                            <div class="col-auto">
                                <a href="#!" class="small" key="t-view-all"> Files.View All </a>
                            </div>
                        </div>
                    </div>
                    <div data-simplebar style="max-height: 230px;">
                        <a href="" class="text-reset notification-item">
                            <div class="d-flex">
                                <div class="avatar-xs me-3">
                                    <span class="avatar-title bg-primary rounded-circle font-size-16">
                                        <i class="bx bx-cart"></i>
                                    </span>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mt-0 mb-1" key="t-your-order">Your order is placed</h6>
                                    <div class="font-size-12 text-muted">
                                        <p class="mb-1" key="t-grammer">If several languages coalesce the grammar</p>
                                        <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span key="t-min-ago">3 min ago</span></p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href="" class="text-reset notification-item">
                            <div class="d-flex">
                                <img src="assets/images/users/avatar-3.jpg"
                                    class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                <div class="flex-grow-1">
                                    <h6 class="mt-0 mb-1">James Lemire</h6>
                                    <div class="font-size-12 text-muted">
                                        <p class="mb-1" key="t-simplified">It will seem like simplified English.</p>
                                        <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span key="t-hours-ago">1 hours ago</span></p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href="" class="text-reset notification-item">
                            <div class="d-flex">
                                <div class="avatar-xs me-3">
                                    <span class="avatar-title bg-success rounded-circle font-size-16">
                                        <i class="bx bx-badge-check"></i>
                                    </span>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mt-0 mb-1" key="t-shipped">Your item is shipped</h6>
                                    <div class="font-size-12 text-muted">
                                        <p class="mb-1" key="t-grammer">If several languages coalesce the grammar</p>
                                        <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span key="t-min-ago">3 min ago</span></p>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <a href="" class="text-reset notification-item">
                            <div class="d-flex">
                                <img src="assets/images/users/avatar-4.jpg"
                                    class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                <div class="flex-grow-1">
                                    <h6 class="mt-0 mb-1">Salena Layfield</h6>
                                    <div class="font-size-12 text-muted">
                                        <p class="mb-1" key="t-occidental">As a skeptical Cambridge friend of mine occidental.</p>
                                        <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span key="t-hours-ago">1 hours ago</span></p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="p-2 border-top d-grid">
                        <a class="btn btn-sm btn-link font-size-14 text-center" href="javascript:void(0)">
                            <i class="mdi mdi-arrow-right-circle me-1"></i> <span key="t-view-more">View More..</span> 
                        </a>
                    </div>
                </div>
            </div>  */ ?>
            <div class="d-inline-block">
                <a href="logout" target="_self" style="display:block; font-size:22px; padding:20px 20px 0 20px">
                    <i class="bx bx-cog  bx-power-off "></i>
</a>
           </div>
    </div>
</header>
<!-- ========== Left Sidebar Start ========== -->
<?php $getUserOnlineStatus = getUserOnlineStatus($globaluserid);
if($getUserOnlineStatus=="0"){
    $UserOnlineClass = "userisoffline";
    $userOnlineLabel = "Offline";
    $laststatus = "Last Time Out: ".date("h:i A", getLastTimeOut($globaluserid));
} else {
    $UserOnlineClass = "userisonline";
    $userOnlineLabel = "Online";
    $laststatus = "Last Time In: ".date("h:i A", getLastTimeIn($globaluserid));

}
?>

<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
          
          <div class="time-in-out">

<?php 
    
    
    $vaccineAlert =covidAlert($globaluserid);
    if($vaccineAlert == "Completed"){ } else {
 /*   ?>

    <div class="get-vaccinated">Time-In has been disabled for unvaccinated users.</div>
    <?php */ }  ?>
          
              <div class="row">
               
                  <div class="col-md-3">
          <div  class="cube-switch <?php if($getUserOnlineStatus=="1") echo 'active'; ?>">
        <span class="switch">
            <span class="switch-state off">Click <BR> to <BR> Timeout</span>
            <span class="switch-state on">Click <BR> to <BR> Timein</span>
        </span>
</div>
</div>

<div class="col-md-9">
<div class="currentstatus">
<h5>Current Status: <BR> <span class="<?php echo $UserOnlineClass; ?>" id="usercurrentstatus"><?php 
 ?><?php echo $userOnlineLabel; ?></span></h5>
<h6 class="timestatus"><?php echo $laststatus; ?></h6>
</div></div>

</div>


          </div>
          
            <ul class="metismenu list-unstyled" id="side-menu">
            
                <li>
                    <a href="../portal" class="waves-effect">
                        <i class="bx bx-home-circle"></i>
                        <span key="t-dashboards">Dashboard</span>
                    </a>
                
                </li>

                <?php if($globalUserDetails['usertype'] == "5" || $globalUserDetails['usertype'] == "3" || $globalUserDetails['usertype'] == "2" || isSuperAdmin($globaluserid)){ ?>

                    <li>
                        
                        <a href="javascript:;" class="drop-btn" rel="1"><i class="bx bx-layout"></i>Attendance</a>
                        <div class="dropdown" id="dropdown1">
                            <ul>
                               
                                <li><a href="../portal/attendance"><i class="bx bx-layout"></i>Attendance</a></li>
                          

                                <li><a href="../portal/attendance/team.php"><i class="bx bx-layout"></i>Team Members</a></li>

                                <?php if($globalUserDetails['departmentkey'] != "326588548754565784"){ ?> 
                                <li><a href="../portal/attendance/department.php"><i class="bx bx-layout"></i>Department</a></li>

                            <?php } ?>
                            </ul>
                        </div>

                    </li>
          
                <?php } else{ ?>
                <li>
                <a href="../portal/attendance" class="waves-effect">
                        <i class="bx bx-layout"></i>
                        <span key="t-layouts">Attendance</span>
                    </a>
                </li>
                <?php } ?>

                <?php if( $globalUserDetails['usertype'] == "2" || isSuperAdmin($globaluserid)  || $globaluserid == "329616306678943624"){ ?>

                    <li>
                <a href="../portal/shift" class="waves-effect">
                        <i class="bx bx-layout"></i>
                        <span key="t-layouts">Mark Shift</span>
                    </a>
                </li>

                <?php } ?>
                <li>
                    <a href="http://mail.trc.com/Mondo/lang/sys/login.aspx" target="_blank"  class="waves-effect">
                        <i class="bx bx-envelope"></i>
                        <span key="t-ecommerce"><span>My Mail</span></a>
                </li>

                <li>
                <a href="../portal/department"  data-toggle="tooltip"   class="waves-effect">
                        <i class="bx bx-layout"></i>
                        <span key="t-layouts">Departments</span>
                    </a>
                </li>
                
                <li>
                <a href="../portal/users" data-toggle="tooltip"   class="waves-effect">
                        <i class="bx bx-layout"></i>
                        <span key="t-layouts">Users</span>
                    </a>
                </li>
             
               
                <li class="comingsoon">
                  <a href="javascript: void(0);" data-toggle="tooltip" title="Coming Soon!"   class=" waves-effect">
                        <i class="bx bx-store"></i>
                        <span key="t-ecommerce"><span>Forms</span>
                    </a>
            
                </li>
                <?php if($_SESSION['sessionuser'] == "521116304857525667" || $_SESSION['sessionuser'] == "326716304839179062" ||$_SESSION['sessionuser'] == "201693481630942329"){
                    $start_time = (int)strtotime(date('d-m-Y')) - 1;
                    $end_time = $start_time + 86399;
                    $getTodaysMenu = getTodaysMenu($start_time,$end_time);
                    $menu_data = $getTodaysMenu->fetch_assoc();
                    $food_name = ($getTodaysMenu->num_rows>0)?$menu_data['name']:'Sorry nothing is in menu today';
                    $today_day = ($menu_data["schedule_date"] != NULL)?date('l',$menu_data["schedule_date"]):'-';
                    // $food_name = 'Sorry nothing is in menu today';
                    $lunch =    $food_name." (".$today_day.")";
                    ?>
                <li class="">
                  <a href="foodmanagement" data-toggle="tooltip" title="<?= $lunch;?>"   class=" waves-effect">
                        <i class="bx bx-store"></i>
                        <span key="t-ecommerce"><span>Food Management</span>
                    </a>
            
                </li>
                <?php } ?>

               <?php if( $globalUserDetails['usertype'] == "2" || isSuperAdmin($globaluserid)){ ?>


                     <li>
                        
                        <a href="javascript:;" class="drop-btn" rel="2"><i class="bx bx-layout"></i>Discrepancy</a>
                        <div class="dropdown" id="dropdown2">
                            <ul>
                               

                                <li><a href="../portal/discrepancy/department.php"><i class="bx bx-layout"></i>User Discrepancy</a></li>

                              
                            </ul>
                        </div>

                    </li>

                 <?php } ?>
                  <?php if($globalUserDetails['usertype'] == "5" || isSuperAdmin($globaluserid)){ ?>

                <li>
                <a href="../portal/report" class="waves-effect">
                        <i class="bx bx-layout"></i>
                        <span key="t-layouts">Attendance Report</span>
                    </a>
                </li>
                <?php } ?>




                 <?php if(isSuperAdmin($globaluserid)){ ?>   
                <li class="highlight">
                  <a href="covid/records.php"   class="waves-effect">
                        <i class="bx bx-chart"></i>
                        <span key="t-ecommerce"><span>Vaccination Records</span>
                    </a>
            
                </li>
<?php } ?>

 <?php if(isSuperAdmin($globaluserid) || $globaluserid == "329616306678943624"){ ?>   
                <li>
                  <a href="users/userdirectory.php"   class="waves-effect">
                        <i class="bx bx-chart"></i>
                        <span key="t-ecommerce"><span>User Directory</span>
                    </a>
            
                </li>
<?php } ?>
                


            

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
            