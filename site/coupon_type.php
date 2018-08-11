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
                            <li class="dropdown">
                                <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-user"></i> 
								<?php echo $userRow['userName']; ?> <i class="caret"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a tabindex="-1" href="logout.php">Logout</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        
                            </li>
                            
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

$con = mysqli_connect('198.71.225.55:3306','ganeshdesai','rama1234','manage_coupon');

if(!isset($_SESSION['userSession']))
{
header("Location: index.php");
};

if(isset($_POST['save-data']))
{

$sql = "SELECT * FROM tbl_users WHERE userID =".$_SESSION['userSession'];
$res = mysqli_query($con,$sql);
$userRow = mysqli_fetch_array($res);
        

	
	$product_category = $_POST['product_category']; 
	$coupon_type	= $_POST['coupon_type']; 
	$postage_included = $_POST['postage_included']; 
	$tax_included = $_POST['tax_included']; 
	$product_net_price = $_POST['product_net_price'];
	$coupon_value = $_POST['coupon_value']; 
	$brand = $_POST['brand']; 
	$manufacturer_name = $_POST['manufacturer_name'];
	
	
	
	$sql1 = "INSERT INTO coupon_master 
	( product_category , 
	coupon_type , 
	postage_included , 
	tax_included , 
	product_net_price  , 
	coupon_value , 
	brand , 
	manufacturer_name ) VALUES 
	( '$product_category' , 
	'$coupon_type' , 
	'$postage_included' , 
	'$tax_included' , 
	'$product_net_price'  , 
	'$coupon_value' , 
	'$brand' ,
    '$manufacturer_name') ";
	 

$result1 = (mysqli_query($con,$sql1));

if (!$result1) {
    die("Query to show fields from table failed");
}


}

?>
<!DOCTYPE>
<html><head><title>MySQL Table Viewer</title></head>
<div align="center">

<body>	
	
<form   method="POST">
<br>
<br>
<table  width="500px" border="0" >


<tr>				
<td ><Label style="float:left;width:170px;margin:10px"><FONT FACE="Verdana" color="brown"><b>Product Category :<b></FONT></Label>
<input type="text" name="product_category" placeholder="Product Category" required></td>
</tr>
<tr>				
<td><Label style="float:left;width:170px;margin:10px"><FONT FACE="Verdana"><b>Coupon Type:<b></FONT></Label>
<input type="text" name="coupon_type" placeholder="Coupon Type" required></td>
</tr>
<tr>				
<td><Label style="float:left;width:170px;margin:10px"><FONT FACE="Verdana"><b>Postage Included:<b></FONT></Label>
<input type="text" name="postage_included" placeholder="Postage Included" ></td>
</tr>
<tr>				
<td><Label style="float:left;width:170px;margin:10px"><FONT FACE="Verdana"><b>Tax Included :<b></FONT></Label>
<input type="text" name="tax_included" placeholder="Tax Included" ></td>
</tr>
<tr>
<td><Label style="float:left;width:170px;margin:10px"><FONT FACE="Verdana"><b>Product Net price :<b></FONT></Label>
<input type="text" name="product_net_price" placeholder="Product Net Price" ></td>
</tr>
<tr>
<td><Label style="float:left;width:170px;margin:10px"><FONT FACE="Verdana"><b>Coupon Value :<b></FONT></Label>
<input type="text" name="coupon_value" placeholder="Coupon Value" ></td>
</tr>
<tr>
<td><Label style="float:left;width:170px;margin:10px"><FONT FACE="Verdana"><b>Brand:<b></FONT></Label>
<input type="text" name="brand" placeholder="Brand" required></td>
</tr>
<tr>
<td><Label style="float:left;width:170px;margin:10px"><FONT FACE="Verdana"><b>Manufacturer Name:<b></FONT></Label>
<input type="text" name="manufacturer_name" placeholder="Manufacturer Name" ></td>
</tr>
<tr>
<td align ="center"><input type="submit" 	value="SAVE"  class="btn btn-large btn-primary"  name="save-data" 
	style="width:100px;height:25px;padding-top:2px" ></td>

</tr>

</table>
</form>
</body>
</div>
</html>





