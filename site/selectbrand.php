<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT']."/class.user.php");
$user_home = new USER();

if(!$user_home->is_logged_in())
{
	$user_home->redirect('index.php');
}

$stmt = $user_home->runQuery("SELECT * FROM tbl_users WHERE userID=:uid");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html class="no-js">
    
    <head>
        <title><?php echo $row['userName']; ?></title>
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
                            
                                 <p style="float:right;"><h4><i class="icon-user" style="vertical-align:middle;"></i>&nbsp; <?php echo $row['userName']; ?>&nbsp;&nbsp;&nbsp;<a href="logout.php" >Logout</a> </h4></P>
                               
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
</form>
<form  action="getreport.php" method="get">
<table width="345px" height="200px" border="0">

<tr>
<td  bgcolor ="#e0eded" style ="padding-top:10px">
	<label style="float:left;width:170px;margin:10px" ><FONT FACE="Verdana"><b>Select Brand :<b></FONT></label>
    <select name="brand" 
	class="input-block-level" style="width:140px;border:5px">
		<?php while ($row1 = mysqli_fetch_array($result1)):;?>
		<option value="" disabled selected style="display: none;">Select Brand</option>    	
		<option><?php echo $row1['brand'];?></option>
		<?php endwhile;?>
		</select></td>
	</tr>
	</br>
	
	<tr>
	<td align="center" bgcolor ="#e0eded" style ="padding-bottom:10px"><input type="submit" 
	value="VIEW / PRINT INVOICE"  class="btn btn-large btn-primary"  name="save-data" 
	style="width:220px;height:25px;padding-top:2px" ></td>
        </tr>


		</br>
		
    
</table>

</form>
</body>
	
</div>
</html>
	
