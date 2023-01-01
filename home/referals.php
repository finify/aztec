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
$userrefcode =$row['refcode'];
$username =$row['username'];

$sql = mysqli_query($con, "SELECT * FROM `fx_refearnings` WHERE userid='$userid'");
$rows = mysqli_num_rows($sql) ;

$sql1 = mysqli_query($con, "SELECT * FROM `fx_userprofile` WHERE reffereeid='$userrefcode'");

$rows1 = mysqli_num_rows($sql1) ;

?>
              <div class="page-header">
                <h3 class="page-title"> Referrals</h3>
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Referrals
                    </li>
                  </ol>
                </nav>
              </div>
              <div class="row">
           
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                        <h4 class="card-title">Your Ref link</h4>
                        <h2 class="h2 text-default mb-4 pt-2"> <?= $siteurl ?>index.php?refcode=<?php echo $userrefcode;?></h2>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title">Referral Earning history</h4>
                        <div class="table-responsive">
                          <table class="table table-striped" >
                            <thead>
                              <tr>  
                              <th>username</th>
                              <th>Amount</th>
                              <th>Date</th>
                              </tr>
                            </thead>
                            <tbody>
                            <?php
                            if($rows<1){?>
                              <div class="alert alert-warning" role="alert">
                              <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                              <span class="alert-text"><strong>Warning!</strong> you do not have any referral earnings yet</span>
                              </div>
                              <?php
                            }else{
                              while($row = mysqli_fetch_array($sql)){

                                $fromuser=$row['fromuser'];
                                $amount=$row['amount'];
                                $created=$row['created'];

                                $query1 = "SELECT * FROM `fx_userprofile` WHERE ID='$fromuser' ";
                                $result1 = mysqli_query($con,$query1) ;
                                $row11 = mysqli_fetch_array($result1);
                                $userreffirstname =$row11['firstname'];
                                $userreflastname =$row11['lastname'];
                                echo"<tr>
                              
                                <th scope='row'>
                                  $userreffirstname $userreflastname
                                </th>
                                <td>
                                $amount
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