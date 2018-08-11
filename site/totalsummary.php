<?php
session_start();
if(!isset($_SESSION['userSession']))

{ header("Location: index.php"); }

$con = mysqli_connect('198.71.225.55:3306','ganeshdesai','rama1234','manage_coupon');

	$qry = "SELECT * FROM tbl_users WHERE userID =".$_SESSION['userSession'];
        $reslt = mysqli_query($con,$qry);
        $userRow = mysqli_fetch_array($reslt);

?>
<!DOCTYPE html>
<html class="no-js">
    
    <head>
        <title><?php echo $userRow['userName']; ?></title>
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
                            
                                 <p style="float:right;"><h4><i class="icon-user" style="vertical-align:middle;"></i>&nbsp; <?php echo $userRow['userName']; ?>&nbsp;&nbsp;&nbsp;<a href="logout.php" >Logout</a> </h4></P>
                               
                            
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
        
    </body>

</html>

	<html><head><title>MySQL Table Viewer</title></head>
	<br>
	<br>
	<div align = "center"><h1>TOTAL COUPONS SENT STATEMENT</h1> </div>
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


$query = "SELECT invoice_no  , invoice_date as 'Invoice Date',
brand as 'Brand' , sum(no_of_coupons) as 'Total Coupons',
 (sum(no_of_coupons)*0.08) as 'Handling', 
 sum(coupon_entry_total) as 'Face Value' , check_received
 FROM coupon_entry  where   userEmail = '$userRow[userEmail]' group by invoice_no ";

$result = (mysqli_query($con,$query));
if (!$result) {
    die("Query to show fields from table failed");
}

{
?>
<table border="1px">
<br>
<br>
<tr>
<td align="center" bgcolor ="#d3dfdf"><h5>Invoice Number<h5></td>
<td align="center" bgcolor ="#d3dfdf"><h5>Invoice Date<h5></td>
<td align="center" bgcolor ="#d3dfdf"><h5>Brand<h5></td>
<td align="center" bgcolor ="#d3dfdf"><h5>Total<h5></td>
<td align="center" bgcolor ="#d3dfdf"><h5>Check Received<h5></td>
<td align="center" bgcolor ="#d3dfdf"><h5>Invoice Info.<h5></td>
</tr>
<?php
}
while($rows=mysqli_fetch_array($result))
	{
$total_coupons = $rows['Total Coupons']  ;

if ($postage = ( $total_coupons > '0' and $total_coupons <= '200'))
{ $postage = '2.00';}
elseif ($postage = ($total_coupons > '200' and $total_coupons <= '400'))
{ $postage = '4.00';}
elseif ($postage = ($total_coupons > '400' and $total_coupons <= '600'))
{ $postage = '6.00';}
elseif ($postage = ($total_coupons > '600' and $total_coupons <= '800'))
{ $postage = '8.00';}
elseif ($postage = ($total_coupons > '800' ))
{ $postage = '10.00';}

$total = $rows['Face Value'] + $rows['Handling'] + $postage ;


{

?>

<tr>
<td align="center" bgcolor="white"><? echo $rows['invoice_no']; ?></td>
<td align="center" bgcolor="white"><? echo $rows['Invoice Date']; ?></td>
<td align="center" bgcolor="white"><? echo $rows['Brand']; ?></td>
<td align="right" bgcolor="white"><? echo $total; ?></td>
<td align="center" bgcolor="white"><? echo $rows['check_received']; ?></td>
<td align ="center" bgcolor="white"><a href="viewreport.php?invoice_no=<? echo $rows['invoice_no']; ?>">VIEW DETAILS</a></td>
</tr>

<?php

}
}
?>

</table>
</div>
</body></html>