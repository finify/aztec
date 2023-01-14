<?php
include('includes/header.php');

if(!isset($_GET['refcode'])){
	$refercode = '';
}else{
   $_SESSION['refcode'] = $_GET['refcode'];
}
?>
    <!-- header close --><!-- content begin -->
<div class="no-bottom no-top" id="content">
  <div id="top"></div>
  <section aria-label="section" data-bgimage="url(assets/images/bg2.jpg) top" class="text-light" id="home">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-5 wow fadeInRight" data-wow-delay=".0s">
          <div class="spacer-10"></div>
          <div class="h2 text-light">
            <span style="color:#ffcc29;font-size:18px">What you get on Aztecmining</span> <br/>
            <div class="typed-strings">
              <p>Profitable investment</p>
              <p>Quick Withdrawal</p>
              <p>24/7 Support</p>
            </div>
            <div class="typed"></div>
          </div>
          <p class="lead">
            Earn by investing in the rapidly growing crypto market. Our team of experts are dedicated to creating a unique & profitable investment opportunity for you.<br>
          
          </p>
          <div class="spacer-20"></div>
          <a class="btn-custom" href="account/register.php" style="background-color: #ffcc29; color: #000">SIGN UP</a>
          <a class="btn-custom" href="account/login.php" style="background-color: var(--primary_color); color: #fff">LOGIN</a>
          <div class="mb-sm-30"></div>
        </div>
        <div class="col-lg-6 offset-lg-1 text-center wow fadeInLeft" data-wow-delay=".5s" style="padding-top: 100px; padding-bottom: 100px">
          <!--img src="assets/images/mobile.png" class="img-fluid" alt=""/-->
          <!-- <video width="100%" height="350" class="img-fluid" controls>
            <source src="https://www.youtube.com/watch?v=41JCpzvnn_0" type="youtube">
            <source src="assets/images/bg.ogg" type="video/ogg"> Your browser does not support the video tag.
          </video> -->
          <iframe width="100%" height="315" src="https://www.youtube.com/embed/41JCpzvnn_0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
        </div>
      </div>
    </div>
  </section>
  
  <!-- TradingView Widget BEGIN -->
<div class="tradingview-widget-container">
  <div class="tradingview-widget-container__widget"></div>
  
  <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-ticker-tape.js" async>
  {
  "symbols": [
    {
      "proName": "FOREXCOM:SPXUSD",
      "title": "S&P 500"
    },
    {
      "proName": "FOREXCOM:NSXUSD",
      "title": "US 100"
    },
    {
      "proName": "FX_IDC:EURUSD",
      "title": "EUR/USD"
    },
    {
      "proName": "BITSTAMP:BTCUSD",
      "title": "Bitcoin"
    },
    {
      "proName": "BITSTAMP:ETHUSD",
      "title": "Ethereum"
    }
  ],
  "showSymbolLogo": true,
  "colorTheme": "dark",
  "isTransparent": false,
  "displayMode": "adaptive",
  "locale": "en"
}
  </script>
