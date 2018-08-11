<?php
require 'vendor/autoload.php';
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;
define("AUTHORIZENET_LOG_FILE", "createLog");
require_once("db.php");
require 'constants/Constants.php';
$result = mysqli_query($con, "SELECT * FROM tbl_users WHERE userID='32'") or die(mysqli_error($con));
$row = mysqli_fetch_array($result);
$userid = $row['userID'];

if (isset($_POST['save-data'])) {
	$ccNum = $_POST['ccNum'];
	$expDate = $_POST['expDate'];
	$ccv = $_POST['ccv'];
	$phone = $_POST['phone'];
	$billAddr = $_POST['billAddr'];
	$billCity = $_POST['billCity'];
	$billState = $_POST['billState'];
	$billZipcode = $_POST['billZipcode'];
	
	// Common setup for API credentials
	$merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
	$merchantAuthentication->setName(\Constants::MERCHANT_LOGIN_ID);
	$merchantAuthentication->setTransactionKey(\Constants::MERCHANT_TRANSACTION_KEY);
	$refId = $userid; // 'ref' . time();
	$creditCard = new AnetAPI\CreditCardType();
	$creditCard->setCardNumber($ccNum);
	$creditCard->setExpirationDate($expDate);
	$creditCard->setCardCode($ccv);
	$paymentCreditCard = new AnetAPI\PaymentType();
	$paymentCreditCard->setCreditCard($creditCard);
	
	// Create the Bill To info for new payment type
	$billto = new AnetAPI\CustomerAddressType();
	$billto->setFirstName($row['firstName']);
	$billto->setLastName($row['lastName']);
	$billto->setAddress($billAddr);
	$billto->setCity($billCity);
	$billto->setState($billState);
	$billto->setZip($billZipcode);
	$billto->setPhoneNumber($phone);
	$billto->setCountry("USA");
	
	// Create a new Customer Payment Profile
	$paymentprofile = new AnetAPI\CustomerPaymentProfileType();
	$paymentprofile->setCustomerType('individual');
	$paymentprofile->setBillTo($billto);
	$paymentprofile->setPayment($paymentCreditCard);
	$paymentprofiles[] = $paymentprofile;
	
	$customerprofile = new AnetAPI\CustomerProfileType();
	$customerprofile->setDescription("ManageCoupon.com");
	$customerprofile->setMerchantCustomerId("M_".$userid);
	$customerprofile->setEmail($row['userEmail']);
	$customerprofile->setPaymentProfiles($paymentprofiles);
	
	$request = new AnetAPI\CreateCustomerProfileRequest();
	$request->setMerchantAuthentication($merchantAuthentication);
	$request->setRefId($refId);
	$request->setProfile($customerprofile);
	$controller = new AnetController\CreateCustomerProfileController($request);
	$response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::PRODUCTION);
	if (($response != null) && ($response->getMessages()->getResultCode() == "Ok")) {
		echo "Succesfully create customer profile : " . $response->getCustomerProfileId() . "\n";
		$paymentProfiles = $response->getCustomerPaymentProfileIdList();
		echo "<br>SUCCESS: PAYMENT PROFILE ID : " . $paymentProfiles[0] . "\n";
		$payment_profile_id = $paymentProfiles[0];
		$profile_id = $response->getCustomerProfileId();
		$sql = mysqli_query($con, "UPDATE tbl_users SET profileID='$profile_id', payProfile='$payment_profile_id' WHERE userID='$userid'") or die(mysqli_error($con));
		header('Location: myaccount.php');
	} else {
	 	echo "ERROR :  Invalid response\n";
		$errorMessages = $response->getMessages()->getMessage();
        echo "<br>Response : " . $errorMessages[0]->getCode() . "  " .$errorMessages[0]->getText() . "\n";
        exit; 
	}
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Create Profile</title>
</head>
<body>
<form method="POST">
<?php 
if ($row["profileID"] != NULL) { 
	$profile_id = $row["profileID"];
	echo '<input type="hidden" name="profileID" value="' . $profile_id . '">';
}
?>
<h2>Create Customer Profile</h2>
<p>Please fill out this form in its entirity to complete your Profile.</p>

	<input type="hidden" name="userid" value="<?=$userid;?>">
	<table width="500px" border="0">
	<tr>				
		<td><Label style="float:left;width:170px;margin:10px"><FONT FACE="Verdana"><b>Address :<b></FONT></Label>
		<input type="text" name="billAddr" placeholder="Address" required></td>
	</tr>
	<tr>				
		<td><Label style="float:left;width:170px;margin:10px"><FONT FACE="Verdana"><b>City :<b></FONT></Label>
		<input type="text" name="billCity" placeholder="City" required></td>
	</tr>
	<tr>
		<td><Label style="float:left;width:170px;margin:10px"><FONT FACE="Verdana"><b>State :<b></FONT></Label>
		<input type="text" name="billState" placeholder="State" required></td>
	</tr>
	<tr>
		<td><Label style="float:left;width:170px;margin:10px"><FONT FACE="Verdana"><b>Zip Code :<b></FONT></Label>
		<input type="text" name="billZipcode" placeholder="Zip Code" required></td>
	</tr>
	<tr>
		<td><Label style="float:left;width:170px;margin:10px"><FONT FACE="Verdana"><b>Telephone No.:<b></FONT></Label>
		<input type="text" name="phone" placeholder="xxx-xxx-xxxx" required></td>
	</tr>
	<tr>
		<td><Label style="float:left;width:170px;margin:10px"><FONT FACE="Verdana"><b>Credit Card Number :<b></FONT></Label>
		<input type="text" name="ccNum" placeholder="Credit Card Number" required></td>
	</tr>
	<tr>
		<td><Label style="float:left;width:170px;margin:10px"><FONT FACE="Verdana"><b>Expiration Date :<b></FONT></Label>
		<input type="text" name="expDate" placeholder="YYYY-MM" required></td>
	</tr>
	<tr>
		<td><Label style="float:left;width:170px;margin:10px"><FONT FACE="Verdana"><b>CCV :<b></FONT></Label>
		<input type="text" name="ccv" placeholder="security code" required></td>
	</tr>
	<tr>
		<td align ="center"><input type="submit" value="SAVE" class="btn btn-large btn-primary" name="save-data" style="width:100px;height:25px;padding-top:2px"></td>
	</tr>
	</table>
</form>
</body>
</html>