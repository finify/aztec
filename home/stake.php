<?php 
require('includes/auth.php');
require('includes/header.php');
require('../includes/dbconnect.php');//DBCONNECTION
$useremail = $_SESSION['useremail'];


$sql1 = mysqli_query($con, "SELECT * FROM `fx_token` order by ID desc");   //checking no of investments
$rows1 = mysqli_num_rows($sql1) ;


?>
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title">Availble Token to Stake</h4>
                        <div class="table-responsive">
                          <table class="table table-striped" style="color:white!important">
                            <thead>
                              <tr>
                                <th> Token</th>
                                <th> Code</th>
                                <th> Min amount </th>
                                <th> Reward%</th>
                                <th> Duration</th>
                                <th> stake </th>
                              </tr>
                            </thead>
                            <tbody>
                            <?php
                    if($rows1<1){?>
                      <div class="alert alert-warning" role="alert">
                      <span class="alert-icon"><i class="ni ni-fat-remove"></i></span>
                      <span class="alert-text">No Tokens yet</span>
                      </div>
                      <?php
                    }else{
                      while($row11 = mysqli_fetch_array($sql1)){
                          $tokenid =$row11["ID"];
                        $token_name =$row11["token_name"];
                        $token_image =$row11["token_image"];
                        $token_code =$row11["token_code"];
                        $token_min =$row11["token_min"];
                        $roi =$row11["roi"];
                        $weeks =$row11["weeks"];
                        $date_created =$row11["date_created"];

                        echo"<tr>
                      
                        <td>
                        <img src='../admin/$token_image' width='50px'/>
                        $token_name 
                        </td>
                        <td>
                        $token_code
                        </td>
                        <td>
                       $ $token_min
                        </td>
                        <td>
                        $roi %
                        </td>
                        <td>
                        $weeks week/s
                        </td>
                        <td>
                          <form method='POST' action='stakecoin.php'>
                          <input type='hidden' value='$tokenid'  name='tokenid'/>
                          <input class='btn btn-primary btn-sm' type='submit' value='stake'></input>
                          </form>
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