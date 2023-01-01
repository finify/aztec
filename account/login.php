<?php
session_start();
require('../includes/dbconnect.php');
if(isset($_SESSION["username"])){
  header("Location: ../home");
  exit(); 
}
if (isset($_POST['Email']))
{
    // removes backslashes
	$Email = stripslashes($_REQUEST['Email']);
    //escapes special characters in a string
	$Email = mysqli_real_escape_string($con,$Email);	
	$userpassword = stripslashes($_REQUEST['userpassword']);
	$userpassword = mysqli_real_escape_string($con,$userpassword);
	//Checking is user existing in the database or not
	$query = "SELECT * FROM `fx_userprofile` WHERE email='$Email' and userpassword='$userpassword' ";
  $query2 = "SELECT * FROM `fx_adminuser` WHERE useremail='$Email' and userpassword='$userpassword' ";
	$result2 = mysqli_query($con,$query2) ;
	$rows2 = mysqli_num_rows($result2) ;

	$result = mysqli_query($con,$query) ;
	$rows = mysqli_num_rows($result) ;
	if($rows==1)
	{
    $query4 = "SELECT * FROM `fx_userprofile` WHERE email='$Email' and userpassword='$userpassword' and activestat='0' ";
    $result4 = mysqli_query($con,$query4) ;
	  $rows4 = mysqli_num_rows($result4) ;

    if($rows4==1){
      $_SESSION['useremail'] = $Email;
		// Redirect user to index.php
		header("Location:../home");
    }else{
      $error = "Your account is not active or have been suspended";
      include('includes/header.php');
    }
		
	}elseif($rows2==1){
		$_SESSION['fx_adminemail'] = $Email;
		// Redirect user to index.php
		header("Location:../admin");
	}else{
		$error = "Wrong Username or password combination";
    include('includes/header.php');
	}
}else{
  include('includes/header.php');
}
?>

      <form method="post">
        <div class="card">
          <div class="card-body pb-1">
            <?php 
              if(isset($_POST['Email'])){
                  if(isset($error)){
                    echo "<div class='container'><div class='alert alert-danger'> $error</div></div>";
                  }
              }
              ?>
            <div class="form-group basic">
              <div class="input-wrapper">
                <label class="label" for="email1">Email or Username</label>
                <input type="text" class="form-control" name="Email" required>
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
                <!-- <a href="reset-password.php" class="text-primary">Reset password?</a> |  -->
                
                <a href="register.php" class="text-primary">Register</a>
              </div>
            </div>
            <input type="submit" class="btn btn-secondary btn-block btn-lg" name="user_login" value="Sign In">
          </div>
        </div>
      </form>
    
  
<?php
include('includes/footer.php');
?>
      