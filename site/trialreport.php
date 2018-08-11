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
<div id="header">
	<div id="left">
    <a href="http://www.managecoupon.com/home.php"><img src="http://www.managecoupon.com/images/logo2.png" alt="logo area"  class="logo"/></a>
    </div>
    <div id="right">
    	<div id="content">
               <a href="http://www.managecoupon.com/2.php">Enter Coupons</a>
        	hi' <?php echo $userRow['username']; ?>&nbsp;<a href="http://www.managecoupon.com/logout.php?logout">Sign Out</a>
        </div>
    </div>
</div>
</body>
</html>



<?php

$con = mysqli_connect('198.71.225.55:3306','ganeshdesai','rama1234','manage_coupon');

$query = "select brand from manufacturer_master";

$result1 = mysqli_query ($con,$query);


?>

<!DOCTYPE html>
<html> 
	<head>
		<meta charset="utf-8"/>
	    <title>Enter Coupon </title>

	</head>
<div align="center">
	<body>
	<form  method="POST">
	<table >
  <tr>		
	<td align="right"><label for="brand">Brand :</label>
                <select name="brand" >	
                <?php while ($row1 = mysqli_fetch_array($result1)):;?>
		<option value="" disabled selected style="display: none;"> Select Brand</option>
		<option ><?php echo $row1['brand'];?></option>
		
		<?php endwhile;?>
			</select></td>
	</tr>
	</br>
		<tr>
	<td align="center"><input type="submit" value="PREVIEW-REPORT"  name="save-data"></td>
        </tr>
		</br>
		<tr>
	        <td><button onClick="window.print()">Print this page</button> </td>
            </tr>
    
</table>

</form>
	
</div>
	
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

//echo "<h1>Table: {$table}</h1>";
echo "<table  align='center' border='0'>
<tr>";
// printing table headers

echo "</tr>\n";
// printing table rows
while($row = mysqli_fetch_row($result1))
{
   echo "<tr>";

    // $row is array... foreach( .. ) puts every element
    // of $row to $cell variable
    foreach($row as $cell)
       echo "<td>$cell</td>";

    //echo "</tr>\n";
}
?>
</div>
</body></html>
<html><head><title>MySQL Table Viewer</title></head>
<div align="center">

<?php
$con = mysqli_connect('198.71.225.55:3306','ganeshdesai','rama1234','manage_coupon');


$query1 = "SELECT cust_company_address 
  FROM cust_company_information where email = '$userRow[email]'";

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
// printing table rows
while($row = mysqli_fetch_row($result1))
{
   //echo "<tr>";

    // $row is array... foreach( .. ) puts every element
    // of $row to $cell variable
    foreach($row as $cell)
       echo "<td>$cell</td>";

   // echo "</tr>\n";
}
?>
</div>
</body></html>
<html><head><title>MySQL Table Viewer</title></head>
<div align="center">

<?php
$con = mysqli_connect('198.71.225.55:3306','ganeshdesai','rama1234','manage_coupon');


$query1 = "SELECT  
cust_company_city,cust_company_state ,
cust_company_zipcode   FROM cust_company_information where email = '$userRow[email]'";

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
// printing table rows
while($row = mysqli_fetch_row($result1))
{
   //echo "<tr>";

    // $row is array... foreach( .. ) puts every element
    // of $row to $cell variable
    foreach($row as $cell)
       echo "<td>$cell</td>";

    echo "</tr>\n";
}
?>
</div>
</body></html>

<?php
// sending query
$con = mysqli_connect('198.71.225.55:3306','ganeshdesai','rama1234','manage_coupon');
$brand = $_POST['brand'];
$query2 = "SELECT coupon_value as 'Value of Coupon' , sum(no_of_coupons) as 'No. Of Coupons' , 
sum(coupon_entry_total) as 'Total' FROM coupon_entry where brand='$brand' and email ='$userRow[email]' group by coupon_value";
$result2 = (mysqli_query($con,$query2));
if (!$result2) {
    die("Query2 to show fields from table failed");
}

$fields_num = mysqli_num_fields($result2);

//echo "<h1>Table: {$table}</h1>";
echo "<table  align='center' border='1'>
<tr>";
// printing table headers
for($i=0; $i<$fields_num; $i++)
{
    $field = mysqli_fetch_field($result2);
    echo "<td>{$field->name}</td>";
}
echo "</tr>\n";
// printing table rows
while($row = mysqli_fetch_row($result2))
{
    echo "<tr>";

    // $row is array... foreach( .. ) puts every element
    // of $row to $cell variable
    foreach($row as $cell)
        echo "<td>$cell</td>";

    echo "</tr>\n";
}
?>
<?php
$con = mysqli_connect('198.71.225.55:3306','ganeshdesai','rama1234','manage_coupon');
$brand = $_POST['brand'];
$query3 = "SELECT sum(coupon_entry_total) 
FROM coupon_entry where brand='$brand' and email ='$userRow[email]' group by brand ";
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
FROM coupon_entry where brand='$brand' and email ='$userRow[email]' group by brand ";
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
        echo "<td>Total no. of Coupons</td><td>$cell1</td>";

    echo "</tr>\n";
}
?>
<?php
$con = mysqli_connect('198.71.225.55:3306','ganeshdesai','rama1234','manage_coupon');
$brand = $_POST['brand'];
$query5 = "SELECT (sum(no_of_coupons) * 0.08) 
FROM coupon_entry where brand='$brand' and email ='$userRow[email]' group by brand ";
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
        echo "<td>Coupon Handling $0.08/Coupon</td><td>$cell3</td>";

    echo "</tr>\n";
}
?>
<?php
$con = mysqli_connect('198.71.225.55:3306','ganeshdesai','rama1234','manage_coupon');


