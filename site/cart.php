<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT']."/class.user.php");
$user_home = new USER();
if(!$user_home->is_logged_in()) {
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
         <script src="bootstrap/js/jquery-1.9.1.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/scripts.js"></script>
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
                            
                                 <p style="float:right;"><h4><i class="icon-user" style="vertical-align:middle;"></i>&nbsp; <?php echo $row['userName']; ?>&nbsp;&nbsp;&nbsp;<a href="logout.php" >Logout</a> </h4></P>
                               
                            
                        </ul>
                    </div>
                    <!--/.nav-collapse -->
                </div>
            </div>
        </div>
    </body>
	<div align = "center">
	
		<html><head><title>MySQL Table Viewer</title></head>
		<div align = "center"><h1>SUBSCRIPTION CART</h1> </div>
<div class="home" align="center">
<?php
$db_host = '198.71.225.55:3306';
$db_user = 'ganeshdesai';
$db_pwd = 'rama1234';
$database = 'manage_coupon';
$table = 'coupon_entry';
$con = (mysqli_connect($db_host, $db_user, $db_pwd));
if (!mysqli_connect($db_host, $db_user, $db_pwd))
    die("Can't connect to database");

if (!mysqli_select_db($con , $database))
   die("Can't select database");
$query = "SELECT  * from product_master ";
$result = (mysqli_query($con,$query));
if (!$result) {
    die("Query to show fields from table failed");
}
?>

<table border="1px">
<tr>
<td align="center" bgcolor ="#d3dfdf" style = "width:85px"><h5>Product ID<h5></td>
<td align="center" bgcolor ="#d3dfdf" style = "width:200px"><h5>Description<h5></td>
<td align="center" bgcolor ="#d3dfdf" style = "width:120px"><h5>Value (US $)<h5></td>
<td align="center" bgcolor ="#d3dfdf" style = "width:80px"><h5>Period<h5></td>
</tr>

<?php
while($rows=mysqli_fetch_array($result)){
?>
<tr>
<td align="center" bgcolor="white" ><h5><? echo $rows['product_id']; ?></h5></td>
<td align="center" bgcolor="white" ><h5><? echo $rows['description']; ?></h5></td>
<td align="center" bgcolor="white" ><h4><? echo $rows['value']; ?></h4></td>
<td align="center" bgcolor="white" ><h5><? echo $rows['period']; ?></h5></td>
</tr></table>
<?php
// close while loop 
}
?>
	<tr>
<table >
<tr><td align = "center" bgcolor = "white"><h4>-: IMPORTANT :-</h4></td></tr>
<tr><td align = " left" bgcolor = "#c7c7c7"><h5>1. You can cancel Your subcription any time with single click without any obligation.</h5></td></tr>
<tr><td align = " left" bgcolor = "white"><h5>2. Your Subcription Starts immediately on Successful completion of payment transaction.</h5></td></tr>
<tr><td align = " left" bgcolor = "#c7c7c7"><h5>3. Your Credit Card/Debit Card account will be charged $1.99 every month. </h5></td></tr>
<tr><td align = " left" bgcolor = "white"><h5>4. Please go through the <a href="http://www.managecoupon.com/terms.html">
		Terms and Conditions , Cancellation and Privacy Policy</a> before making any payment.</h5></td></tr>
<td>
</table>
<br>
<input type="checkbox" style="vertical-align:top;" required /><span><b> I have read and agree to the<a href="http://www.managecoupon.com/terms.html">
		<font Color ="white">Terms and Conditions , Cancellation and Privacy Policy.</a><b></span>
      </br></br>
<form name="PrePage" method = "post" action="https://Simplecheckout.authorize.net/payment/CatalogPayment.aspx">
<input type="hidden" name="LinkId" value="b713cfed-2a81-45f7-867b-e9ea9d3e9ad8"> 
<input type="image" src="//content.authorize.net/images/buy-now-gold.gif"> 
</form>

<script type="text/javascript" src="https://sealserver.trustwave.com/seal.js?code=26dc321ba0c24b6fb0fe27495bad1ea3"></script>&nbsp;&nbsp;&nbsp;
				
<span id="siteseal"><script type="text/javascript" src="https://seal.godaddy.com/getSeal?sealID=xbo8WnnH7UkEKwqLc62jJtkPLTvFDVRDNBQxTMgi6vD5K6CWv1QW0VSM7yRx"></script></span>

<!-- (c) 2005, 2016. Authorize.Net is a registered trademark of CyberSource Corporation --> <div class="AuthorizeNetSeal"> <script type="text/javascript" language="javascript">var ANS_customer_id="df8ff47a-91ab-4b4a-b026-5bd0b383c3ff";</script> 
<script type="text/javascript" language="javascript" src="//verify.authorize.net/anetseal/seal.js" ></script>
 <a href="http://www.authorize.net/" id="AuthorizeNetText" target="_blank">E-Commerce Solutions</a> </div>
</div>


</html>