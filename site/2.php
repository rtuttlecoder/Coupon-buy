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
<link rel="stylesheet" href="http://www.managecoupon.com/css/enter.css" type="text/css" />
</head>
<body>
<div id="header">
	<div id="left">
 
<a href="http://www.managecoupon.com/home.php"><img src="http://www.managecoupon.com/images/logo2.png" alt="logo area"  class="logo"/></a>
    </div>
    <div id="right">
    	<div id="content">
                <a href="http://www.managecoupon.com/tryone.php">View Reports</a>   
        	hi' <?php echo $userRow['username']; ?>&nbsp;<a href="http://www.managecoupon.com/logout.php?logout">Sign Out</a>
        </div>
    </div>
</div>
</body>
</html>


<?php
session_start();
if(!isset($_SESSION['user']))

{ header("Location: http://www.managecoupon.com/index.php"); }

$con = mysqli_connect('198.71.225.55:3306','ganeshdesai','rama1234','manage_coupon');
if(isset($_POST['save-data']))
{
	$qry = "SELECT * FROM users WHERE userid =".$_SESSION['user'];
        $reslt = mysqli_query($con,$qry);
        $userRow = mysqli_fetch_array($reslt);
        

	
	//$current_date = $_POST['current_date'];
	$brand = $_POST['brand'];
	$type_of_coupon = $_POST['type_of_coupon'];
	$noofcoupons = $_POST['noofcoupons'];
	$product_price = $_POST['product_price'];
	
	
	$sql = "insert into coupon_entry (brand,coupon_type,no_of_coupons,email)
	values ('$brand','$type_of_coupon','$noofcoupons' ,'$userRow[email]')";
	
	$sql1 = "update coupon_entry set coupon_value = 1 ORDER  BY id_coupon_entry desc LIMIT 1";
	$sql2 = "update coupon_entry set coupon_value = 1.5 ORDER  BY id_coupon_entry desc LIMIT 1";
	$sql3 = "update coupon_entry set coupon_value = 2 ORDER  BY id_coupon_entry desc LIMIT 1";
	$sql4 = "update coupon_entry set coupon_value = 2.5 ORDER  BY id_coupon_entry desc LIMIT 1";
	$sql5 = "update coupon_entry set coupon_value = 3 ORDER  BY id_coupon_entry desc LIMIT 1";
	$sql6 = "update coupon_entry set coupon_value = .5 ORDER  BY id_coupon_entry desc LIMIT 1";
	$sql7 = "update coupon_entry set coupon_value = '$product_price'  ORDER  BY id_coupon_entry desc LIMIT 1";
	$sql8 = "UPDATE coupon_entry  SET coupon_value = ('$product_price' - 1) ORDER  BY id_coupon_entry desc LIMIT 1";
	$sql9 = "UPDATE coupon_entry  SET coupon_value = ('$product_price' - 2) ORDER  BY id_coupon_entry desc LIMIT 1";
	$sql10 = "UPDATE coupon_entry  SET coupon_value = ('$product_price' - 3) ORDER  BY id_coupon_entry desc LIMIT 1";
	$sql11 = "update coupon_entry set coupon_entry_total = (coupon_value * no_of_coupons ) ";
	$sql12 = "update coupon_entry set product_net_price = '$product_price' ORDER  BY id_coupon_entry desc LIMIT 1";
	
	if (mysqli_query($con,$sql));
	if (mysqli_query($con,$sql12));
	
	switch ($type_of_coupon)
	{
		case "1 $ OFF":
	
		(mysqli_query($con,$sql1));
		
		break;
	
		case "1.50 $ OFF":
	
		(mysqli_query($con,$sql2));
		
		break;
		
		case "2 $ OFF":
	
		(mysqli_query($con,$sql3));
		
		break;
		
		case "2.50 $ OFF":
	
		(mysqli_query($con,$sql4));
		
		break;
		
		case "3 $ OFF":
	
		(mysqli_query($con,$sql5));
		
		break;
		
		case "50 Cents OFF":
	
		(mysqli_query($con,$sql6));
		
		break;
		
		case "Free":
	
		(mysqli_query($con,$sql7));
		
		break;
		
		case "Pack For 1 $":
		
	
		(mysqli_query($con,$sql8));
		
		break;
		
		case "Pack For 2 $":
		
	
		(mysqli_query($con,$sql9));
		
		break;
		
		case "Pack For 3 $":
		
	
		(mysqli_query($con,$sql10));
		
		break;
		
	}
	if (mysqli_query($con,$sql11));
	
}
		
	?>

