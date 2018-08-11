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
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Welcome - <?php echo $userRow['username']; ?></title>
<link rel="stylesheet" href="http://www.managecoupon.com/css/.css" type="text/css" />
</head>
<body>
<div id="header">
	<div id="left">
 
<a href="http://www.managecoupon.com/home.php"><img src="http://www.managecoupon.com/images/logo2.png" alt="logo area"  class="logo"/></a>
    </div>
    <div id="right">
    	<div id="content">
                <a href="http://www.managecoupon.com/home.php">Home  page</a>   
        	hi' <?php echo $userRow['username']; ?>&nbsp;<a href="http://www.managecoupon.com/logout.php?logout">Sign Out</a>
        </div>
    </div>
</div>
</body>
</html>

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
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Welcome - <?php echo $userRow['username']; ?></title>
<link rel="stylesheet" href="http://www.managecoupon.com/css/report.css" type="text/css" />
</head>
<body>
<button onClick="window.print()">Print this page</button>
</body>
</html>





<html><head><title>MySQL Table Viewer</title></head>
<div align="center">

<?php
$con = mysqli_connect('198.71.225.55:3306','ganeshdesai','rama1234','manage_coupon');


$query1 = "SELECT cust_company_name 
  FROM cust_company_information where email = '$userRow[email]'";

$result1 = (mysqli_query($con,$query1));
if (!$result1) {
    die("Query to show fields from table failed");
}

$fields_num = mysqli_num_fields($result1);


echo "<table  align='center' border='0'>
<tr>";


echo "</tr>\n";

while($row = mysqli_fetch_row($result1))
	{
	
    foreach($row as $cell)
	?>
        <h2><? echo $cell; ?><h2>
<?php
}
?>


<tr>
<td align="center" width ="200px"><h5>Brand<h5></td>
<td align="center" width ="50px" ><h5>Coups<h5></td>
<td align="center" width ="100px"><h5>Total<h5></td>
<td align="center" width ="100px"><h5>Handling<h5></td>
<td align="center" width ="100px"><h5>Postage<h5></td>
<td align="center" width ="100px"><h5>Total<h5></td>

</tr>
</div>
</body></html>

<?php
$con = mysqli_connect('198.71.225.55:3306','ganeshdesai','rama1234','manage_coupon');

$query3 = "SELECT brand as 'Brand' FROM coupon_entry where  brand like 'Marlboro' and email ='$userRow[email]' group by brand ";
$result3 = (mysqli_query($con,$query3));
if (!$result3) {
    die("Query to show fields from table failed");
}

echo "<table  align='center' border='1'>
<tr>";

while($row = mysqli_fetch_row($result3)){
	

    foreach($row as $cell3)
	?>
        <td align="center" width="200px"><? echo $cell3; ?></td>
<?php
}
?>

<?php
$con = mysqli_connect('198.71.225.55:3306','ganeshdesai','rama1234','manage_coupon');

$query4 = "SELECT sum(no_of_coupons) 
FROM coupon_entry where  email ='$userRow[email]' and brand = 'Marlboro'";
$result4 = (mysqli_query($con,$query4));
if (!$result4) {
    die("Query to show fields from table failed");
}

while($row = mysqli_fetch_row($result4)){
	

    foreach($row as $cell4)
	?>
        <td align="center" width="50px"><? echo $cell4; ?></td>
<?php
}
?>

<?php
$con = mysqli_connect('198.71.225.55:3306','ganeshdesai','rama1234','manage_coupon');
$brand = $_POST['brand'];
$query3 = "SELECT sum(coupon_entry_total) 
FROM coupon_entry where brand= 'Marlboro' and email ='$userRow[email]' ";
$result3 = (mysqli_query($con,$query3));
if (!$result3) {
    die("Query to show fields from table failed");
}

while($row = mysqli_fetch_row($result3)){
	

    foreach($row as $cell3)
	?>
        <td align="center" width="100px"><? echo $cell3; ?></td>
<?php
}
?>

<?php
$con = mysqli_connect('198.71.225.55:3306','ganeshdesai','rama1234','manage_coupon');

