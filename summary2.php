<?php
//retrieves data from previous page
$namepost = $_POST["duration"];
$typepost = $_POST["type"];
$pricepost = $_POST["price"];

$title = $_POST["title"];
$fname = $_POST["firstname"];
$lname = $_POST["lastname"];
$email = $_POST["email"];
$hphone = $_POST["homephone"];
$mphone = $_POST["mobile"];


//get membership details then add them to database


//### check if customer email exists in tbl_customer ###//
try {
// connect to the database using the new more secure PDO method
    $conn = new PDO('mysql:host=localhost;dbname=gym', 'test', 'pass'); 
     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   
	//query selects the customer id for the specified customer email
    $query="SELECT pk_customer FROM tbl_customer WHERE customer_email='$email'";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $row = $stmt->fetchAll();
    //gets the first value in the array
    $rowpk = $row[0][0];
    //counts the number of items in this value - 1=exists, 0=does not exist
    $rowsum = count($row);
} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}
//if email does not exist (customer has not made a previous booking):
if ($rowsum==0){
	// add customer details to db //
		try {
		// connect to the database using the new more secure PDO method
$conn = new PDO('mysql:host=localhost;dbname=gym', 'test', 'pass');                    
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			//query inserts new record into table, with fields specified within the first 
			//set of parentheses, and the values to be placed in these
			//fields inside the second set of parentheses
			$query = "INSERT INTO tbl_customer (customer_title, customer_forename, customer_surname, 
						customer_homephone, customer_mobile, customer_email)
					VALUES ('$title','$fname','$lname','$hphone','$mphone','$email')";
			$stmt = $conn->prepare($query);
			$stmt->execute();
		} catch(PDOException $e) {
			echo 'ERROR: ' . $e->getMessage();
		}
	// get pk for customer just added //
		try {
		// connect to the database using the new more secure PDO method
$conn = new PDO('mysql:host=localhost;dbname=gym', 'test', 'pass');			
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   
			//query selects the customer id for the specified customer email
			$query="SELECT pk_customer FROM tbl_customer WHERE customer_email='$email'";
			$stmt = $conn->prepare($query);
			$stmt->execute();
			$row = $stmt->fetchAll();
			$rowpk = $row[0][0];
		} catch(PDOException $e) {
			echo 'ERROR: ' . $e->getMessage();
		}
}
//if customer has made a previous booking(email exists), or customer details have 
//been added to the database :
//### update order details ###//

//first get the product id  and duration(in days) corresponding to the duration, type etc.
			try {
		// connect to the database using the new more secure PDO method
$conn = new PDO('mysql:host=localhost;dbname=gym', 'test', 'pass');			
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   
			//query selects the customer id for the specified customer email
			$query="SELECT pk_productid, product_duration FROM tbl_product 
					WHERE product_price='$pricepost' AND product_name='$namepost' AND product_type='$typepost'";
			$stmt = $conn->prepare($query);
			$stmt->execute();
			$row = $stmt->fetchAll();
		} catch(PDOException $e) {
			echo 'ERROR: ' . $e->getMessage();
		}
		$productid = $row[0][0];
		$productduration = $row[0][1];
	
//now calculate start/end date of membership
	$startdate = date('Y-m-d');
	$enddate =  date('Y-m-d', strtotime('+' . $productduration . ' days'));

	//now add everything to the db
	try {
	// connect to the database using the new more secure PDO method
$conn = new PDO('mysql:host=localhost;dbname=gym', 'test', 'pass');		
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		//query inserts new record into table, with fields specified within the first 
		//set of parentheses, and the values to be placed in these
		//fields inside the second set of parentheses
		$query = "INSERT INTO tbl_membership (membership_custid, membership_productid, membership_cost, 
		membership_startdate, membership_enddate)
							VALUES ('$rowpk','$productid','$pricepost','$startdate','$enddate')";
		$stmt = $conn->prepare($query);
		$stmt->execute();
	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}
	
	//get pk_membership, so we can pass this to the ipn custom field
					try {
		// connect to the database using the new more secure PDO method
$conn = new PDO('mysql:host=localhost;dbname=gym', 'test', 'pass');			
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   
			//query selects the customer id for the specified customer email
			$query="SELECT pk_membership FROM tbl_membership WHERE membership_custid='$rowpk' ORDER BY pk_membership DESC";
			$stmt = $conn->prepare($query);
			$stmt->execute();
			$row = $stmt->fetchAll();
		} catch(PDOException $e) {
			echo 'ERROR: ' . $e->getMessage();
		}
		$memberid = $row;
	
	
?>

<html lang="en">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
  <!---title of the tab--->
  <title>Summary</title>
  <!---favicon of the tab--->
	<link rel="shortcut icon" href="favicon.ico"> 
  <!---specifies style sheet to be used--->
     <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.css" rel="stylesheet">
    <!-- Bootstrap theme -->
    <link href="dist/css/bootstrap-theme.css" rel="stylesheet">
	<link href="css/sticky-footer.css" rel="stylesheet">
</head>

<body>
<div id="wrap">
	      <!-- Begin page content -->
		<div class="jumbotron">
			<div class="container">
				<!---headings at the top of the page--->
				    <!---headings at the top of the page--->
			<h2>Chipping Campden Gym Booking System</h2>
			<h3> Please Confirm Purchase </h3>
			</div>
		</div>

	
   
 		<div class="container">
				<div class="row">
					<div class="col-md-6 col-md-offset-1">
						<table class="table table-condensed" id="priceinfo">
								<tr>
								<!---formatted column headings--->
									<td><strong>Type</strong></td>
									<td><strong>Duration</strong></td>
									<td><strong>Price</strong></td>
								</tr>
								<tr>
									<td><?php echo $typepost; ?></td>
									<td><?php echo $namepost; ?></td>
									<td>£<?php echo $pricepost; ?></td>
								</tr>
						</table>
					</div>
				</div>
				
<form id="custform" action="complete.php" method="post">

<!---hidden inputs in order to pass data to the next page--->
<input type="hidden" name="duration" value="<?php echo $namepost; ?>">
<input type="hidden" name="type" value="<?php echo $typepost; ?>">
<input type="hidden" name="price" value="<?php echo $pricepost; ?>">

				<div class="row">
					<div class="col-md-offset-1">
						<p> Please click this button in order to be passed onto the payment system </p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-offset-3">
					<!--paypal button -->
						<script src="js/paybut1.js?merchant=merchant001@paypal.com" 
						data-button="buynow" 
						data-name="<?php echo $namepost; ?> <?php echo $typepost; ?> Gym Membership" 
						data-amount="<?php echo $pricepost; ?>"
						data-currency="GBP" 
						data-shipping="0" 
						data-tax="0" 
						data-env="sandbox"
						></script>
					</div>
				</div>
		<p> Once payment is complete, you will be returned to this site, and a confirmation message will be displayed.</p>
 		</form>

		</div>
</div>
  <div id="footer">
    <div class="container">
		<div class="text-center">
        <p><small>&copy;&nbsp; Matt Dean &nbsp;2013/14 </small></p><!---copyright information--->
		</div>
      </div>
    </div>
    
</body>
</html>
	