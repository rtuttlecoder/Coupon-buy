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
<button onClick="window.print()">Print this page</button>
</body>
</html>



<html><head><title>MySQL Table Viewer</title></head>
<div align="center">

<?php
$con = mysqli_connect('198.71.225.55:3306','ganeshdesai','rama1234','manage_coupon');


$query1 = "SELECT * FROM cust_company_information where userEmail = '$userRow[userEmail]'";

$result1 = (mysqli_query($con,$query1));
$row1 = mysqli_fetch_array($result1);
if (!$result1) {
    die("Query to show fields from table failed");
}
echo "<table ><tr>";

?>

<tr>
<td align="center" width = "300px" ><? echo $row1['cust_company_name']; ?></td>
</tr>
<tr>
<td align="center" width = "300px"><? echo $row1['cust_company_address']; ?></td>
</tr>
<tr>
<td align="center"width = "300px"><? echo $row1['cust_company_city']; ?>
								<b><? echo $row1['cust_company_state']; ?></b>
								<? echo $row1['cust_company_zipcode']; ?></td>
</tr>
<tr>
<td align="center" width = "300px"><b>Phone No.: </b><? echo $row1['cust_comp_phone_no']; ?></td>
</tr>
<tr>
<td align="center"width = "300px"><b>Fed Id # </b><? echo $row1['cust_company_fed_no']; ?></td>
</tr>

</div>
</body></html>

<html><head><title>MySQL Table Viewer</title></head>
<div align="center">

<?php
$con = mysqli_connect('198.71.225.55:3306','ganeshdesai','rama1234','manage_coupon');


$query2 = "SELECT max(invoice_no) as 'invoice no' , invoice_date as 'invoice date' 
from coupon_entry 
where   brand = '".$_GET['brand']."'
 and  userEmail = '$userRow[userEmail]' group by brand ";

$result2 = (mysqli_query($con,$query2));
if (!$result2) {
    die("Query to show fields from table failed");
}


echo "<table  align='center' border='0'>
<tr>";

while($row2 = mysqli_fetch_array($result2))
	
{
  
 ?>      
 <td><b>INVOICE DATE :<b></td><td><?echo $row2['invoice date'];?></td>
 <td><b>INVOICE No.:<b></td><td><?echo $row2['invoice no'];?></td>
<?php
    
}
?>
</div>
</body></html>
<?php
$con = mysqli_connect('198.71.225.55:3306','ganeshdesai','rama1234','manage_coupon');

$sql1 = "Select max(invoice_no) as 'max' from coupon_entry
where brand= '".$_GET['brand']."' and userEmail ='$userRow[userEmail]'";
$result1 = (mysqli_query($con,$sql1));
while($rows=mysqli_fetch_array($result1))
$max_invoice_no = $rows['max'];

$query = "SELECT   coupon_value , sum(no_of_coupons) as 'noofcoupons' , 
sum(coupon_entry_total) as 'total'
 FROM coupon_entry  where userEmail = '$userRow[userEmail]' and
 brand= '".$_GET['brand']."' and invoice_no ='$max_invoice_no' group by coupon_value";
$result = (mysqli_query($con,$query));
if (!$result) {
    die("Query to show fields from table failed");
}

//$fields_num = mysqli_num_fields($result);

?>
<table border="1px">

<tr>
<td align="center" width ="160px"><h4>Value Of Coupon<h4></td>
<td align="center" width ="150px"><h4>No. Of Coupon<h4></td>
<td align="center" width ="70px"><h4>Total<h4></td>

</tr>


<?php
while($rows=mysqli_fetch_array($result)){
?>

<tr>

<td align="center" width ="160px"><? echo $rows['coupon_value']; ?></td>
<td align="center" width ="150px"><? echo $rows['noofcoupons']; ?></td>
<td align="right" width ="70px"><? echo $rows['total']; ?></td>
</tr>
<?php

}
?>
<tr>
	
</table>

