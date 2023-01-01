<?php 
require('includes/auth.php');
require('includes/header.php');
require('../includes/dbconnect.php');//DBCONNECTION
$useremail = $_SESSION['useremail'];

//Selecting current user 
$query = "SELECT * FROM `fx_userprofile` WHERE email='$useremail' ";
$result = mysqli_query($con,$query) ;
$row = mysqli_fetch_array($result);
$userbalance =$row['balance'];
$userid =$row['ID'];

$sql = mysqli_query($con, "SELECT * FROM `fx_earnings` WHERE userid='$userid'");
$rows = mysqli_num_rows($sql) ;

$sql3 = mysqli_query($con, "SELECT * FROM `fx_total_earned` WHERE userid='$userid'");   //checking no of earnings

$total_amount_earned = "0";

while($row3 = mysqli_fetch_array($sql3)){
	$total_amount_earned+= $row3['amount_earned'] ;
}
?>
                <div class="page-header">
                    <h3 class="page-title"> Dashboard </h3>
                    <nav aria-label="breadcrumb">
                      <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Earnings</li>
                      </ol>
                    </nav>
                  </div>
                <div class="row">
                    <div class="col-sm-3 col-6 grid-margin">
                      <div class="card">
                        <div class="card-body" style="padding:10px!important;">
                          <h5>Wallet Balance</h5>
                          <div class="row">
                            <div class="col-8 col-sm-12 col-xl-8 my-auto">
                              <div class="d-flex d-sm-block d-md-flex align-items-center">
                                <h3 class="mb-0">$<?php echo number_format($userbalance);?></h3>
                              </div>
                            </div>
                            <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                              <i class="icon-md mdi mdi-wallet text-primary ml-auto"></i>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-3 col-6 grid-margin">
                      <div class="card">
                        <div class="card-body" style="padding:10px!important;">
                          <h5>Total Earnings</h5>
                          <div class="row">
                            <div class="col-8 col-sm-12 col-xl-8 my-auto">
                              <div class="d-flex d-sm-block d-md-flex align-items-center">
                                <h3 class="mb-0">$<?php echo number_format($total_amount_earned); ?></h3>
                              </div>
                            </div>
                            <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                              <i class="icon-md mdi mdi-wallet-travel text-danger ml-auto"></i>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                          <div class="card-body">
                            <h4 class="card-title">All Earnings</h4>
                            <div class="table-responsive">
                              <table class="table table-striped" style="color:white!important;">
                                <thead>
                                  <tr>
                                    <th>package</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                  </tr>
                                </thead>
                                <tbody>
                                <?php
                                    if($rows<1){?>
                                    <div class="alert alert-warning" role="alert">
                                    <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                                    <span class="alert-text"><strong>Warning!</strong> Sorry you have no earning yet choose plan to start earning today</span>
                                    </div>
                                    <?php
                                    }else{
                                    while($row = mysqli_fetch_array($sql)){
                                        $plan =$row["plan"];
                                        $amountearned =$row["amountearned"];
                                        $created =$row["created"];
                                        echo"<tr>
                                    
                                        <th scope='row'>
                                        $plan
                                        </th>
                                        <td>
                                        $$amountearned
                                        </td>
                                        <td>
                                        $created
                                        </td>
                                    </tr>             
                                        ";
                                    }
                                    }
                                    ?>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                </div>
                <?php 
require('includes/footer.php'); 
?>  