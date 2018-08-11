<?php
require 'vendor/autoload.php';
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;
define("AUTHORIZENET_LOG_FILE", "cancelLog");
require_once("db.php");
require 'constants/Constants.php';
$result = mysqli_query($con, "SELECT * FROM tbl_users WHERE userID=$_GET['id']") or die(mysqli_error($con));
$row = mysqli_fetch_array($result);
$merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
$merchantAuthentication->setName(\Constants::MERCHANT_LOGIN_ID);
$merchantAuthentication->setTransactionKey(\Constants::MERCHANT_TRANSACTION_KEY);
$refId = 'ref' . time();
$request = new AnetAPI\ARBCancelSubscriptionRequest();
$request->setMerchantAuthentication($merchantAuthentication);
$request->setRefId($refId);
$request->setSubscriptionId($row["subID"]);
$controller = new AnetController\ARBCancelSubscriptionController($request);
$response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::PRODUCTION);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Subscriber Request</title>
</head>
<body>
<?php
if (($response != null) && ($response->getMessages()->getResultCode() == "Ok")) {
    $successMessages = $response->getMessages()->getMessage();
    echo "SUCCESS : " . $successMessages[0]->getCode() . "  " .$successMessages[0]->getText() . "\n";  
} else {
    echo "ERROR :  Invalid response\n";
    $errorMessages = $response->getMessages()->getMessage();
    echo "Response : " . $errorMessages[0]->getCode() . "  " .$errorMessages[0]->getText() . "\n";  
}
?>
</body>
</html>