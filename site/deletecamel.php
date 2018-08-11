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

$sql="DELETE FROM coupon_entry WHERE coupon_value ='".$_GET['coupon_value']."' 
and userEmail = '$userRow[userEmail]' and brand = 'Camel' and invoice_no = '0'";


$result1 = (mysqli_query($con,$sql));
if ($result1) 
{
    header("Location: camel.php");
}

?>