</div>
<!-- TradingView Widget END -->
  <section id="section-highlight" data-bgcolor="var(--secondary_color)">
    <div class="container" id="howItWorks">
      <div class="text-center">
        <span class="p-title" style="background-color: #fff">Discover</span><br/>
        <h2 style="color: #fff">How it works</h2>
        <div class="small-border pb-5" style="border-color: #ffcc29"></div>
      </div>
      <div class="row sequence">
        <div class="col-lg-4 col-md-6 mb30 sq-item wow">
          <div class="f-box f-icon-left f-icon-circle f-icon-shadow">
            <i class="fa fa-user bg-color text-light"></i>
            <div class="fb-text">
              <p class="whited" style="color:white">
                Create your own account to get started. It takes a few minutes to complete registration.
              </p>
              <a href="account/register.php" class="btn-border text-white">Sign Up</a>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 mb30 sq-item wow">
          <div class="f-box f-icon-left f-icon-circle f-icon-shadow">
            <i class="fa fa-line-chart bg-color text-light"></i>
            <div class="fb-text">
              <p class="whited" style="color:white">
                Make your investment deposit using Bitcoin or other accepted payment methods.
              </p>
              <a href="account/login.php" class="btn-border text-white">Invest Funds</a>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 mb30 sq-item wow">
          <div class="f-box f-icon-left f-icon-circle f-icon-shadow">
            <i class="fa fa-money bg-color text-light"></i>
            <div class="fb-text">
              <p class="whited" style="color:white">
                Now you are all setup and ready to start earning and withdraw without hassle.
              </p>
              <a href="account/login.php" class="btn-border text-white">Withdraw Profit</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section aria-label="section" data-bgimage="url(assets/images/slide2.jpg) top" class="text-light" id="plans">
    <div class="container" id="about" align="center">
      <div class="text-center">
        <h2 style="color: #fff">Energised to be part of the future?</h2>
        <div class="small-border pb-5" style="border-color: #ffcc29"></div>
                <div class="row sequence" style="justify-content: center;">
                <?php
                        $sql1 = mysqli_query($con, "SELECT * FROM `fx_plan_category` order by category_order ASC");   //checking no of investments
                        $rows1 = mysqli_num_rows($sql1) ;

                        if($rows1<1){?>
                           <div class="alert alert-warning" role="alert">
                           <span class="alert-icon"><i class="ni ni-fat-remove"></i></span>
                           <span class="alert-text">No Plans Yet</span>
                           </div>
                        <?php }else{

                        
                           while($row11 = mysqli_fetch_array($sql1)){
                              $categoryid =$row11["ID"];
                           $category_name =$row11["category_name"];
                           $category_order =$row11["category_order"];
                           $datecreated =$row11["datecreated"];

                           echo "<h1 class='p-title' style='color: #fff; background-color: #9f03fb; width:100%'>$category_name Plan</h1><br/>";
                           
                           $sql12 = mysqli_query($con, "SELECT * FROM `fx_investments_plans` WHERE plan_category='$category_name'  order by plan_order ASC");   //checking no of investments
                           $rows12 = mysqli_num_rows($sql12) ;

                           if($rows12<1){
                              echo "<div class='alert alert-warning' role='alert'>
                              <span class='alert-icon'><i class='ni ni-fat-remove'></i></span>
                              <span class='alert-text'>No $category_name plan yet</span>
                              </div>";
                           }else{
                              while($row12 = mysqli_fetch_array($sql12)){
                                 $planid =$row12["ID"];
                                 $plan_name =$row12["plan_name"];
                                 $plan_min =$row12["plan_min"];
                                 $plan_max =$row12["plan_max"];
                                 $plan_roi =$row12["plan_roi"];
                                 $plan_roi_type =$row12["plan_roi_type"];
                                 $plan_order =$row12["plan_order"];
                                 $plan_duration =$row12["plan_duration"];
                                 $plan_status =$row12["plan_status"];
                                 $plan_category =$row12["plan_category"];

                                 if($plan_roi_type == "daily" || $plan_roi_type == "after"){
                                  $plan_duration_suf = "Days";
                                 }else{
                                  $plan_duration_suf = "Weeks";
                                 }

                                 $plan_min = number_format($plan_min);
                                 if($plan_max == ""){
                                 $plan_max = "UNLIMITED";
                                 }else{
                                    $plan_max = number_format($plan_max);
                                 }
                                 echo "
                                    <div class='col-lg-3 col-md-6 col-sm-12 sq-item wow'>
                                      <div class='pricing-s1 mb30' style='border: 2px white solid'>
                                        <div class='top'>
                                          <p class='plan-tagline'>
                                            <b>
                                            $plan_name  </b>
                                          </p>
                                        </div>
                                        <div class='mid text-light' style='background-color: var(--secondary_color)'>
                                          <h2>
                                          $plan_roi% Profit $plan_roi_type                  
                                          </h2>
                                        </div>
                                        <div class='bottom'>
                                          <ul>
                                            <li><i class='fa fa-check' style='color:#ffcc29'></i><b><span style='color:#ffcc29'>Duration:</span> $plan_duration $plan_duration_suf</b>
                                            </li>
                                            <li><i class='fa fa-check' style='color:#ffcc29'></i><b><span style='color:#ffcc29'>Minimum:</span> $$plan_min</b>
                                            </li>
                                            <li><i class='fa fa-check' style='color:#ffcc29'></i><b><span style='color:#ffcc29'>Maximum:</span> $$plan_max</b>
                                            </li>
                                          </ul>
                                        </div>
                                        <div class='action'>
                                          <a href='account/register.php' class='btn-custom' style='background-color: #ffcc29; color: #000'>Slelect</a
                                                          >
                                          </div>
                                      </div>
                                    </div>
                                    ";

                                
                              }
                              
                           }
                        }
                     }
                  ?>
                    <!-- <div class='col-lg-3 col-md-6 col-sm-12 sq-item wow'>
                      <div class='pricing-s1 mb30' style='border: 2px white solid'>
                        <div class='top'>
                          <p class='plan-tagline'>
                            <b>
                            $plan_name                </b>
                          </p>
                        </div>
                        <div class='mid text-light' style='background-color: var(--secondary_color)'>
                          <h2>
                          $plan_roi% Profit $plan_roi_type                  
                          </h2>
                        </div>
                        <div class='bottom'>
                          <ul>
                            <li><i class='fa fa-check' style='color:#ffcc29'></i><b><span style='color:#ffcc29'>Duration:</span> $plan_duration Days</b>
                            </li>
                            <li><i class='fa fa-check' style='color:#ffcc29'></i><b><span style='color:#ffcc29'>Minimum:</span> $$plan_min</b>
                            </li>
                            <li><i class='fa fa-check' style='color:#ffcc29'></i><b><span style='color:#ffcc29'>Maximum:</span> $$plan_max</b>
                            </li>
                          </ul>
                        </div>
                        <div class="action">
                          <a href="account/register.php" class="btn-custom" style="background-color: #ffcc29; color: #000">Slelect</a
                                          >
                          </div>
                      </div>
                    </div> -->

                  </div>
                          
                 <div class="row sequence">
                   <!--<div class="col-lg-6 offset-lg-3 text-center">
                        <small class="text-white">All plans shown are principal inclusive.</small>
                     </div>-->
                     <div class="col-md-12">
                    <h2 class="title" style='text-align:center; margin-bottom: 20px; color: #fff'> Calculate <b>Profit</b></h2>
                    <form name="calculator">
                      <div class="form-group row">
                        <div class="col-md-3">
                          <label class="text-warning font-weight-bold">Choose Plan</label>
                          <select class="form-control" name="percent" id="percent">
                          <?php
                          $sql1 = mysqli_query($con, "SELECT * FROM `fx_plan_category` order by category_order ASC");  
                          $rows1 = mysqli_num_rows($sql1) ;

                                if($rows1<1){?>
                                    <option>No plan yet</option>
                                <?php }else{

                                
                                    while($row11 = mysqli_fetch_array($sql1)){
                                        $categoryid =$row11["ID"];
                                    $category_name =$row11["category_name"];
                                    $category_order =$row11["category_order"];
                                    $datecreated =$row11["datecreated"];
                                    
                                    echo "<option disabled>$category_name PLANS</option>";
                                    
                                    $sql12 = mysqli_query($con, "SELECT * FROM `fx_investments_plans` WHERE plan_category='$category_name'  order by plan_order ASC");   //checking no of investments
                                    $rows12 = mysqli_num_rows($sql12) ;
                                    if($rows12<1){
                                        echo "<option>No $category_name plan yet</option>";
                                    }else{
                                        while($row12 = mysqli_fetch_array($sql12)){
                                        $planid =$row12["ID"];
                                        $plan_name =$row12["plan_name"];
                                        $plan_min =$row12["plan_min"];
                                        $plan_max =$row12["plan_max"];
                                        $plan_roi =$row12["plan_roi"];
                                        $plan_roi_type =$row12["plan_roi_type"];
                                        $plan_order =$row12["plan_order"];
                                        $plan_duration =$row12["plan_duration"];
                                        $plan_status =$row12["plan_status"];
                                        $plan_category =$row12["plan_category"];
                                        echo"<option value='$plan_min,$plan_max,$plan_roi,$plan_roi_type,$plan_duration'>$plan_name PLAN</option>";
                
                                        }
                                        }
                                    }
                                    }
                                ?>
                          </select>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label class="text-warning font-weight-bold">Enter Amount</label>
                            <input type="number" name="amount" id="amount" class="form-control" aria-describedby="basic-addon1">
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label class="text-warning font-weight-bold">&nbsp;</label><br>
                            <input type="button" class="btn btn-warning" style="line-height:normal;color:#fff" value="Calculate Profit" onClick="javascript:multiply();">
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="row">
                            <div class="col-sm-6 col-xs-12">
                              <label class="text-warning font-weight-bold">Net Profit</label>
                              <h2 class="text-white">$<span id="netProfit" class="text-white">0.00</span></h2>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                              <label class="text-warning font-weight-bold">Total Return</label>
                              <h2 class="text-white">$<span id="profit" class="text-white">0.00</span></h2>
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
  </section>

  <section id="section-banner" data-bgcolor="var(--secondary_color)" id="profile">
    <div class="container" id="about">
      <div class="row align-items-center">
        <div class="col-lg-6 wow fadeInLeft" data-wow-delay="0s">
          <h2 style="color: #fff">Corporate Profile</h2>
          <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active whited" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
              <div class="field field--name-field-nir-global-block-body field--type-text-long field--label-hidden field__item" style="color:#fff">
                <p>We build, own, and operate data center and electrical infrastructure for the mining of Bitcoin.</p>

                <p>We believe it is increasingly vital that Bitcoin is, and can be, mined and utilized in an environmentally and socially responsible manner. We are focused on locating our operations in areas with low-cost and excess renewable energy.</p>

                <p>We are building proprietary data centers that continue to be refined through years of research and development to optimize the operational environment and efficiencies, including stable uptime performance during high and low-temperature periods.</p>
              </div>
            </div>
          </div>
          <div class="spacer-half"></div>
          <a class="btn-custom" href="account/register.php" style="background-color: #ffcc29; color: #000">BECOME AN INVESTOR</a>
              </div>
              <div class="col-lg-6 d-none d-lg-block d-xl-block text-center wow fadeInRight" data-wow-delay="0s">
                <!-- TradingView Widget BEGIN -->
                <div class="tradingview-widget-container">
                  <div id="tradingview_8c36b"></div>
                  <div class="tradingview-widget-copyright"><a href="https://www.tradingview.com/symbols/BTCUSDT/?exchange=BINANCE" rel="noopener" target="_blank"><span class="blue-text">BTCUSDT rates</span></a> by TradingView</div>
                  <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
                  <script type="text/javascript">
                  new TradingView.MediumWidget(
                  {
                  "symbols": [
                    [
                      "BINANCE:BTCUSDT|12M"
                    ]
                  ],
                  "chartOnly": false,
                  "width": "100%",
                  "height": "400px",
                  "locale": "en",
                  "colorTheme": "light",
                  "autosize": true,
                  "showVolume": false,
                  "hideDateRanges": false,
                  "hideMarketStatus": false,
                  "scalePosition": "right",
                  "scaleMode": "Normal",
                  "fontFamily": "-apple-system, BlinkMacSystemFont, Trebuchet MS, Roboto, Ubuntu, sans-serif",
                  "fontSize": "10",
                  "noTimeScale": false,
                  "valuesTracking": "1",
                  "chartType": "line",
                  "backgroundColor": "rgba(0, 0, 255, 1)",
                  "container_id": "tradingview_8c36b"
                }
                  );
                  </script>
                </div>
                <!-- TradingView Widget END -->
              </div>

            </div>
          </div>
  </section>

  <!-- section close -->
  <section aria-label="section" data-bgimage="url(assets/images/hp.jpg) top" class="text-light" id="whyUs">
    <div class="container">
      <div class="text-center">
        <span class="p-title" style="background-color: #fff">Discover</span
                        ><br />
                     <h2 style="color: #fff">Why we are the best</h2>
                     <div class="small-border" style="border-color: #ffcc29"></div>
                  </div>
                  <div class="row sequence">
                     <div class="col-lg-4 col-md-6 mb30 sq-item wow">
                        <div class="f-box f-icon-left f-icon-circle f-icon-shadow">
                           <i class="fa fa-usd bg-color text-light"></i>
                           <div class="fb-text">
                              <h4 style="color: #fff">Profitable Returns</h4>
                              <p class="whited" style="color:white">
                                 Our Plans & our earnings at the mining & trading sector of
                                 the business apply to all, we make sure that our expenses
                                 & revenue are balanced to keep us running.
                              </p>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-4 col-md-6 mb30 sq-item wow">
                        <div class="f-box f-icon-left f-icon-circle f-icon-shadow">
                           <i class="fa fa-shield bg-color text-light"></i>
                           <div class="fb-text">
                              <h4 style="color: #fff">Top Encryption</h4>
                              <p class="whited"  style="color:white">
                                 We have enforced SSL encryption on all dynamic response
                                 pages to secure financial transactions and account charges
                                 per demand.
                              </p>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-4 col-md-6 mb30 sq-item wow">
                        <div class="f-box f-icon-left f-icon-circle f-icon-shadow">
                           <i class="fa fa-tachometer bg-color text-light"></i>
                           <div class="fb-text">
                              <h4 style="color: #fff">Fast Proccess</h4>
                              <p class="whited" style="color:white">
                                 You can withdraw your money at any moment by requesting.
                                 The funds will be sent to your crypto-wallet instantly.
                              </p>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-4 col-md-6 mb30 sq-item wow">
                        <div class="f-box f-icon-left f-icon-circle f-icon-shadow">
                           <i class="fa fa-certificate bg-color text-light"></i>
                           <div class="fb-text">
                              <h4 style="color: #fff">Legal Company</h4>
                              <p class="whited" style="color:white">
                                 Our company conducts absolutely legal activities in the legal field. We are certified to operate investment business, we are legal and safe.
                              </p>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-4 col-md-6 mb30 sq-item wow">
                        <div class="f-box f-icon-left f-icon-circle f-icon-shadow">
                           <i class="fa fa-smile-o bg-color text-light"></i>
                           <div class="fb-text">
                              <h4 style="color: #fff">High reliability</h4>
                              <p class="whited" style="color:white">
                                 We are trusted by a huge number of people. We are working hard constantly to improve the level of our security system and minimize possible risks.
                              </p>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-4 col-md-6 mb30 sq-item wow">
                        <div class="f-box f-icon-left f-icon-circle f-icon-shadow">
                           <i class="fa fa-user-secret bg-color text-light"></i>
                           <div class="fb-text">
                              <h4 style="color: #fff">Anonymity</h4>
                              <p class="whited" style="color:white">
                                 Anonymity and using cryptocurrency as a payment instrument. In the era of electronic money – this is one of the most convenient ways of cooperation.
                              </p>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-4 col-md-6 mb30 sq-item wow">
                        <div class="f-box f-icon-left f-icon-circle f-icon-shadow">
                           <i class="fa fa-money bg-color text-light"></i>
                           <div class="fb-text">
                              <h4 style="color: #fff">
                                 Quick Withdrawal
                              </h4>
                              <p class="whited" style="color:white">
                                 Our all retreats are treated spontaneously once requested. There are high maximum limits. The minimum withdrawal amount is only $10 .
                              </p>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-4 col-md-6 mb30 sq-item wow">
                        <div class="f-box f-icon-left f-icon-circle f-icon-shadow">
                           <i class="fa fa-share-alt bg-color text-light"></i>
                           <div class="fb-text">
                              <h4 style="color: #fff">Referral Program</h4>
                              <p class="whited" style="color:white">
                                 We think investing is better with family and friends, so for everyone you invite to join, you’ll both earn reward crypto assets.
                              </p>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-4 col-md-6 mb30 sq-item wow">
                        <div class="f-box f-icon-left f-icon-circle f-icon-shadow">
                           <i class="fa fa-headphones bg-color text-light"></i>
                           <div class="fb-text">
                              <h4 style="color: #fff">
                                 24/7 Support
                              </h4>
                              <p class="whited" style="color:white">
                                 We provide 24/7 customer support through e-mail and telegram. Our support representatives are periodically available to elucidate any difficulty.
                              </p>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-4 col-md-6 mb30 sq-item wow">
                        <div class="f-box f-icon-left f-icon-circle f-icon-shadow">
                           <i class="fa fa-server bg-color text-light"></i>
                           <div class="fb-text">
                              <h4 style="color: #fff">Dedicated Server</h4>
                              <p class="whited" style="color:white">
                                 We are using a dedicated server for the website which allows us exclusive use of the resources of the entire server.
                              </p>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-4 col-md-6 mb30 sq-item wow">
                        <div class="f-box f-icon-left f-icon-circle f-icon-shadow">
                           <i class="fa fa-lock bg-color text-light"></i>
                           <div class="fb-text">
                              <h4 style="color: #fff">
                                 SSL Secured
                              </h4>
                              <p class="whited" style="color:white">
                                 Comodo Essential-SSL Security encryption confirms that the presented content is genuine and legitimate.
                              </p>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-4 col-md-6 mb30 sq-item wow">
                        <div class="f-box f-icon-left f-icon-circle f-icon-shadow">
                           <i class="fa fa-ban bg-color text-light"></i>
                           <div class="fb-text">
                              <h4 style="color: #fff">DDOS Protection</h4>
                              <p class="whited" style="color:white">
                                 We are using one of the most experienced, professional, and trusted DDoS Protection and mitigation provider.
                              </p>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>

  </section>
  
  <section aria-label="section" data-bgimage="url(assets/images/sl-home2-img1.jpg) top" class="text-light" id="affiliate">
                      <div class="container">
                     <div class="row align-items-center">
                         <div
                           class="col-md-6 text-center wow fadeInLeft"
                           data-wow-delay="0s"
                           style="margin: auto 0px"
                           >
                           <br /><br /><img
                              src="assets/images/mobile.png"
                              class="img-fluid"
                              alt=""
                              style="width: 60%"
                              />
                        </div>
                        <div
                           class="col-md-6 col-sm-12 wow fadeInRight"
                           data-wow-delay="0s">
                           <span class="p-title" style="color: #fff">Affiliates</span><br/>
        <h2 style="color: #fff">Earn Referral Bonus</h2>
        <p style="color: #fff">
          “We think investing is better with family and friends, so for everyone you invite to join, you’ll both earn reward crypto assets. As soon as your friend signs up and Makes a first deposit , we’ll credit each of your accounts with a reward Crypto Assets. Keep in mind: You can receive up to $500 in reward crypto assets each calendar year, so feel free to spread the word.”
        </p>
        <div class="spacer-half"></div>
        <a class="btn-custom" href="signup.php" style="background-color: #ffcc29; color: #000">Sign Up</a
                              >&nbsp;
                           <a
                              class="btn-border"
                              href="signin.php"
                              style="background-color: var(--secondary_color)"
                              >Login</a
                              >
                        </div>
                        
                     </div>
                  </div>
  </section>

