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
$withdraw_balance =$row['withdraw_balance'];
$userid =$row['ID'];
$userfirstname =$row['firstname'];
$userlastname =$row['lastname'];
$useractivestat =$row['activestat'];

if (isset($_POST['amount']))
{
    $amount = $_POST['amount'];
    $balancetype = $_POST['balancetype'];
    $to_user = $_POST['to_user'];

    $datecreated =  date("d-m-Y");

    //Selecting current user 
    $query11 = "SELECT * FROM `fx_userprofile` WHERE email='$to_user' ";
    $result11 = mysqli_query($con,$query11) ;
    $row11 = mysqli_fetch_array($result11);
    $rows11 = mysqli_num_rows($result11) ;

    if($rows11 == 1){
        $to_userbalance =$row11['balance'];
        $to_withdraw_balance =$row11['withdraw_balance'];
        $to_userid =$row11['ID'];
        $to_firstname =$row11['firstname'];
        $to_lastname =$row11['lastname'];
        $new_to_userbalance = $to_userbalance + $amount;
        $new_to_withdraw_balance = $to_withdraw_balance + $amount;

        //mail referee when new user registers
        $to3     = $to_user; 

        $subject3 = 'Credit transaction alert'; 

        $message3 = '<html><body>';
        $message3 .= '<div style="background-color: black; text-align: left;color: white; font-family: Arial, Helvetica, sans-serif; padding:20px;">';
        $message3 .= "<img src='{$sitelogo}' alt='{$sitename}' style='width:200px; display:block; margin:auto;' >";
        $message3 .= "<h3> Hello {$to_firstname} {$to_lastname} </h3>";
        $message3 .= "<h3> You Recieved : $". $amount ." from ".$useremail."</h3>";
        $message3 .= "<p style='color:white;'>Login into your dashboard to view transaction history</p>";
        $message3 .= "<p style='color:white;'>For more info email {$site_support_email}</p>";
        $message3 .= '</div>';
        $message3 .= '<div style="margin-top:40px;"><center>';
        $message3 .= '</center></div>';
        $message3 .= "</body></html>";

        $message3 = wordwrap($message3, 70, "\r\n");
    }


    

    

    $userpassword = $_POST['userpassword'];
    //Checking is user existing in the database or not
	$query = "SELECT * FROM `fx_userprofile` WHERE email='$useremail' and userpassword='$userpassword' ";
    $result = mysqli_query($con,$query) ;
	$rows = mysqli_num_rows($result) ;

    $new_userbalance = $userbalance - $amount;
    $new_withdraw_balance = $withdraw_balance - $amount;

     //mail sender
     $to      = $site_support_email; 

     $subject = 'User Transaction alert'; 

     $message = '<html><body>';
     $message .= '<div style="background-color: black; text-align: left;color: white; font-family: Arial, Helvetica, sans-serif; padding:20px;">';
     $message .= "<img src='{$sitelogo}' alt='{$sitename}' style='width:200px; display:block; margin:auto;' >";
     $message .= "<h3> Hi Admin</h3>";
     $message .= "<h3> A user with email :". $useremail ." sent</h3>";
     $message .= "<h3>Transfer Amount $". $amount ." to </h3>";
     $message .= "<h3>A user with email". $to_user ."</h3>";
     $message .= '<p>login to your account dashboard to confirm this transaction</p>';
     $message .= '</div>';
     $message .= '<div style="margin-top:40px;"><center>';
   
     $message .= '</center></div>';
     $message .= "</body></html>";
     $message = wordwrap($message, 70, "\r\n");

     //mail referee when new user registers
     $to2     = $useremail; 

     $subject2 = 'Debit transaction alert'; 

     $message2 = '<html><body>';
     $message2 .= '<div style="background-color: black; text-align: left;color: white; font-family: Arial, Helvetica, sans-serif; padding:20px;">';
     $message2 .= "<img src='{$sitelogo}' alt='{$sitename}' style='width:200px; display:block; margin:auto;' >";
     $message2 .= "<h3> Hello {$userfirstname} {$userlastname} </h3>";
     $message2 .= "<h3> You sent : $". $amount ." to ".$to_user."</h3>";
   
     $message2 .= "<p style='color:white;'>Login into your dashboard to view transaction history</p>";
     $message2 .= "<p style='color:white;'>For more info email {$site_support_email}</p>";
     $message2 .= '</div>';
     $message2 .= '<div style="margin-top:40px;"><center>';
     $message2 .= '</center></div>';
     $message2 .= "</body></html>";

     $message2 = wordwrap($message2, 70, "\r\n");

    

    if($rows11 == 1){
        if($rows==1)
        {
            if($balancetype == 1){
                if($amount <= $userbalance ){
                    //update sender
                    $sqlquery = "UPDATE fx_userprofile 
                    SET balance='$new_userbalance'
                    WHERE ID='$userid' " ;
                    $sqlresult = mysqli_query($con,$sqlquery) ;

                    

                    // update to user
                    $sqlquery11 = "UPDATE fx_userprofile 
                    SET balance='$new_to_userbalance'
                    WHERE email='$to_user' " ;
                    $sqlresult11 = mysqli_query($con,$sqlquery11) ;

                    $insertquery1 = mysqli_query($con, "INSERT INTO `transaction` (from_user,to_user,amount,created) VALUES ('$userid','$to_userid','$amount','$datecreated')"); 

                    if($sqlresult && $sqlresult11 && $insertquery1){
                        $success = "Funds sent successfully";
                        // mailto($to, $subject, $message);
                        // mailto($to2, $subject2, $message2);
                        // mailto($to3, $subject3, $message3);
                    }
                }else{
                    $error = "insufficient funds to complete this transaction";
                }
            }elseif($balancetype == 2){
                if($amount <= $withdraw_balance ){
                    $sqlquery = "UPDATE fx_userprofile 
                    SET withdraw_balance='$new_withdraw_balance'
                    WHERE ID='$userid' " ;
                    $sqlresult = mysqli_query($con,$sqlquery) ;

                    // update to user
                    $sqlquery11 = "UPDATE fx_userprofile 
                    SET withdraw_balance='$new_to_withdraw_balance'
                    WHERE email='$to_user' " ;
                    $sqlresult11 = mysqli_query($con,$sqlquery11) ;

                    $insertquery1 = mysqli_query($con, "INSERT INTO `transaction` (from_user,to_user,amount,created) VALUES ('$userid','$to_userid','$amount','$datecreated')"); 

                    if($sqlresult && $sqlresult11 && $insertquery1){
                        $success = "Funds sent successfully";
                        // mailto($to, $subject, $message);
                        // mailto($to2, $subject2, $message2);
                        // mailto($to3, $subject3, $message3);
                    }
                }else{
                    $error = "insufficient funds to complete this transaction";
                }
            }
        }else{
            $error =  "Password is wrong";
        }

    }else{
        $error =  "No user with such Email try again";
    }   

}

