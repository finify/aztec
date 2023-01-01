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
$eth =$row['eth'];
$btc =$row['btc'];
$usdt =$row['usdt'];


//data to fill out the page
if (isset($_POST['wallettype']))
{
  $wallettype = $_POST['wallettype'];
  $btc = $_POST["btc"];
  $eth = $_POST["eth"];
  $usdt = $_POST["usdt"];

  if($wallettype == 1){
    $walletname = "BTC";
    $userwalletid = $btc;
  }elseif($wallettype == 2){
    $walletname = "ETH";
    $userwalletid = $eth;
  }elseif($wallettype == 3){
    $walletname = "USDT";
    $userwalletid = $usdt;
  }

}
// On withdraw action clicked
if(isset($_POST["submit"])){

  $usdamount = $_POST["usdamount"];
 
  
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
                                <label for="exampleSelectGender">Gender</label>
                                <select  name="wallettype" class="form-control" id="exampleSelectGender">
                                <option selected>Choose...</option>
                                <option value="1">Bitcoin</option>
                                <option value="2">Litecoin</option>
                                <option value="3">Ethereum</option>
                                <option value="4">Binance</option>
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

            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title">Withdrawal History</h4>
                        <div class="table-responsive">
                          <table class="table table-striped" >
                            <thead>
                              <tr>  
                              <th>Amount</th>
                                <th>Payment method</th>
                                <th>Wallet id</th>
                                <th>Status</th>
                                <th>created</th>
                              </tr>
                            </thead>
                            <tbody>
                            <?php
                            if($rows<1){?>
                            <div class="alert alert-warning" role="alert">
                            <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                            <span class="alert-text"><strong>Warning!</strong> You have not made any withdrawals yet</span>
                            </div>
                            <?php
                                }else{
                                while($row4 = mysqli_fetch_array($sql4)){
                                    $amount =$row4["amount"];
                                    $gateway =$row4["gateway"];
                                    $userwalletid =$row4["userwalletid"];
                                    $amount =$row4["amount"];
                                    $amount =$row4["amount"];
                                    $created =$row4["created"];
                                    $withdrawalstatus =$row4["withdrawalstatus"];
                                    if($withdrawalstatus == 0){
                                    $withdrawalstatus = " <label class='badge badge-danger'>Pending</label>";
                                    }else{
                                    $withdrawalstatus = " <label class='badge badge-success'>Approved</label>";
                                    }
                                    echo"<tr>
                                
                                    <th scope='row'>
                                    $$amount
                                    </th>
                                    <th scope='row'>
                                    $gateway
                                    </th>
                                    <th scope='row'>
                                    $userwalletid
                                    </th>
                                    <td>
                                    $withdrawalstatus
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