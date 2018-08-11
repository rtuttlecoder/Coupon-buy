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
$cim = new AuthnetCIM('9kq9HTrZ6dz', '34D9Mq2W2c4ULukY', false);
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
<?php
try {
	$cim->setParameter('customerProfileId', $_POST["profileID"]);
	$cim->setParameter('billToFirstName', $_POST["fName"]);
	$cim->setParameter('billToLastName', $_POST["lName"]);
	$cim->setParameter('billToAddress', $_POST["baddr"]);
	$cim->setParameter('billToCity', $_POST["bcity"]);
	$cim->setParameter('billToZip', $_POST["bzip"]);
	$cim->setParameter('billToState', $_POST["bstate"]);
	$cim->setParameter('billToCountry', 'US');
	$cim->setParameter('billToPhoneNumber', $_POST["bphone"]);
	$cim->setParameter('cardNumber', $_POST["ccNum"]);
	$cim->setParameter('expirationDate', $_POST["ccExp"]);
	if ($_POST["payProfile"] == '' || $_POST["payProfile"] == NULL) {
		$cim->createCustomerPaymentProfile();
	} else {
		$cim->updateCustomerPaymentProfile();
	}
	if ($cim->isSuccessful()) {
		if ($_POST["payProfile"] == '' || $_POST["payProfile"] == NULL) {
			$payment_profile_id = $cim->getPaymentProfileId();
		} else {
			$payment_profile_id = $_POST["payProfile"];
		}
		echo "Customer payment profile information updated successfully!<br>";
		$sqlPayUpdate = "UPDATE tbl_users SET payProfile='$payment_profile_id' WHERE userID='$_POST[userID]'";
		$updatePayResult = (mysqli_query($con, $sqlPayUpdate));
		if (!$updatePayResult) {
			die("Updating customer information failed!");
		}
	} else {
		echo "<h3>Something bad happened and nothing got processed!</h3>";
	}
} catch (AuthnetCIMException $e) {
	echo $e;
	echo $cim;
}
?>
</div>
</div>
</body>
</html>