$query5 = "SELECT (sum(no_of_coupons) * 0.08) as 'Handling'
FROM coupon_entry  where email ='$userRow[email]' and brand ='Marlboro' ";
$result5 = (mysqli_query($con,$query5));
if (!$result5) {
    die("Query5 to show fields from table failed");
}

$fields_num = mysqli_num_fields($result5);



while($row = mysqli_fetch_row($result5)){
	

    foreach($row as $cell5)
	?>
        <td align="center" width="100px"><? echo $cell5; ?></td>
<?php
}
?>

<?php
$con = mysqli_connect('198.71.225.55:3306','ganeshdesai','rama1234','manage_coupon');
if ($postage = ($cell4 > '0' and $cell4 <= '200'))

{ $postage = '2.00';
?>
<td align="center" width="100px"><? echo $postage ;?></td>
<?php
}

elseif ($postage = ($cell4 > '200' and $cell4 <= '400'))

{ $postage = '4.00';
?>
<td align="center" width="100px"><? echo $postage ;?></td>
<?php
}
elseif ($postage = ($cell4 > '400' and $cell4 <= '600'))
{ $postage = '6.00';
?>
<td align="center" width="100px"><? echo $postage ;?></td>
<?php
}
elseif ($postage = ($cell4 > '600' and $cell4 <= '800'))
{ $postage = '8.00';
?>
<td align="center" width="100px"><? echo $postage ;?></td>
<?php
}
elseif ($postage = ($cell4 > '800' ))
{ $postage = '10.00';
?>
<td align="center" width="100px"><? echo $postage ;?></td>
<?php
}

?>
<?php
$con = mysqli_connect('198.71.225.55:3306','ganeshdesai','rama1234','manage_coupon');
if ($tot = ($cell2 + + $cell3 + $cell5+ $postage ))

	?>
        <td align="center" width="100px"><?echo number_format((float)$tot, 2, '.', ''); ?></td>
<?php

?>



</div>
</body></html>

<?php
$con = mysqli_connect('198.71.225.55:3306','ganeshdesai','rama1234','manage_coupon');

$query3 = "SELECT brand as 'Brand' FROM coupon_entry where  brand like 'Newport' and email ='$userRow[email]' group by brand ";
$result3 = (mysqli_query($con,$query3));
if (!$result3) {
    die("Query to show fields from table failed");
}

echo "<table  align='center' border='1'>
<tr>";

while($row = mysqli_fetch_row($result3)){
	

    foreach($row as $cell3)
	?>
        <td align="center" width="200px"><? echo $cell3; ?></td>
<?php
}
?>

<?php
$con = mysqli_connect('198.71.225.55:3306','ganeshdesai','rama1234','manage_coupon');

$query4 = "SELECT sum(no_of_coupons) 
FROM coupon_entry where  email ='$userRow[email]' and brand = 'Newport'";
$result4 = (mysqli_query($con,$query4));
if (!$result4) {
    die("Query to show fields from table failed");
}

while($row = mysqli_fetch_row($result4)){
	

    foreach($row as $cell4)
	?>
        <td align="center" width="50px"><? echo $cell4; ?></td>
<?php
}
?>

<?php
$con = mysqli_connect('198.71.225.55:3306','ganeshdesai','rama1234','manage_coupon');
$brand = $_POST['brand'];
$query3 = "SELECT sum(coupon_entry_total) 
FROM coupon_entry where brand= 'Newport' and email ='$userRow[email]' ";
$result3 = (mysqli_query($con,$query3));
if (!$result3) {
    die("Query to show fields from table failed");
}

while($row = mysqli_fetch_row($result3)){
	

    foreach($row as $cell3)
	?>
        <td align="center" width="100px"><? echo $cell3; ?></td>
<?php
}
?>

<?php
$con = mysqli_connect('198.71.225.55:3306','ganeshdesai','rama1234','manage_coupon');

$query5 = "SELECT (sum(no_of_coupons) * 0.08) as 'Handling'
FROM coupon_entry  where email ='$userRow[email]' and brand ='Newport' ";
$result5 = (mysqli_query($con,$query5));
if (!$result5) {
    die("Query5 to show fields from table failed");
}

$fields_num = mysqli_num_fields($result5);



while($row = mysqli_fetch_row($result5)){
	

    foreach($row as $cell5)
	?>
        <td align="center" width="100px"><? echo $cell5; ?></td>
<?php
}
?>

