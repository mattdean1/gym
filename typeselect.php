<?php
//set out prices in array and get post variable
$arrayprices = array('£20', '£100', '£180');
$namepost = $_POST['submit'];
	//get product info from database
try {
// connect to the database using the new more secure PDO method
$conn = new PDO('mysql:host=localhost;dbname=gym', 'test', 'pass');    
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   
    $query="SELECT product_type, product_price FROM tbl_product WHERE product_name = '$namepost'";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $row = $stmt->fetchAll();
} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}
$productinfo = $row;

//get number of elements in array $productinfo
$count = count($productinfo);

?>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
  <title>Select Membership Type</title>
	<link rel="shortcut icon" href="favicon.ico"> 
     <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.css" rel="stylesheet">
    <!-- Bootstrap theme -->
    <link href="dist/css/bootstrap-theme.css" rel="stylesheet">
	<link href="css/sticky-footer.css" rel="stylesheet">
</head>

<body role="document">

   <div id="wrap">
		<div class="jumbotron">
			<div class="container">
				<!---headings at the top of the page--->
			<h2>Chipping Campden Gym Booking System</h2>
			<h3> Please Select Membership Type </h3>
			</div>
		</div>
		<div class="container">
		
	<form action="enterdetails.php" method="post">
	 <!--passes information to the next page when submitted-->	
			<?php
			for ($i = 0; $i < $count; $i++): //repeats i times
			?>
				<!--displays value from array for this iteration on a button-->
				<div class="row"><div class="col-md-offset-1">
				<p><button type="submit" class="btn btn-lg btn-default" name="submit"
				value="<?php echo  implode(",", $productinfo[$i]);?>"> 
				<?php echo $productinfo[$i][0]; echo ' - £'.$productinfo[$i][1];?>
				</button></p>
				</div></div>
			<?php     	
			endfor;
			?>  
		
		<!--hidden input so duration(from previous page) can be passed on-->	
		<input type="hidden" name="duration" value="<?php echo $namepost; ?>">
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
