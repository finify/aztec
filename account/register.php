<?php
session_start();
require('../includes/dbconnect.php');
require('../includes/settings.php');
require('../includes/mail.php');


if(isset($_SESSION["username"])){
  header("Location: ../home");
  exit(); 
}
if(isset($_SESSION["refcode"])){
	$refercode = $_SESSION["refcode"];
}else{
	$refercode = 'No Referral';
}
if (isset($_REQUEST['firstname']))
{
    //cleaning input for db upload
	$firstname = stripslashes($_REQUEST['firstname']);
	$firstname = mysqli_real_escape_string($con,$firstname);

	$lastname = stripslashes($_REQUEST['lastname']);
	$lastname = mysqli_real_escape_string($con,$lastname);
	
	$username = stripslashes($_REQUEST['username']);
	$username = mysqli_real_escape_string($con,$username);

	$Email = stripslashes($_REQUEST['Email']);
	$Email = mysqli_real_escape_string($con,$Email);
	
	$userpassword = stripslashes($_REQUEST['userpassword']);
	$userpassword = mysqli_real_escape_string($con,$userpassword);

	$refcode = stripslashes($_REQUEST['refcode']);
	$refcode = mysqli_real_escape_string($con,$refcode);

    if($refcode == ""){ //if refcode is empty set to 0
	    $refcode = 0;
	  }
	
    $sql5 = mysqli_query($con, "SELECT * FROM `fx_userprofile` WHERE refcode='$refcode'");
    $rows1 = mysqli_num_rows($sql5) ;

    if($rows1<1){
      $refcode = 0;
    }else{
	    //Selecting referal user 
		$query = "SELECT * FROM `fx_userprofile` WHERE refcode='$refcode' ";
		$result = mysqli_query($con,$query) ;
		$row2 = mysqli_fetch_array($result);
		$referemail =$row2['email'];
		$referfirstname =$row2['firstname'];
		$referlastname =$row2['lastname'];
		
		
	  }
	
    $confirm_userpassword = stripslashes($_REQUEST['confirm_userpassword']);
    $confirm_userpassword = mysqli_real_escape_string($con,$confirm_userpassword);

    $balance = 0;
    
    $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
    $userrefcode = substr(str_shuffle($permitted_chars), 0,5);
    
    $created = date("Y/m/d");

    $query = "SELECT * FROM `fx_userprofile` WHERE email='$Email' or username='$username' " ;//query to select input with same details as in db
    $result = mysqli_query($con,$query);
    $rows = mysqli_num_rows($result);

  if($rows==1)//if user already exist
	{
    $error = 'This user already Exists please try again with another detail';
    include('includes/header.php');
  }else{
    if($userpassword == $confirm_userpassword){
      //insert into userprofile//
    $query1 = "INSERT  into `fx_userprofile` 
    (username,firstname,lastname,email,btc,eth,usdt,activestat,userpassword,refcode,reffereeid,balance,withdraw_balance,created)
    VALUES 
    ('$username','$firstname','$lastname','$Email','0','0','0','1','$userpassword','$userrefcode','$refcode','$balance','$balance','$created')";
    $result1 = mysqli_query($con,$query1);
    if($result1)
    { 
      if($refcode != 0){ //if refcode is set to not 0 email
        //mail referee when new user registers
        $to2     = $referemail; 

        $subject2 = 'New Referral Registration'; 

        $message2 = '<html><body>';
        $message2 .= '<div style="background-color: black; text-align: left;color: white; font-family: Arial, Helvetica, sans-serif; padding:20px;">';
        $message2 .= "<img src='{$sitelogo}' alt='{$sitename}' style='width:200px; display:block; margin:auto;' >";
        $message2 .= "<h3> Hello {$referfirstname} {$referlastname} </h3>";
        $message2 .= "<h3> You Reffered : ". $firstname ." ". $lastname ."</h3>";
        $message2 .= "<p>You will recieve {$referral_commision}% of the first deposit this user makes</p>";
        $message2 .= '<p style="color:white;">For more info email {$site_support_email}</p>';
        $message2 .= '</div>';
        $message2 .= "</body></html>";
        
        mailto($to2, $subject2, $message2);
      }

      //mail user that signed up
      $to      = $Email; 
      $subject = 'Registration Confirmation'; 

      $message = '<html><body>';
      $message .= '<div style="background-color: black; text-align: left;color: white; font-family: Arial, Helvetica, sans-serif; padding:20px;">';
      $message .= "<img src='{$sitelogo}' alt='{$sitename}' style='width:200px; display:block; margin:auto;' >";
      $message .= "<h3> Hello {$firstname} {$lastname} </h3>";
      $message .= "<p>You Have successfully registered for {$sitename} </p>";
      $message .= '<p>Please take note of your registration details</p>';
      $message .= "<h3>User Email : {$Email}  </h3>";
      $message .= "<h3>User Password : {$userpassword} </h3>";
      $message .= "<p>Click <a href='{$siteurl}account/confirmuser.php?activate={$userrefcode}'>Here</a> to activate your account</p>";
      $message .= "<p>Visit {$siteurl}login to make you first deposit and start investing</p>";
      $message .= "<p>Thanks for joining {$sitename}.</p>";
      $message .= "<p style='color:white;'>For more info email {$site_support_email}</p>";
      $message .= '</div>';
      $message .= "</body></html>";

      $message = wordwrap($message, 70, "\r\n");

      
      
      mailto($to, $subject, $message); 


      //mail admin when new user registers
      $to1     = $site_admin_email; 

      $subject1 = 'New User Registration'; 

      $message1 = '<html><body>';
      $message1 .= '<div style="background-color: black; text-align: left;color: white; font-family: Arial, Helvetica, sans-serif; padding:20px;">';
      $message1 .= "<img src='{$sitelogo}' alt='{$sitename}' style='width:200px; display:block; margin:auto;' >";
      $message1 .= "<h3> Hello Admin </h3>";
      $message1 .= "<h3> User name: ". $firstname ." ". $lastname ."</h3>";
      $message1 .= '<p>User Registration details are</p>';
      $message1 .= "<h3>User Email : {$Email}  </h3>";
      $message1 .= "<h3>User Password : {$userpassword} </h3>";
      $message1 .= '</div>';
      $message1 .= "</body></html>";

      $message1 = wordwrap($message1, 70, "\r\n"); 

      mailto($to1, $subject1, $message1); 

      include('includes/header.php');
      echo "<div class='form' style='background-color:white; align-content:center;'>
      <center>
      <img src='../img/success.png' alt='errorimage' width='100px' height='100px'/>
      <br/>
      <h3>Your registration was successful</h3> <br/>
      <h3>Please check your email to activate your account with the link provided</h3> <br/>
      <a href='../account/login.php' class='btn btn-secondary btn-block btn-lg'>Login</a>
      </center>
      </div>
      ";
      include('includes/footer.php');
      die();
  
    }
  }else{
    $error = 'Password do not match ';
    include('includes/header.php');
  }
}
}else{
  include('includes/header.php');
}
?>

      <form method="post">
        <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
        <input type="hidden" name="action" value="validate_captcha">
        <div class="card">
          <div class="card-body pb-1">
          <?php 
              if(isset($_REQUEST['firstname'])){
                  if(isset($error)){
                    echo "<div class='container'><div class='alert alert-danger'> $error</div></div>";
                  }
              }
              ?>
            <div class="form-group basic">
              <div class="input-wrapper">
                <label class="label" for="email1">First name</label>
                <input type="text" class="form-control" name="firstname" required>
              </div>
            </div>
            <div class="form-group basic">
              <div class="input-wrapper">
                <label class="label" for="email1">Last name</label>
                <input type="text" class="form-control" name="lastname" required>
              </div>
            </div>

            <div class="form-group basic">
              <div class="input-wrapper">
                <label class="label" for="email1">Username</label>
                <input type="text" class="form-control" name="username" required>
              </div>
            </div>

            <div class="form-group basic">
              <div class="input-wrapper">
                <label class="label" for="email1">Email</label>
                <input type="email" class="form-control" name="Email" required>
              </div>
            </div>

            <div class="form-group basic">
              <div class="input-wrapper">
                <label class="label" for="password1">Password</label>
                <input type="password" class="form-control" name="userpassword" required>
              </div>
            </div>
            <div class="form-group basic">
              <div class="input-wrapper">
                <label class="label" for="password1">Confirm Password</label>
                <input type="password" class="form-control" name="confirm_userpassword" required>
              </div>
            </div>
            <div class="form-group basic">
              <div class="input-wrapper">
                <label class="label" for="password1">Referred By(Optional)</label>
                <input type="text" name="refcode" class="form-control" value="<?= $refercode ?>" readonly>
              </div>
            </div>
            <div class="form-group basic">
              <div class="input-wrapper">
                Have an account? <a href="login.php" class="text-primary">Login</a>
              </div>
            </div>
            <input type="submit" class="btn btn-secondary btn-block btn-lg" name="register" value="Continue">
          </div>
        </div>

      </form>
    </div>

  </div>
<?php
include('includes/footer.php');
?>