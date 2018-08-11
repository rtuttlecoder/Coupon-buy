<?php

if (isset($_POST["submit"])) {
	$cim->setParameter('customerProfileId', $_POST["profileID"]);
	$cim->setParameter('billToFirstName', $_POST["fName"]);
	$cim->setParameter('billToLastName', $_POST["lName"]);
	$cim->setParameter('billToAddress', $_POST["baddr"]);
	$cim->setParameter('billToCity', $_POST["bcity"]);
	$cim->setParameter('billToState', $_POST["bstate"]);
	$cim->setParameter('billToZip', $_POST["bzip"]);
	$cim->setParameter('billToCountry', 'US');
	$cim->setParameter('billToPhoneNumber', $_POST["bphone"]);
	$cim->setParameter('cardNumber', $_POST["ccNum"]);
	$cim->setParameter('expirationDate', $_POST["ccExp"]);
	if ($cim->isSuccessful()) {
		$payment_profile_id = $cim->getPaymentProfileId();
		echo "Customer Payment information updated successfully!<br>";
		$sqlPayUpdate = "UPDATE tbl_users SET payProfile='$payment_profile_id' WHERE userID='$_POST[userID]'";
		$updatePayResult = (mysqli_query($con, $sqlPayUpdate));
		if (!$updatePayResult) {
			die("Updating customer payment information failed!");
		}
	}
}

echo "<p><strong>Please enter your Payment information</strong>:</p>";
?>
<form id="payProfileForm" action="" method="post">
	<input type="hidden" name="profileID" value="<?=$row['profileID'];?>">
	<input type="hidden" name="fName" value="<?=$row['firstName'];?>">
	<input type="hidden" name="lName" value="<?=$row['lastName'];?>">
	<input type="hidden" name="userID" value="<?=$row['userID'];?>">
	<input type="hidden" name="updatePay" value="1">
	Billing Address: <input type="text" name="baddr" placeholder="Your Billing address" size="50" value=""><br>
	Billing City: <input type="text" name="bcity" placeholder="Your Billing city" size="50" value=""><br>
	Billing State: <input type="text" name="bstate" placeholder="Your Billing state" value="" size="2"><br>
	Billing Zipcode: <input type="text" name="bzip" placeholder="Your Billing zipcode" size="10" value=""><br>
	Billing Phone: <input type="text" name="bphone" placeholder="Your Billing phone" size="10" value=""><br>
	Credit Card Number: <input type="text" name="ccNum" placeholder="Credit Card Number" value="" size="25"><br>
	Expiration Date: <input type="text" name="ccExp" placeholder="Card Expiration Date" size="4" value=""><br>
	<input type="submit" name="submit" value="UPDATE">
</form>