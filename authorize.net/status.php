<?php
require 'vendor/autoload.php';
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;
define("AUTHORIZENET_LOG_FILE", "statusLog");
require_once("db.php");
require 'constants/Constants.php';
$result = mysqli_query($con, "SELECT * FROM tbl_users WHERE userID='32'") or die(mysqli_error($con));
$row = mysqli_fetch_array($result);
$subscriptionId = $row["subID"];
$merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
$merchantAuthentication->setName(\Constants::MERCHANT_LOGIN_ID);
$merchantAuthentication->setTransactionKey(\Constants::MERCHANT_TRANSACTION_KEY);
$refId = 'ref' . time();
$request = new AnetAPI\ARBGetSubscriptionStatusRequest();
$request->setMerchantAuthentication($merchantAuthentication);
$request->setRefId($refId);
$request->setSubscriptionId($subscriptionId);
$controller = new AnetController\ARBGetSubscriptionStatusController($request);
$response = $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::PRODUCTION);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Profile Viewer</title>
</head>
<body>
<?php 
if (($response != null) && ($response->getMessages()->getResultCode() == "Ok")) {
	echo "Subscription Status : <strong>" . $response->getStatus() . "</strong>\n";
} else {
	echo "ERROR :  Invalid response\n";
	$errorMessages = $response->getMessages()->getMessage();
	echo "<br>Response : " . $errorMessages[0]->getCode() . "  " .$errorMessages[0]->getText() . "\n";
}
?>
<p><strong>Want to cancel your subscription?</strong> - <a href="cancel.php?id=<?=$row['userID'];?>">click here</a>.</p>
</body>
</html>