<?php

$con = mysqli_connect('198.71.225.55:3306','ganeshdesai','rama1234','manage_coupon');

$query = "select brand from manufacturer_master";
$query2 = "select coupon_type from coupon_master group by coupon_type";
$result1 = mysqli_query ($con,$query);
$result2 = mysqli_query ($con,$query2);


?>

<!DOCTYPE html>
<html> 
	<head>
		<meta charset="utf-8"/>
	    <title>Enter Coupon </title>



<script language="javascript">
function checktype(){

switch(document.getElementById('mySelect').value)
{
case "Pack For 1 $":
document.getElementById("other-div").style.display = 'block';
break;

case "Pack For 2 $":
document.getElementById("other-div").style.display = 'block';
break;

case "Pack For 3 $":
document.getElementById("other-div").style.display = 'block';
break;

case "Free":
document.getElementById("other-div").style.display = 'block';
break;
default:
document.getElementById("other-div").style.display = 'none';
break;


}
}

</script>
    
	</head>
<div align="center">
	<body>
<form method="POST">
<table width="320px" border="1">
<tr>		
	<td align="right"><FONT FACE="Verdana">Brand :</FONT>
                <select  name="brand"  >	
                <?php while ($row1 = mysqli_fetch_array($result1)):;?>
		<option value="" disabled selected style="display: none;">Select Brand</option>
                 <option><?php echo $row1['brand'];?></option>
		<?php endwhile;?>
			</select></td>
	</tr>
	</br>
	<tr>	<td align="right"><FONT FACE="Verdana">Type Of Coupon :</FONT>
          <select id="mySelect" onchange="checktype();" name="type_of_coupon" >
		<?php while ($row1 = mysqli_fetch_array($result2)):;?>
<option value="" disabled selected style="display: none;">Select Type</option>    	
<option><?php echo $row1['coupon_type'];?></option>
		<?php endwhile;?>
			</select>
			</td>
</tr>
<tr>				
<td align="right"><div id="other-div" style="display:none;">
       <FONT FACE="Verdana">Enter Net Price :</FONT><input  id="other-input" type="text" name="product_price" placeholder="Enter Product Net Price" ></td>
			
</div>
			</tr>
</br>
	
	<tr>
	<td align="right"><FONT FACE="Verdana">No. Of Coupons :</FONT> 
          <input type="integer" name="noofcoupons" placeholder="00" required ></td>
			
        </tr>
</br>
	<tr>
	<td align="center"><input type="submit" value="SAVE"  name="save-data"></td>
        </tr>

</table>

</form>
	
</div>

	<html><head><title>MySQL Table Viewer</title></head>
<div class="home" align="center">
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


$query = "SELECT * FROM coupon_entry  where email = '$userRow[email]' order by id_coupon_entry desc limit 5";
$result = (mysqli_query($con,$query));
if (!$result) {
    die("Query to show fields from table failed");
}

//$fields_num = mysqli_num_fields($result);

?>
<table border="1px" >

<tr>
<td align="center" ><h5>Date<h5></td>
<td align="center" ><h5>Brand<h5></td>
<td align="center" ><h5>Value Of Coupon<h5></td>
<td align="center" ><h5>No. Of Coupon<h5></td>
<td align="center" ><h5>Total<h5></td>

</tr>


<?php
while($rows=mysqli_fetch_array($result)){
?>

<tr>
<td align="center"><? echo $rows['coupon_entry_date']; ?></td>
<td align="center"><? echo $rows['brand']; ?></td>
<td align="center"><? echo $rows['coupon_value']; ?></td>
<td align="center"><? echo $rows['no_of_coupons']; ?></td>
<td align="right"><? echo $rows['coupon_entry_total']; ?></td>
<td align="center"><a href="http://www.managecoupon.com/delete.php?id_coupon_entry=<? echo $rows['id_coupon_entry']; ?>">delete</a></td>
</tr>

<?php
// close while loop 
}
?>
</table>
</div>
</body></html>



