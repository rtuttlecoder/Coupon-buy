<?php
session_start();
if(!isset($_SESSION['userSession']))

{ header("Location: index.php"); }

$con = mysqli_connect('198.71.225.55:3306','ganeshdesai','rama1234','manage_coupon');

	$qry = "SELECT * FROM tbl_users WHERE userID =".$_SESSION['userSession'];
        $reslt = mysqli_query($con,$qry);
        $userRow = mysqli_fetch_array($reslt);

?>
<!DOCTYPE html>
<html class="no-js">
    
    <head>
        <title><?php echo $userRow['userName']; ?></title>
        <!-- Bootstrap -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
        <link href="assets/styles.css" rel="stylesheet" media="screen">
        
        
    </head>
    
    <body>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                    </a>
                    <a class="brand" href="home.php">Member Home</a>
                    <div class="nav-collapse collapse">
                        <ul class="nav pull-right">
                            
                                 <p style="float:right;"><h4><i class="icon-user" style="vertical-align:middle;"></i>&nbsp; <?php echo $userRow['userName']; ?>&nbsp;&nbsp;&nbsp;<a href="logout.php" >Logout</a> </h4></P>
                               
                        </ul>
                        
                            
                    </div>
                    <!--/.nav-collapse -->
                </div>
            </div>
        </div>
        
        <!--/.fluid-container-->
        <script src="bootstrap/js/jquery-1.9.1.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/scripts.js"></script>
        
    </body>

</html>

<?php
session_start();
if(!isset($_SESSION['userSession']))

{ header("Location: index.php"); }

$con = mysqli_connect('198.71.225.55:3306','ganeshdesai','rama1234','manage_coupon');

if(isset($_POST['save-data']))
{
	$qry = "SELECT * FROM tbl_users WHERE userID =".$_SESSION['userSession'];
        $reslt = mysqli_query($con,$qry);
        $userRow = mysqli_fetch_array($reslt);
        

	
	//$current_date = $_POST['current_date'];
	//$brand = $_POST['brand'];
	if (empty($_POST['type_of_coupon'])) {
     $coupontypeErr = "Please Select Type of Coupon";
   } else {
     $type_of_coupon = $_POST['type_of_coupon'];
   }
	//$type_of_coupon = $_POST['type_of_coupon'];
	$noofcoupons = $_POST['noofcoupons'];
	$product_price = $_POST['product_price'];
	
	
	$sql = "insert into coupon_entry (brand,coupon_type,no_of_coupons,userEmail)
	values ('Skoal','$type_of_coupon','$noofcoupons' ,'$userRow[userEmail]')";
	
	$sql1 = "update coupon_entry set coupon_value = 1 where userEmail = '$userRow[userEmail]' ORDER  BY id_coupon_entry desc LIMIT 1";
	$sql2 = "update coupon_entry set coupon_value = 1.5 where userEmail = '$userRow[userEmail]' ORDER  BY id_coupon_entry desc LIMIT 1";
	$sql3 = "update coupon_entry set coupon_value = 2 where userEmail = '$userRow[userEmail]' ORDER  BY id_coupon_entry desc LIMIT 1";
	$sql4 = "update coupon_entry set coupon_value = 2.5 where userEmail = '$userRow[userEmail]' ORDER  BY id_coupon_entry desc LIMIT 1";
	$sql5 = "update coupon_entry set coupon_value = 3 where userEmail = '$userRow[userEmail]' ORDER  BY id_coupon_entry desc LIMIT 1";
	$sql6 = "update coupon_entry set coupon_value = .5 where userEmail = '$userRow[userEmail]' ORDER  BY id_coupon_entry desc LIMIT 1";
	$sql7 = "update coupon_entry set coupon_value = '$product_price'  where userEmail = '$userRow[userEmail]' ORDER  BY id_coupon_entry desc LIMIT 1";
	$sql8 = "UPDATE coupon_entry  SET coupon_value = ('$product_price' - 1) where userEmail = '$userRow[userEmail]' ORDER  BY id_coupon_entry desc LIMIT 1";
	$sql9 = "UPDATE coupon_entry  SET coupon_value = ('$product_price' - 2) where userEmail = '$userRow[userEmail]' ORDER  BY id_coupon_entry desc LIMIT 1";
	$sql10 = "UPDATE coupon_entry  SET coupon_value = ('$product_price' - 3) where userEmail = '$userRow[userEmail]' ORDER  BY id_coupon_entry desc LIMIT 1";
	$sql11 = "update coupon_entry set coupon_entry_total = (coupon_value * no_of_coupons ) ";
	$sql12 = "update coupon_entry set product_net_price = '$product_price' where userEmail = '$userRow[userEmail]' ORDER  BY id_coupon_entry desc LIMIT 1";
	$sql13 = "update coupon_entry set coupon_value = 5 where userEmail = '$userRow[userEmail]' ORDER  BY id_coupon_entry desc LIMIT 1";
	$sql14 = "delete from coupon_entry where userEmail='$userRow[userEmail]' ORDER  BY id_coupon_entry desc LIMIT 1";
	$sql15 = "update coupon_entry set coupon_value = 10 where userEmail = '$userRow[userEmail]' ORDER  BY id_coupon_entry desc LIMIT 1";
	$sql16 = "update coupon_entry set coupon_value = 3.5 where userEmail = '$userRow[userEmail]' ORDER  BY id_coupon_entry desc LIMIT 1";
	
	if (mysqli_query($con,$sql));
	if (mysqli_query($con,$sql12));
	
	switch ($noofcoupons)
	{case "0": 
	(mysqli_query($con,$sql14));
	break;}
	
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
		
		case "5 $ OFF":
	
		(mysqli_query($con,$sql13));
		
		break;
		
		case "50 Cents OFF":
	
		(mysqli_query($con,$sql6));
		
		break;
		
		case "Buy 1 Get 1 Free":
	
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
		
		case "Tin For 1 $":
		
		(mysqli_query($con,$sql8));
		
		break;
		
		case "3.50 $ OFF":
		
		(mysqli_query($con,$sql16));
		
		break;
		
		case "":
		
	
		(mysqli_query($con,$sql14));
		
		break;
		
	}
	if (mysqli_query($con,$sql11));
	
}
		
	?>

