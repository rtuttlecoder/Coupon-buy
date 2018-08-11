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
	$coupon_value = $_POST['coupon_value'];
	$brand = $_POST['brand'];
	
	$sql = "insert into coupon_entry (brand,coupon_value,no_of_coupons,userEmail,invoice_no,check_received )
	values ('$brand','$coupon_value','$noofcoupons' ,'$userRow[userEmail]','0','no')";
	
	
	$sql11 = "update coupon_entry set coupon_entry_total = (coupon_value * no_of_coupons ) ";
	
	if (mysqli_query($con,$sql));
	if (mysqli_query($con,$sql11));
	
	
	}
	
	
	?>



<!DOCTYPE html>
<html> 
	<head>
		<meta charset="utf-8"/>
	    <title>Enter Coupon </title>


	</head>
<div align="center">
	<body bgcolor="#c3e3ef">

	<form method="POST">
<table width="335px" border="0">
<tr >
<td align="center" bgcolor ="#72b5e6"><font Color ="#e0eded"><h1>Occasional<h1></td></tr>
	
	<tr>
	
<td  bgcolor ="#e0eded" style ="padding-top:10px">
	<label style="float:left;width:170px;margin:10px" ><FONT FACE="Verdana"><b>Brand :<b></FONT></label>
    <input id="mySelect"  name="brand"  class="input-block-level" style="width:130px;border:5px">
			
		</td>
	</tr>
	<tr>
	
<td  bgcolor ="#e0eded" style ="padding-top:10px">
	<label style="float:left;width:170px;margin:10px" ><FONT FACE="Verdana"><b>Value Of Coupon :<b></FONT></label>
    <input id="mySelect"  name="coupon_value"  class="input-block-level" style="width:130px;border:5px">
			
		</td>
	</tr>
	
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
 brand = '$brand' and invoice_no = '0' group by coupon_value";
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
<td align="center" bgcolor="white"style = "width:80px"><a href="deletephillip.php?coupon_value=<? echo $rows['coupon_value']; ?>">
<img src="images/bin.png" alt="delete"  class="delete"/></a></td>
</tr>

<?php

}
?>
<tr>
	

</table>
</br>
<?php
$con = mysqli_connect('198.71.225.55:3306','ganeshdesai','rama1234','manage_coupon');
$sql20 = "select *  from coupon_entry 
where userEmail = '$userRow[userEmail]'  and
brand = 'Phillip Morris' ORDER  BY id_coupon_entry desc LIMIT 1 ";
$result20 = (mysqli_query($con,$sql20));
while($rows = mysqli_fetch_array($result20))
	$min = $rows['invoice_no'] ;

if ($min != '0' )

{
?>
<table>
 <td bgcolor="white"><b><a href ="phillipedit.php">Edit Last Invoice</a><b></td>
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
<td align="center" bgcolor ="white"><b><a href ="phillipinvoiceno.php">Generate Invoice</a><b></td>
        </tr>
	</table>
	<?php }
	?>

	
</div>
</body></html>



