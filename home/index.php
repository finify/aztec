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
$withdraw_balance =$row['withdraw_balance'];
$userid =$row['ID'];
$userfirstname =$row['firstname'];
$userlastname =$row['lastname'];
$useractivestat =$row['activestat'];

//returns will come in here
require('returns.php');//automatic returns
//returns will come in here



//counting user details 
$sql1 = mysqli_query($con, "SELECT * FROM `fx_investment` WHERE userid='$userid'");   //checking no of investments
$sql2 = mysqli_query($con, "SELECT * FROM `fx_investment` WHERE userid='$userid'");   //checking no of investments
$sql3 = mysqli_query($con, "SELECT * FROM `fx_total_earned` WHERE userid='$userid'");   //checking no of earnings

$no_investment = "0";
$amount_invested = "0";
$total_amount_earned = "0";
while($row = mysqli_fetch_array($sql1)){
	$no_investment++;
}
while($row2 = mysqli_fetch_array($sql2)){
	$amount_invested+= $row2['amountinvested'] ;
}
while($row3 = mysqli_fetch_array($sql3)){
	$total_amount_earned+= $row3['amount_earned'] ;
}

$sql4 = mysqli_query($con, "SELECT * FROM `fx_investment` WHERE userid='$userid' order by ID desc");
$rows = mysqli_num_rows($sql4) ;

$sql5 = mysqli_query($con, "SELECT * FROM `fx_notification` WHERE userid='$userid' order by ID desc");
$rows1 = mysqli_num_rows($sql5) ;



?>
                <div class="page-header">
                    <h3 class="page-title"> Dashboard </h3>
                    <nav aria-label="breadcrumb">
                      <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
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
                    <div class="col-sm-3 col-6 grid-margin">
                      <div class="card">
                        <div class="card-body" style="padding:10px!important;">
                          <h5>Withdrawable Balance</h5>
                          <div class="row">
                            <div class="col-8 col-sm-12 col-xl-8 my-auto">
                              <div class="d-flex d-sm-block d-md-flex align-items-center">
                                <h3 class="mb-0">$<?php echo number_format($withdraw_balance) ; ?></h3>
                              </div>
                            </div>
                            <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                              <i class="icon-md mdi mdi-monitor text-success ml-auto"></i>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-3 col-6 grid-margin">
                      <div class="card">
                        <div class="card-body" style="padding:10px!important;">
                          <h5>Total Invested</h5>
                          <div class="row">
                            <div class="col-8 col-sm-12 col-xl-8 my-auto">
                              <div class="d-flex d-sm-block d-md-flex align-items-center">
                                <h3 class="mb-0">$<?php echo number_format($amount_invested); ?></h3>
                              </div>
                            </div>
                            <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                              <i class="icon-md mdi mdi-monitor text-warning ml-auto"></i>
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
                            <h4 class="card-title">All Investment</h4>
                            <div class="table-responsive">
                              <table class="table table-striped" style="color:white!important;">
                                <thead>
                                  <tr>
                                  <th>package</th>
                                  <th>Amount</th>
                                  <th>Amount earned</th>
                                  <th>Status</th>
                                  <th>Created</th>
                                  <th>Expire</th>
                                  </tr>
                                </thead>
                                <tbody>
                                <?php
                                  if($rows<1){?>
                                    <div class="alert alert-warning" role="alert">
                                    <span class="alert-icon"><i class="ni ni-fat-remove"></i></span>
                                    <span class="alert-text">Sorry you have not made any investment yet</span>
                                    </div>
                                    <?php
                                  }else{
                                    while($row4 = mysqli_fetch_array($sql4)){
                                      $plan_name =$row4["plan_name"];
                                      $plan_id =$row4["ID"];
                                      $amountinvested =$row4["amountinvested"];
                                      $amount_earned =$row4["amount_earned"];
                                      $plan_status =$row4["plan_status"];
                                      $created =$row4["created"];
                                      $endingdate =$row4["endingdate"];
                                      
                                      
                                      if($plan_status == 0){
                                        $plan_status = "<span class='bg-primary badge badge-dot p-2'>
                                        <i class='bg-default'></i>
                                        <span class='status'>ACTIVE</span>
                                      </span>";
                                      }elseif($plan_status == 3){
                                        $plan_status = "<span class='bg-default badge badge-dot p-2'>
                                        <i class='bg-primary'></i>
                                        <span class='status'>PENDING</span>
                                      </span>";
                                      }else{
                                        $plan_status = "<span class='bg-danger badge badge-dot p-2'>
                                        <i class='bg-primary'></i>
                                        <span class='status'>EXPIRED</span>
                                      </span>";
                                      } 
                                      echo"<tr>
                                    
                                      <th scope='row'>
                                       #$plan_id $plan_name
                                      </th>
                                      <td>
                                      $$amountinvested
                                      </td>
                                      <td>
                                      $$amount_earned
                                      </td>
                                      <td>
                                      $plan_status
                                      </td>
                                      <td>
                                      $created
                                      </td>
                                      <td>
                                      $endingdate
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