<?php
require 'vendor/autoload.php';
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;
define("AUTHORIZENET_LOG_FILE", "updateLog");
require_once("db.php");
require 'constants/Constants.php';
$result = mysqli_query($con, "SELECT * FROM tbl_users WHERE userID=$_GET['uid']") or die(mysqli_error($con));
$row = mysqli_fetch_array($result);
$customerProfileId = $row["profileID"];
$customerPaymentProfileId = $row["payProfile"];

$merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
$merchantAuthentication->setName(\Constants::MERCHANT_LOGIN_ID);
$merchantAuthentication->setTransactionKey(\Constants::MERCHANT_TRANSACTION_KEY);
$refId = 'ref' . time();

if (isset($_POST["save-data"])) {
	//Set profile ids of profile to be updated
	$request = new AnetAPI\UpdateCustomerPaymentProfileRequest();
	$request->setMerchantAuthentication($merchantAuthentication);
	$request->setCustomerProfileId($customerProfileId);
	$controller = new AnetController\GetCustomerProfileController($request);
	// We're updating the billing address but everything has to be passed in an update
	$creditCard = new AnetAPI\CreditCardType();
	$creditCard->setCardNumber($_POST['ccNum']);
	$creditCard->setExpirationDate($_POST['expDate']);
	$paymentCreditCard = new AnetAPI\PaymentType();
	$paymentCreditCard->setCreditCard($creditCard);
	// create the Bill To info
	$billto = new AnetAPI\CustomerAddressType();
	$billto->setAddress($_POST['billAddr']);
    $billto->setCity($_POST['billCity']);
    $billto->setState($_POST['billState']);
    $billto->setZip($_POST['billZipcode']);
    $billto->setCountry("USA");
    $billto->setPhoneNumber($_POST['phone']);
    // Create the Customer Payment Profile object
    $paymentprofile = new AnetAPI\CustomerPaymentProfileExType();
	$paymentprofile->setCustomerPaymentProfileId($customerPaymentProfileId);
	$paymentprofile->setBillTo($billto);
	$paymentprofile->setPayment($paymentCreditCard);
    // Submit a UpdatePaymentProfileRequest
	$request->setPaymentProfile($paymentprofile);
    $controller = new AnetController\UpdateCustomerPaymentProfileController($request);
	$response = $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::PRODUCTION);
	if (($response != null) && ($response->getMessages()->getResultCode() == "Ok")) {
		echo "Update Customer Payment Profile SUCCESS! " . "\n";
		// Update only returns success or fail, if success
		// confirm the update by doing a GetCustomerPaymentProfile
		$getRequest = new AnetAPI\GetCustomerPaymentProfileRequest();
		$getRequest->setMerchantAuthentication($merchantAuthentication);
		$getRequest->setRefId( $refId);
		$getRequest->setCustomerProfileId($customerProfileId);
		$getRequest->setCustomerPaymentProfileId($customerPaymentProfileId);
		$controller = new AnetController\GetCustomerPaymentProfileController($getRequest);
		$response = $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::PRODUCTION);
		if (($response != null)) {
			if ($response->getMessages()->getResultCode() == "Ok") {
				$addr = $response->getPaymentProfile()->getbillTo()->getAddress();
				$city = $response->getPaymentProfile()->getbillTo()->getCity();
				$state = $response->getPaymentProfile()->getbillTo()->getState();
				$zip = $response->getPaymentProfile()->getbillTo()->getZip();
				$phone = $response->getPaymentProfile()->getbillTo()->getPhoneNumber();
				$exp = $response->getPaymentProfile()->getPayment()->getCreditCard()->getExpirationDate();
				$ccNum = $response->getPaymentProfile()->getPayment()->getCreditCard()->getCardNumber();
			} else {
				echo "GetCustomerPaymentProfile ERROR :  Invalid response\n";
				$errorMessages = $response->getMessages()->getMessage();
		        echo "Response : " . $errorMessages[0]->getCode() . "  " .$errorMessages[0]->getText() . "\n";
			  }
		} else {
			echo "NULL Response Error";
		}
	} else {
		echo "Update Customer Payment Profile: ERROR Invalid response\n";
		$errorMessages = $response->getMessages()->getMessage();
		echo "Response : " . $errorMessages[0]->getCode() . "  " .$errorMessages[0]->getText() . "\n";
	}
} else {
	$request = new AnetAPI\GetCustomerPaymentProfileRequest();
	$request->setMerchantAuthentication($merchantAuthentication);
	$request->setRefId($refId);
	$request->setCustomerProfileId($customerProfileId);
	$request->setCustomerPaymentProfileId($customerPaymentProfileId);
	$controller = new AnetController\GetCustomerPaymentProfileController($request);
	$response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::PRODUCTION);
	if (($response != null)) {
		if ($response->getMessages()->getResultCode() == "Ok") {
			$addr = $response->getPaymentProfile()->getbillTo()->getAddress();
			$city = $response->getPaymentProfile()->getbillTo()->getCity();
			$state = $response->getPaymentProfile()->getbillTo()->getState();
			$zip = $response->getPaymentProfile()->getbillTo()->getZip();
			$phone = $response->getPaymentProfile()->getbillTo()->getPhoneNumber();
			$exp = $response->getPaymentProfile()->getPayment()->getCreditCard()->getExpirationDate();
			$ccNum = $response->getPaymentProfile()->getPayment()->getCreditCard()->getCardNumber();
		} else {
			echo "GetCustomerPaymentProfile ERROR :  Invalid response\n";
			$errorMessages = $response->getMessages()->getMessage();
			echo "<br>Response : " . $errorMessages[0]->getCode() . "  " .$errorMessages[0]->getText() . "\n";
		}
	}
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Profile</title>
</head>
<body>
<p>Please update as necessary.</p>
<form method="POST">
	<input type="hidden" name="userid" value="<?=$row['userID'];?>">
	<table width="900px" border="0">
	<tr>				
		<td><Label style="float:left;width:250px;margin:10px"><FONT FACE="Verdana"><b>Address :<b></FONT></Label>
		<input type="text" name="billAddr" value="<?=$addr;?>" required></td>
	</tr>
	<tr>				
		<td><Label style="float:left;width:250px;margin:10px"><FONT FACE="Verdana"><b>City :<b></FONT></Label>
		<input type="text" name="billCity" value="<?=$city;?>" required></td>
	</tr>
	<tr>
		<td><Label style="float:left;width:250px;margin:10px"><FONT FACE="Verdana"><b>State :<b></FONT></Label>
		<input type="text" name="billState" value="<?=$state;?>" required></td>
	</tr>
	<tr>
		<td><Label style="float:left;width:250px;margin:10px"><FONT FACE="Verdana"><b>Zip Code :<b></FONT></Label>
		<input type="text" name="billZipcode" value="<?=$zip;?>" required></td>
	</tr>
	<tr>
		<td><Label style="float:left;width:250px;margin:10px"><FONT FACE="Verdana"><b>Telephone No. :<b></FONT></Label>
		<input type="text" name="phone" value="<?=$phone;?>" required></td>
	</tr>
	<tr>
		<td><Label style="float:left;width:250px;margin:10px"><FONT FACE="Verdana"><b>Credit Card Number :<b></FONT></Label>
		<input type="text" name="ccNum" value="<?=$ccNum;?>"> *ONLY CHANGE IF YOU NEED TO UPDATE</td>
	</tr>
	<tr>
		<td><Label style="float:left;width:250px;margin:10px"><FONT FACE="Verdana"><b>Expiration Date :<b></FONT></Label>
		<input type="text" name="expDate" value="<?=$exp;?>"> *ONLY CHANGE IF YOU NEED TO UPDATE</td>
	</tr>
	<tr>
		<td align ="center"><input type="submit" value="UPDATE" class="btn btn-large btn-primary" name="save-data" style="width:100px;height:25px;padding-top:2px"></td>
	</tr>
	</table>
</form>
</body>
</html>