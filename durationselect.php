<?php
	//initialise empty arrays
$arrayprices = array();
$productnamesarr = array();
	//get product info from database
try {
// connect to the database using the new more secure PDO method
    $conn = new PDO('mysql:host=localhost;dbname=gym', 'test', 'pass');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   
    $query="SELECT pk_productid, product_name, product_price FROM tbl_product GROUP BY product_name ORDER BY pk_productid";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $row = $stmt->fetchAll();
} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}
$productnames = $row;
	//put each bit of product info into the respective arrays
	foreach($productnames as $value){
		array_push($productnamesarr, $value['product_name']);
		array_push($arrayprices, $value['product_price']);
	}
	
?>
<html lang="en">
<!--head defines meta info such as title, favicon and stylesheets -->
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
  <title>Select Membership Duration</title>
	<link rel="shortcut icon" href="favicon.ico"> 
     <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.css" rel="stylesheet">
    <!-- Bootstrap theme -->
    <link href="dist/css/bootstrap-theme.css" rel="stylesheet">
	<link href="css/sticky-footer.css" rel="stylesheet">
</head>

<!--body contains all document content-->
<body role="document">
	<!--this div contains the main page content, excepting the footer -->
   <div id="wrap">
		<div class="jumbotron">
			<div class="container">
				<!---headings at the top of the page--->
				<h2>Chipping Campden Gym Booking System</h2>
				<h3> Please Select Membership Duration </h3>
			</div>
		</div>
		<div class="container">
			
				<!--form for customer to choose the duration -->
			<form action="typeselect.php" method="post">
					<?php
					for ($i = 0; $i < 3; $i++): //repeats 4 times
					?>
						<!---displays value from array for this iteration on a button--->
							<div class="row"><div class="col-md-offset-1">
							<p><button  type="submit" class="btn btn-lg btn-default" name="submit" 
							value="<?php echo $productnamesarr[$i];?>"> 
							<?php echo $productnamesarr[$i]; echo ' - from £'.$arrayprices[$i];?>
							</button>
							</p>
							</div></div>
					<?php     	
					endfor;
					?>  
			</form>
				
		</div>	
 </div>

	<!--sticky footer --> 
  <div id="footer">
    <div class="container">
		<div class="text-center">
        <p><small>&copy;&nbsp; Matt Dean &nbsp;2013/14 </small></p><!---copyright information--->
		</div>
      </div>
    </div>
</body>
</html>