if ($postage = ($cell1 > '0' and $cell1 <= '200'))

{ $postage = '2.00';
echo "<tr>";
echo "<td>Approximate Postage</td><td>$postage</td>";
echo "</tr>\n";}
elseif ($postage = ($cell1 > '200' and $cell1 <= '400'))
{ $postage = '4.00';
echo "<tr>";
echo "<td>Approximate Postage</td><td>$postage</td>";
echo "</tr>\n";}
elseif ($postage = ($cell1 > '400' and $cell1 <= '600'))
{ $postage = '6.00';
echo "<tr>";
echo "<td>Approximate Postage</td><td>$postage</td>";
echo "</tr>\n";}
elseif ($postage = ($cell1 > '600' and $cell1 <= '800'))
{ $postage = '8.00';
echo "<tr>";
echo "<td>Approximate Postage</td><td>$postage</td>";
echo "</tr>\n";}
elseif ($postage = ($cell1 > '800' ))
{ $postage = '10.00';
echo "<tr>";
echo "<td>Approximate Postage</td><td>$postage</td>";
echo "</tr>\n";}
?>
<?php
$con = mysqli_connect('198.71.225.55:3306','ganeshdesai','rama1234','manage_coupon');
if ($tot = ($cell2 + $cell3 + $postage ))
{echo "<tr>";
	echo "<td>Grand Total</td><td>$tot</td>";
	echo "</tr>\n";}

?>

<html><head><title>MySQL Table Viewer</title></head>
<div align="center">

<?php
$con = mysqli_connect('198.71.225.55:3306','ganeshdesai','rama1234','manage_coupon');

$brand = $_POST['brand'];

$query1 = "SELECT manufacturer_name FROM manufacturer_master WHERE brand = '$brand'";

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
// printing table rows
while($row = mysqli_fetch_row($result1))
{
   echo "<tr>";

    // $row is array... foreach( .. ) puts every element
    // of $row to $cell variable
    foreach($row as $cell)
       echo "<td>$cell</td>";

    //echo "</tr>\n";
}
?>
</div>
</body></html>
<html><head><title>MySQL Table Viewer</title></head>
<div align="center">

<?php
$con = mysqli_connect('198.71.225.55:3306','ganeshdesai','rama1234','manage_coupon');

$brand = $_POST['brand'];

$query1 = "SELECT coupon_mailing_add1 FROM 
manufacturer_master WHERE brand = '$brand'";


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
// printing table rows
while($row = mysqli_fetch_row($result1))
{
   //echo "<tr>";

    // $row is array... foreach( .. ) puts every element
    // of $row to $cell variable
    foreach($row as $cell)
       echo "<td>$cell</td>";

   // echo "</tr>\n";
}
?>
</div>
</body></html>
<html><head><title>MySQL Table Viewer</title></head>
<div align="center">
<?php
$con = mysqli_connect('198.71.225.55:3306','ganeshdesai','rama1234','manage_coupon');

$brand = $_POST['brand'];

$query1 = "SELECT coupon_mailing_add2 FROM 
manufacturer_master WHERE brand = '$brand'";


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
// printing table rows
while($row = mysqli_fetch_row($result1))
{
   //echo "<tr>";

    // $row is array... foreach( .. ) puts every element
    // of $row to $cell variable
    foreach($row as $cell)
       echo "<td>$cell</td>";

   // echo "</tr>\n";
}
?>
</div>
</body></html>
<html><head><title>MySQL Table Viewer</title></head>
<div align="center">

<?php
$con = mysqli_connect('198.71.225.55:3306','ganeshdesai','rama1234','manage_coupon');

$brand = $_POST['brand'];

$query1 = "SELECT coupon_mailing_city, coupon_mailing_state, coupon_mailing_zipcode
 FROM manufacturer_master WHERE brand = '$brand'";


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
// printing table rows
while($row = mysqli_fetch_row($result1))
{
   //echo "<tr>";

    // $row is array... foreach( .. ) puts every element
    // of $row to $cell variable
    foreach($row as $cell)
       echo "<td>$cell</td>";

    echo "</tr>\n";
}
?>
</div>
</body></html>
