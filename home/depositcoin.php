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

///send selecting benifactors profile//
if(isset($_POST["submit1"])){

  $gateway = $_POST["walletname"];
  $usdamount = $_POST["usdamount"];
  $gatewayamount = $_POST["coinamount"];
  $gatewaywallet = $_POST["walletid"];
  $message = $_POST['message'];
  $status = "0";
  $created = date("d/m/Y");

  
     $query1 = mysqli_query($con, "INSERT INTO fx_deposit (userid,gateway,amount,gatewayamount,gatewaywallet,usermessage,depositstatus,createdat) VALUES ('$userid','$gateway','$usdamount','$gatewayamount','$gatewaywallet','$message','0','$created')");
     
     
$to      = "torniqcryptomining@gmail.com"; 

$subject = 'New Deposit Request made by User'; 

$message = '<html><body>';
$message .= '<div style="background-color:black; text-align: center;color: white; font-family: Arial, Helvetica, sans-serif; padding-top:20px; padding-bottom:30px;">';
$message .= "<h1> Hi Admin</h1>";
$message .= "<h1> This user  ". $firstname ." ". $lastname ." made a Deposit request</h1>";
$message .= "<h2>Deposit Amount $". $usdamount ."</h2>";
$message .= '<p>login to your account dashboard to Approve request</p>';
$message .= '</div>';
$message .= '<div style="margin-top:40px;"><center>';
$message .= '<img src="https://torniqstake.com/assets/images/torniqlogo.png" alt="torniq" style="width:400px">';
$message .= '</center></div>';
$message .= "</body></html>";

$message = wordwrap($message, 70, "\r\n");

$headers = 'From: support@torniqstake.com' . "\r\n" . 

    'Reply-To: support@torniqstake.com' . "\r\n" . 
    
    'MIME-Version: 1.0\r\n'. "\r\n" .
    
    'Content-Type: text/html; charset=ISO-8859-1\r\n'. "\r\n" .

    'X-Mailer: PHP/' . phpversion(); 

mail($to, $subject, $message, $headers); 


     
//mail user for deposit request
$to1     = $useremail; 

$subject1 = 'Deposit Request'; 

$message1 = '<html><body>';
$message1 .= '<div style="background-color:black; text-align: center;color: white; font-family: Arial, Helvetica, sans-serif; padding-top:20px; padding-bottom:30px;">';
$message1 .= "<h1> Hello ". $firstname ." ". $lastname ."</h1>";
$message1 .= "<h2>Your Deposit request of $". $usdamount ." have been placed successfully and will be confirmed soon</h2>";
$message1 .= '<p style="color:black;">For more info email support@torniqstake.com</p>';
$message1 .= '</div>';
$message1 .= '<div style="margin-top:40px;"><center>';
$message1 .= '<img src="https://torniqstake.com/assets/images/torniqlogo.png" alt="regalfunds" style="width:400px">';
$message1 .= '</center></div>';
$message1 .= "</body></html>";

$message1 = wordwrap($message1, 70, "\r\n");

$headers1 = 'From: support@torniqstake.com' . "\r\n" . 

    'Reply-To: support@torniqstake.com' . "\r\n" . 
    
    'MIME-Version: 1.0\r\n'. "\r\n" .
    
    'Content-Type: text/html; charset=ISO-8859-1\r\n'. "\r\n" .

    'X-Mailer: PHP/' . phpversion(); 

mail($to1, $subject1, $message1, $headers1); 
        
  }

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
              <?php 
              
              if (isset($_POST['submit1']))
                {
                  if(isset($query1)){
                    echo "
                    <div class='container'><div class='alert alert-success'>Deposit Successfull(redirecting to deposit page in 5 sections)</div></div>";
                }
                else {
                        echo "<div class='container'><div class='alert alert-danger'>Deposit not successfull</div></div>";
                }
                }
                ?>
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <center>
                                <img src="../admin/<?php echo $coin_qr;?>" width="50%" alt="">
                                <h4 class="card-title">Pay $<?php echo $amount;?>  <?php echo $coin_code;?> in one time payment to</h4>
                        <h4 class="card-title text-primary"><?php echo $coin_wallet;?></h4>
                            </center>
                        
                        
                        </div>
                    </div>
                </div>
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <form class="forms-sample" method="POST" action="">
                                <div class="form-group">
                                    <input type="hidden" name="coinid" value="<?php echo $coinid;?>"/>
                                    <input type="hidden" name="walletname" value="<?php echo $coin_code;?>"/>
                                    <input type="hidden" name="usdamount" value="<?php echo $amount;?>"/>
                                    <input type="hidden" name="amount" value="<?php echo $amount;?>"/>
                                    <input type="hidden" name="coinamount" value="<?php echo $coinamount;?>"/>
                                    <input type="hidden" name="walletid" value="<?php echo $coin_wallet;?>"/>

                                    <label for="exampleTextarea1">Deposit Note</label>
                                    <textarea name="message" class="form-control" id="exampleTextarea1" rows="4"></textarea>
                                  </div>
                                  <input type="submit" name="submit1" value="Deposit" class="btn btn-lg btn-primary mr-2">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            <?php 
require('includes/footer.php'); 
?>  