$sql12 = mysqli_query($con, "SELECT * FROM `transaction` WHERE from_user='$userid' OR to_user='$userid' order by ID desc");   //checking no of transaction
$rows12 = mysqli_num_rows($sql12) ;


?>
              <div class="page-header">
                <h3 class="page-title"> Transaction</h3>
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Transaction
                    </li>
                  </ol>
                </nav>
              </div>
              <div class="row">
                
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                    <?php 
                        if(isset($_POST["amount"])){
                            if(isset($success)){
                                echo "
                                <div class='container'><div class='alert alert-success'>$success</div></div>";
                            }else {
                                echo "<div class='container'><div class='alert alert-danger'> $error</div></div>";
                            }
                        
                        }
                        ?>
                        <div class="card-body">
                        <h4 class="card-title">Send Funds</h4>
                        <form class="forms-sample" method="POST" action="">
                          <div class="row">
                          <div class="col-lg-12">
                            <div class="form-group">
                              <label style="font-size:20px;" class="form-control-label" for="input-username"
                                >Choose Balance</label
                              >
                              <select required name="balancetype" style="color:white;" class="form-control" id="inputGroupSelect02">
                                <option value='1'>Wallet Balance</option>
                                <option value='2'>Withdrawable balance</option>
                              </select>
                            </div>
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
                                name="amount"
                                step="any"
                              />
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-lg-12">
                            <div class="form-group">
                              <label style="font-size:25px;" class="form-control-label" for="input-first-name"
                                >Recipient Email</label
                              >
                              <input 
                                required 
                                type="email"
                                id="input-first-name"
                                class="form-control text-white"
                                placeholder="Recipient email"
                                name="to_user"
                                step="any"
                              />
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-lg-12">
                            <div class="form-group">
                              <label style="font-size:25px;" class="form-control-label" for="input-first-name"
                                >Input your password to confirm transaction</label
                              >
                              <input 
                                required 
                                type="text"
                                id="input-first-name"
                                class="form-control text-white"
                                placeholder="Password"
                                name="userpassword"
                                step="any"
                              />
                            </div>
                          </div>
                        </div>
                            <input class="btn btn-primary mr-2" type="submit" value="Send" name="submit"/>
                           
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
                          <table class="table table-striped">
                            <thead>
                              <tr>
                                <th> Transacton ID</th>
                                <th> Amount</th>
                                <th> Transaction</th>
                                <th> User</th>
                                <th> Date</th>
                              </tr>
                            </thead>
                            <tbody>
                            <?php
                            if($rows12<1){?>
                            <div class="alert alert-warning" role="alert">
                            <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                            <span class="alert-text">No Transactions yet</span>
                            </div>
                            <?php
                            }else{
                            while($row12 = mysqli_fetch_array($sql12)){
                                $from_user1 =$row12["from_user"];
                                $to_user1 =$row12["to_user"];
                                $amount1 =$row12["amount"];
                                $created1 =$row12["created"];
                                $transactionid1 =$row12["ID"];

                                if($from_user1 == $userid){
                                    $transactionstatus = "<label class='badge badge-danger'>Sent</label>";
                                    //Selecting to_user 
                                    $query111 = "SELECT * FROM `fx_userprofile` WHERE ID='$to_user1' ";
                                    $result111 = mysqli_query($con,$query111) ;
                                    $row111 = mysqli_fetch_array($result111);
                                    $to_email111 =$row111['email'];

                                    echo"<tr>
                            
                                    <th scope='row'>
                                    #$transactionid1
                                    </th>
                                    <td>
                                    $amount1
                                    </td>
                                    <td>
                                    $transactionstatus
                                    </td>
                                    <td>
                                    $to_email111
                                    </td>
                                    <td>
                                    $created1
                                    </td>
                                </tr>             
                                    ";

                                }elseif($to_user == $userid){
                                    $transactionstatus = "<label class='badge badge-success'>Recieved</label>";

                                    //Selecting to_user 
                                    $query111 = "SELECT * FROM `fx_userprofile` WHERE ID='$from_user1' ";
                                    $result111 = mysqli_query($con,$query111) ;
                                    $row111 = mysqli_fetch_array($result111);
                                    $from_email111 =$row111['email'];

                                    echo"<tr>
                            
                                    <th scope='row'>
                                    #$transactionid1
                                    </th>
                                    <td>
                                    $amount1
                                    </td>
                                    <td>
                                    $transactionstatus
                                    </td>
                                    <td>
                                    $from_email111
                                    </td>
                                    <td>
                                    $created1
                                    </td>
                                    </tr>
                                    ";

                                }

                                
                               
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