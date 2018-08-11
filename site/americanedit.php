<?php
session_start();

$con = mysqli_connect('198.71.225.55:3306','ganeshdesai','rama1234','manage_coupon');

if(!isset($_SESSION['userSession']))
{
header("Location: index.php");
};

$sql = "SELECT * FROM tbl_users WHERE userID =".$_SESSION['userSession'];
$res = mysqli_query($con,$sql);
$userRow = mysqli_fetch_array($res);
?>

<?php
$con = mysqli_connect('198.71.225.55:3306','ganeshdesai','rama1234','manage_coupon');


$sql1 = "Select max(invoice_no) as 'max' from coupon_entry
where brand= 'American Spirits' and userEmail ='$userRow[userEmail]'";
$result1 = (mysqli_query($con,$sql1));
while($rows=mysqli_fetch_array($result1))
$max_invoice_no = $rows['max'];
$sql13 = "update coupon_entry set invoice_no = '0' , invoice_date = '0000-00-00'
 
 WHERE userEmail = '$userRow[userEmail]' and invoice_no = '$max_invoice_no' and brand = 'American Spirits' and check_received = 'NO'";
 
//if (mysqli_query($con,$sql13));
$result1 = mysqli_query($con,$sql13);
if ($result1) 
{
    header("Location: american.php");
}

?>