<?php
$con = mysqli_connect('198.71.225.55:3306','ganeshdesai','rama1234','manage_coupon');
if ($postage = ($cell4 > '0' and $cell4 <= '200'))

{ $postage = '2.00';
?>
<td align="center" width="100px"><? echo $postage ;?></td>
<?php
}

elseif ($postage = ($cell4 > '200' and $cell4 <= '400'))

{ $postage = '4.00';
?>
<td align="center" width="100px"><? echo $postage ;?></td>
<?php
}
elseif ($postage = ($cell4 > '400' and $cell4 <= '600'))
{ $postage = '6.00';
?>
<td align="center" width="100px"><? echo $postage ;?></td>
<?php
}
elseif ($postage = ($cell4 > '600' and $cell4 <= '800'))
{ $postage = '8.00';
?>
<td align="center" width="100px"><? echo $postage ;?></td>
<?php
}
elseif ($postage = ($cell4 > '800' ))
{ $postage = '10.00';
?>
<td align="center" width="100px"><? echo $postage ;?></td>
<?php
}

?>
<?php
$con = mysqli_connect('198.71.225.55:3306','ganeshdesai','rama1234','manage_coupon');
if ($tot = ($cell2 + + $cell3 + $cell5+ $postage ))

	?>
        <td align="center" width="100px"><? echo number_format((float)$tot, 2, '.', '');?></td>
		
<?php

?>


</div>
</body></html>




<?php
$con = mysqli_connect('198.71.225.55:3306','ganeshdesai','rama1234','manage_coupon');

$query3 = "SELECT brand as 'Brand' FROM coupon_entry where  brand like 'American Spirits' and email ='$userRow[email]' group by brand ";
$result3 = (mysqli_query($con,$query3));
if (!$result3) {
    die("Query to show fields from table failed");
}

echo "<table  align='center' border='1'>
<tr>";

while($row = mysqli_fetch_row($result3)){
	

    foreach($row as $cell3)
	?>
        <td align="center" width="200px"><? echo $cell3; ?></td>
<?php
}
?>

<?php
$con = mysqli_connect('198.71.225.55:3306','ganeshdesai','rama1234','manage_coupon');

$query4 = "SELECT sum(no_of_coupons) 
FROM coupon_entry where  email ='$userRow[email]' and brand = 'American Spirits'";
$result4 = (mysqli_query($con,$query4));
if (!$result4) {
    die("Query to show fields from table failed");
}

while($row = mysqli_fetch_row($result4)){
	

    foreach($row as $cell4)
	?>
        <td align="center" width="50px"><? echo $cell4; ?></td>
<?php
}
?>

<?php
$con = mysqli_connect('198.71.225.55:3306','ganeshdesai','rama1234','manage_coupon');
$brand = $_POST['brand'];
$query3 = "SELECT sum(coupon_entry_total) 
FROM coupon_entry where brand= 'American Spirits' and email ='$userRow[email]' ";
$result3 = (mysqli_query($con,$query3));
if (!$result3) {
    die("Query to show fields from table failed");
}

while($row = mysqli_fetch_row($result3)){
	

    foreach($row as $cell3)
	?>
        <td align="center" width="100px"><? echo $cell3; ?></td>
<?php
}
?>

<?php
$con = mysqli_connect('198.71.225.55:3306','ganeshdesai','rama1234','manage_coupon');

$query5 = "SELECT (sum(no_of_coupons) * 0.08) as 'Handling'
FROM coupon_entry  where email ='$userRow[email]' and brand ='American Spirits' ";
$result5 = (mysqli_query($con,$query5));
if (!$result5) {
    die("Query5 to show fields from table failed");
}

$fields_num = mysqli_num_fields($result5);



while($row = mysqli_fetch_row($result5)){
	

    foreach($row as $cell5)
	?>
        <td align="center" width="100px"><? echo $cell5; ?></td>
<?php
}
?>

<?php
$con = mysqli_connect('198.71.225.55:3306','ganeshdesai','rama1234','manage_coupon');
if ($postage = ($cell4 > '0' and $cell4 <= '200'))

{ $postage = '2.00';
?>
<td align="center" width="100px"><? echo $postage ;?></td>
<?php
}

