<?php	
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
  <script>
  	//submits form (see enter details)
  	function submitform() {
		document.getElementById("custform").submit();
	}
	
	//validates form (see enter details)
  	function validate() {
	var result = true;
	var msg="";

		if (document.custform.firstname.value=="") {
		msg+="You must enter your First Name \n";
		document.custform.firstname.focus();
		document.getElementById('fname').style.color="red";
		result = false;
		}
		else { document.getElementById('fname').style.color="black"; }

		if (document.custform.lastname.value=="") {
		msg+="You must enter your Last Name \n";
		document.custform.lastname.focus();
		document.getElementById('sname').style.color="red";
		result = false;
		}
		else { document.getElementById('sname').style.color="black"; }

		if (document.custform.email.value=="") {
		msg+="You must enter your Email \n";
		document.custform.email.focus();
		document.getElementById('email').style.color="red";
		result = false;
		}
		else { document.getElementById('email').style.color="black"; }

		var x=document.forms["custform"]["email"].value;
		var atpos=x.indexOf("@");
		var dotpos=x.lastIndexOf(".");
		if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {
		msg+="You have not entered a valid e-mail address \n";
		document.custform.email.focus();
		document.getElementById('email').style.color="red";
		result = false;
		}
		else { document.getElementById('email').style.color="black"; }
		
		if(msg==""){
		return submitform();
		}

		{
		alert(msg)
		return result;
		}
		}
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
		<h3> Customer Portal </h3>
		</div>
	</div>
	
	<div class="container">

		<div class="row">
			<p> Please enter some details so we can find your information for you: </p><br />
		</div>
	
		<div class="row">
			<form class="form-horizontal" name="custform" id="custform" action="portal2.php"  
			onsubmit="return validate();" method="post">	
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
				<div class="form-group" id="fnamediv">
					<label for="firstname" class="col-sm-2 control-label">*First Name: </label>
					<div class="col-sm-3">
						<input type="text" name="firstname" id="firstname" class="form-control"/>
					</div>
				</div>
				<div class="form-group" id="lnamediv">
					<label for="lastname" class="col-sm-2 control-label">*Last Name: </label>
					<div class="col-sm-3">
						<input type="text" name="lastname" id="lastname" class="form-control"/>
					</div>
				</div>
				<div class="form-group" id="emaildiv">
					<label for="email" class="col-sm-2 control-label">*Email: </label>
					<div class="col-sm-3">
						<input type="email" name="email" id="email" class="form-control"/>
					</div>
				</div>
		</div>
		<div class="row">
			<div class="col-md-offset-3">
				<input type="submit" class="btn btn-success btn-lg" value="Confirm">
			</div>
		</div>			
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