<?php

$con = mysqli_connect('198.71.225.55:3306','ganeshdesai','rama1234','manage_coupon');

$query = "select brand from manufacturer_master";
$query2 = "select coupon_type from coupon_master where brand = 'Skoal' ";
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

case "Buy 1 Get 1 Free":
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
     <SCRIPT>
      <!--
      function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }
      //-->
   </SCRIPT>
	</head>
<div align="center">
	<body bgcolor="#c3e3ef">

	<form method="POST">
<table width="335px" border="0">
<tr >
<td align="center" bgcolor ="#72b5e6"><font Color ="#e0eded"><h1>Skoal<h1></td></tr>
	</br>
	<tr>
	
<td  bgcolor ="#e0eded" style ="padding-top:10px">
	<label style="float:left;width:170px;margin:10px" ><FONT FACE="Verdana"><b>Type Of Coupon :<b></FONT></label>
    <select id="mySelect" onchange="checktype();" name="type_of_coupon" 
	class="input-block-level" style="width:130px;border:5px">
		<option value="" disabled selected style="display: none;">Select Type</option>    	
		
		<?php while ($row1 = mysqli_fetch_array($result2)):;?>
		<option><?php echo $row1['coupon_type'];?></option>
		<?php endwhile;?>
		</select>
			<span class="error"><font Color ="red" size="2px"><?php echo $coupontypeErr;?></span>
		</td>
	</tr>
	<tr>				
<td bgcolor ="#e0eded"><div id="other-div" style="display:none;">
   <label style="float:left; width:170px;margin:10px" ><FONT FACE="Verdana"><b>Enter Product Price :<b></FONT></label>
   <input id="other-input" type="text" name="product_price" size="8" placeholder="0.00"
         class="input-block-level" style="width:130px;border:5px" >
   </td>
			
</div>
			</tr>
</br>
	
	<tr>
	<td  bgcolor ="#e0eded" >
	<label style="float:left; width:170px;margin:10px" ><FONT FACE="Verdana"><b>No. Of Coupons :<b></FONT></label> 
          <input type="integer" onkeypress="return isNumberKey(event)" 
		  class="input-block-level" style="width:130px;border:5px"
		  name="noofcoupons" placeholder="00" size="8" required ></td>
			
        </tr>
</br>
	<tr>
	<td align="center" bgcolor ="#e0eded" style ="padding-bottom:10px"><input type="submit" 
	value="SAVE"  class="btn btn-large btn-primary"  name="save-data" 
	style="width:100px;height:25px;padding-top:2px" ></td>
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


$query = "SELECT  coupon_entry_date , coupon_value , sum(no_of_coupons) as 'noofcoupons' , 
sum(coupon_entry_total) as 'total'
 FROM coupon_entry  where userEmail = '$userRow[userEmail]' and
 brand = 'Skoal' and invoice_no = '0' group by coupon_value";
$result = (mysqli_query($con,$query));
if (!$result) {
    die("Query to show fields from table failed");
}

//$fields_num = mysqli_num_fields($result);

?>
<table border="1px">

<tr>
<td align="center" bgcolor ="#d3dfdf" style = "width:85px"><h5>Value Of Coupon<h5></td>
<td align="center" bgcolor ="#d3dfdf" style = "width:80px"><h5>No. Of Coupon<h5></td>
<td align="center" bgcolor ="#d3dfdf" style = "width:80px"><h5>Total<h5></td>
<td align="center" bgcolor ="#d3dfdf"style = "width:80px"><h5>Delete<h5></td>
</tr>


<?php
while($rows=mysqli_fetch_array($result)){
?>

<tr>

<td align="center" bgcolor="white" style = "width:85px"><? echo $rows['coupon_value']; ?></td>
<td align="center" bgcolor="white"style = "width:80px"><? echo $rows['noofcoupons']; ?></td>
<td align="center" bgcolor="white" style = "width:80px"><? echo $rows['total']; ?></td>
<td align="center" bgcolor="white"style = "width:80px"><a href="deleteskoal.php?coupon_value=<? echo $rows['coupon_value']; ?>">
<img src="images/bin.png" alt="delete"  class="delete"/></a></td>
</tr>

<?php
// close while loop 
}
?>
<tr>
	

</table>
</br>
<?php
$con = mysqli_connect('198.71.225.55:3306','ganeshdesai','rama1234','manage_coupon');
$sql20 = "select *  from coupon_entry 
where userEmail = '$userRow[userEmail]'  and
brand = 'Skoal' ORDER  BY id_coupon_entry desc LIMIT 1 ";
$result20 = (mysqli_query($con,$sql20));
while($rows = mysqli_fetch_array($result20))
	$min = $rows['invoice_no'] ;

if ($min != '0' )

{
?>
<table>
 <td bgcolor="white"><b><?echo '<a href ="skoaledit.php">Edit Last Invoice</a>'; ?><b></td>
 </tr>
 </table> 
<?php
	}
	else 
	{
?>
<tr>
	
</table>
<table>
<td align="center" bgcolor ="white"><b><a href ="skoalinvoiceno.php">Generate Invoice</a><b></td>
        </tr>
	</table>
	<?php }
	?>

	
</div>
</body></html>



