<?php 
require('includes/auth.php');
require('includes/header.php');
require('../includes/dbconnect.php');//DBCONNECTION
require('../includes/mail.php');
$useremail = $_SESSION['useremail'];

//Selecting current user 
$query = "SELECT * FROM `fx_userprofile` WHERE email='$useremail' ";
$result = mysqli_query($con,$query) ;
$row = mysqli_fetch_array($result);
$userbalance =$row['balance'];
$userid =$row['ID'];
$firstname =$row['firstname'];
$lastname =$row['lastname'];

//Selecting settings
$query = "SELECT * FROM `fx_settings` WHERE ID='1' ";
$result = mysqli_query($con,$query) ;
$row = mysqli_fetch_array($result);
$deposit_type =$row['deposit_type'];

if($deposit_type == 0){ //manually invest after deposit
    //data to fill out the page
    if (isset($_POST['coinid']))
    {
      $coinid = $_POST['coinid'];
      $amount = $_POST['amount'];

      //Selecting current refer
    $query1 = "SELECT * FROM `fx_coin` WHERE ID='$coinid' ";
    $result1 = mysqli_query($con,$query1) ;
    $row1 = mysqli_fetch_array($result1);
    $coin_id =$row1['ID'];
    $coin_name =$row1['coin_name'];
    $coin_code =$row1['coin_code'];
    $coin_qr =$row1['coin_qr'];
    $coin_wallet =$row1['coin_wallet'];

    $coin_code = strtoupper($coin_code);

    $url = "https://min-api.cryptocompare.com/data/price?tsyms=USD&fsym=".$coin_code;
      $json = json_decode(file_get_contents($url));
      foreach($json as $obj){
        $avalue = $obj;
        $amountusd =  $amount;
        $coinamount = $amountusd / $avalue ;
      }

    }

    //making deposit
    if(isset($_POST["submit1"])){

      $gateway = $_POST["walletname"];
      $usdamount = $_POST["usdamount"];
      $gatewayamount = $_POST["coinamount"];
      $gatewaywallet = $_POST["coin_code"];
      $message = $_POST['message'];
      $status = "0";
      $created = date("Y/m/d");

      
      $query1 = mysqli_query($con, "INSERT INTO fx_deposit (userid,gateway,amount,gatewayamount,gatewaywallet,usermessage,depositstatus,createdat) VALUES ('$userid','$gateway','$usdamount','$gatewayamount','$gatewaywallet','$message','0','$created')");
          
          
          //mail admin for user deposit
      $to      = $site_admin_email; 

      $subject = 'New Deposit Request made by User'; 

      $message = '<html><body>';
      $message .= '<div style="background-color: black; text-align: left;color: white; font-family: Arial, Helvetica, sans-serif; padding:20px;">';
      $message .= "<img src='{$sitelogo}' alt='{$sitename}' style='width:200px; display:block; margin:auto;' >";
      $message .= "<h3> Hi Admin</h1>";
      $message .= "<h3> This user  ". $firstname ." ". $lastname ." made a Deposit request</h3>";
      $message .= "<h3>Deposit Amount $". $usdamount ."</h3>";
      $message .= '<p>login to your account dashboard to Approve request</p>';
      $message .= '</div>';
      $message .= "</body></html>";

      $message = wordwrap($message, 70, "\r\n");


      mailto($to, $subject, $message); 


          
      //mail user for deposit request
      $to1     = $useremail; 

      $subject1 = 'Deposit Request'; 

      $message1 = '<html><body>';
      $message1 .= '<div style="background-color: black; text-align: left;color: white; font-family: Arial, Helvetica, sans-serif; padding:20px;">';
      $message1 .= "<img src='{$sitelogo}' alt='{$sitename}' style='width:200px; display:block; margin:auto;' >";
      $message1 .= "<h3> Hello ". $firstname ." ". $lastname ."</h3>";
      $message1 .= "<h3>Your Deposit request of $". $usdamount ." have been placed successfully and will be confirmed soon</h3>";
      $message1 .= "<p style='color:white;'>For more info email {$site_support_email}</p>";
      $message1 .= '</div>';
      $message1 .= "</body></html>";

      $message1 = wordwrap($message1, 70, "\r\n");


      mailto($to1, $subject1, $message1); 
            
    }
}else{ //what happens if deposit type is 1 which is invest on deposit
  //data to fill out the page
  if (isset($_POST['coinid']))
  {
    $coinid = $_POST['coinid'];
    $amount = $_POST['amount'];

    //Selecting current refer
    $query1 = "SELECT * FROM `fx_coin` WHERE ID='$coinid' ";
    $result1 = mysqli_query($con,$query1) ;
    $row1 = mysqli_fetch_array($result1);
    $coin_id =$row1['ID'];
    $coin_name =$row1['coin_name'];
    $coin_code =$row1['coin_code'];
    $coin_qr =$row1['coin_qr'];
    $coin_wallet =$row1['coin_wallet'];

    $coin_code = strtoupper($coin_code);

    $url = "https://min-api.cryptocompare.com/data/price?tsyms=USD&fsym=".$coin_code;
      $json = json_decode(file_get_contents($url));
      foreach($json as $obj){
        $avalue = $obj;
        $amountusd =  $amount;
        $coinamount = $amountusd / $avalue ;
      }

    }
   $plan_name = $_POST["plan_name"];
   $amount = $_POST['amount'];

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
    

    if($plan_roi_type == "daily" || $plan_roi_type == "after"){
        $plan_returns = "";
        for ($x = 1; $x <= $plan_duration; $x++) {
          $d=strtotime("+$x Days");
          $nextdate = date("d-m-Y", $d);
    
          $plan_returns = $plan_returns. ',' . $nextdate; 
        }
     }else{
        $plan_returns = "";
        $plan_week = 0;
        for ($x = 1; $x <= $plan_duration; $x++) {
          $plan_week += 7;
          $d=strtotime("+$plan_week Days");
          $nextdate = date("d-m-Y", $d);
          $plan_returns = $plan_returns. ',' . $nextdate; 
        }
     }

    if($plan_max == ""){
      if($amount >= $plan_min){
        $status="passed";
      }else{
        $error = "Please choose a correct amount for plan selected";
      }
    }else{
      if($amount >= $plan_min && $amount <= $plan_max){
        $status="passed";
      }else{
        $error = "Please choose a correct amount for plan selected";
      }
    }

    //making deposit
    if(isset($_POST["submit1"])){

      $gateway = $_POST["walletname"];
      $usdamount = $_POST["usdamount"];
      $gatewayamount = $_POST["coinamount"];
      $gatewaywallet = $_POST["coin_code"];
      $message = $_POST['message'];
      $status = "0";
      $created = date("Y/m/d");

      $query1 = mysqli_query($con, "INSERT INTO `fx_investment` (userid,plan_name,plan_min,plan_max,plan_roi,plan_roi_type,plan_duration,plan_returns,amount_earned,plan_status,created,endingdate,amountinvested) VALUES ('$userid','$plan_name','$plan_min','$plan_max','$plan_roi','$plan_roi_type','$plan_duration','$plan_returns','0','3','$datecreated','$endingdate','$usdamount')");

      $last_id = mysqli_insert_id($con);

      $query1 = mysqli_query($con, "INSERT INTO fx_deposit (userid,gateway,amount,gatewayamount,gatewaywallet,usermessage,depositstatus,createdat,investmentid) VALUES ('$userid','$gateway','$usdamount','$gatewayamount','$gatewaywallet','$message','0','$created','$last_id')");


      
          
          
          //mail admin for user deposit
      $to      = $site_admin_email; 

      $subject = 'New Deposit Request made by User'; 

      $message = '<html><body>';
      $message .= '<div style="background-color: black; text-align: left;color: white; font-family: Arial, Helvetica, sans-serif; padding:20px;">';
      $message .= "<img src='{$sitelogo}' alt='{$sitename}' style='width:200px; display:block; margin:auto;' >";
      $message .= "<h3> Hi Admin</h3>";
      $message .= "<h3> This user  ". $firstname ." ". $lastname ." made a Deposit request</h3>";
      $message .= "<h3>Deposit Amount $". $usdamount ."</h3>";
      $message .= '<p>login to your account dashboard to Approve request</p>';
      $message .= '</div>';
      $message .= "</body></html>";

      $message = wordwrap($message, 70, "\r\n");


      // mailto($to, $subject, $message); 


          
      //mail user for deposit request
      $to1     = $useremail; 

      $subject1 = 'Deposit Request'; 

      $message1 = '<html><body>';
      $message1 .= '<div style="background-color: black; text-align: left;color: white; font-family: Arial, Helvetica, sans-serif; padding:20px;">';
      $message1 .= "<img src='{$sitelogo}' alt='{$sitename}' style='width:200px; display:block; margin:auto;' >";
      $message1 .= "<h3> Hello ". $firstname ." ". $lastname ."</h3>";
      $message1 .= "<h3>Your Deposit request of $". $usdamount ." have been placed successfully and will be confirmed soon</h3>";
      $message1 .= "<p style='color:white;'>For more info email {$site_support_email}</p>";
      $message1 .= '</div>';
      $message1 .= "</body></html>";

      $message1 = wordwrap($message1, 70, "\r\n");


      // mailto($to1, $subject1, $message1); 
            
    }

}




