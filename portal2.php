<?php
$allmemb=array();
//get details from post:
$title = $_POST["title"];
$fname = $_POST["firstname"];
$lname = $_POST["lastname"];
$email = $_POST["email"];
//get membership details then add them to database


//### check if customer email exists in tbl_customer ###//
try {
// connect to the database using the new more secure PDO method
    $conn = new PDO('mysql:host=localhost;dbname=gym', 'test', 'pass'); 
     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   
	//query selects the customer id for the specified customer email
    $query="SELECT pk_customer FROM tbl_customer WHERE customer_email='$email' AND customer_title='$title' 
    AND customer_forename='$fname' 
    AND customer_surname='$lname'";
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
	$exist=0;
	
	//send customer to nocust.php if their details are not in the database
	header('Location: nocust.php');  
	}
else {
		$exist=1;
	
		try {
			// connect to the database using the new more secure PDO method
			$conn = new PDO('mysql:host=localhost;dbname=gym', 'test', 'pass'); 
			 $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   
			//query selects the customer id for the specified customer email
			$query="SELECT * FROM tbl_membership WHERE membership_custid='$rowpk'";
			$stmt = $conn->prepare($query);
			$stmt->execute();
			$row = $stmt->fetchAll();
			$allmemb=$row[0];
		} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
		}
		
		try {
			// connect to the database using the new more secure PDO method
			$conn = new PDO('mysql:host=localhost;dbname=gym', 'test', 'pass'); 
			 $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   
			//query selects the customer id for the specified customer email
			$query="SELECT * FROM tbl_product WHERE pk_productid='$allmemb[2]'";
			$stmt = $conn->prepare($query);
			$stmt->execute();
			$row = $stmt->fetchAll();
			$allprod=$row[0];
		} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
		}
		
		
	}

	
?>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
  <!---title of the tab--->
  <title>Portal</title>
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
		<h3> Membership Details </h3>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-1">
			<!--table displaying customers order details -->
				<table class="table table-condensed" id="priceinfo">
						<tr>
						<!---formatted column headings--->
							<td><strong>Type</strong></td>
							<td><strong>Duration</strong></td>
							<td><strong>Price</strong></td>
						</tr>
						<tr>
							<td><?php echo $allprod[3]; ?></td>
							<td><?php echo $allprod[4]; ?></td>
							<td>£<?php echo $allmemb[3]; ?></td>
						</tr>
				</table>
			</div>
		</div>
		
		<div class="row"><br></div>
		
		<div class="row">
			<div class="col-md-2 col-md-offset-2">
				Membership start date: 
			</div>
			<div class="col-md-offset-2">
			<!--display membership start date -->
			<strong><?php echo $allmemb[4]; ?></strong>
			</div>
		</div>
		
		<br>
		
		<div class="row">
			<div class="col-md-2 col-md-offset-2">
				Membership end date: 
			</div>
			<div class="col-md-offset-2">
			<!--display membership start date -->
			<strong><?php echo $allmemb[5]; ?></strong>
			</div>
		</div>
		
		<br>
		
		<div class="row">
		<!--calculate and display time till expiry -->
			<div class="col-md-2 col-md-offset-2">
				Time till expiry: 
			</div>
			<div class="col-md-offset-2">
				<strong>
					<?php 
					$date1 = new DateTime("now"); //get the current date
					$date2 = new DateTime("$allmemb[5]"); //convert end date to datetime object
					$interval = $date1->diff($date2); //get difference of two dates
					$invert = $interval->invert; //find the invert status of the difference
													//(positive or negative)
					if ($invert==1){ //if the date difference is negative
					//i.e. if now is after the end date
					echo "<div style='color:red;'>EXPIRED</div>"; //display expired message
					}
					else{
					//otherwise display the difference between the dates
					echo "" . $interval->m." months, ".$interval->d." days "; 
					}
					?></strong>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-offset-3">
				<button class="btn btn-lg btn-primary hidden-print" onclick="window.print();return false;">Print</button>
			</div>
		</div>
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
	