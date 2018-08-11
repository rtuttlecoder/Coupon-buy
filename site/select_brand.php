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
	<div align = "center">
	
	<h3 >Select Brand or Company<h3>
	<table >
	<tr>
		<tr><td align="center" bgcolor = "white"><h4><a href="marlboro.php">Marlboro</a></h4></td><td>&nbsp;&nbsp;</td>
		<td align="center" bgcolor = "#c7c7c7" ><h4><a href="phillip.php">Phillip Morris</a></h4><h6>(Marlboro,Pall Mall)</h6></td></tr>
		<tr><td align="center" bgcolor = "#c7c7c7"><h4><a href="newport.php">Newport</a></h4></td><td>&nbsp;&nbsp;</td>
		<td align="center" bgcolor = "white"><h4><a href="reynolds.php">R J Reynolds</a></h4><h6>(Newport,Camel,L & M)</h6></td></tr>
        <tr><td align="center" bgcolor = "white"><h4><a href="camel.php">Camel</a></h4></td></tr>
        <tr><td align="center" bgcolor = "#c7c7c7"><h4><a href="pallmall.php">Pall Mall</a></h4></td></tr>
        <tr><td align="center" bgcolor = "white"><h4><a href="american.php">Americal Spirits</a></h4></td></tr>
        <tr><td align="center" bgcolor = "#c7c7c7"><h4><a href="markten.php">MarkTen</a></h4></td></tr>
		<tr><td align="center" bgcolor = "white"><h4><a href="l&m.php">L & M</a></h4></td></tr>
	    <tr><td align="center" bgcolor = "#c7c7c7"><h4><a href="skoal.php">Skoal</a></h4></td></tr>
		
	
	</table>				
		<h4><a href="select_brand1.php"><font color="black">> > NEXT PAGE > ></a></h4>									
			
			</div>

</html>