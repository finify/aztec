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

      if($plan_max == ""){
        if($usdamount >= $plan_min){
            $amountearned = ((($plan_roi / 100)*$usdamount) * $plan_duration ) + $usdamount;
            $forcast = "You will make $$amountearned in $plan_duration days";
        }
      }else{
        if($usdamount >= $plan_min && $usdamount <= $plan_max){
            $amountearned = ((($plan_roi / 100)*$usdamount) * $plan_duration)+ $usdamount;
            $forcast = "You will make $$amountearned in $plan_duration days";
        }else{
          $error = "Please choose a correct amount for plan selected";
        }
      }
    
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
                            if(isset($forcast)){
                                echo  "<div class='container'><div class='alert alert-success'>$forcast</div></div>";
                            }else {
                                echo "<div class='container'><div class='alert alert-danger'> $error</div></div>";
                            }
                        
                        }
                        ?>
                        <div class="card-body">
                        <h4 class="card-title">Income forecast</h4>
                        <form class="forms-sample" method="POST" action="">
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

            <?php 
require('includes/footer.php'); 
?>  