<?php
include('includes/header.php');

if(!isset($_GET['refcode'])){
	$refercode = '';
}else{
   $_SESSION['refcode'] = $_GET['refcode'];
}
?>
<div class="no-bottom no-top" id="content">
  <div id="top"></div>
  <style>
    .whited {
      color: #fff;
    }
    
    .orange {
      color: #FFCC29;
    }
  </style>
  <!-- section begin -->

  <section aria-label="section" data-bgimage="url(assets/images/bg2.jpg) top" class="text-light" id="subheader">
    <div class="center-y relative text-center">
      <div class="container">
        <div class="row">
          <div class="col text-center">
            <div class="spacer-single"></div>
            <h1 style="color:#FFCC29;">Our business-building experience <br> is as wide as it is deep.</h1>
          </div>
          <div class="clearfix"></div>
        </div>
      </div>
    </div>
  </section>
  <!-- section close -->
  <section aria-label="section">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-12">
          <div class="theme-row-zero">
            <center><h2 style="text-align: center;color: #9f03fb">Executive Leadership</h2></center>
            <p style="text-align: center;"><span style="color: #1ca94b; font-weight: 600;">
              <span style="font-size: 24px; line-height: 1.2;">Our leadership team is comprised of experienced business builders who carry deep industry expertise across construction, infrastructure, finance, data centres, digital assets, technology and global energy markets.</span>
            </p>
          </div>
          <hr>
          <div class="row">
          <div class="col-md-3"><img src="assets/images/juan.jpg" class="rounded-circle" alt="Juan" width="180px" height="180px"></div>
          <div class="col-md-9">
          <h3 style="color: #9f03fb">Juan Torres <br><small>Founder/CEO</small></h3> 
            <p>Juan has 15 years’ experience across finance, infrastructure and renewables.Juan was previously the 2nd largest individual shareholder in Palisade Investment Partners ($6 bn AUM, direct infrastructure assets across 23 businesses). Juan has extensive board experience spanning airports, ports, gas pipelines, bulk liquid storage businesses, waste treatment facilities, wind solar farms. Juan's previous experience was with Macquarie and PwC.</p>
          </div>
          </div>
          <hr>
          <div class="row">
          <div class="col-md-3"><img src="assets/images/ignacia.jpg" class="rounded-circle" alt="Ignacia" width="180px" height="180px"></div>
          <div class="col-md-9">
          <h3 style="color: #9f03fb">Ignacia Galindo <br><small>General Counsel and Company Secretary</small></h3> 
            <p>Ignascia is a senior executive, lawyer and company secretary with 25 years’ experience in corporate governance, capital markets, M&A, infrastructure projects and regulator engagement across multiple jurisdictions and in listed organisations. Ignascia was previously General Counsel and/or Company Secretary at ME Bank, Jetstar Airways, Billabong International and Epic Energy, and has also held senior legal positions with Alinta Energy, ExxonMobil and QGC..</p>
          </div>
          </div>
          <hr>
          <div class="row">
          <div class="col-md-3"><img src="assets/images/shaw.jpg" class="rounded-circle" alt="Dave" width="180px" height="180px"></div>
          <div class="col-md-9">
          <h3 style="color: #9f03fb">Dave Shaw <br><small>Chief Operating Officer</small></h3> 
            <p>Dave has 30 years experience working across the energy, utilities and resources sectors in the Asia Pac and North America. David is a strategic and operational leader with an extensive background in delivering a portfolio of projects and reliable operations. Dave was most recently SVP Asia Pac East of Wood's Operations Division delivering multi-million dollar critical services to complex and diverse industries.</p>
          </div>
          </div>
          <hr>
          <div class="row">
          <div class="col-md-3"><img src="assets/images/glen.jpg" class="rounded-circle" alt="Glenn" width="180px" height="180px"></div>
          <div class="col-md-9">
          <h3 style="color: #9f03fb">Glenn Harry <br><small>Vice President – Operations</small></h3> 
            <p>Glenn has 14 years’ experience across finance, resources and commodities. Glenn was most recently APAC COO and Division Director for Commodity Markets and Finance at Macquarie Group.</p>
          </div>
          </div>
          <hr>
          <div class="row">
          <div class="col-md-3"><img src="assets/images/kent.jpg" class="rounded-circle" alt="Glenn" width="180px" height="180px"></div>
          <div class="col-md-9">
          <h3 style="color: #9f03fb">Kent Draper <br><small>Vice President – Commercial</small></h3> 
            <p>Kent has 15+ years’ experience in investment banking and financing in infrastructure, power & renewables. Kent was most recently Vice President at First Solar, leading ~$8bn+ of investments and financings in the US and AsiaPac.</p>
          </div>
          </div>
        </div>
      </div>
    </div>
  </section>

</div>
<!-- content close -->


<?php
include('includes/footer.php');
?>