<?php
session_start();

$con = mysqli_connect('198.71.225.55:3306','ganeshdesai','rama1234','manage_coupon');

if(!isset($_SESSION['user']))
{
header("Location: http://www.managecoupon.com/index.php");
};

$sql = "SELECT * FROM users WHERE userid =".$_SESSION['user'];
$res = mysqli_query($con,$sql);
$userRow = mysqli_fetch_array($res);
?>

<?php
$con = mysqli_connect('198.71.225.55:3306','ganeshdesai','rama1234','manage_coupon');

$sql="DELETE FROM coupon_entry WHERE id_coupon_entry ='".$_GET['id_coupon_entry']."' 
and email = '$userRow[email]'";


$result1 = (mysqli_query($con,$sql));
if ($result1) 
{
    header("Location: http://www.managecoupon.com/2.php");
}

?>
