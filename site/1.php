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
        

	$cust_company_name = $_POST['cust_company_name'];
	$cust_comp_phone_no = $_POST['cust_comp_phone_no'];
	$cust_company_address = $_POST['cust_company_address'];
	$cust_company_city = $_POST['cust_company_city'];
	$cust_company_state = $_POST['cust_company_state'];
	$cust_company_zipcode = $_POST['cust_company_zipcode'];
	$cust_company_fed_no = $_POST['cust_company_fed_no'];
	
	
	
	$sql = "INSERT INTO cust_company_information( userID, cust_company_name, cust_comp_phone_no, 
	cust_company_address, cust_company_city, cust_company_state, cust_company_zipcode , 
	 cust_company_fed_no, userEmail) VALUES ('$userRow[userID]','$cust_company_name','$cust_comp_phone_no',
	 '$cust_company_address','$cust_company_city', '$cust_company_state','$cust_company_zipcode',
	 '$cust_company_fed_no' ,'$userRow[userEmail]')";
	 $sql1 = "update cust_company_information set  
	 	 cust_comp_phone_no = '$cust_comp_phone_no', 
	cust_company_address = '$cust_company_address',
	cust_company_city = '$cust_company_city', 
	cust_company_state = '$cust_company_state', 
	cust_company_zipcode = '$cust_company_zipcode' , 
	 cust_company_fed_no = '$cust_company_fed_no'
 where userEmail = '$userRow[userEmail]'  ";
	
	$sql2 = "Select userID from cust_company_information where userEmail = '$userRow[userEmail]' " ;


$result2 = (mysqli_query($con,$sql2));

if (!$result2) {
    die("Query to show fields from table failed");
}
$count = (mysqli_num_rows($result2)) ;

if ($count == 0)
{
    (mysqli_query($con,$sql));{
    header("Location: companydetails.php");
}
}
else if ($count > 0)
	{
    (mysqli_query($con,$sql1));{
    header("Location: companydetails.php");
}
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
<td ><Label style="float:left;width:170px;margin:10px"><FONT FACE="Verdana" color="brown"><b>Company Name :<b></FONT></Label>
<input type="text" name="cust_company_name" placeholder="Company Name" required></td>
</tr>
<tr>				
<td><Label style="float:left;width:170px;margin:10px"><FONT FACE="Verdana"><b>Company Phone No.:<b></FONT></Label>
<input type="text" name="cust_comp_phone_no" placeholder="Company Phone No." required></td>
</tr>
<tr>				
<td><Label style="float:left;width:170px;margin:10px"><FONT FACE="Verdana"><b>Company Address :<b></FONT></Label>
<input type="text" name="cust_company_address" placeholder="Company Address" required></td>
</tr>
<tr>				
<td><Label style="float:left;width:170px;margin:10px"><FONT FACE="Verdana"><b>City :<b></FONT></Label>
<input type="text" name="cust_company_city" placeholder="City" required></td>
</tr>
<tr>
<td><Label style="float:left;width:170px;margin:10px"><FONT FACE="Verdana"><b>State :<b></FONT></Label>
<input type="text" name="cust_company_state" placeholder="State" required></td>
</tr>
<tr>
<td><Label style="float:left;width:170px;margin:10px"><FONT FACE="Verdana"><b>Zip Code :<b></FONT></Label>
<input type="text" name="cust_company_zipcode" placeholder="Zip Code" required ></td>
</tr>
<tr>
<td><Label style="float:left;width:170px;margin:10px"><FONT FACE="Verdana"><b>Fed ID No.:<b></FONT></Label>
<input type="text" name="cust_company_fed_no" placeholder="Fed ID #" required></td>
</tr>
<tr>
<td align ="center"><input type="submit" 	value="SAVE"  class="btn btn-large btn-primary"  name="save-data" 
	style="width:100px;height:25px;padding-top:2px" ></td>

</tr>

</table>
</form>
</body>
<br>
<p><font Color ="brown"><h4>NOTE : You will not be able to change or edit Company's Name in future<h4><p>
</div>
</html>





