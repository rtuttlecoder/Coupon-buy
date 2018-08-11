<?php
require '../vendor/autoload.php';
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;
define("AUTHORIZENET_LOG_FILE", "anlog");
require_once("db.php");
$result = mysqli_query($con, "SELECT * FROM tbl_users") or die(mysqli_error($con));
$row = mysqli_fetch_array($result);

function createCustomerPaymentProfile($existingcustomerprofileid) {
	$ccNum = $_POST['ccNum'];
	$expDate = $_POST['expDate'];
	$ccv = $_POST['ccv'];
	$phone = $_POST['phone'];
	$billAddr = $_POST['billAddr'];
	$billCity = $_POST['billCity'];
	$billState = $_POST['billState'];
	$billZipcode = $_POST['billZipcode'];
	$userid = $_POST['userID'];
	
	// Common setup for API credentials
	$merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
	$merchantAuthentication->setName(\Ganesh\Constants::MERCHANT_LOGIN_ID);
	$merchantAuthentication->setTransactionKey(\Ganesh\Constants::MERCHANT_TRANSACTION_KEY);
	$refId = 'ref' . time();
	$creditCard = new AnetAPI\CreditCardType();
	$creditCard->setCardNumber($ccNum);
	$creditCard->setExpirationDate($expDate);
	$creditCard->setCardCode($ccv);
	$paymentCreditCard = new AnetAPI\PaymentType();
	$paymentCreditCard->setCreditCard($creditCard);
	
	// Create the Bill To info for new payment type
	$billto = new AnetAPI\CustomerAddressType();
	$billto->setFirstName($row['fName']);
	$billto->setLastName($row['lName']);
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
	
	// Submit a CreateCustomerPaymentProfileRequest to create a new Customer Payment Profile
	$paymentprofilerequest = new AnetAPI\CreateCustomerPaymentProfileRequest();
	$paymentprofilerequest->setMerchantAuthentication($merchantAuthentication);
	$paymentprofilerequest->setCustomerProfileId($existingcustomerprofileid);
	$paymentprofilerequest->setPaymentProfile($paymentprofile);
	$paymentprofilerequest->setValidationMode("liveMode");
	$controller = new AnetController\CreateCustomerPaymentProfileController($paymentprofilerequest);
	$response = $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::SANDBOX);
	if (($response != null) && ($response->getMessages()->getResultCode() == "Ok")) {
		echo "Create Customer Payment Profile SUCCESS: " . $response->getCustomerPaymentProfileId() . "\n";
		$payment_profile_id = $response->getCustomerPaymentProfileId();
		$sql = mysqli_query($con, "UPDATE tbl_users SET payProfile='$payment_profile_id' WHERE userID='$userid'") or die(mysqli_error($con));
		if (mysqli_query($con, $sql)) {
			header("Location: myaccount.php");
		} else {
			echo "Updating customer profile information failed!";
		}
		
	} else {
	 	echo "Create Customer Payment Profile: ERROR Invalid response\n";
	 	$errorMessages = $response->getMessages()->getMessage();
		echo "Response : " . $errorMessages[0]->getCode() . "  " .$errorMessages[0]->getText() . "\n";
	}
	return $response;
}

if (isset($_POST['save-data'])) {
	$profileID = $_POST["profileID"];
	createCustomerPaymentProfile($profileID);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Create Profile</title>
</head>
<body>
<?php
if ($row["profileID"] == NULL) {
	$cim->setParameter('email', $row["userEmail"]);
	$cim->setParameter('description', 'profile for user ' . $row["userID"]);
	$cim->setParameter('merchantCustomerId', $row["userID"]);
	$cim->createCustomerProfile();
	if ($cim->isSuccessful()) {
		$profile_id = $cim->getProfileID();
		$sqlUpdate = "UPDATE tbl_users SET profileID='$profile_id' WHERE userID='$row[userID]'";
		$updateResult = (mysqli_query($con, $sqlUpdate));
		if (!$updateResult) {
			die("Updating customer information failed!");
		}
		echo "<strong>Profile ID:</strong> " . $profile_id . "<br>";
	}  else {
		echo "CIM connection unsuccessful. Please contact Authorize.net for additional information.<br>";
	}
} else {
	$profile_id = $row["profileID"];
}
?>
<h2>Create Customer Profile</h2>
<form method="POST">
	<input type="hidden" name="profileID" value="<?=$profile_id;?>">
	<input type="hidden" name="userid" value="<?=$userID;?>">
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