<?php

//Check if the form has been submitted
if (isset($_POST['submitted'])) {
	require_once('../../mysqli_connect.php'); // connect to DB
	$errors = array(); // Initialize error array.


	$firstname = mysqli_real_escape_string($con, trim($_POST['firstname']));
	if (empty($firstname))
	{
		$errors[] = 'You forget to enter your first name.';
	}
	$lastname = mysqli_real_escape_string($con, trim($_POST['lastname']));
	if (empty($lastname))
	{
		$errors[] = 'You forget to enter your last name.';
	}
	$street = mysqli_real_escape_string($con, trim($_POST['street']));
	if (empty($street))
	{
		$errors[] = 'You forget to enter your address.';
	}
	$city = mysqli_real_escape_string($con, trim($_POST['city']));
	if( empty($city))
	{
		$errors[] = 'You forgot to enter your city.';
	}
	$state = mysqli_real_escape_string($con, trim($_POST['state']));
	if (empty($state))
	{
		$errors[] = 'You forget to enter your state.';
	}
	$zip = mysqli_real_escape_string($con, trim($_POST['zip']));
	if(empty($zip))
	{
		$errors[] = 'You forgot to enter you zip code.';
	}
	$email = mysqli_real_escape_string($con, trim($_POST['email']));
	if(empty($email))
	{
		$errors[] = 'You forgot to enter your email.';
	}
	$phonenumber = mysqli_real_escape_string($con, trim($_POST['phonenumber']));
	if(empty($phonenumber))
	{
		$errors[] = 'You forgot to enter your phone number.';
	}
	$password  = mysqli_real_escape_string($con, trim($_POST['password']));
	if(empty($password))
	{
		$errors[] = 'You forgot to enter a password.';
	}
	else
	{
		$md5password = md5($password);
	}

	if(empty($errors)) { //IF everything's OK
		//Register the user in the Database.
		//Check for Previous registration.
		$query = "SELECT * FROM users WHERE email='$email'"; 
		$result = mysqli_query($con, $query) or die(mysqli_error($con)); // Run the query.
		if (mysqli_num_rows($result) == 0) {// if there is no such email address
			//make the query
			$query = "INSERT INTO users (firstname, lastname, phonenumber, email, street, city, state, zip, password) 
			VALUES ('$firstname', '$lastname', '$phonenumber', '$email', '$street', '$city', '$state', '$zip', '$md5password')";
			$result = mysqli_query($con, $query); 
			
			if($result){ //If it ran OK.
				echo "<p>You are now registered. Please, proceed to login.</p>";
				echo "<a href=index.php>Login</a>";
				exit();
			} else { //If it did not run OK.
				$errors[] = 'You could not be registered due to a system error. We apologize for any inconvenience.'; // Public message.
				$errors[] = mysqli_error($con); // MySQL error message.
			}
		} else { // Email Address is already taken.
			$errors[] = 'The email address has already been registered.';
		}

	} // End of If (empty($errors)) 

	mysqli_close($con); //Close the database connection

} else { // Form has not been submitted
	$errors = NULL;
} // End of the main Submited conditional

// Begin the page now.


?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no, width=device-width" />
<title>49 Books - Sign Up</title>

<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.css" />
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.js"></script>

