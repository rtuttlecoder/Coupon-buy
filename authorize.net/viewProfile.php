<?php
require 'vendor/autoload.php';
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;
define("AUTHORIZENET_LOG_FILE", "viewLog");
require_once("db.php");
require 'constants/Constants.php';
$result = mysqli_query($con, "SELECT * FROM tbl_users WHERE userID='32'") or die(mysqli_error($con));
$row = mysqli_fetch_array($result);
$customerProfileId = $row["profileID"];
$customerPaymentProfileId = $row["payProfile"];

$merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
$merchantAuthentication->setName(\Constants::MERCHANT_LOGIN_ID);
$merchantAuthentication->setTransactionKey(\Constants::MERCHANT_TRANSACTION_KEY);
$refId = 'ref' . time();
$request = new AnetAPI\GetCustomerPaymentProfileRequest();
$request->setMerchantAuthentication($merchantAuthentication);
$request->setRefId($refId);
$request->setCustomerProfileId($customerProfileId);
$request->setCustomerPaymentProfileId($customerPaymentProfileId);
$controller = new AnetController\GetCustomerPaymentProfileController($request);
$response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::PRODUCTION);
if (($response != null)) {
	if ($response->getMessages()->getResultCode() == "Ok") {} else {
		echo "GetCustomerPaymentProfile ERROR :  Invalid response\n";
		$errorMessages = $response->getMessages()->getMessage();
		echo "<br>Response : " . $errorMessages[0]->getCode() . "  " .$errorMessages[0]->getText() . "\n";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Profile Viewer</title>
</head>
<body>
<?php
if (($response != null)) {
	if ($response->getMessages()->getResultCode() == "Ok") {
?>
		<p><strong>First Name : </strong> <?php echo $row["firstName"]; ?><br>
		<strong>Last Name : </strong> <?php echo $row["lastName"]; ?><br>
		<strong>Address : </strong> <?php echo $response->getPaymentProfile()->getbillTo()->getAddress(); ?><br>
		<strong>City : </strong> <?php echo $response->getPaymentProfile()->getbillTo()->getCity(); ?><br>
		<strong>State : </strong> <?php echo $response->getPaymentProfile()->getbillTo()->getState(); ?><br>
		<strong>Zipcode : </strong> <?php echo $response->getPaymentProfile()->getbillTo()->getZip(); ?><br>
		<strong>Credit Card on file : </strong><?php echo $response->getPaymentProfile()->getPayment()->getCreditCard()->getCardNumber(); ?></p>
		<p>Need to update your information?  Do so <a href="update.php?uid=<?=$row['userID'];?>">HERE</a></p>
<?php } } else { echo "NULL Response Error"; } ?>
</body>
</html>