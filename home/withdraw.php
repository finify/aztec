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
$firstname =$row['firstname'];
$lastname =$row['lastname'];
$useremail =$row['email'];
$withdraw_balance =$row['withdraw_balance'];

//data to fill out the page
if (isset($_POST['wallettype']))
{
  $wallettype = $_POST['wallettype'];

  if($wallettype == 1){
    $walletname = "BTC";
  }elseif($wallettype == 2){
    $walletname = "ETH";
  }elseif($wallettype == 3){
    $walletname = "USDT";
  }

}
// On withdraw action clicked
if(isset($_POST["submit"])){

  $usdamount = $_POST["usdamount"];
  $userwalletid = $_POST["userwalletid"];
 
  
  $created = date("Y/m/d");
  $status = 0;
  
  
  $to      = $site_admin_email;  

  $subject = 'New Withdrawal Request made by User'; 

  $message = '<html><body>';
  $message .= '<div style="background-color: black; text-align: left;color: white; font-family: Arial, Helvetica, sans-serif; padding:20px;">';
  $message .= "<img src='{$sitelogo}' alt='{$sitename}' style='width:200px; display:block; margin:auto;' >";
  $message .= "<h3> Hi Admin</h3>";
  $message .= "<h3> This user  ". $firstname ." ". $lastname ." made a withdrawal request</h3>";
  $message .= "<h3>Withdrawal Amount $". $usdamount ."</h3>";
  $message .= "<h3>wallet id : ". $userwalletid ."</h3>";
  $message .= "<h3>wallet type: ". $walletname ."</h3>";
  $message .= '<p>login to your account dashboard to Approve request</p>';
  $message .= '</div>';
  $message .= "</body></html>";

  $message = wordwrap($message, 70, "\r\n");


  mailto($to, $subject, $message); 


  //mail user for withdrawal request
  $to1     = $useremail; 

  $subject1 = 'Withdrawal Request'; 

  $message1 = '<html><body>';
  $message1 .= '<div style="background-color: black; text-align: left;color: white; font-family: Arial, Helvetica, sans-serif; padding:20px;">';
  $message1 .= "<img src='{$sitelogo}' alt='{$sitename}' style='width:200px; display:block; margin:auto;' >";
  $message1 .= "<3> Hello ". $firstname ." ". $lastname ."</h3>";
  $message1 .= "<h3>Your Withdrawal request of $". $usdamount ." have been placed successfully and will be confirmed soon</h3>";
  $message1 .= "<p style='color:white;'>For more info email {$site_support_email}</p>";
  $message1 .= '</div>';
  $message1 .= "</body></html>";

  $message1 = wordwrap($message1, 70, "\r\n");


  mailto($to1, $subject1, $message1); 




    if($withdraw_balance >= $usdamount && $usdamount >=10){
      $query1 = mysqli_query($con, "INSERT INTO fx_withdrawal (userid,gateway,amount,userwalletid ,withdrawalstatus,created) VALUES ('$userid','$walletname','$usdamount','$userwalletid','$status','$created')"); 

      $newwithdraw_balance = $withdraw_balance - $usdamount;
      $sqlquery = "UPDATE fx_userprofile 
      SET withdraw_balance='$newwithdraw_balance'
      WHERE ID='$userid' " ;
      $sqlresult = mysqli_query($con,$sqlquery) ;
    }else{
      $amounterror = "Invalid amount please try again";
    }
  
  }

  
$sql4 = mysqli_query($con, "SELECT * FROM `fx_withdrawal` WHERE userid='$userid' order by ID desc");
$rows = mysqli_num_rows($sql4) ;

//Selecting current user 
$query = "SELECT * FROM `fx_userprofile` WHERE email='$useremail' ";
$result = mysqli_query($con,$query) ;
$row = mysqli_fetch_array($result);
$withdraw_balance =$row['withdraw_balance'];


?>
              <div class="page-header">
                <h3 class="page-title"> Withdraw</h3>
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Withdraw
                    </li>
                  </ol>
                </nav>
              </div>
              <div class="row">
              <?php 
                if(isset($_POST["submit"])){

                    if($withdraw_balance >= $usdamount && $usdamount >=10){
                    if($query1){
                      echo "
                      <div class='container'><div class='alert alert-success'>Your Withdraw order have been placed successfully</div></div>";
                    }
                    else {?>
                          <div class='container'><div class='alert alert-danger'> Error occured while trying to make your investment please try again</div></div>
                    <?php }
                  }else{?>
                    <div class='container'><div class='alert alert-danger'>Please choose a valid amount</div></div>
                  <?php }
                }
              ?>
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                    <h2 class="h2 text-default mb-4">
                        Your Balance = <?php echo number_format($withdraw_balance) ; ?>
                        </h2>
                        <div class="card-body">
                        <h4 class="card-title">Withdraw</h4>
                        <form class="forms-sample" method="POST" action="">
                            <div class="form-group">
                                <label for="exampleSelectGender">Wallet type</label>
                                <select  name="wallettype" class="form-control" id="exampleSelectGender">
                                <option selected>Choose...</option>
                                <option value="1">Bitcoin</option>
                                <option value="2">Ethereum</option>
                                <option value="3">Usdt</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername1">Amount</label>
                                <input name="usdamount" type="number" class="form-control" id="exampleInputUsername1" placeholder="Amount">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername1">Wallet</label>
                                <input  name="userwalletid" required type="text" class="form-control" id="exampleInputUsername1" placeholder="wallet id">
                            </div>
                            <input type="submit" name="submit" value="Submit" class="btn btn-primary mr-2" >
                          
                        </form>
                        </div>
                    </div>
                </div>
            </div>
            
            <?php 
require('includes/footer.php'); 
?>  