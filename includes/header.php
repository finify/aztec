<?php
session_start();
include('settings.php');
require('includes/dbconnect.php');//DBCONNECTION
?>
<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <title>
    Home | Aztecmining  </title>
  <meta property="og:title" content="Aztecmining">
  <meta name="author" content="Aztecmining">
  <meta name="description" content="Aztecmining is a leading, independent Digital Assets Investment platform that provides bespoke financial solutions that add value to our individual and institutional clients. We are licensed and regulated by the Securities & Exchange Commission (SEC) and Financial Industry Regulatory Authority ( FINRA ) to provide Investment Banking, Asset Management and Securities services to our discerning clientele.">
  <meta name="keywords" content="Aztecminingtrading.com">
  <meta property="og:locale" content="en_US">
  <meta property="og:description" content="Aztecmining is a leading, independent Digital Assets Investment platform that provides bespoke financial solutions that add value to our individual and institutional clients. We are licensed and regulated by the Securities & Exchange Commission (SEC) and Financial Industry Regulatory Authority ( FINRA ) to provide Investment Banking, Asset Management and Securities Trading services to our discerning clientele.">
  <meta name="og:keywords" content="Aztecminingtrading.com">
  <meta property="og:url" content="index.php">
  <meta property="og:site_name" content="Aztecmining">
  <meta name="theme-color" content="#9f03fb">
  <meta property="og:image" content="account/upload/peer_fav.png"/>
  <link rel="canonical" href="Aztecmining.php">
  <!-- favicon & bookmark -->
  <link rel="apple-touch-icon" sizes="144x144" href="account/upload/peer_fav.png">
  <link rel="shortcut icon" href="account/upload/peer_fav.png">

  <meta name="robots" content="index, follow"/>
  <!-- Chrome, Firefox OS and Opera -->
  <meta name="theme-color" content="#9f03fb">
  <!-- Windows Phone -->
  <meta name="msapplication-navbutton-color" content="#9f03fb"/>
  <!-- iOS Safari -->
  <style>
    :root {
      --primary_color: #9f03fb;
      --secondary_color: #0f00af;
      --primary_color-rgb: 4,61,247;
    }
  </style>
  <link href="assets/css/coloring.css" rel="stylesheet" type="text/css"/>
  <link href="assets/css/style.css" rel="stylesheet" type="text/css"/>
  
  <meta name="apple-mobile-web-app-status-bar-style" content="#9f03fb"/>
  <link id="bootstrap" href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
  <link id="bootstrap-grid" href="assets/css/bootstrap-grid.min.css" rel="stylesheet" type="text/css"/>
  <link id="bootstrap-reboot" href="assets/css/bootstrap-reboot.min.css" rel="stylesheet" type="text/css"/>
  <link href="assets/css/animate.css" rel="stylesheet" type="text/css"/>
  <link href="assets/css/owl.carousel.css" rel="stylesheet" type="text/css"/>
  <link href="assets/css/owl.theme.css" rel="stylesheet" type="text/css"/>
  <link href="assets/css/owl.transitions.css" rel="stylesheet" type="text/css"/>
  <link href="assets/css/magnific-popup.css" rel="stylesheet" type="text/css"/>
  <link href="assets/css/jquery.countdown.css" rel="stylesheet" type="text/css"/>
  
  <!-- color scheme -->

  
  <link href="assets/fonts/font-awesome/css/font-awesome.css" rel="stylesheet">
  <link rel="stylesheet" href="account/assets/css/others.css">
  <script async src="pagead2.googlesyndication.com/pagead/js/f1ca8.txt?client=ca-pub-1216412245248140" crossorigin="anonymous"></script>
  <script src="account/assets/javascript/language.js"></script>
  <script type="text/javascript" src="translate.google.com/translate_a/element7876.js?cb=googleTranslateElementInit2"></script>
  <script>
	function multiply() {
		amount = Number( document.calculator.amount.value );
		percent = Number( document.calculator.percent.value );
    
    function thousands_separators( num ) {
        var num_parts = num.toString().split( "." );
        num_parts[ 0 ] = num_parts[ 0 ].replace( /\B(?=(\d{3})+(?!\d))/g, "," );
        return num_parts.join( "." );
      };
    
		document.getElementById( "profit" ).innerHTML = thousands_separators(( amount * percent ) + amount);
		document.getElementById( "netProfit" ).innerHTML = thousands_separators(amount * percent);

	}
</script>
</head>

<body>
  <div id="preloader">
    <div class="spinner">
      <div class="bounce1"></div>
      <div class="bounce2"></div>
      <div class="bounce3"></div>
    </div>
  </div>
  <div id="wrapper">
    <div id="topbar" class="text-white bg-color" style="background-color: var(--secondary_color)">
      <div class="container">
        <div class="topbar-left sm-hide">
          <span class="topbar-widget tb-social">
                  <a href="https://www.facebook.com/sharer/sharer.php?u=https://Aztecminingtrading.com"><i class="fa fa-facebook"></i></a>
                  <a href="https://twitter.com/intent/tweet?url=https://Aztecminingtrading.com"><i class="fa fa-twitter"></i></a>
                  <a href="#"><i class="fa fa-instagram"></i></a>
                  </span>
        </div>
        <div class="topbar-right">
          <span class="topbar-widget"><a href="#" style="margin-top: -4px"><i class="fa fa-envelope"></i>support@Aztecminingtrading.com</a></span>
          <span class="topbar-widget">
            