<?php
$con = mysqli_connect('198.71.225.55:3306','ganeshdesai','rama1234','manage_coupon');
//$brand = $_POST['brand'];
$query3 = "SELECT sum(coupon_entry_total) as 'sumtotal'
FROM coupon_entry where brand= '".$_GET['brand']."' and invoice_no ='$max_invoice_no' 
and userEmail ='$userRow[userEmail]' group by brand ";
$result3 = (mysqli_query($con,$query3));
if (!$result3) {
    die("Query to show fields from table failed");
}
echo "<table  align='center' border='0'><tr>";
while($row3 = mysqli_fetch_array($result3))
	$cell2 = $row3['sumtotal'];
	
{
	?>

<tr>
<td width = "318px">Total Face Value</td><td align ="right"><? echo $cell2; ?></td>
</tr>
<?php } ?>
<?php
$con = mysqli_connect('198.71.225.55:3306','ganeshdesai','rama1234','manage_coupon');

$query4 = "SELECT sum(no_of_coupons) as sumcoupons
FROM coupon_entry where brand= '".$_GET['brand']."' and userEmail ='$userRow[userEmail]'
and invoice_no ='$max_invoice_no'  group by brand ";
$result4 = (mysqli_query($con,$query4));
if (!$result4) {
    die("Query to show fields from table failed");
}


while($row4 = mysqli_fetch_array($result4))
	$cell1 = $row4['sumcoupons'];
{
?>
<tr>
<td width = "318px">Total No. of Coupons </td><td width = "70px" >[<? echo $cell1; ?>]</td>
</tr>
<?php } ?>
<?php
$con = mysqli_connect('198.71.225.55:3306','ganeshdesai','rama1234','manage_coupon');

$query5 = "SELECT (sum(no_of_coupons) * 0.08) as handling
FROM coupon_entry where brand= '".$_GET['brand']."' and userEmail ='$userRow[userEmail]' 
and invoice_no ='$max_invoice_no' group by brand ";
$result5 = (mysqli_query($con,$query5));
if (!$result5) {
    die("Query to show fields from table failed");
}


while($row5 = mysqli_fetch_array($result5))
	$cell3 = $row5['handling'];
{
?>
<tr>
<td width = "318px">Handling @ 8 cents/coupon </td><td width = "70px" align ="right"><? echo $cell3 ; ?></td>
</tr>
<?php } ?>
<?php
$con = mysqli_connect('198.71.225.55:3306','ganeshdesai','rama1234','manage_coupon');


if ($postage = ($cell1 > '0' and $cell1 <= '200'))

{ $postage = '2.00';}
elseif ($postage = ($cell1 > '200' and $cell1 <= '400'))
{ $postage = '4.00';}
elseif ($postage = ($cell1 > '400' and $cell1 <= '600'))
{ $postage = '6.00';}
elseif ($postage = ($cell1 > '600' and $cell1 <= '800'))
{ $postage = '8.00';}
elseif ($postage = ($cell1 > '800' ))
{ $postage = '10.00';}
?>

<tr>
<td >Approximate Postage</td><td align = "right"><? echo $postage ;?></td>
</tr>
 
<?php
$con = mysqli_connect('198.71.225.55:3306','ganeshdesai','rama1234','manage_coupon');
if ($tot = ($cell2 + $cell3 + $postage ))
{
	?>
	
	<td>Grand Total (Amount In Dollors) $:</td><td align = "right"><? echo $tot ; ?></td>
	<?php }

?>
<html><head><title>MySQL Table Viewer</title></head>
<div align="center">
<?php
$con = mysqli_connect('198.71.225.55:3306','ganeshdesai','rama1234','manage_coupon');
echo "<table align='center' border='0'>
<tr>";
if ($lin = '<br><br><hr><hr><br><br>')
{
echo "<tr>";
	echo "$lin";
	echo "</tr>\n";}

?>

