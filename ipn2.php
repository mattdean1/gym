<?php
// This file is www.developphp.com curriculum material
// Written by Adam Khoury January 01, 2011
// http://www.youtube.com/view_play_list?p=442E340A42191003
// Check to see there are posted variables coming into the script
if ($_SERVER['REQUEST_METHOD'] != "POST") die ("No Post Variables");
// Initialize the $req variable and add CMD key value pair
$req = 'cmd=_notify-validate';
// Read the post from PayPal
foreach ($_POST as $key => $value) {
    $value = urlencode(stripslashes($value));
    $req .= "&$key=$value";
}
// Now Post all of that back to PayPal's server using curl, and validate everything with PayPal
// We will use CURL instead of PHP for this for a more universally operable script (fsockopen has issues on some environments)
$url = "https://www.sandbox.paypal.com/cgi-bin/webscr";
//$url = "https://www.paypal.com/cgi-bin/webscr";
$curl_result=$curl_err='';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/x-www-form-urlencoded", "Content-Length: " . strlen($req)));
curl_setopt($ch, CURLOPT_HEADER , 0);   
curl_setopt($ch, CURLOPT_VERBOSE, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);
$curl_result = @curl_exec($ch);
$curl_err = curl_error($ch);
curl_close($ch);

$req = str_replace("&", "\n", $req);  // Make it a nice list in case we want to email it to ourselves for reporting

// Check that the result verifies
if (strpos($curl_result, "VERIFIED") !== false) {
    $req .= "\n\nPaypal Verified OK";
	//only used for testing - remove and do the checks once this works
	//mail("brisingrfire82@gmail.com", "IPN interaction verified", "$req", "From: brisingrfire82@gmail.com" );
} else {
	$req .= "\n\nData NOT verified from Paypal!";
	mail("brisingrfire82@gmail.com", "IPN interaction not verified", "$req", "From: brisingrfire82@gmail.com" );
	exit();
}
//connect to sql here maybe
//Make sure that the transaction’s payment status is “completed”
if ($_POST['payment_status'] != "Completed") {
	// Handle how you think you should if a payment is not complete yet
	//info is passed to customer by pdt, so nothing needs to be done here
}
else {
// change database flag to paid ------------------------------------
$memberid = $_POST['custom'];
$memberid = rtrim($memberid, ","); // remove last comma
try {
// connect to the database using the new more secure PDO method
    $conn = new PDO('mysql:host=mysql14.000webhost.com;dbname=a3521387_gym', 'a3521387_test', 'Matx82');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$query = "UPDATE tbl_membership SET membership_paid=1 WHERE membership_custid='$memberid'";
		$stmt = $conn->prepare($query);
    	$stmt->execute();
	}
catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
} 


}

// Mail yourself the details FOR TESTING
//mail("you@youremail.com", "NORMAL IPN RESULT YAY MONEY!", $req, "From: you@youremail.com"); 
?>