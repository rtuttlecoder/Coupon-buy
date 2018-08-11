<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT']."/class.user.php");
$user_home = new USER();

if(!$user_home->is_logged_in())
{
	$user_home->redirect('index.php');
}

$stmt = $user_home->runQuery("SELECT * FROM tbl_users WHERE userID=:uid");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html class="no-js">
    
    <head>
        <title><?php echo $row['userName']; ?></title>
        <!-- Bootstrap -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
        <link href="assets/styles.css" rel="stylesheet" media="screen">
        
        
    </head>
    
    <body>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                    </a>
                    <img src="images/logofinal.png" alt="logo area" class="brand" width ="60px" height ="16px" />
                    <div class="nav-collapse collapse">
                        <ul class="nav pull-right">
                            
                                 <p style="float:right;"><h4><i class="icon-user" style="vertical-align:middle;"></i>&nbsp; <?php echo $row['userName']; ?>&nbsp;&nbsp;&nbsp;<a href="logout.php" >Logout</a> </h4></P>
                                
                                
                        </ul>
                        <ul class="nav">
                            <li class="active">
                             <h4><a href="couponcounter.php">Print Coupon Counter</a></h4>
                            </li>
                            
                                
                    </div>
                    <!--/.nav-collapse -->
                </div>
            </div>
        </div>
        
        <!--/.fluid-container-->
        <script src="bootstrap/js/jquery-1.9.1.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/scripts.js"></script>
        
    </body>
<div align = "center">
<br><br><br><br><br>
	
	<h3>Thank You for Subscribing manageoupon.com , Please <a href ="index.php">Sign In</a> and start using complete features of website.</h3>
</div>
</html>