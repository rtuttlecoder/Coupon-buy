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
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Welcome - <?php echo $userRow['userName']; ?></title>
<link rel="stylesheet" href="css/report.css" type="text/css" />
</head>
<body>
<td align="center" bgcolor ="white"><a href ="home.php">HOME PAGE</a></td>

</body>
</html>

<html><head><title>MySQL Table Viewer</title></head>
<div align="center">


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


$query = "SELECT  brand , invoice_no ,invoice_date
 FROM coupon_entry  where userEmail = '$userRow[userEmail]' and invoice_no = '".$_GET['invoice_no']."'
 group by brand ";
$result = (mysqli_query($con,$query));
if (!$result) {
    die("Query to show fields from table failed");
}


while($rows=mysqli_fetch_array($result)){
?>

<table border="1px">
<tr>
<td><h5>Invoice No. :<h5></td><td> <? echo $rows['invoice_no'] ?></td>
</tr>
<tr>
<td><h5>Date. :<h5></td><td> <? echo $rows['invoice_date'] ?></td>
</tr>
<tr>
<td><h5>Brand :<h5></td><td> <? echo $rows['brand'] ?></td>
</tr>

<?php

}
?>

	
</table>
<html><head><title>MySQL Table Viewer</title></head>
<div align="center">


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


$query1 = "SELECT   coupon_value , sum(no_of_coupons) as 'noofcoupons' , 
sum(coupon_entry_total) as 'total'
 FROM coupon_entry  where userEmail = '$userRow[userEmail]' and invoice_no ='".$_GET['invoice_no']."'
 group by coupon_value ";
$result1 = (mysqli_query($con,$query1));
if (!$result1) {
    die("Query to show fields from table failed");
}

//$fields_num = mysqli_num_fields($result);

?>

<table border="1px">

<tr>
<td align="center" ><h4>Value Of Coupon<h4></td>
<td align="center" ><h4>No. Of Coupon<h4></td>
<td align="center" ><h4>Total<h4></td>

</tr>
<?php
while($rows1=mysqli_fetch_array($result1)){
	?>


<tr>

<td align="center" ><? echo $rows1['coupon_value']; ?></td>
<td align="center" ><? echo $rows1['noofcoupons']; ?></td>
<td align="right" ><? echo $rows1['total']; ?></td>

<?php

}
?>
<tr>
	
</table>
<?php
$con = mysqli_connect('198.71.225.55:3306','ganeshdesai','rama1234','manage_coupon');
//$brand = $_POST['brand'];
$query3 = "SELECT sum(coupon_entry_total) 
FROM coupon_entry where invoice_no = '".$_GET['invoice_no']."' 
and userEmail ='$userRow[userEmail]' group by brand ";
$result3 = (mysqli_query($con,$query3));
if (!$result3) {
    die("Query to show fields from table failed");
}

$fields_num = mysqli_num_fields($result3);

//echo "<h1>Table: {$table}</h1>";
echo "<table  align='center' border='1'>
<tr>";

while($row = mysqli_fetch_row($result3))
{
    echo "<tr>";

    
    foreach($row as $cell2)
        echo "<td>Total Face Value</td><td>$cell2</td>";

    echo "</tr>\n";
}
?>
<?php
$con = mysqli_connect('198.71.225.55:3306','ganeshdesai','rama1234','manage_coupon');
$brand = $_POST['brand'];
$query4 = "SELECT sum(no_of_coupons) 
FROM coupon_entry where invoice_no = '".$_GET['invoice_no']."' and userEmail ='$userRow[userEmail]'
 group by brand ";
$result4 = (mysqli_query($con,$query4));
if (!$result4) {
    die("Query to show fields from table failed");
}

$fields_num = mysqli_num_fields($result4);

//echo "<h1>Table: {$table}</h1>";
//echo "<table  align='center' border='1'>
//<tr>";

while($row = mysqli_fetch_row($result4))
{
    echo "<tr>";

    
    foreach($row as $cell1)
        echo "<td>Total no. of Coupons ($cell1)</td>";

    echo "</tr>\n";
}
?>
<?php
$con = mysqli_connect('198.71.225.55:3306','ganeshdesai','rama1234','manage_coupon');
$brand = $_POST['brand'];
$query5 = "SELECT (sum(no_of_coupons) * 0.08) 
FROM coupon_entry where invoice_no= '".$_GET['invoice_no']."' and userEmail ='$userRow[userEmail]' 
 group by brand ";
$result5 = (mysqli_query($con,$query5));
if (!$result5) {
    die("Query to show fields from table failed");
}

$fields_num = mysqli_num_fields($result5);

//echo "<h1>Table: {$table}</h1>";
//echo "<table  align='center' border='1'>
//<tr>";

while($row = mysqli_fetch_row($result5))
{
    echo "<tr>";

    
    foreach($row as $cell3)
        echo "<td>Coupon Handling ($0.08/Coupon)</td><td>$cell3</td>";

    echo "</tr>\n";
}
?>
<?php
$con = mysqli_connect('198.71.225.55:3306','ganeshdesai','rama1234','manage_coupon');


if ($postage = ($cell1 > '0' and $cell1 <= '200'))

{ $postage = '2.00';
echo "<tr>";
echo "<td >Approximate Postage</td><td>$postage</td>";
echo "</tr>\n";}
elseif ($postage = ($cell1 > '200' and $cell1 <= '400'))
{ $postage = '4.00';
echo "<tr>";
echo "<td >Approximate Postage</td><td>$postage</td>";
echo "</tr>\n";}
elseif ($postage = ($cell1 > '400' and $cell1 <= '600'))
{ $postage = '6.00';
echo "<tr>";
echo "<td >Approximate Postage</td><td>$postage</td>";
echo "</tr>\n";}
elseif ($postage = ($cell1 > '600' and $cell1 <= '800'))
{ $postage = '8.00';
echo "<tr>";
echo "<td>Approximate Postage</td><td>$postage</td>";
echo "</tr>\n";}
elseif ($postage = ($cell1 > '800' ))
{ $postage = '10.00';
echo "<tr>";
echo "<td >Approximate Postage</td><td>$postage</td>";
echo "</tr>\n";}
?>
<?php
$con = mysqli_connect('198.71.225.55:3306','ganeshdesai','rama1234','manage_coupon');
if ($tot = ($cell2 + $cell3 + $postage ))
{echo "<tr>";
	echo "<td>Grand Total (Amount In Dollors) $:</td><td>$tot</td>";
	echo "</tr>\n";}

?>
<html><head><title>MySQL Table Viewer</title></head>
<div align="center">