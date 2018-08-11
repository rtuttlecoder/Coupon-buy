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

$sql="update coupon_entry set check_received = 'yes' 
where userEmail = '$userRow[userEmail]' and invoice_no ='".$_GET['invoice_no']."' ";


$result1 = (mysqli_query($con,$sql));
if ($result1) 
{
    header("Location: http://www.managecoupon.com/checksummary.php");
}

?>
