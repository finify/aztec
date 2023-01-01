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

//Selecting current user 
$query = "SELECT * FROM `fx_settings` WHERE ID=1 ";
$result = mysqli_query($con,$query) ;
$row = mysqli_fetch_array($result);
$kyc =$row['kyc'];

if (isset($_POST['kyctype']))
{
  $kyctype = $_POST['kyctype'];

  if($kyctype == 1){
    $kyctype = "NID";
  }elseif($kyctype == 2){
    $kyctype = "IP";
  }

}

///send selecting benifactors profile//
if(isset($_POST["submit"])){

  $status = "0";
  $created = date("Y-m-d h:i:sa");

  $folder = "../kycproof/";
  $types = array('.JPG', '.jpg', '.jpeg', '.PNG', '.bmp', '.gif', '.png');

  $file1 = $_FILES["idfront"]["name"];
  $file2 = $_FILES["idback"]["name"];

  $ext1 = substr($file1, strpos($file1, '.'), strlen($file1)-1);
  $ext2 = substr($file2, strpos($file2, '.'), strlen($file2)-1);
  
  if($kyc == 1){
        if(move_uploaded_file($_FILES["idfront"]["tmp_name"], $folder.$file1) && move_uploaded_file($_FILES["idback"]["tmp_name"], $folder.$file2)){

    
     $query1 = mysqli_query($con, "INSERT INTO fx_kyc (userid,kyctype,frontimage,backimage,kycstatus,created) VALUES ('$userid','$kyctype','$file1','$file2','$status','$created')"); 
          
      }
    }
  

  }

  $sql5 = mysqli_query($con, "SELECT * FROM `fx_kyc` WHERE userid='$userid' order by ID desc");
$rows1 = mysqli_num_rows($sql5) ;


//Selecting current user 
$query11 = "SELECT * FROM `fx_kyc` WHERE userid='$userid' ";
$result11 = mysqli_query($con,$query11) ;
$row11 = mysqli_fetch_array($result11);
$kycstatus =$row11['kycstatus'];
?>
<!-- Page content -->
<div class="container-fluid mt--6">
    <div class="row">
        <div class="col-xl-12">
        <div class="card">
            <div class="card-header bg-transparent">
            <div class="row align-items-center">
                <div class="col">
                <h2 class="h1 text-center text-default mb-0">Upload ID</h2>
                </div>
            </div>
            </div>
            <div class="card-body">
            <?php 
            if(isset($_POST["submit"])){
            if($query1){
                echo "
                <div class='container'><div class='alert alert-success'> Upload successfull</div></div>";
            }
            else {
                    echo "<div class='container'><div class='alert alert-danger'>Couldnot upload</div></div>";
            }
            }
            ?>

            <?php
                    if($rows1>=1){
                        if($kycstatus== 0 ){?>
                      <div class="alert alert-warning" role="alert">
                      <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                      <span class="alert-text">Your id approval is pending</span>
                      </div>
                        <?php }else{?>
                            <div class="alert alert-success" role="alert">
                      <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                      <span class="alert-text"><strong> Your id have been approved</span>
                      </div>
                       <?php }
                    }else{?>
            <form method="post" enctype="multipart/form-data" action="">
                <div class="pl-lg-4">
                <div class="form-group">
                    <label for="exampleSelectGender">Gender</label>
                    <select required name="kyctype" class="form-control" id="exampleSelectGender">
                        <option value="">Choose...</option>
                        <option value="1">National ID</option>
                        <option value="2">International Passport</option>
                    </select>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                    <div class="form-group">
                        <label class="form-control-label" for="input-username"
                        >select front image</label
                        > </br name>
                        <input
                        name="idfront"
                        required
                        type="file"
                        id="input-first-name"
                        class="form-control"
                        placeholder="ID Front"
                        />
                    </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                    <div class="form-group">
                        <label class="form-control-label" for="input-username"
                        >select Back image</label
                        > </br name>
                        <input
                        required
                        name="idback"
                        type="file"
                        id="input-first-name"
                        class="form-control"
                        placeholder="ID back"
                        />
                    </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <input
                        name="submit"
                        type="submit"
                        id="submit1"
                        class="form-control btn btn-primary my-4"
                        value="Upload Id"
                        />
                    </div>
                </div>
                </div>
            </form>
            <?php }?>
            
            </div>
        </div>
        </div>
    </div>


<?php 
require('includes/footer.php'); 
?>  