<section id="section-highlight" data-bgcolor="var(--secondary_color)" id="testimonials">
  <div class="container" id="testimonialFix">
    <div class="row">
      <div class="col-lg-12">
        <div class="text-center">
          <span class="p-title" style="color: #fff">Testimonials</span
                                 ><br />
                              <h2 style="color: #fff">What Our Investors Say</h2>
                              <div
                                 class="small-border"
                                 style="border-color: #ffcc29"
                                 ></div>
                           </div>
                           <div
                              class="owl-carousel owl-theme wow fadeInUp"
                              id="testimonial-carousel"
                              >
                              <div class="item">
                                 <div class="de_testi opt-2 review">
                                    <blockquote>
                                       <div class="p-rating">
                                          <i class="fa fa-star checked"></i>
                                          <i class="fa fa-star checked"></i>
                                          <i class="fa fa-star checked"></i>
                                          <i class="fa fa-star checked"></i>
                                          <i class="fa fa-star"></i>
                                       </div>
                                       <h3>Pretty Awesome!</h3>
                                       <p>
                                          “Thank you for your support and concern during this difficult times. Accessing my money is very easy. Opening an investment account was a good decision.”
                                       </p>
                                       <div class="de_testi_by">
                                          <span><b>Alexi</b>, Verified Investor</span>
        </div>
        </blockquote>
      </div>
    </div>
    <div class="item">
      <div class="de_testi opt-2 review">
        <blockquote>
          <div class="p-rating">
            <i class="fa fa-star checked"></i>
            <i class="fa fa-star checked"></i>
            <i class="fa fa-star checked"></i>
            <i class="fa fa-star checked"></i>
            <i class="fa fa-star"></i>
          </div>
          <h3>Thank You!</h3>
          <p>"What an excellent service. Thank you very much, I really recommend
            Aztecmining"
          </p>
          <div class="de_testi_by">
            <span><b>Sarah</b>, Verified Investor</span>
          </div>
        </blockquote>
      </div>
    </div>
    <div class="item">
      <div class="de_testi opt-2 review">
        <blockquote>
          <div class="p-rating">
            <i class="fa fa-star checked"></i>
            <i class="fa fa-star checked"></i>
            <i class="fa fa-star checked"></i>
            <i class="fa fa-star checked"></i>
            <i class="fa fa-star"></i>
          </div>
          <h3>Unbelievable!</h3>
          <p>"My questions/issues are resolved as soon as I make them know to her. Indeed,
            Aztecmininghas provided customer service with a delightful difference”
          </p>
          <div class="de_testi_by">
            <span><b>Dehli</b>, Verified Investor</span>
          </div>
        </blockquote>
      </div>
    </div>
  </div>
  </div>
  </div>
  </div>