?>
            <div class="page-header">
                <h3 class="page-title"> Dashboard</h3>
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Payment</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Payment Checkout</li>
                  </ol>
                </nav>
              </div>
              <div class="row">
              <?php 
              if(isset($_POST["submit1"])){
                if($query1){
                  echo "
                  <center><img width='20%' height='100%' src='assets/img/uploaddone.gif'/></center>
                  
                  <div class='container'><div class='alert alert-success'>Your deposit order have been placed Successfully , it will be approved shortly if you have made the payment</div></div>";
                }
                else {
                      echo "<div class='container'><div class='alert alert-danger'>Couldnot Deposit/div></div>";
                }
              }else{
                ?>
                <?php
                  if(isset($error)){
                    echo "<div class='container'><div class='alert alert-danger'> $error</div></div>";
                  }else{
                  }
                ?>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                          <div class="d-flex flex-row justify-content-between">
                            <h4 class="card-title mb-1">Sending Details</h4>
                          </div>
                          <div class="row">
                            <div class="col-12">
                                <center>
                                <img src="../admin/<?php echo $coin_qr;?>" width="70%" alt="image" /> 
                                </br>
                                <div class="preview-item-content d-sm-flex flex-grow">
                                  <div class="flex-grow">
                                  </br>
                                    <h3 class="preview-subject"><?php echo $coinamount ?> <?php echo $coin_code ?></h3>
                                    </br>
                                    <h3 class="preview-subject">Send <?php echo $coinamount ?> <?php echo $coin_code ?> (in ONE payment) to:</h3>
                                    </br>
                                    <h3 class="preview-subject"><?php echo $coin_wallet ?></h3>
                                    
                                  </div>
                                </div>
                                </center>
                            </div>
                          </div>
                        </div>
                      </div>
                </div>
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                        <h4 class="card-title">Checkout</h4>
                        <form class="forms-sample" method="POST" action="">
                            <div class="form-group">
                            <input
                              value="<?php echo $coin_code?>"
                              name="walletname"
                              type="hidden"
                            />
                            <input
                              value="<?php echo $amount?>"
                              name="usdamount"
                              type="hidden"
                            />
                            <input
                              value="<?php echo $amount?>"
                              name="amount"
                              type="hidden"
                            />
                            <input
                              value="<?php echo $plan_name?>"
                              name="plan_name"
                              type="hidden"
                            />
                            <input
                              value="<?php echo $coinamount?>"
                              name="coinamount"
                              type="hidden"
                            />
                            <input
                              value="<?php echo $coin_code?>"
                              name="coin_code"
                              type="hidden"
                            />
                            <label for="exampleInputUsername1">short note(optional)</label>
                            <input type="text" class="form-control text-white" value="message"
                      name="message" id="exampleInputUsername1" placeholder="Note">
                            </div>
                            
                            <?php
                            if(isset($error)){
                            }else{
                            echo'<input type="submit" name="submit1" class="btn btn-primary mr-2 value="Complete Deposit" >';

                          }
                          ?>
                        </form>
                        </div>
                    </div>
                </div>
            </div>

            <?php } ?>
            
            <?php 
require('includes/footer.php'); 
?>  