<link rel="stylesheet" href="../css/style.css" type="text/css"/>
<link rel="stylesheet" href="../css/small.css" type="text/css" />
</head>
<body>
		<div data-role="page" id="signup" data-theme="a" data-ajax="false">
			<header data-role="header" data-theme="b">
				<a href="index.php" data-inline="true" data-mini="true" class="ui-btn-left">Cancel</a>
				<h3 align="center">Sign Up Form</h3>
			</header>
			
			<div data-role="main" class="ui-content"> 
			<form id="newuser" action="signup.php" method="post" data-ajax="false">
			<div style="padding:10px 10px;">
				
				<div class="ui-field-contain">
					<label for="firstname">First Name:</label>
					<input type="text" name="firstname" id="firstname" placeholder="John" data-theme="a" data-clear-btn="true" size="10"
						value="<?php echo $_POST['firstname']; ?>" />
				</div>
				
				<div class="ui-field-contain">
					<label for="lastname">Last Name:</label>
					<input type="text" name="lastname" id="lastname" placeholder="Doe" data-theme="a" data-clear-btn="true"
						value="<?php echo $_POST['lastname']; ?>"/>		
				</div>
				
				<div class="ui-field-contain">
					<label for="phone">Phone: </label>
					<input type="tel" name="phonenumber" id="phonenumber" placeholder="eg 555-555-5555" data-theme="a" data-clear-btn="true"
						value="<?php echo $_POST['phonenumber']; ?>"/>		
				</div>
				
				<div class="ui-field-contain">
					<label for="email">Email: </label>
					<input type="email" name="email" id="email"  placeholder="doejohn@example.com" data-theme="a" data-clear-btn="true" 
						value="<?php echo $_POST['email']; ?>"/>
				</div>
				
				<div class="ui-field-contain">
					<label for="street"> Street: </label>
					<input type="text" name="street" id="street" placeholder="e.g. 123 Center St." data-theme="a" data-clear-btn="true"
						value="<?php echo $_POST['street']; ?>"/>
				</div>
				
				<div class="ui-field-contain">
					<label for="city"> City: </label>
					<input type="text" name="city" id="city" placeholder="e.g. Milwaukee" data-theme="a" data-clear-btn="true"
						value="<?php echo $_POST['city']; ?>"/>
				</div>
				
				<div class="ui-field-contain">
					<label for="state"> State: </label>
					<input type="text" name="state" id="state" placeholder="e.g. Wisconsin" data-theme="a" data-clear-btn="true"
						value="<?php echo $_POST['state']; ?>"/>
				</div>
				
				<div class="ui-field-contain">
					<label for="zip"> Zipcode: </label>
					<input type="number" name="zip" id="zip"  placeholder="53204" data-theme="a" data-clear-btn="true"  pattern="\d*"
						value="<?php echo $_POST['zip']; ?>"/>
				</div>
				
				<div class="ui-field-contain">
					<label for="pw"> Password:</label>
					<input type="password" name="password" id="pw" value="" placeholder="password" data-theme="a" data-clear-btn="true">
				</div>
				
									
				<!-- <button type="submit" name="submitted" class="ui-btn ui-corner-all ui-shadow ui-btn-b ui-btn-icon-left ui-icon-check" data-inline="true">Submit</button> -->
				<center><input type="submit"  name="submit" value="Submit"/></center>
				<input type="hidden" name="submitted" value="TRUE" />
				
				
				
				
				<!--error management-->
				<div data-role="popup" id="error" data-overlay-theme="b" data-theme="b" data-dismissible="false" data-position-to="window" style="max-width:400px;"> 
					<a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a> 
					<header data-role="header" data-theme="a"><h6>Sign Up Error</h6></header> 
					  
					<div role="main" class="ui-content"> 
						<h4 class="ui-title">Invalid input</h4> 
							<p>Sorry, the value you input for <!-- some php to tell which field is wrong --> is invalid. Please try again.</p> 
								<center><a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" data-rel="back" data-mini="true" data-transition="flow">Ok</a></center> 
					</div> 
				</div> 
				
				<!-- SUCCESS Pop up dialogue when selecting an item --> 
				<div data-role="popup" id="success" data-overlay-theme="b" data-theme="b" data-dismissible="false" data-position-to="window" style="max-width:400px;"> 
					<a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a> 
					<header data-role="header" data-theme="a"><h6>Thank you</h6></header> 
					  
					<div role="main" class="ui-content"> 
						<h4 class="ui-title">Thank you for signing up !</h4> 
							<p>You may now log into your new 49 Books&copy; account!</p> 
								<center><a href="index.php" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" data-rel="back" data-mini="true" data-transition="flow">Login</a></center> 
					</div> 
				</div> 
				
				<?php
						if (!empty($errors))
						{
							echo '<h1 id="mainhead">Error!</h1> <p class="error">The following error(s) occurred:<br />';
						foreach ($errors as $msg)
						{
							echo " - $msg<br />\n";
						}
							echo '</p><p>Please try again.</p>';
						}
					?>		
				
			<!-- end of style div -->
			</div>				
			</form>
		<!-- end of main content div -->
			</div>
		</div>
	
		
</body>
</html>