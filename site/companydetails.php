<?php
session_start();
if (!isset($_SESSION['userSession'])) { 
	header("Location: index.php"); 
}
$con = mysqli_connect('198.71.225.55:3306','ganeshdesai','rama1234','manage_coupon');
$qry = "SELECT * FROM tbl_users WHERE userID =".$_SESSION['userSession'];
$reslt = mysqli_query($con,$qry);
$userRow = mysqli_fetch_array($reslt);
?>
<!DOCTYPE html>
<html class="no-js">
    <head>
        <title>User: <?php echo $userRow['userName']; ?></title>
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
                    <a class="brand" href="home.php">Member Home</a>
                    <div class="nav-collapse collapse">
                        <ul class="nav pull-right">
                                 <p style="float:right;"><h4><i class="icon-user" style="vertical-align:middle;"></i>&nbsp; <?php echo $userRow['userName']; ?>&nbsp;&nbsp;&nbsp;<a href="logout.php">Logout</a> </h4></P>
                        </ul>
                    </div>
                    <!--/.nav-collapse -->
                </div>
            </div>
        </div>
        
        <!--/.fluid-container-->
        <script src="bootstrap/js/jquery-1.9.1.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/scripts.js"></script>
<div align="center">
<?php
$sql = "SELECT * FROM tbl_users WHERE userID =".$_SESSION['userSession'];
$res = mysqli_query($con,$sql);
$userRow = mysqli_fetch_array($res);
$sql = "Select * from cust_company_information where userEmail = '$userRow[userEmail]'";
$result = mysqli_query($con,$sql);
if (!$result) {
    die("Query to show fields from table failed");
}
while ($rows= mysqli_fetch_array($result)) {
?>
<br>
<div align="center"><h1>COMPANY INFORMATION</h1></div>
<br>
<h2 style="color:white"><? echo $rows['cust_company_name']; ?></h2>
<h4><? echo $rows['cust_company_address']; ?></h4>
<h4><? echo $rows['cust_company_city'];?>-<? echo $rows['cust_company_state'];?>-<?  echo $rows['cust_company_zipcode']; ?></h4>
<h4>Fed Id : <? echo $rows['cust_company_fed_no']; ?></h4>
<h4>Phone No : <? echo $rows['cust_comp_phone_no']; ?></h4>
<?php
}
?>
</table>
</div>
<br>
<br>
<div align="center">
<a href="3.php"><h3>EDIT COMPANY INFORMATION<h3></a>
</div>
</body>
</html>