</div>
</body></html>
<html><head><title>MySQL Table Viewer</title></head>
<div align="center">

<?php
$con = mysqli_connect('198.71.225.55:3306','ganeshdesai','rama1234','manage_coupon');


echo "<table  align='center' border='0'>
<tr>";

echo "</tr>\n";
{
	
	?>
        <td align="left" width="300px"><? echo 'To,'; ?></td>
<?php
}
?>

<html><head><title>MySQL Table Viewer</title></head>
<div align="center">

<?php
$con = mysqli_connect('198.71.225.55:3306','ganeshdesai','rama1234','manage_coupon');


$query1 = "SELECT manufacturer_name FROM manufacturer_master WHERE brand = '".$_GET['brand']."'";

$result1 = (mysqli_query($con,$query1));
if (!$result1) {
    die("Query to show fields from table failed");
}

$fields_num = mysqli_num_fields($result1);


echo "<table  align='center' border='0'>
<tr>";

echo "</tr>\n";
while($row = mysqli_fetch_row($result1)){
	

    foreach($row as $cell)
	?>
        <td align="left" width="300px"><? echo $cell; ?></td>
<?php
}
?>


</div>
</body></html>
<html><head><title>MySQL Table Viewer</title></head>
<div align="center">

<?php
$con = mysqli_connect('198.71.225.55:3306','ganeshdesai','rama1234','manage_coupon');


$query1 = "SELECT coupon_mailing_add1 FROM 
manufacturer_master WHERE brand = '".$_GET['brand']."'";

$result1 = (mysqli_query($con,$query1));
if (!$result1) {
    die("Query to show fields from table failed");
}

$fields_num = mysqli_num_fields($result1);

//echo "<h1>Table: {$table}</h1>";
echo "<table  align='center' border='0'>
<tr>";
// printing table headers

echo "</tr>\n";
while($row = mysqli_fetch_row($result1)){
	

    foreach($row as $cell)
	?>
        <td align="left" width="300px"><? echo $cell; ?></td>
<?php
}
?>

</div>
</body></html>
<html><head><title>MySQL Table Viewer</title></head>
<div align="center">

<?php
$con = mysqli_connect('198.71.225.55:3306','ganeshdesai','rama1234','manage_coupon');


$query1 = "SELECT coupon_mailing_add2 FROM 
manufacturer_master WHERE brand = '".$_GET['brand']."'";

$result1 = (mysqli_query($con,$query1));
if (!$result1) {
    die("Query to show fields from table failed");
}

$fields_num = mysqli_num_fields($result1);

//echo "<h1>Table: {$table}</h1>";
echo "<table  align='center' border='0'>
<tr>";
// printing table headers

echo "</tr>\n";
while($row = mysqli_fetch_row($result1)){
	

    foreach($row as $cell)
	?>
        <td align="left" width="300px"><? echo $cell; ?></td>
<?php
}
?>

</div>
</body></html>
<html><head><title>MySQL Table Viewer</title></head>
<div align="center">

<?php
$con = mysqli_connect('198.71.225.55:3306','ganeshdesai','rama1234','manage_coupon');


$query1 = "SELECT coupon_mailing_city , coupon_mailing_state , coupon_mailing_zipcode
 FROM manufacturer_master WHERE brand = '".$_GET['brand']."'";

$result1 = (mysqli_query($con,$query1));
if (!$result1) {
    die("Query to show fields from table failed");
}

$fields_num = mysqli_num_fields($result1);

//echo "<h1>Table: {$table}</h1>";
echo "<table  align='center' border='0'>
<tr>";
// printing table headers

echo "</tr>\n";
while($row=mysqli_fetch_array($result1))
{
	
    
	?>
        <td align="left" width="300px"><? echo $row['coupon_mailing_city'];?>  <b><?echo $row['coupon_mailing_state'];?></b>  <?echo $row['coupon_mailing_zipcode']; ?></td>
		
<?php
}
?>

</div>
</body></html>

