<?php
require_once("db.php");
$result = mysqli_query($con, "SELECT * FROM tbl_users WHERE userID='32'") or die(mysqli_error($con));
$row = mysqli_fetch_array($result);
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= "From: info@managecoupon.com" . "\r\n";
$mailTo = $row["userEmail"];
$mailSub = "Thank you for your subscription";
$msg = "<h2>THANK YOU!</h2><p>Thank you for your subscription at ManageCoupon.com.  Your card has been charged \$1.99 for your initial month and will be charged again every month until you cancel.</p><p>We appreciate your business!</p><br><br><small>PID: " . $row['profileID'] . " | PP: " . $row['payProfile'] . " | SID: " . $row['subID'] . "</small>";
mail($mailTo, $mailSub, $msg, $headers);
?>
<!DOCTYPE html>
<html>
<head>
    <title>THANK YOU!</title>
</head>
<body>
	<h2>THANK YOU!</h2>
	<p>Thank you for your subscription.  Your subscription is now active and you can begin using our website.</p>
	<p><a href="myaccount.php">GO TO MY ACCOUNT</a> NOW.</p>
</body>
</html>