elseif ($postage = ($cell4 > '200' and $cell4 <= '400'))

{ $postage = '4.00';
?>
<td align="center" width="100px"><? echo $postage ;?></td>
<?php
}
elseif ($postage = ($cell4 > '400' and $cell4 <= '600'))
{ $postage = '6.00';
?>
<td align="center" width="100px"><? echo $postage ;?></td>
<?php
}
elseif ($postage = ($cell4 > '600' and $cell4 <= '800'))
{ $postage = '8.00';
?>
<td align="center" width="100px"><? echo $postage ;?></td>
<?php
}
elseif ($postage = ($cell4 > '800' ))
{ $postage = '10.00';
?>
<td align="center" width="100px"><? echo $postage ;?></td>
<?php
}

?>
<?php
$con = mysqli_connect('198.71.225.55:3306','ganeshdesai','rama1234','manage_coupon');
if ($tot = ($cell2 + + $cell3 + $cell5+ $postage ))

	?>
        <td align="center" width="100px"><?echo number_format((float)$tot, 2, '.', '');?></td>
<?php

?>


</div>
</body></html>
<?php
$con = mysqli_connect('198.71.225.55:3306','ganeshdesai','rama1234','manage_coupon');

$query3 = "SELECT brand as 'Brand' FROM coupon_entry where  brand like 'Camel' and email ='$userRow[email]' group by brand ";
$result3 = (mysqli_query($con,$query3));
if (!$result3) {
    die("Query to show fields from table failed");
}

echo "<table  align='center' border='1'>
<tr>";

while($row = mysqli_fetch_row($result3)){
	

    foreach($row as $cell3)
	?>
        <td align="center" width="200px"><? echo $cell3; ?></td>
<?php
}
?>

<?php
$con = mysqli_connect('198.71.225.55:3306','ganeshdesai','rama1234','manage_coupon');

$query4 = "SELECT sum(no_of_coupons) 
FROM coupon_entry where  email ='$userRow[email]' and brand = 'Camel'";
$result4 = (mysqli_query($con,$query4));
if (!$result4) {
    die("Query to show fields from table failed");
}

while($row = mysqli_fetch_row($result4)){
	

    foreach($row as $cell4)
	?>
        <td align="center" width="50px"><? echo $cell4; ?></td>
<?php
}
?>

<?php
$con = mysqli_connect('198.71.225.55:3306','ganeshdesai','rama1234','manage_coupon');
$brand = $_POST['brand'];
$query3 = "SELECT sum(coupon_entry_total) 
FROM coupon_entry where brand= 'Camel' and email ='$userRow[email]' ";
$result3 = (mysqli_query($con,$query3));
if (!$result3) {
    die("Query to show fields from table failed");
}

while($row = mysqli_fetch_row($result3)){
	

    foreach($row as $cell3)
	?>
        <td align="center" width="100px"><? echo $cell3; ?></td>
<?php
}
?>

<?php
$con = mysqli_connect('198.71.225.55:3306','ganeshdesai','rama1234','manage_coupon');

$query5 = "SELECT (sum(no_of_coupons) * 0.08) as 'Handling'
FROM coupon_entry  where email ='$userRow[email]' and brand ='Camel' ";
$result5 = (mysqli_query($con,$query5));
if (!$result5) {
    die("Query5 to show fields from table failed");
}

$fields_num = mysqli_num_fields($result5);



while($row = mysqli_fetch_row($result5)){
	

    foreach($row as $cell5)
	?>
        <td align="center" width="100px"><? echo $cell5; ?></td>
<?php
}
?>

<?php
$con = mysqli_connect('198.71.225.55:3306','ganeshdesai','rama1234','manage_coupon');
if ($postage = ($cell4 > '0' and $cell4 <= '200'))

{ $postage = '2.00';
?>
<td align="center" width="100px"><? echo $postage ;?></td>
<?php
}

elseif ($postage = ($cell4 > '200' and $cell4 <= '400'))