</section>

<section aria-label="section" data-bgimage="url(assets/images/Layer-4.jpg) top" class="text-light" id="contact">
  <div class="container">
    <div class="row">
      <div class="col-lg-4">
        <h3 style="color: #fff">Do you have any question?</h3>
        <p class="whited">
          Kindly contact us with any of the means below & we will get back to you as soon as possible
        </p>
        <div class="padding40 box-rounded mb30" data-bgcolor="#c94747">
          <h3>Our Office</h3>
          <address class="s1">
              <span><i class="id-color fa fa-map-marker fa-lg"></i>Aztec Group House, 11-15 Seaton Place, St Helier, Jersey, JE4 0QH</span>
               <span><i class="id-color fa fa-envelope-o fa-lg"></i><a	href="mailto:support@Aztecminingtrading.com">support@Aztecminingtrading.com</a></span>
          </address>
        




        </div>
      </div>
      <div class="col-lg-8 mb-sm-30">
        <form name="contactForm" id="contact_form" class="form-border" method="post" action="#">
          <div class="field-set">
            <input type="text" name="name" id="name" class="form-control" placeholder="Your Name" style="background-color: #f0f4fd"/>
          </div>
          <div class="field-set">
            <input type="text" name="email" id="email" class="form-control" placeholder="Your Email" style="background-color: #f0f4fd"/>
          </div>
          <div class="field-set">
            <input type="text" name="phone" id="phone" class="form-control" placeholder="Your Phone" style="background-color: #f0f4fd"/>
          </div>
          <div class="field-set">
            <textarea name="message" id="message" class="form-control" placeholder="Your Message" style="background-color: #f0f4fd"></textarea>
          </div>
          <div class="spacer-half"></div>
          <div id="submit">
            <input type="submit" id="send_message" value="Submit Form" class="btn btn-custom" style="background-color: #ffcc29; color: #000"/>
          </div>
          <div id="mail_success" class="success">
            Your message has been sent successfully.
          </div>
          <div id="mail_fail" class="error">
            Sorry, error occured this time sending your message.
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

