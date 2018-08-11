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
        

	
	
	$manufacturer_name = $_POST['manufacturer_name'];
	$coupon_mailing_add1 = $_POST['coupon_mailing_add1']; 
	$coupon_mailing_add2 = $_POST['coupon_mailing_add2']; 
	$coupon_mailing_city = $_POST['coupon_mailing_city']; 
	$coupon_mailing_state = $_POST['coupon_mailing_state']; 
	$coupon_mailing_zipcode = $_POST['coupon_mailing_zipcode'];
	$product_category = $_POST['product_category'];
	$brand = $_POST['brand'];
	
	
	
	
	$sql = "INSERT INTO manufacturer_master (manufacturer_name ,
	coupon_mailing_add1 , 
	coupon_mailing_add2 ,
	coupon_mailing_city , 
	coupon_mailing_state , 
	coupon_mailing_zipcode ,
	product_category ,
	brand  ) VALUES ($manufacturer_name ,
	$coupon_mailing_add1 ,
	$coupon_mailing_add2 ,
	$coupon_mailing_city ,
	$coupon_mailing_state ,
	$coupon_mailing_zipcode ,
	$product_category ,
	$brand  ) ";
	 

$result = (mysqli_query($con,$sql));

if (!$result) {
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
<td ><Label style="float:left;width:170px;margin:10px"><FONT FACE="Verdana" color="brown"><b>Manufacturer Name :<b></FONT></Label>
<input type="text" name="manufacturer_name" placeholder="Manufacturer Name" required></td>
</tr>
<tr>				
<td><Label style="float:left;width:170px;margin:10px"><FONT FACE="Verdana"><b>Address 1:<b></FONT></Label>
<input type="text" name="coupon_mailing_add1" placeholder="Address 1" required></td>
</tr>
<tr>				
<td><Label style="float:left;width:170px;margin:10px"><FONT FACE="Verdana"><b>Address 2:<b></FONT></Label>
<input type="text" name="coupon_mailing_add2" placeholder="Address 2" required></td>
</tr>
<tr>				
<td><Label style="float:left;width:170px;margin:10px"><FONT FACE="Verdana"><b>City :<b></FONT></Label>
<input type="text" name="coupon_mailing_city" placeholder="City" required></td>
</tr>
<tr>
<td><Label style="float:left;width:170px;margin:10px"><FONT FACE="Verdana"><b>State :<b></FONT></Label>
<input type="text" name="coupon_mailing_state" placeholder="State" required></td>
</tr>
<tr>
<td><Label style="float:left;width:170px;margin:10px"><FONT FACE="Verdana"><b>Zip Code :<b></FONT></Label>
<input type="text" name="coupon_mailing_zipcode" placeholder="Zip Code" required ></td>
</tr>
<tr>
<td><Label style="float:left;width:170px;margin:10px"><FONT FACE="Verdana"><b>Product Category:<b></FONT></Label>
<input type="text" name="product_category" placeholder="Product Category" required></td>
</tr>
<tr>
<td><Label style="float:left;width:170px;margin:10px"><FONT FACE="Verdana"><b>Brand:<b></FONT></Label>
<input type="text" name="brand" placeholder="Brand" required></td>
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