{ $postage = '4.00';
?>
<td align="center" width="100px"><? echo $postage ;?></td>
<?php
}
elseif ($postage = ($cell4 > '400' and $cell4 <= '600'))
{ $postage = '6.00';
?>
<td align="center" width="100px"><? echo $postage ;?></td>
<?php
}
elseif ($postage = ($cell4 > '600' and $cell4 <= '800'))
{ $postage = '8.00';
?>
<td align="center" width="100px"><? echo $postage ;?></td>
<?php
}
elseif ($postage = ($cell4 > '800' ))
{ $postage = '10.00';
?>
<td align="center" width="100px"><? echo $postage ;?></td>
<?php
}

?>
<?php
$con = mysqli_connect('198.71.225.55:3306','ganeshdesai','rama1234','manage_coupon');
if ($tot = ($cell2 + + $cell3 + $cell5+ $postage ))

	?>
        <td align="center" width="100px"><?echo number_format((float)$tot, 2, '.', '');?></td>
<?php

?>


</div>
</body></html>
<?php
$con = mysqli_connect('198.71.225.55:3306','ganeshdesai','rama1234','manage_coupon');

$query3 = "SELECT brand as 'Brand' FROM coupon_entry where  brand like 'Pall Mall' and email ='$userRow[email]' group by brand ";
$result3 = (mysqli_query($con,$query3));
if (!$result3) {
    die("Query to show fields from table failed");
}

echo "<table  align='center' border='1'>
<tr>";

while($row = mysqli_fetch_row($result3)){
	

    foreach($row as $cell3)
	?>
        <td align="center" width="200px"><? echo $cell3; ?></td>
<?php
}
?>

<?php
$con = mysqli_connect('198.71.225.55:3306','ganeshdesai','rama1234','manage_coupon');

$query4 = "SELECT sum(no_of_coupons) 
FROM coupon_entry where  email ='$userRow[email]' and brand = 'Pall Mall'";
$result4 = (mysqli_query($con,$query4));
if (!$result4) {
    die("Query to show fields from table failed");
}

while($row = mysqli_fetch_row($result4)){
	

    foreach($row as $cell4)
	?>
        <td align="center" width="50px"><? echo $cell4; ?></td>
<?php
}
?>

<?php
$con = mysqli_connect('198.71.225.55:3306','ganeshdesai','rama1234','manage_coupon');
$brand = $_POST['brand'];
$query3 = "SELECT sum(coupon_entry_total) 
FROM coupon_entry where brand= 'Pall Mall' and email ='$userRow[email]' ";
$result3 = (mysqli_query($con,$query3));
if (!$result3) {
    die("Query to show fields from table failed");
}

while($row = mysqli_fetch_row($result3)){
	

    foreach($row as $cell3)
	?>
        <td align="center" width="100px"><? echo $cell3; ?></td>
<?php
}
?>

<?php
$con = mysqli_connect('198.71.225.55:3306','ganeshdesai','rama1234','manage_coupon');

$query5 = "SELECT (sum(no_of_coupons) * 0.08) as 'Handling'
FROM coupon_entry  where email ='$userRow[email]' and brand ='Pall Mall' ";
$result5 = (mysqli_query($con,$query5));
if (!$result5) {
    die("Query5 to show fields from table failed");
}

$fields_num = mysqli_num_fields($result5);



while($row = mysqli_fetch_row($result5)){
	

    foreach($row as $cell5)
	?>
        <td align="center" width="100px"><? echo $cell5; ?></td>
<?php
}
?>

<?php
$con = mysqli_connect('198.71.225.55:3306','ganeshdesai','rama1234','manage_coupon');
if ($postage = ($cell4 > '0' and $cell4 <= '200'))

{ $postage = '2.00';
?>
<td align="center" width="100px"><? echo $postage ;?></td>
<?php
}

elseif ($postage = ($cell4 > '200' and $cell4 <= '400'))

{ $postage = '4.00';
?>
<td align="center" width="100px"><? echo $postage ;?></td>
<?php
}
elseif ($postage = ($cell4 > '400' and $cell4 <= '600'))
{ $postage = '6.00';
?>
<td align="center" width="100px"><? echo $postage ;?></td>
<?php
}
elseif ($postage = ($cell4 > '600' and $cell4 <= '800'))
{ $postage = '8.00';
?>
<td align="center" width="100px"><? echo $postage ;?></td>
<?php
}
elseif ($postage = ($cell4 > '800' ))
{ $postage = '10.00';
?>
<td align="center" width="100px"><? echo $postage ;?></td>
<?php
}

