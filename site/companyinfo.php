<?php
session_start();

$con = mysqli_connect('198.71.225.55:3306','ganeshdesai','rama1234','manage_coupon');
if(!isset($_SESSION['userSession']))
{
header("Location: http://www.managecoupon.com/index.php");
};

$sql = "SELECT * FROM tbl_users WHERE userID =".$_SESSION['userSession'];
$res = mysqli_query($con,$sql);
$userRow = mysqli_fetch_array($res);
?>


<?php
$con = mysqli_connect('198.71.225.55:3306','ganeshdesai','rama1234','manage_coupon');

$sql1 = "Select userID from cust_company_information where userEmail = '$userRow[userEmail]' " ;


$result1 = (mysqli_query($con,$sql1));

if (!$result1) {
    die("Query to show fields from table failed");
}
$count = (mysqli_num_rows($result1)) ;

if ($count == 0)
{
    header("Location: http://www.managecoupon.com/1.php");
}
else
	{
    header("Location: http://www.managecoupon.com/companydetails.php");
};
?>

