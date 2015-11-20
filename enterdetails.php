<?php
//retrieves data from previous page
$infopoststring = $_POST["submit"];
$infopost = explode(",", $_POST["submit"]);
$namepost = $_POST["duration"];

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
  <script language="javascript" type="text/javascript">
  	//submits form (can be called onclick
	function submitform() {
		document.getElementById("custform").submit();
	}
	

//validates form 
function validate() { 
	//initialise variables
	var msg="";
	var result = true;
		
		//presence check
		if (document.getElementById('firstname').value === "") 
		{
		//add new line to alert msg
		msg+="You must enter your First Name \n";
		//set result to false -> the form will not submit
		result = false;
		//add class to div, highlights the field red
		document.getElementById('fnamediv').classList.add('has-error');
		}
		else { 
		//unhighlight the field
		document.getElementById('fnamediv').classList.remove('has-error'); }
	
		if (document.getElementById('lastname').value === "")
		{
		msg+="You must enter your Last Name \n";
		result = false;
		document.getElementById('lnamediv').classList.add('has-error');
		}
		else { 
		document.getElementById('lnamediv').classList.remove('has-error'); }
		
			if (document.getElementById('email').value === "") 
			{
		msg+="You must enter your Email \n";
		result = false;
		document.getElementById('emaildiv').classList.add('has-error');
		}
		else { 
		document.getElementById('emaildiv').classList.remove('has-error'); }
		
		
		if (document.getElementById('hphone').value === "")
		{
		msg+="You must enter your Home Phone Number \n";
		document.getElementById('hphonediv').classList.add('has-error');
		result = false;
		}
		else { 
		document.getElementById('hphonediv').classList.remove('has-error'); 
		}
		
		//length check
		if (document.custform.homephone.value.length!=11) {
		msg+=" Home Phone Numbers must be 11 digits \n";
		document.getElementById('hphonediv').classList.add('has-error');
		result = false;
		}
		else { 
		document.getElementById('hphonediv').classList.remove('has-error');	}
		
		if (document.getElementById('mphone').value === "")
		{
		msg+="You must enter your Mobile Phone Number \n";
		document.getElementById('mphonediv').classList.add('has-error');
		result = false;
		}
		else { 
		document.getElementById('mphonediv').classList.remove('has-error'); 
		}
		
		if (document.custform.mobile.value.length!=11) {
		msg+=" Mobile Phone Numbers must be 11 digits \n";
		document.getElementById('mphonediv').classList.add('has-error');
		result = false;
		}
		else { 
		document.getElementById('mphonediv').classList.remove('has-error');	} 
		
	if (msg !== ""){
	//if msg contains text make popup alert
	alert(msg);}
	return result; }
	
	</script>
</head>
<body>

<div id="wrap">
      <!-- Begin page content -->
		<div class="jumbotron">
			<div class="container">
				<!---headings at the top of the page--->
				    <!---headings at the top of the page--->
			<h2>Chipping Campden Gym Booking System</h2>
			<h3> Please Enter Details </h3>
			</div>
		</div>
		
		
		<div class="container"> <!--layout-->
				<div class="row">
					<div class="col-md-6 col-md-offset-1">
					<!--table to show what options the customer has selected -->
						<table class="table table-condensed" id="priceinfo">
								<tr>
								<!---formatted column headings--->
									<td><strong>Type</strong></td>
									<td><strong>Duration</strong></td>
									<td><strong>Price</strong></td>
								</tr>
								<tr>
									<td><?php echo $infopost[0]; ?></td>
									<td><?php echo $namepost; ?></td>
									<td>£<?php echo $infopost[2]; ?></td>
								</tr>
						</table>
					</div>
				</div>

				<div class="row"><br></div>
				
				<div class="row">
					<!--form where customer enters their details-->
					<form class="form-horizontal" name="custform" id="custform" action="summary2.php"  
					onsubmit="return validate();" method="post">
								
								<!--hidden inputs to continue passing post variables -->
								<input type="hidden" name="duration" value="<?php echo $namepost; ?>">
								<input type="hidden" name="type" value="<?php echo $infopost[0]; ?>">
								<input type="hidden" name="price" value="<?php echo $infopost[2]; ?>">
								
						<div class="form-group" id="titlediv">
									<!---labels ensure all fields are lined up vertically and spaced correctly-->
									<label for="title" class="col-sm-2 control-label">*Title: </label>
									<div class="col-sm-3">
										<!---dropdown to select title-->
										<select name="title" id="title" class="form-control" name="title">
										<option value="Mr">Mr</option>
										<option value="Mrs">Mrs</option>
										<option value="Ms">Ms</option>
										<option value="Dr">Dr</option>
										<option value="Professor">Professor</option>
										</select>	
									</div>
						</div>
						
						<!--text input for each field -->
						<div class="form-group" id="fnamediv">
							<label for="firstname1" class="col-sm-2 control-label">*First Name: </label>
							<div class="col-sm-3">
								<input type="text" name="firstname" id="firstname" class="form-control"/>
							</div>
						</div>
						<div class="form-group" id="lnamediv">
							<label for="lastname1" class="col-sm-2 control-label">*Last Name: </label>
							<div class="col-sm-3">
								<input type="text" name="lastname" id="lastname" class="form-control"/>
							</div>
						</div>
						<div class="form-group" id="emaildiv">
							<label for="email1" class="col-sm-2 control-label">*Email: </label>
							<div class="col-sm-3">
								<input type="email" name="email" id="email" class="form-control"/>
							</div>
						</div>
						<div class="form-group" id="hphonediv">
							<label for="hphone" class="col-sm-2 control-label">*Home Phone: </label>
							<div class="col-sm-3">
								<input type="text" name="homephone" id="hphone" class="form-control"/>
							</div>
						</div>
						<div class="form-group" id="mphonediv">
							<label for="mphone" class="col-sm-2 control-label">*Mobile: </label>
							<div class="col-sm-3">
								<input type="text" name="mobile" id="mphone" class="form-control"/>
							</div>
						</div>
				</div>
				<div class="row">
						<div class="col-md-offset-3">
							<!-- restart button - sends customer to start of system -->
							<a href="durationselect.php" class="btn btn-default btn-lg" role="button">Restart</a>
							<!--submit button -->
							<input type="submit" class="btn btn-success btn-lg" value="Confirm">
						</div>
						
				</div>
				</form>
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
