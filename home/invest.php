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
$userrefferee =$row['reffereeid'];


//Selecting settings
$query = "SELECT * FROM `fx_settings` WHERE ID='1' ";
$result = mysqli_query($con,$query) ;
$row = mysqli_fetch_array($result);
$deposit_type =$row['deposit_type'];

if($deposit_type == 1){ //invest immediately on deposit
      ///send selecting benifactors profile//
      if(isset($_POST["submit"])){

          $plan_name = $_POST["plan_name"];
          $usdamount = $_POST["usdamount"];

          //Selecting current user 
          $query = "SELECT * FROM `fx_investments_plans` WHERE plan_name='$plan_name' ";
          $result = mysqli_query($con,$query) ;
          $row12 = mysqli_fetch_array($result);
          $planid =$row12["ID"];
          $plan_name =$row12["plan_name"];
          $plan_min =$row12["plan_min"];
          $plan_max =$row12["plan_max"];
          $plan_roi =$row12["plan_roi"];
          $plan_roi_type =$row12["plan_roi_type"];
          $plan_order =$row12["plan_order"];
          $plan_duration =$row12["plan_duration"];

          $datecreated =  date("d-m-Y");
          $d=strtotime('+'.$plan_duration.' Days');
          $endingdate = date("d-m-Y", $d);

          // $plan_duration1 = $plan_duration - 1 ;
            $plan_returns = "";
            for ($x = 1; $x <= $plan_duration; $x++) {
                $d=strtotime("+$x Days");
                $nextdate = date("d-m-Y", $d);

                $plan_returns = $plan_returns. ',' . $nextdate; 
          }

          if($withdraw_balance >= $usdamount){
            if($plan_max == ""){
              $query1 = mysqli_query($con, "INSERT INTO `fx_investment` (userid,plan_name,plan_min,plan_max,plan_roi,plan_roi_type,plan_duration,plan_returns,amount_earned,plan_status,created,endingdate,amountinvested) VALUES ('$userid','$plan_name','$plan_min','$plan_max','$plan_roi','$plan_roi_type','$plan_duration','$plan_returns','0','0','$datecreated','$endingdate','$usdamount')"); 
              
                $newbalance = $withdraw_balance - $usdamount;
                $sqlquery = "UPDATE fx_userprofile 
                SET withdraw_balance='$newbalance'
                WHERE ID='$userid' " ;
                $sqlresult = mysqli_query($con,$sqlquery) ;
            }else{
              if($usdamount >= $plan_min && $usdamount <= $plan_max){
                $query1 = mysqli_query($con, "INSERT INTO `fx_investment` (userid,plan_name,plan_min,plan_max,plan_roi,plan_roi_type,plan_duration,plan_returns,amount_earned,plan_status,created,endingdate,amountinvested) VALUES ('$userid','$plan_name','$plan_min','$plan_max','$plan_roi','$plan_roi_type','$plan_duration','$plan_returns','0','0','$datecreated','$endingdate','$usdamount')"); 

                $newbalance = $withdraw_balance - $usdamount;
                $sqlquery = "UPDATE fx_userprofile 
                SET withdraw_balance='$newbalance'
                WHERE ID='$userid' " ;
                $sqlresult = mysqli_query($con,$sqlquery) ;

              }else{
                $error = "Please choose a correct amount for plan selected";
              }
            }
          }else{
            $error = "Please you do not have sufficent balance to make this investment";
          }
      }

      //Selecting current user 
      $query = "SELECT * FROM `fx_userprofile` WHERE email='$useremail' ";
      $result = mysqli_query($con,$query) ;
      $row = mysqli_fetch_array($result);
      $userbalance =$row['withdraw_balance'];
      $userid =$row['ID'];
  }else{
      ///send selecting benifactors profile//
      if(isset($_POST["submit"])){

        $plan_name = $_POST["plan_name"];
        $usdamount = $_POST["usdamount"];

        //Selecting current user 
        $query = "SELECT * FROM `fx_investments_plans` WHERE plan_name='$plan_name' ";
        $result = mysqli_query($con,$query) ;
        $row12 = mysqli_fetch_array($result);
        $planid =$row12["ID"];
        $plan_name =$row12["plan_name"];
        $plan_min =$row12["plan_min"];
        $plan_max =$row12["plan_max"];
        $plan_roi =$row12["plan_roi"];
        $plan_roi_type =$row12["plan_roi_type"];
        $plan_order =$row12["plan_order"];
        $plan_duration =$row12["plan_duration"];

        $datecreated =  date("d-m-Y");
        $d=strtotime('+'.$plan_duration.' Days');
        $endingdate = date("d-m-Y", $d);

        // $plan_duration1 = $plan_duration - 1 ;
          $plan_returns = "";
          for ($x = 1; $x <= $plan_duration; $x++) {
              $d=strtotime("+$x Days");
              $nextdate = date("d-m-Y", $d);

              $plan_returns = $plan_returns. ',' . $nextdate; 
        }

        if($userbalance >= $usdamount){
          if($plan_max == ""){
            $query1 = mysqli_query($con, "INSERT INTO `fx_investment` (userid,plan_name,plan_min,plan_max,plan_roi,plan_roi_type,plan_duration,plan_returns,amount_earned,plan_status,created,endingdate,amountinvested) VALUES ('$userid','$plan_name','$plan_min','$plan_max','$plan_roi','$plan_roi_type','$plan_duration','$plan_returns','0','0','$datecreated','$endingdate','$usdamount')"); 
            
              $newbalance = $userbalance - $usdamount;
              $sqlquery = "UPDATE fx_userprofile 
              SET balance='$newbalance'
              WHERE ID='$userid' " ;
              $sqlresult = mysqli_query($con,$sqlquery) ;
          }else{
            if($usdamount >= $plan_min && $usdamount <= $plan_max){
              $query1 = mysqli_query($con, "INSERT INTO `fx_investment` (userid,plan_name,plan_min,plan_max,plan_roi,plan_roi_type,plan_duration,plan_returns,amount_earned,plan_status,created,endingdate,amountinvested) VALUES ('$userid','$plan_name','$plan_min','$plan_max','$plan_roi','$plan_roi_type','$plan_duration','$plan_returns','0','0','$datecreated','$endingdate','$usdamount')"); 

              $newbalance = $userbalance - $usdamount;
              $sqlquery = "UPDATE fx_userprofile 
              SET balance='$newbalance'
              WHERE ID='$userid' " ;
              $sqlresult = mysqli_query($con,$sqlquery) ;

            }else{
              $error = "Please choose a correct amount for plan selected";
            }
          }
        }else{
          $error = "Please you do not have sufficent balance to make this investment";
        }
    }

    //Selecting current user 
    $query = "SELECT * FROM `fx_userprofile` WHERE email='$useremail' ";
    $result = mysqli_query($con,$query) ;
    $row = mysqli_fetch_array($result);
    $userbalance =$row['balance'];
    $userid =$row['ID'];
  }

  $sql1 = mysqli_query($con, "SELECT * FROM `fx_plan_category` order by category_order ASC");   //checking no of investments
  $rows1 = mysqli_num_rows($sql1) ;

  
