<?php 
require('../includes/settings.php'); 
require('../includes/dbconnect.php');//DBCONNECTION
$username = $_SESSION['useremail'];

//Selecting current user 
$query = "SELECT * FROM `fx_userprofile` WHERE email='$username' ";
$result = mysqli_query($con,$query) ;
$row = mysqli_fetch_array($result);
$userbalance =$row['balance'];
$userid =$row['ID'];
$userfirstname =$row['firstname'];
$userlastname =$row['lastname'];
$useremail =$row['email'];
$username =$row['username']; 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $sitetitle; ?></title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="assets/vendors/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.theme.default.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="../assets/images/torniqfavicon.png" />

    <style>
        .menu-title{
            color:white!important;
        }
    </style>
  </head>
  <body>
    <div class="container-scroller">
         <!-- sidebar start-->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
            <a class="sidebar-brand brand-logo" href="index.html"><img src="../img/aztecmininglogo.png" alt="logo" /></a>
            <a class="sidebar-brand brand-logo-mini" href="index.html"><img src="../img/aztecmininglogo.png" alt="logo" /></a>
            </div>
            <ul class="nav">
            <li class="nav-item profile">
                <div class="profile-desc">
                <div class="profile-pic">
                    <div class="count-indicator">
                    <img class="img-xs rounded-circle " src="assets/images/faces-clipart/pic-8.png" alt="">
                    <span class="count bg-success"></span>
                    </div>
                    <div class="profile-name">
                    <h5 class="mb-0 font-weight-normal"><?php echo $userfirstname.' '.$userlastname;?></h5>
                    </div>
                </div>
                </div>
            </li>
            <li class="nav-item nav-category">
                <span class="nav-link">Menu</span>
            </li>
            <li class="nav-item menu-items">
                <a class="nav-link" href="index.php">
                <span class="menu-icon">
                    <i class="mdi mdi-speedometer"></i>
                </span>
                <span class="menu-title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item menu-items">
                <a class="nav-link" href="deposit.php">
                <span class="menu-icon">
                    <i class="mdi mdi-briefcase-upload"></i>
                </span>
                <span class="menu-title">Deposit</span>
                </a>
            </li>
            <li class="nav-item menu-items">
                <a class="nav-link" href="invest.php">
                <span class="menu-icon">
                    <i class="mdi mdi-briefcase-upload"></i>
                </span>
                <span class="menu-title">Invest</span>
                </a>
            </li>
            <li class="nav-item menu-items">
                <a class="nav-link" href="earnings.php">
                <span class="menu-icon">
                    <i class="mdi mdi mdi-camera-timer"></i>
                </span>
                <span class="menu-title">Earnings</span>
                </a>
            </li>
            <li class="nav-item menu-items">
                <a class="nav-link" href="withdraw.php">
                <span class="menu-icon">
                    <i class="mdi mdi-rocket"></i>
                </span>
                <span class="menu-title">Withdrawal</span>
                </a>
            </li>
            <li class="nav-item menu-items">
                <a class="nav-link" href="transaction.php">
                <span class="menu-icon">
                    <i class="mdi mdi-sync-alert"></i>
                </span>
                <span class="menu-title">Transaction</span>
                </a>
            </li>
            <li class="nav-item menu-items">
                <a class="nav-link" href="kyc.php">
                <span class="menu-icon">
                    <i class="mdi mdi-account-card-details"></i>
                </span>
                <span class="menu-title">Kyc</span>
                </a>
            </li>
            <li class="nav-item menu-items">
                <a class="nav-link" href="incomeforecast.php">
                <span class="menu-icon">
                    <i class="mdi mdi-alarm-multiple"></i>
                </span>
                <span class="menu-title">Income Forecast</span>
                </a>
            </li>
            <li class="nav-item menu-items">
                <a class="nav-link" href="referals.php">
                <span class="menu-icon">
                    <i class="mdi mdi-account-multiple-plus"></i>
                </span>
                <span class="menu-title">Referral</span>
                </a>
            </li>
            <li class="nav-item menu-items">
                <a class="nav-link" href="../includes/logout.php">
                <span class="menu-icon">
                    <i class="mdi mdi-logout"></i>
                </span>
                <span class="menu-title">logout</span>
                </a>
            </li>
            </ul>
        </nav>
        <!-- sidebar end-->
        <!-- nav start-->
        <nav class="navbar p-0 fixed-top d-flex flex-row">
            <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
            <a class="navbar-brand brand-logo-mini" href="index.html"><img src="../img/aztecminingfavicon.png" alt="logo" style="width:50px!important;"/></a>
            </div>
            <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                <span class="mdi mdi-menu"></span>
            </button>
            <ul class="navbar-nav w-100">
                <li class="nav-item w-100">
                  <form class="nav-link mt-2 mt-md-0 d-none d-lg-flex search">
                    <input type="text" class="form-control" placeholder="">
                  </form>
                </li>
            </ul>
            <ul class="navbar-nav navbar-nav-right">
                <li class="nav-item dropdown">
                <a class="nav-link" id="profileDropdown" href="#" data-toggle="dropdown">
                    <div class="navbar-profile">
                    <img class="img-xs rounded-circle" src="assets/images/faces-clipart/pic-8.png" alt="">
                    <p class="mb-0 d-none d-sm-block navbar-profile-name"><?php echo $userfirstname.' '.$userlastname;?></p>
                    <i class="mdi mdi-menu-down d-none d-sm-block"></i>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="profileDropdown">
                    <h6 class="p-3 mb-0">Profile</h6>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item preview-item" href="settings.php">
                    <div class="preview-thumbnail">
                        <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-settings text-success"></i>
                        </div>
                    </div>
                    <div class="preview-item-content">
                       <p class="preview-subject mb-1" href="index.php">User Settings</p>
                    </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item preview-item" href="../includes/logout.php">
                    <div class="preview-thumbnail">
                        <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-logout text-danger"></i>
                        </div>
                    </div>
                    <div class="preview-item-content">
                        <p class="preview-subject mb-1">Log out</p>
                    </div>
                    </a>
                </div>
                </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                <span class="mdi mdi-format-line-spacing"></span>
            </button>
            </div>
        </nav>
        <div class="main-panel">
            <div class="content-wrapper">
                <!-- nav end-->