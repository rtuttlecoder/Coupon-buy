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
require_once("AuthnetCIM.class.php");
try {
	$cim = new AuthnetCIM('9kq9HTrZ6dz', '34D9Mq2W2c4ULukY', false);
} catch (AuthnetCIMException $e) {
	echo "There was an error processing the transaction.  Here is the error message: ";
	echo $e->__toString();
}
$con = mysqli_connect('198.71.225.55:3306','ganeshdesai','rama1234','manage_coupon');
?>
<!DOCTYPE html>
<html class="no-js">
<head>
	<title><?php echo $row['userName']; ?> Customer Account Profile Information</title>
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
<div class="home" align="center">
<strong>Full Name:</strong> <?php echo $row["firstName"] . " " . $row["lastName"]; ?></p>
<p><strong>User ID:</strong> <?php echo $row["userID"]; ?></p>
<p><strong>Email:</strong> <?php echo $row["userEmail"]; ?></p>
<?php
echo "<p><strong>Please enter your Payment information</strong>:</p>";
?>
<form action="profileCIM.php" method="post">
	<input type="hidden" name="profileID" value="<?=$row['profileID'];?>">
	<input type="hidden" name="fName" value="<?=$row['firstName'];?>">
	<input type="hidden" name="lName" value="<?=$row['lastName'];?>">
	<input type="hidden" name="userID" value="<?=$row['userID'];?>">
	<input type="hidden" name="subID" value="<?=$row['subID'];?>">
	<input type="hidden" name="payProfile" value="<?=$row['payProfile'];?>">
	Billing Address: <input type="text" name="baddr" size="50" value=""><br>
	Billing City: <input type="text" name="bcity" size="50" value=""><br>
	Billing State: <input type="text" name="bstate" value="" size="2"><br>
	Billing Zipcode: <input type="text" name="bzip" size="10" value=""><br>
	Billing Phone: <input type="text" name="bphone" size="10" placeholder="xxx-xxx-xxxx" value=""><br>
	Credit Card Number: <input type="text" name="ccNum" value="" size="25"><br>
	Expiration Date: <input type="text" name="ccExp" placeholder="MMYY" size="4" value=""><br>
	<input type="submit" name="submit" value="UPDATE">
</form>
</div>
</div>
</body>
</html>