?>
              <div class="page-header">
                <h3 class="page-title"> Deposit</h3>
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Income forecast
                    </li>
                  </ol>
                </nav>
              </div>
              <div class="row">
                
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <?php 
                        if(isset($_POST["submit"])){
                            if(isset($sqlresult) && isset($query1)){
                                echo "
                                <div class='container'><div class='alert alert-success'>Your Investment have been made successfully</div></div>";
                            }else {
                                echo "<div class='container'><div class='alert alert-danger'> $error</div></div>";
                            }
                        
                        }
                        ?>
                        <div class="card-body">
                        <h4 class="card-title">Make an Investment</h4>
                        <form class="forms-sample" method="POST" action="">
                        <h3>Your balance available for investing is $<?= number_format($userbalance)?></h3>
                        <div class="row">
                          <div class="col-lg-12">
                            <label style="font-size:20px;" class="form-control-label" for="input-username">Choose investment plan</label> 
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
                          
                        
                        <div class="row">
                          <div class="col-lg-12">
                            <div class="form-group">
                              <label style="font-size:25px;" class="form-control-label" for="input-first-name"
                                >Amount in USD</label
                              >
                              <input 
                                required 
                                type="number"
                                id="input-first-name"
                                class="form-control text-white"
                                placeholder="Amount"
                                name="usdamount"
                                step="any"
                              />
                            </div>
                          </div>
                        </div>
                            <input class="btn btn-primary mr-2" type="submit" value="Calculate" name="submit"/>
                           
                        </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
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

              echo "<div class='col-12'>";
              echo "<center><h1>$category_name PLANS</h1> </center>";
              echo "<div class='card-deck'>";
              
              
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

                  if($plan_max == ""){
                    $plan_max = "∞";
                  }

                  echo" 
                  <div class='card'>
                    <div class='text-default text-center card-header'>$plan_name PLAN</div>
                    <h4
                      class='card-title h4 text-center text-default font-style-arial mb-0'
                    >
                      (minimum)
                    </h4>
                    <h1
                      class='card-title h1 text-center text-default font-style-arial mb-0'
                    >
                      $$plan_min
                    </h1>
                    <h4
                      class='card-title h4 text-center text-default font-style-arial mb-0'
                    >
                      (maximum)
                    </h4>
                    <h1
                      class='card-title h1 display-1 text-center text-default font-style-arial mb-0'
                    >
                      $$plan_max
                    </h1>
                    <h4
                      class='card-title h4 text-center text-default font-style-arial mb-0'
                    >
                    $plan_roi% Profit $plan_roi_type for $plan_duration $plan_duration_suf
                    </h4>
                    <h4
                      class='card-title h4 text-center text-default font-style-arial mb-0'
                    >
                    <i class='ni text-center ni-check-bold text-primary'></i
                          > $plan_category plan
                    </h4>
                  </div>         
                  ";
                }
              }

              echo "</div>";          
              echo "</div>";          
            }
          }
        ?>
            </div>

            <?php 
require('includes/footer.php'); 
?>  