<style>
.lang {
			width: 120px;
			border-radius: 20px;
		}
		@media only screen and (max-width: 600px) {
			.lang {
				width: 50px;
			border-radius: 20px;
			}

		}
		
</style>
<div class="top-bar-item top-bar-item-full" id="id_100">
						<select onchange="doGTranslate(this);" class="text-primary lang">
							<option value="">EN</option>
							<option value="en|af">Afrikaans</option>
							<option value="en|sq">Albanian</option>
							<option value="en|ar">Arabic</option>
							<option value="en|hy">Armenian</option>
							<option value="en|az">Azerbaijani</option>
							<option value="en|eu">Basque</option>
							<option value="en|be">Belarusian</option>
							<option value="en|bg">Bulgarian</option>
							<option value="en|ca">Catalan</option>
							<option value="en|zh-CN">Chinese (Simplified)</option>
							<option value="en|zh-TW">Chinese (Traditional)</option>
							<option value="en|hr">Croatian</option>
							<option value="en|cs">Czech</option>
							<option value="en|da">Danish</option>
							<option value="en|nl">Dutch</option>
							<option value="en|en">English</option>
							<option value="en|et">Estonian</option>
							<option value="en|tl">Filipino</option>
							<option value="en|fi">Finnish</option>
							<option value="en|fr">French</option>
							<option value="en|gl">Galician</option>
							<option value="en|ka">Georgian</option>
							<option value="en|de">German</option>
							<option value="en|el">Greek</option>
							<option value="en|ht">Haitian Creole</option>
							<option value="en|iw">Hebrew</option>
							<option value="en|hi">Hindi</option>
							<option value="en|hu">Hungarian</option>
							<option value="en|is">Icelandic</option>
							<option value="en|id">Indonesian</option>
							<option value="en|ga">Irish</option>
							<option value="en|it">Italian</option>
							<option value="en|ja">Japanese</option>
							<option value="en|ko">Korean</option>
							<option value="en|lv">Latvian</option>
							<option value="en|lt">Lithuanian</option>
							<option value="en|mk">Macedonian</option>
							<option value="en|ms">Malay</option>
							<option value="en|mt">Maltese</option>
							<option value="en|no" >Norwegian</option>
							<option value="en|fa">Persian</option>
							<option value="en|pl">Polish</option>
							<option value="en|pt">Portuguese</option>
							<option value="en|ro">Romanian</option>
							<option value="en|ru">Russian</option>
							<option value="en|sr">Serbian</option>
							<option value="en|sk">Slovak</option>
							<option value="en|sl">Slovenian</option>
							<option value="en|es">Spanish</option>
							<option value="en|sw">Swahili</option>
							<option value="en|sv">Swedish</option>
							<option value="en|th">Thai</option>
							<option value="en|tr">Turkish</option>
							<option value="en|uk">Ukrainian</option>
							<option value="en|ur">Urdu</option>
							<option value="en|vi">Vietnamese</option>
							<option value="en|cy">Welsh</option>
							<option value="en|yi">Yiddish</option>
						</select>
						<div id="google_translate_element2"></div>
					</div>          </span>
        </div>
        <div class="clearfix"></div>
      </div>
    </div>
    <!-- header begin -->
    <header class="transparent">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="de-flex sm-pt10" id="logo-mobile-fix">
              <div class="de-flex-col">
                <!-- logo begin -->
                <div id="logo">
                  <a href="index.php">
                              <img alt="" class="logo" src="img/aztecmininglogo.png" style="width:200px"/>
                              <img alt="" class="logo-2" src="img/aztecmininglogo.png" style="width:100%"/>
                              </a>
                
                </div>
                <!-- logo close -->
              </div>
              <style>
                a.nnav:hover {
                  color: #ffcc29 !important;
                }
              </style>
              <div class="de-flex-col header-col-mid">
                <!-- mainmenu begin -->
                <ul id="mainmenu">
                  <li>
                    <a href="index.php" class="nnav">Home<span></span></a>
                  </li>
                  <li>
                    <a href="about.php" class="nnav">About Us<span></span></a>
                  </li>
            
                  <li>
                    <a href="index.php#plans" class="nnav">Plans<span></span></a>
                  </li>
                  
                  <li>
                    <a href="index.php#testimonials" class="nnav">Testimonials<span></span></a>
                  </li>
                  <li>
                    <a href="index.php#contact" class="nnav">Contact Us<span></span></a>
                  </li>
                  <li>
                    <a href="assets/sec_doc.pdf" class="nnav">SEC regulation<span></span></a>
                  </li>
                </ul>
              </div>
              <div class="de-flex-col">
                <a class="btn-custom" href="account/login.php" style="background-color: #ffcc29; color: #000">LOGIN <i class="fa fa-arrow-right"></i ></a>
                <span id="menu-btn"></span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>