?>
<?php
$con = mysqli_connect('198.71.225.55:3306','ganeshdesai','rama1234','manage_coupon');
if ($tot = ($cell2 + + $cell3 + $cell5+ $postage ))

	?>
        <td align="center" width="100px"><?echo number_format((float)$tot, 2, '.', '');?></td>
<?php

?>


</div>
</body></html>
<?php
$con = mysqli_connect('198.71.225.55:3306','ganeshdesai','rama1234','manage_coupon');

$query3 = "SELECT brand as 'Brand' FROM coupon_entry where  brand like 'Markten' and email ='$userRow[email]' group by brand ";
$result3 = (mysqli_query($con,$query3));
if (!$result3) {
    die("Query to show fields from table failed");
}

echo "<table  align='center' border='1'>
<tr>";

while($row = mysqli_fetch_row($result3)){
	

    foreach($row as $cell3)
	?>
        <td align="center" width="200px"><? echo $cell3; ?></td>
<?php
}
?>

<?php
$con = mysqli_connect('198.71.225.55:3306','ganeshdesai','rama1234','manage_coupon');

$query4 = "SELECT sum(no_of_coupons) 
FROM coupon_entry where  email ='$userRow[email]' and brand = 'Markten'";
$result4 = (mysqli_query($con,$query4));
if (!$result4) {
    die("Query to show fields from table failed");
}

while($row = mysqli_fetch_row($result4)){
	

    foreach($row as $cell4)
	?>
        <td align="center" width="50px"><? echo $cell4; ?></td>
<?php
}
?>

<?php
$con = mysqli_connect('198.71.225.55:3306','ganeshdesai','rama1234','manage_coupon');
$brand = $_POST['brand'];
$query3 = "SELECT sum(coupon_entry_total) 
FROM coupon_entry where brand= 'Markten' and email ='$userRow[email]' ";
$result3 = (mysqli_query($con,$query3));
if (!$result3) {
    die("Query to show fields from table failed");
}

while($row = mysqli_fetch_row($result3)){
	

    foreach($row as $cell3)
	?>
        <td align="center" width="100px"><? echo $cell3; ?></td>
<?php
}
?>

<?php
$con = mysqli_connect('198.71.225.55:3306','ganeshdesai','rama1234','manage_coupon');

$query5 = "SELECT (sum(no_of_coupons) * 0.08) as 'Handling'
FROM coupon_entry  where email ='$userRow[email]' and brand ='Markten' ";
$result5 = (mysqli_query($con,$query5));
if (!$result5) {
    die("Query5 to show fields from table failed");
}

$fields_num = mysqli_num_fields($result5);



while($row = mysqli_fetch_row($result5)){
	

    foreach($row as $cell5)
	?>
        <td align="center" width="100px"><? echo $cell5; ?></td>
<?php
}
?>

<?php
$con = mysqli_connect('198.71.225.55:3306','ganeshdesai','rama1234','manage_coupon');
if ($postage = ($cell4 > '0' and $cell4 <= '200'))

{ $postage = '2.00';
?>
<td align="center" width="100px"><? echo $postage ;?></td>
<?php
}

elseif ($postage = ($cell4 > '200' and $cell4 <= '400'))

{ $postage = '4.00';
?>
<td align="center" width="100px"><? echo $postage ;?></td>
<?php
}
elseif ($postage = ($cell4 > '400' and $cell4 <= '600'))
{ $postage = '6.00';
?>
<td align="center" width="100px"><? echo $postage ;?></td>
<?php
}
elseif ($postage = ($cell4 > '600' and $cell4 <= '800'))
{ $postage = '8.00';
?>
<td align="center" width="100px"><? echo $postage ;?></td>
<?php
}
elseif ($postage = ($cell4 > '800' ))
{ $postage = '10.00';
?>
<td align="center" width="100px"><? echo $postage ;?></td>
<?php
}

?>
<?php
$con = mysqli_connect('198.71.225.55:3306','ganeshdesai','rama1234','manage_coupon');
if ($tot = ($cell2 + + $cell3 + $cell5+ $postage ))

	?>
        <td align="center" width="100px"><?echo number_format((float)$tot, 2, '.', ''); ?></td>
<?php

?>


</div>
</body></html>
