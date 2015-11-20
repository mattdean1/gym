<?php
$arrayprices = array();
$productnamesarr = array();
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
	foreach($productnames as $value){
		array_push($productnamesarr, $value['product_name']);
		array_push($arrayprices, $value['product_price']);
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
		<h3> Customer Details not found </h3>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<strong><p>Customer Details not found </p></strong><br />
			<p>If you are a member, please return to the portal entry page and try again:</p>
			<div class="col-md-offset-2"><a href='portal.php' class="btn btn-default btn-lg" role="button">Portal</a></div>
		</div>
		
		<div class="row">
		<p>Alternatively, if you are not currently a member, please click here to purchase a membership: </p>
		<div class="col-md-offset-2"><a href='durationselect.php' 
		class="btn btn-default btn-lg" role="button">Purchase</a></div>
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