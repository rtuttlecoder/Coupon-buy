<?php
session_start();
require_once("class.user.php");
$user_home = new USER();
if (!$user_home->is_logged_in()) {
	$user_home->redirect('index.php');
}
$stmt = $user_home->runQuery("SELECT * FROM tbl_users WHERE userID=:uid");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
require_once("AuthnetARB.class.php");
$subscription = new AuthnetARB('9kq9HTrZ6dz', '34D9Mq2W2c4ULukY', false);
$t = 0;
?>
<!DOCTYPE html>
<html class="no-js">
<head>
	<title><?php echo $row['userName']; ?> Account Information</title>
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
	<link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
	<link href="assets/styles.css" rel="stylesheet" media="screen">
	<script src="bootstrap/js/jquery-1.9.1.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<script src="assets/scripts.js"></script>
</head>
<body>
<div class="navbar navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container-fluid"><a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></a><a class="brand" href="home.php">Member Home</a>
			<div class="nav-collapse collapse"><ul class="nav pull-right"><p style="float:right;"><h4><i class="icon-user" style="vertical-align:middle;"></i>&nbsp; <?php echo $row['userName']; ?>&nbsp;&nbsp;&nbsp;<a href="logout.php">Logout</a></h4></P></ul>
			</div>
		</div>
	</div>
</div>
<div align="center">
	<div class="home" align="center"><h2>Customer Information</h2><p><strong>Full Name:</strong> <?php echo $row["firstName"] . " " . $row["lastName"]; ?></p>
	<p><strong>User ID:</strong> <?php echo $row["userID"]; ?></p>
	<p><strong>Email:</strong> <?php echo $row["userEmail"]; ?></p>
	<?php
	
		if ($row["payProfile"] != NULL) {
			echo "<a href='#'>Update Your Payment Information</a><br>";
		} else {
			echo "<strong>No Customer Profile information available.  Please <a href='create.php'>create</a> your profile now!</strong><br>";
			$t = 1;
		}
	/* if ($row["subID"] == NULL && $row["payProfile"] > 0) {
		$subscription->setParameter('amount', '$row["value"]');
		$subscription->createAccount();
		if ($subscription->isSuccessful()) {
			$subID = $subscription->getSubscriberID();
		} else {
			echo "ERROR: no subscription created!<br>";
		}
	} */
	?>
	<br><br>
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
	$query = "SELECT  * from product_master ";
	$result = (mysqli_query($con,$query));
	if (!$result) {
		die("Query to show fields from table failed");
	}
	?>
	<table border="1px">
	<tr>
		<td align="center" bgcolor="#d3dfdf" style="width:85px;"><h5>Product ID</h5></td>
		<td align="center" bgcolor="#d3dfdf" style="width:80px;"><h5>Description</h5></td>
		<td align="center" bgcolor="#d3dfdf" style="width:120px;"><h5>Value (US $)</h5></td>
		<td align="center" bgcolor="#d3dfdf" style="width:80px;"><h5>Period</h5></td>
		<td align="center" bgcolor="#d3dfdf" style="width:80px;"><h5>Status</h5></td>
	</tr>
	<?php
	while ($rows = mysqli_fetch_array($result)) {
	?>
	<tr>
		<td align="center" bgcolor="white" style="width:85px;"><? echo $rows['product_id']; ?></td>
		<td align="center" bgcolor="white" style="width:200px;"><? echo $rows['description']; ?></td>
		<td align="center" bgcolor="white" style="width:80px;"><? echo "$" . number_format($rows['value'], 2); ?></td>
		<td align="center" bgcolor="white" style="width:80px;"><? echo $rows['period']; ?></td>
		<td align="center" bgcolor="white" style="width:150px;">
		<?php
		if ($t == 0) {
			if ($row["userStatus"] == "Y") {
				echo "<strong>Subscription ACTIVE</strong>";
			} else {
				echo "<a href='authorize.php'>SUBSCRIBE TODAY!</a>";
			}
		} elseif ($t == 1) {
			echo "See notes above!";
		} 
		?>
		</td>
	</tr>
	<?php
	} // close while loop 
	?>
	</table>
	</div>
</div>
</body>
</html>