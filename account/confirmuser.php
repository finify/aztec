<?php
require('../includes/dbconnect.php');
require('../includes/settings.php');
require('../includes/mail.php');
if(!isset($_GET['activate'])){
	include('includes/header.php');
      echo "<div class='form' style='background-color:white; align-content:center;'>
      <center>
      <img src='../img/error.png' alt='errorimage' width='100px' height='100px'/>
      <br/>
      <h3>Sorry Your activation was not successfull</h3> <br/><a href='login.php' class='btn btn-secondary btn-block btn-lg'>Login</a>
      </center>
      </div>
      ";
      include('includes/footer.php');
      die();
}else{
   $activate = $_GET['activate'];

   $query = "SELECT * FROM `fx_userprofile` WHERE refcode='$activate'";
   $result = mysqli_query($con,$query) ;
   $rows = mysqli_num_rows($result) ;
   if($rows==1)
   {
    $sqlquery1 = "UPDATE fx_userprofile 
    SET activestat='0'
    WHERE refcode='$activate' " ;
    $sqlresult1 = mysqli_query($con,$sqlquery1) ;

    if($sqlresult1){
        include('includes/header.php');
      echo "<div class='form' style='background-color:white; align-content:center;'>
      <center>
      <img src='../img/success.png' alt='errorimage' width='100px' height='100px'/>
      <br/>
      <h3>Your account activation was successful</h3> <br/><a href='login.php' class='btn btn-secondary btn-block btn-lg'>Login</a>
      </center>
      </div>
      ";
      include('includes/footer.php');
      die();
    }else{
        include('includes/header.php');
      echo "<div class='form' style='background-color:white; align-content:center;'>
      <center>
      <img src='../img/error.png' alt='errorimage' width='100px' height='100px'/>
      <br/>
      <h3>Sorry Your activation was not successfull</h3> <br/><a href='login.php' class='btn btn-secondary btn-block btn-lg'>Login</a>
      </center>
      </div>
      ";
      include('includes/footer.php');
      die();
    }
   }else{
    include('includes/header.php');
    echo "<div class='form' style='background-color:white; align-content:center;'>
    <center>
    <img src='../img/error.png' alt='errorimage' width='100px' height='100px'/>
    <br/>
    <h3>Sorry Your activation was not successfull</h3> <br/><a href='login.php' class='btn btn-secondary btn-block btn-lg'>Login</a>
    </center>
    </div>
    ";
    include('includes/footer.php');
    die();
   }

   
}
?>