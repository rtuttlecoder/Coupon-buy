<?php
require 'vendor/autoload.php';
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;
define("AUTHORIZENET_LOG_FILE", "subLog");
require_once("db.php");
require 'constants/Constants.php';
$result = mysqli_query($con, "SELECT * FROM tbl_users WHERE userID='32'") or die(mysqli_error($con));
$row = mysqli_fetch_array($result);
$userid = $row['userID'];
$pid = $row["profileID"];
$pp = $row["payProfile"];
$today = date("Y-m-d");

if (isset($_POST['sub'])) {
	$intervalLength = 30;
	$customerProfileId = $pid;
	$customerPaymentProfileId = $pp;

	// Common Set Up for API Credentials
    $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
	$merchantAuthentication->setName(\Constants::MERCHANT_LOGIN_ID);
	$merchantAuthentication->setTransactionKey(\Constants::MERCHANT_TRANSACTION_KEY);
	$refId = "sub_" . $userid; // 'ref' . time();

    // Subscription Type Info
    $subscription = new AnetAPI\ARBSubscriptionType();
    $subscription->setName("Sample Subscription");
    $interval = new AnetAPI\PaymentScheduleType\IntervalAType();
    $interval->setLength($intervalLength);
    $interval->setUnit("days");

    $paymentSchedule = new AnetAPI\PaymentScheduleType();
    $paymentSchedule->setInterval($interval);
    $paymentSchedule->setStartDate(new DateTime($today));
    $paymentSchedule->setTotalOccurrences("12");

    $subscription->setPaymentSchedule($paymentSchedule);
    $subscription->setAmount(1.99);
    
    $profile = new AnetAPI\CustomerProfileIdType();
    $profile->setCustomerProfileId($customerProfileId);
    $profile->setCustomerPaymentProfileId($customerPaymentProfileId);

    $subscription->setProfile($profile);

    $request = new AnetAPI\ARBCreateSubscriptionRequest();
    $request->setmerchantAuthentication($merchantAuthentication);
    $request->setRefId($refId);
    $request->setSubscription($subscription);
    $controller = new AnetController\ARBCreateSubscriptionController($request);
    $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::PRODUCTION);
    
    if (($response != null) && ($response->getMessages()->getResultCode() == "Ok")) {
        echo "SUCCESS: Subscription ID : " . $response->getSubscriptionId() . "\n";
        $subid = $response->getSubscriptionId();
        $sql = mysqli_query($con, "UPDATE tbl_users SET subID='$subid', userStatus='Y' WHERE userID='$userid'") or die(mysqli_error($con));
        header('Location: thankyou.php');
    } else {
        echo "ERROR :  Invalid response\n";
        $errorMessages = $response->getMessages()->getMessage();
        echo "<br>Response : " . $errorMessages[0]->getCode() . "  " .$errorMessages[0]->getText() . "\n";
    }
} 
?>
<!DOCTYPE html>
<html>
<head>
    <title>SUBSCRIBE TODAY!</title>
</head>
<body>
<?php
if ($pid == NULL || $pp == NULL) {
	echo "<h2>Sorry, but your Profile is not yet completed.  You must do that first before subscribing!</h2>";
} else {
?>
	<form method="POST">
	<input type="hidden" name="pid" value="<?=$pid;?>">
	<input type="hidden" name="pp" value="<?=$pp;?>">
	<input type="submit" name="sub" value="SUBSCRIBE">
	</form>
<?php } ?>
</body>
</html>