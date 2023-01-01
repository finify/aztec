<?php 
require('includes/auth.php');
require('includes/header.php');
require('../includes/dbconnect.php');//DBCONNECTION
$useremail = $_SESSION['useremail'];

//Selecting settings
$query = "SELECT * FROM `fx_settings` WHERE ID='1' ";
$result = mysqli_query($con,$query) ;
$row = mysqli_fetch_array($result);
$deposit_type =$row['deposit_type'];

$sql1 = mysqli_query($con, "SELECT * FROM `fx_plan_category` order by category_order ASC");   //checking no of investments
$rows1 = mysqli_num_rows($sql1) ;


$sql = mysqli_query($con, "SELECT * FROM `fx_coin` order by ID desc");
$rows = mysqli_num_rows($sql) ;


$sql4 = mysqli_query($con, "SELECT * FROM `fx_deposit` WHERE userid='$userid' order by ID desc");
$rows4 = mysqli_num_rows($sql4) ;
?>
              <div class="page-header">
                <h3 class="page-title"> Deposit</h3>
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Deposit
                    </li>
                  </ol>
                </nav>
              </div>
              <div class="row">
                
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                        <h4 class="card-title">Deposit</h4>
                        <form class="forms-sample" method="POST" action="payment.php">
                            
                        <?php
                        if($deposit_type == 1){?>
                          <div class="row">
                          <div class="col-lg-12">
                            <div class="form-group">
                              
                              <label style="font-size:17px;" class="form-control-label" for="inputGroupSelect02"
                                >Choose plan</label
                              >
                              <select required name="plan_name" style="color:white;" class="form-control" id="inputGroupSelect02">
                              <?php
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
                                        echo"<option value='$plan_name'>$plan_name PLAN</option>";
                
                                        }
                                      }
                                    }
                                  }
                                ?>
                              </select>
                            </div>
                          </div>
                        </div>

                        <?php } ?>
                        <div class="row">
                          <div class="col-lg-12">
                            <div class="form-group">

                              <label style="font-size:17px;" class="form-control-label" for="input-username"
                                >Choose payment method</label
                              >
                              <select required name="coinid" style="color:white;" class="form-control" id="inputGroupSelect02">
                              <?php
                                          if($rows<1){?>
                                            <option>No coin</option>
                                            <?php
                                          }else{
                                            echo " <option value=''>Select coin</option>";
                                            while($row1 = mysqli_fetch_array($sql)){
                                              $coin_id =$row1["ID"];

                                              $coin_name =$row1["coin_name"];

                                              echo"<option value='$coin_id'>$coin_name</option>
                                              ";
                                            }
                                          }
                                          ?>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-lg-12">
                            <div class="form-group">
                              <label style="font-size:17px;" class="form-control-label" for="input-first-name"
                                >Amount in USD</label
                              >
                              <input 
                                required 
                                type="number"
                                id="input-first-name"
                                class="form-control text-white"
                                placeholder="Amount"
                                name="amount"
                                step="any"
                              />
                            </div>
                          </div>
                        </div>
                            <input class="btn btn-primary mr-2" type="submit" value="Deposit" name="submit"/>
                           
                        </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title">Deposit History</h4>
                        <div class="table-responsive">
                          <table class="table table-striped text-white">
                            <thead>
                              <tr>
                                <th> Amount</th>
                                <th> Coin </th>
                                <th> status</th>
                                <th> Date</th>
                              </tr>
                            </thead>
                            <tbody>
                            <?php
                            if($rows4<1){?>
                            <div class="alert alert-warning" role="alert">
                            <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                            <span class="alert-text">You have not made any deposit yet</span>
                            </div>
                            <?php
                            }else{
                            while($row4 = mysqli_fetch_array($sql4)){
                                $gatewayamount =$row4["gatewayamount"];
                                $gateway =$row4["gateway"];
                                $amount =$row4["amount"];
                                $created =$row4["createdat"];
                                $depositstatus =$row4["depositstatus"];

                                if($depositstatus == 0){
                                $depositstatus = "<label class='badge badge-danger'>Pending</label>";
                                }else{
                                $depositstatus = "<label class='badge badge-success'>Approved</label>";
                                } 
                                echo"<tr>
                            
                                <th scope='row'>
                                $ $amount
                                </th>
                                <td>
                                $gateway
                                </td>
                                <td>
                                $depositstatus
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