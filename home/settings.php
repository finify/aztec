<?php 
require('includes/auth.php');
require('includes/header.php');
require('../includes/dbconnect.php');//DBCONNECTION
$useremail = $_SESSION['useremail'];


if(isset($_POST['submit'])){

  $userpassword = $_POST['userpassword'] ;

  $sqlquery = "UPDATE fx_userprofile 
    SET userpassword='$userpassword'
    WHERE email='$useremail' " ;						
    $sqlresult = mysqli_query($con,$sqlquery) ;
}
//Selecting current user 
$query = "SELECT * FROM `fx_userprofile` WHERE email='$useremail' ";
$result = mysqli_query($con,$query) ;
$row = mysqli_fetch_array($result);
$userpassword =$row['userpassword'];
$useremail =$row['email'];


?>
              <div class="page-header">
                <h3 class="page-title"> Settings</h3>
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Settings
                    </li>
                  </ol>
                </nav>
              </div>
              <div class="row">
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                        <?php 
                        if(isset($_POST["submit"])){
                          if($sqlquery){
                            echo "
                            <div class='container'><div class='alert alert-success'> Settings updated successfully</div></div>";
                          }else {
                                echo "<div class='container'><div class='alert alert-danger'>Couldnot update settings</div></div>";
                          }
                        }
                        ?>
                        <h4 class="card-title">Settings</h4>
                        <form class="forms-sample" method="POST" action="">
                        <div class="row">
                          <div class="col-lg-12">
                            <div class="form-group">
                              <label style="font-size:25px;" class="form-control-label" for="input-first-name"
                                >Email</label
                              >
                              <input 
                                required 
                                type="text"
                                id="input-first-name"
                                class="form-control text-white"
                                placeholder="Amount"
                                name="useremail"
                                value="<?= $useremail?>"
                                step="any"
                                disabled
                              />
                            </div>
                          </div>
                          <div class="col-lg-12">
                            <div class="form-group">
                              <label style="font-size:25px;" class="form-control-label" for="input-first-name"
                                >User Password</label
                              >
                              <input 
                                required 
                                type="text"
                                id="input-first-name"
                                class="form-control text-white"
                                placeholder="Amount"
                                name="userpassword"
                                value="<?= $userpassword?>"
                                step="any"
                              />
                            </div>
                          </div>
                        </div>
                            <input class="btn btn-primary mr-2" type="submit" value="update" name="submit"/>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php 
require('includes/footer.php'); 
?>  