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

$sql13 = "update coupon_entry set 
invoice_no = 1+(SELECT max_invoice_no from(SELECT MAX(invoice_no)
 AS max_invoice_no FROM coupon_entry where userEmail = '$userRow[userEmail]') as new_invoice_no ) , invoice_date = '".date('Y-m-d')."' 
 WHERE userEmail = '$userRow[userEmail]' and invoice_no = '0' ";
 

$result1 = mysqli_query ($con,$sql13);
if ($result1) 
{
    header("Location: http://managecoupon.com/getreport.php?brand=Newport&save-data=VIEW-INVOICE");
}

?>

