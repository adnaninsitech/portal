<?php include('header.php'); ?>

<body class="home-body">
<div class="main-container">
<header class="home-header">
<div class="home-full-stats"><h5>Total Sales</h5>
<h3>$ <span id="totalsales">79,124.00</span></h3>
<h6><i class="fa fa-arrow-up"></i>24%</h6>
</div>
<div class="today-stats">
    
    <div class="show-today thisisactive"><label>Sales Today</label>
        <h5>$4,555.00</h5>
        </div>
        <div class="show-yesterday"><label>Sales Yesterday</label>
    <h5>$2,124.00</h5>
    </div>
<a href="#" id="today-yesterday"><i class="fa fa-arrow-left"></i></a>
</div>
</header>


<section class="home-table white-bg">
    <h5 class="the-title">Unit Wise Stats</h5>
<div id="unit-stats">
    <div class="odd"><a href="unit.php?unit=1"><i class="chartbg gradient-bg" style="width:75%"></i><span>Design Unit <i class="fa fa-star"></i></span><em><strong>75,234</strong>/100000</em></a></div>
    <div><i class="chartbg gradient-bg" style="width:95%"></i><span>Writing Unit</span><em><strong>50,004</strong>/50000</em></div>
    <div class="odd"><i class="chartbg gradient-bg" style="width:55%"></i><span>Auto Trading</span><em><strong>37,100</strong>/10000</em></div>
    <div><i class="chartbg gradient-bg" style="width:15%"></i><span>Hardware</span><em><strong>5,157</strong>/10000</em></div>
</div>
</section>
<section class="top-performers"><h5>Top Achievers</h5>
<ul>
    <li><img src="images/performer1.jpg"> <span>Muhammad Nasir Zia <strong>Monster Logo Design</strong></span> <em class="gradient-bg">$3345.98</em></li>
    <li><img src="images/performer1.jpg"> <span>Muhammad Nasir Zia <strong>Monster Logo Design</strong></span> <em class="gradient-bg">$3345.98</em></li>
    <li><img src="images/performer1.jpg"> <span>Muhammad Nasir Zia <strong>Monster Logo Design</strong></span> <em class="gradient-bg">$3345.98</em></li>
 </ul>
</section>
<?php include('footer.php'); ?> 