<section data-bgcolor="var(--secondary_color)" id="faqs">
  <div class="container">
    <div class="row">
      <div class="col-md-12 text-center">
        <h2 style="color: #fff">Frequent Questions</h2>
        <div class="small-border" style="border-color: #ffcc29"></div>
      </div>
      <div class="col-md-6">
        <!-- Accordion -->
        <div id="accordion-1" class="accordion">
          <!-- Accordion item 1 -->
          <div class="card">
            <div id="heading-a1" class="card-header bg-white shadow-sm border-0">
              <h6 class="mb-0 font-weight-bold">
                                    <a
                                       href="#"
                                       data-toggle="collapse"
                                       data-target="#collapse-a1"
                                       aria-expanded="false"
                                       aria-controls="collapse-a1"
                                       class="
                                       d-block
                                       position-relative
                                       text-dark
                                       collapsible-link
                                       py-2
                                       "
                                       >How do I make profit from cryptocurrency investment?</a
                                       >
                                 </h6>
            


            </div>
            <div id="collapse-a1" aria-labelledby="heading-a1" data-parent="#accordion-1" class="collapse">
              <div class="card-body p-4">
                <p class="m-0">
                  A: The profit on investment is the interest earned which is paid periodically. Interest on investment is paid monthly, quarterly or at maturity of the investment. You have the option of reinvesting your accrued interest or receiving (same as) a direct credit into your Wallet.
                </p>
              </div>
            </div>
          </div>
          <!-- Accordion item 2 -->
          <div class="card">
            <div id="heading-a2" class="card-header bg-white shadow-sm border-0">
              <h6 class="mb-0 font-weight-bold">
                                    <a
                                       href="#"
                                       data-toggle="collapse"
                                       data-target="#collapse-a2"
                                       aria-expanded="false"
                                       aria-controls="collapse-a2"
                                       class="
                                       d-block
                                       position-relative
                                       collapsed
                                       text-dark
                                       collapsible-link
                                       py-2
                                       "
                                       >What interest rates can I expect to receive?</a
                                       >
                                 </h6>
            


            </div>
            <div id="collapse-a2" aria-labelledby="heading-a2" data-parent="#accordion-1" class="collapse">
              <div class="card-body p-4">
                <p class="m-0">
                  A: Our interest rates vary depending on your investment package, value of investment, duration of the investment and the current interest rate trend in the financial market. However, we have one of the most competitive rates in the market.
                </p>
              </div>
            </div>
          </div>
          <!-- Accordion item 3 -->
          <div class="card">
            <div id="heading-a3" class="card-header bg-white shadow-sm border-0">
              <h6 class="mb-0 font-weight-bold">
                                    <a
                                       href="#"
                                       data-toggle="collapse"
                                       data-target="#collapse-a3"
                                       aria-expanded="false"
                                       aria-controls="collapse-a3"
                                       class="
                                       d-block
                                       position-relative
                                       collapsed
                                       text-dark
                                       collapsible-link
                                       py-2
                                       "
                                       >How do I know my money is safe?</a
                                       >
                                 </h6>
            


            </div>
            <div id="collapse-a3" aria-labelledby="heading-a3" data-parent="#accordion-1" class="collapse">
              <div class="card-body p-4">
                <p class="m-0">
                  A: We are regulated by the Securities and Exchange Commission (SEC) and Financial Industry Regulatory Authority.
                  Aztecmining owns a very strong capital base and a robust risk management framework that ensures your investment is in safe hands.
                </p>
              </div>
            </div>
          </div>
          <div class="card">
            <div id="heading-a4" class="card-header bg-white shadow-sm border-0">
              <h6 class="mb-0 font-weight-bold">
                                    <a
                                       href="#"
                                       data-toggle="collapse"
                                       data-target="#collapse-a4"
                                       aria-expanded="false"
                                       aria-controls="collapse-a4"
                                       class="
                                       d-block
                                       position-relative
                                       collapsed
                                       text-dark
                                       collapsible-link
                                       py-2
                                       "
                                       >What will I receive as proof of my investment</a
                                       >
                                 </h6>
            


            </div>
            <div id="collapse-a4" aria-labelledby="heading-a4" data-parent="#accordion-1" class="collapse">
              <div class="card-body p-4">
                <p class="m-0">
                  A: The
                  Aztecmining Customer Service team will provide you with an investment certificate at the start of your investment and for additional investments in your account.
                </p>
              </div>
            </div>
          </div>
          <div class="card">
            <div id="heading-b5" class="card-header bg-white shadow-sm border-0">
              <h6 class="mb-0 font-weight-bold">
                                    <a
                                       href="#"
                                       data-toggle="collapse"
                                       data-target="#collapse-b5"
                                       aria-expanded="false"
                                       aria-controls="collapse-b5"
                                       class="
                                       d-block
                                       position-relative
                                       collapsed
                                       text-dark
                                       collapsible-link
                                       py-2
                                       "
                                       >Can I invest in multiple investment products?
                                    </a>
                                 </h6>
            


            </div>
            <div id="collapse-b5" aria-labelledby="heading-b4" data-parent="#accordion-2" class="collapse">
              <div class="card-body p-4">
                <p class="m-0">
                  A: Yes, you can. Most investment products are tailored to address a particular investment objective. Thus, you can invest in several of our products to suit your various investment needs.
                </p>
              </div>
            </div>
          </div>
          <div class="card">
            <div id="heading-b6" class="card-header bg-white shadow-sm border-0">
              <h6 class="mb-0 font-weight-bold">
                                    <a
                                       href="#"
                                       data-toggle="collapse"
                                       data-target="#collapse-b6"
                                       aria-expanded="false"
                                       aria-controls="collapse-b6"
                                       class="
                                       d-block
                                       position-relative
                                       collapsed
                                       text-dark
                                       collapsible-link
                                       py-2
                                       "
                                       >What is the maximum number of people in a group who can invest in this scheme?
                                    </a>
                                 </h6>
            


            </div>
            <div id="collapse-b6" aria-labelledby="heading-b4" data-parent="#accordion-2" class="collapse">
              <div class="card-body p-4">
                <p class="m-0">
                  A: There is no cap to the number of people who can make up a group to invest in the scheme.
                </p>
              </div>
            </div>
          </div>
          <div class="card">
            <div id="heading-b7" class="card-header bg-white shadow-sm border-0">
              <h6 class="mb-0 font-weight-bold">
                                    <a
                                       href="#"
                                       data-toggle="collapse"
                                       data-target="#collapse-b7"
                                       aria-expanded="false"
                                       aria-controls="collapse-b7"
                                       class="
                                       d-block
                                       position-relative
                                       collapsed
                                       text-dark
                                       collapsible-link
                                       py-2
                                       "
                                       >Can I invest with what currencies?
                                    </a>
                                 </h6>
            


            </div>
            <div id="collapse-b7" aria-labelledby="heading-b4" data-parent="#accordion-2" class="collapse">
              <div class="card-body p-4">
                <p class="m-0">
                  A: Yes, you can invest with crypto currencies like Bitcoins ( BTC ), Ethereum ( ETH ), Binance coin ( BNB ),Tether USD ( USDT ) , Cardano ( ADA ) .
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <!-- Accordion -->
        <div id="accordion-2" class="accordion">
          <!-- Accordion item 1 -->
          <div class="card">
            <div id="heading-b8" class="card-header bg-white shadow-sm border-0">
              <h6 class="mb-0 font-weight-bold">
                                    <a
                                       href="#"
                                       data-toggle="collapse"
                                       data-target="#collapse-b8"
                                       aria-expanded="false"
                                       aria-controls="collapse-b8"
                                       class="
                                       d-block
                                       position-relative
                                       text-dark
                                       collapsible-link
                                       py-2
                                       "
                                       >How can I keep track of my investment?</a
                                       >
                                 </h6>
            


            </div>
            <div id="collapse-b8" aria-labelledby="heading-b1" data-parent="#accordion-2" class="collapse">
              <div class="card-body p-4">
                <p class="m-0">
                  A: Once you’ve signed on as a client, you will be given access to view and monitor your account activity online. You may also request for your account statement at any time.
                </p>
              </div>
            </div>
          </div>
          <!-- Accordion item 2 -->
          <div class="card">
            <div id="heading-b9" class="card-header bg-white shadow-sm border-0">
              <h6 class="mb-0 font-weight-bold">
                                    <a
                                       href="#"
                                       data-toggle="collapse"
                                       data-target="#collapse-b9"
                                       aria-expanded="false"
                                       aria-controls="collapse-b9"
                                       class="
                                       d-block
                                       position-relative
                                       collapsed
                                       text-dark
                                       collapsible-link
                                       py-2
                                       "
                                       >Can I invest for my children?</a
                                       >
                                 </h6>
            


            </div>
            <div id="collapse-b9" aria-labelledby="heading-b2" data-parent="#accordion-2" class="collapse">
              <div class="card-body p-4">
                <p class="m-0">
                  A: Yes, you can.
                </p>
              </div>
            </div>
          </div>
          <!-- Accordion item 3 -->
          <div class="card">
            <div id="heading-b10" class="card-header bg-white shadow-sm border-0">
              <h6 class="mb-0 font-weight-bold">
                                    <a
                                       href="#"
                                       data-toggle="collapse"
                                       data-target="#collapse-b10"
                                       aria-expanded="false"
                                       aria-controls="collapse-b10"
                                       class="
                                       d-block
                                       position-relative
                                       collapsed
                                       text-dark
                                       collapsible-link
                                       py-2
                                       "
                                       >How long does it take to withdraw my fund when I want it?</a
                                       >
                                 </h6>
            


            </div>
            <div id="collapse-b10" aria-labelledby="heading-b3" data-parent="#accordion-2" class="collapse">
              <div class="card-body p-4">
                <p class="m-0">
                  A: Withdrawal of fund is processed on the same working day your request is received provided your request is received during working hours (8am – 5pm).
                </p>
              </div>
            </div>
          </div>
          <div class="card">
            <div id="heading-b11" class="card-header bg-white shadow-sm border-0">
              <h6 class="mb-0 font-weight-bold">
                                    <a
                                       href="#"
                                       data-toggle="collapse"
                                       data-target="#collapse-b11"
                                       aria-expanded="false"
                                       aria-controls="collapse-b11"
                                       class="
                                       d-block
                                       position-relative
                                       collapsed
                                       text-dark
                                       collapsible-link
                                       py-2
                                       "
                                       >Can I invest from any part of the world?
                                    </a>
                                 </h6>
            


            </div>
            <div id="collapse-b11" aria-labelledby="heading-b4" data-parent="#accordion-2" class="collapse">
              <div class="card-body p-4">
                <p class="m-0">
                  A: Yes, you can. Our robust platform allows you to invest from any part of the world by opening an account online.
                </p>
              </div>
            </div>
          </div>
          <div class="card">
            <div id="heading-b12" class="card-header bg-white shadow-sm border-0">
              <h6 class="mb-0 font-weight-bold">
                                    <a
                                       href="#"
                                       data-toggle="collapse"
                                       data-target="#collapse-b12"
                                       aria-expanded="false"
                                       aria-controls="collapse-b12"
                                       class="
                                       d-block
                                       position-relative
                                       collapsed
                                       text-dark
                                       collapsible-link
                                       py-2
                                       "
                                       >Can I add to my investment at any time?
                                    </a>
                                 </h6>
            


            </div>
            <div id="collapse-b12" aria-labelledby="heading-b4" data-parent="#accordion-2" class="collapse">
              <div class="card-body p-4">
                <p class="m-0">
                  A: Yes, you can. Our platform allows you to top up your investment at any time.
                </p>
              </div>
            </div>
          </div>
          <div class="card">
            <div id="heading-b13" class="card-header bg-white shadow-sm border-0">
              <h6 class="mb-0 font-weight-bold">
                                    <a
                                       href="#"
                                       data-toggle="collapse"
                                       data-target="#collapse-b13"
                                       aria-expanded="false"
                                       aria-controls="collapse-b13"
                                       class="
                                       d-block
                                       position-relative
                                       collapsed
                                       text-dark
                                       collapsible-link
                                       py-2
                                       "
                                       >Can I have multiple investment accounts running?
                                    </a>
                                 </h6>
            


            </div>
            <div id="collapse-b13" aria-labelledby="heading-b4" data-parent="#accordion-2" class="collapse">
              <div class="card-body p-4">
                <p class="m-0">
                  A: No, you can not. Registering of multiple accounts in the platform is not advisable.
                </p>
              </div>
            </div>
          </div>
          <div class="card">
            <div id="heading-b14" class="card-header bg-white shadow-sm border-0">
              <h6 class="mb-0 font-weight-bold">
                                    <a
                                       href="#"
                                       data-toggle="collapse"
                                       data-target="#collapse-b14"
                                       aria-expanded="false"
                                       aria-controls="collapse-b14"
                                       class="
                                       d-block
                                       position-relative
                                       collapsed
                                       text-dark
                                       collapsible-link
                                       py-2
                                       "
                                       >Can I transfer my investments from me to someone else?
                                    </a>
                                 </h6>
            


            </div>
            <div id="collapse-b14" aria-labelledby="heading-b4" data-parent="#accordion-2" class="collapse">
              <div class="card-body p-4">
                <p class="m-0">
                  A: Yes, you can. All you need to do is send a duly signed instruction to that effect.
                </p>
              </div>
            </div>
          </div>
          
          <div class="card">
            <div id="heading-b20" class="card-header bg-white shadow-sm border-0">
              <h6 class="mb-0 font-weight-bold">
                                    <a
                                       href="#"
                                       data-toggle="collapse"
                                       data-target="#collapse-b20"
                                       aria-expanded="false"
                                       aria-controls="collapse-b20"
                                       class="
                                       d-block
                                       position-relative
                                       collapsed
                                       text-dark
                                       collapsible-link
                                       py-2
                                       "
                                       >How often can I reinvest?
                                    </a>
                                 </h6>
            


            </div>
            <div id="collapse-b20" aria-labelledby="heading-b4" data-parent="#accordion-2" class="collapse">
              <div class="card-body p-4">
                <p class="m-0">
                  A: You are only allowed to reinvest 5 times in a particular plan.

                </p>
              </div>
            </div>
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
      