<?php
	session_start();
	if(isset($_POST['submitted'])) {
	      require_once('../../mysqli_connect.php'); //connect to the DB
	      $erros = array(); //intialize error array.

	$firstname = mysqli_real_escape_string($con, trim($_POST['firstname']));
	if (empty($firstname)) {
		$errors[] = 'You forget to enter your first name.';
	}

	$firstname = mysqli_real_escape_string($con, trim($_POST['lastname']));
	if (empty($firstname)) {
		$errors[] = 'You forget to enter your last name.';
	}
	
	$phonenumber = mysqli_real_escape_string($con, trim($_POST['phonenumber']));
	if(empty($phonenumber)) {
		$errors[] = 'You forgot to enter your phone number.';
	} 

	$email = mysqli_real_escape_string($con, trim($_POST['email']));
	if(empty($email)) {
		$errors[] = 'You forgot to enter your email.';
	}

	$city = mysqli_real_escape_string($con, trim($_POST['city']));
	if( empty($city)) {
		$errors[] = 'You forgot to enter your city.';
	} 

	$state = mysqli_real_escape_string($con, trim($_POST['state']));
	if (empty($state)) {
		$errors[] = 'You forget to enter your state.';
	} 

	$zip = mysqli_real_escape_string($con, trim($_POST['zip']));
	if(empty($zip)) {
		$errors[] = 'You forgot to enter you zip code.';
	} 

	$password  = mysqli_real_escape_string($con, trim($_POST['password']));
	
	if(empty($password)) {
		$errors[] = 'You forgot to enter a password.';
	} else {
		$md5password = md5($password);
	}


	if(empty($errors))
	{ 
	  $query = "INSERT INTO users (firstname, lastname, phonenumber, email, street, city, state, zip, password) 
	  VALUES ('$firstname', '$lastname', '$phonenumber', '$email', '',  '$city', '$state', '$zip', '$md5password')";

	  $result = mysqli_query($con, $query) or die(mysqli_error($con));

	  if($result){ //If it ran OK.
		  echo "<p>User is added to Database</p>";
		  echo "<a href=inventory.php>inventory</a>";
		  exit();
	  } else { // If it did not run OK
		  echo "<p>The record could not be added due to a system error" . mysqli_error() . "</p>"; 
	  }

	} 

}
	mysqli_close();

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no, width=device-width" />
<title>49 Books</title>

<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.css" />
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.js"></script>

<link rel="stylesheet" href="../css/style.css" type="text/css"/>
<link rel="stylesheet" href="../css/small.css" type="text/css" />
</head>

<body>

  <!-------------------------
 ADD USERS PAGE 
 ------------------------->
 <div data-role="page" id="adduser" data-theme="a">
			<!--<a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a>-->
			<header data-role="header" data-theme="b">
				<a href="#" data-rel="back" data-inline="true" data-mini="true" class="ui-btn-left">Cancel</a>
				<h3 align="center">Add User Form</h3>
			</header>
			
			<div data-role="main" class="ui-content"> 
			<form id="newuser" action="<? echo $PHP_SELF;?>" method="post" data-ajax="false">
			<div style="padding:10px 10px;">
				
				<div class="ui-field-contain">
					<label for="fn">First Name:</label>
					<input type="text" name="firstname" id="firstname" value="<?php echo $_POST['firstname']; ?>" placeholder="John" data-theme="a" data-clear-btn="true" size="10">
				</div>
				
				<div class="ui-field-contain">
					<label for="ln">Last Name:</label>
					<input type="text" name="lastname" id="lastnmae" value="<?php echo $_POST['lastname']; ?>" placeholder="Doe" data-theme="a" data-clear-btn="true">		
				</div>
				
				<div class="ui-field-contain">
					<label for="phone">Phone: </label>
					<input type="tel" name="phonenumber" id="phonenumber" value="<?php echo $_POST['phonenumber']; ?>" placeholder="" data-theme="a" data-clear-btn="true">		
				</div>
				
				<div class="ui-field-contain">
					<label for="email">Email: </label>
					<input type="email" name="email" id="email" value="<?php echo $_POST['email']; ?>" placeholder="doejohn@example.com" data-theme="a" data-clear-btn="true">
				</div>
				
				<div class="ui-field-contain">
					<label for="city"> City: </label>
					<input type="text" name="city" id="city" value="<?php echo $_POST['city']; ?>" placeholder="e.g. Milwaukee" data-theme="a" data-clear-btn="true">
				</div>
				
				<div class="ui-field-contain">
					<label for="state"> State: </label>
					<input type="text" name="state" id="state" value="<?php echo $_POST['state']; ?>" placeholder="e.g. Wisconsin" data-theme="a" data-clear-btn="true">
				</div>
				
				<div class="ui-field-contain">
					<label for="zip"> Zipcode: </label>
					<input type="number" name="zip" id="zip" value="<?php echo $_POST['zip']; ?>" placeholder="53204" data-theme="a" data-clear-btn="true">
				</div>

				<div class="ui-field-contain">
					<label for="password"> Password: </label>
					<input type="password" name="password" id="password" value="<?php echo $_POST['password']; ?>" placeholder="53204" data-theme="a" data-clear-btn="true">
				</div>
													
				<center>
				<input type="submit"  name="submit" value="Submit"/></center>
				<input type="hidden" name="submitted" value="TRUE" />

				<center>
				<?php 
					if (!empty($errors)) { // Print any error messages.
						echo '<h1>Error!</h1>
						<p>The following error(s) occurred:<br />';
						foreach ($errors as $msg) { // Print each error.
						echo "$msg<br />";
						}
						echo '</p>';
						echo '<p>Please try again.</p>';
						}
				?>
				</center>
			<!-- end of style div -->
			</div>				
			</form>
		<!-- end of main content div -->
			</div>
		</div>
<!-------------------------
 END ADD USERS PAGE 
 ------------------------->
 
 </body>
 </html>