<?php
session_start(); 
require_once("../../mysqli_connect.php");
$email = $_SESSION["email"];
$query = "SELECT * FROM users WHERE email='$email'"; 
$result = mysqli_query($con, $query);				
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

if (isset($_POST['submitted']))
{
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
	
	#$email = mysqli_real_escape_string($con, trim($_POST['email']));
	#if(empty($email))
	#{
#		$errors[] = 'You forgot to enter your email.';
	#}
	$phonenumber = mysqli_real_escape_string($con, trim($_POST['phonenumber']));
	if(empty($phonenumber))
	{
		$errors[] = 'You forgot to enter your phone number.';
	}
	$password  = mysqli_real_escape_string($con, trim($_POST['password']));
	if(empty($password))
	{
		$errors[] = 'You forgot to re-enter or update your password.';
	}
	else
	{
		$md5password = md5($password);
	}

	if(empty($errors))
	{
		$query = "UPDATE users 
		SET firstname='$firstname', lastname='$lastname', phonenumber='$phonenumber', street='$street', city='$city', state='$state', zip='$zip', password='$md5password' 
		WHERE email='$email'";
		$result = mysqli_query($con, $query); // Run The query.
		if($result)
		{
			header ("Location: uacct.php");
			exit();
		}
		else
		{
			$errors[] = 'You could not be registered due to a system error. We apologize for any inconvenience.'; // Public message.
			$errors[] = mysqli_error($con); // MySQL error message.
		}


	} 

	mysqli_close($con); //Close the database connection
} //submitted conditional
else
{
	$errors = NULL;
	$email = $_SESSION["email"];
	$query = "SELECT * FROM users WHERE email='$email'"; 
	$result = mysqli_query($con, $query) or die(mysqli_error($con)); // Run the query.
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
}
// Begin the page now.


?>
<!doctype html>
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
<!-----------------------------
 UPDATE ACCT FORM PAGE 
 ----------------------------->	
		<div data-role="page" id="update" data-theme="a" data-ajax="false">
			<header data-role="header" data-theme="b">
				<a href="#" data-rel="back" data-inline="true" data-mini="true" class="ui-btn-left">Cancel</a>
				<h3 align="center">Update Account</h3>
			</header>
			
			<div data-role="main" class="ui-content"> 
			<form id="updateinfo" action="updateacct.php" method="post" data-ajax="false">
			<div style="padding:10px 10px;">
			<?php	
			if (isset($_POST['submitted'])) {?>
				<div class="ui-field-contain">
					<label for="firstname">First Name:</label>
					<input type="text" name="firstname" id="firstname" placeholder="John" data-theme="a" data-clear-btn="true" size="10" value="<?php echo $_POST['firstname']; ?>" />
				</div>
				
				<div class="ui-field-contain">
					<label for="lastname">Last Name:</label>
					<input type="text" name="lastname" id="lastname" placeholder="Doe" data-theme="a" data-clear-btn="true" value="<?php echo $_POST['lastname']; ?>"/>			
				</div>
				
				<div class="ui-field-contain">
					<label for="phone">Phone: </label>
					<input type="tel" name="phonenumber" id="phonenumber" placeholder="eg 555-555-5555" data-theme="a" data-clear-btn="true" value="<?php echo $_POST['phonenumber']; ?>"/>				
				</div>
				<!--
				<div class="ui-field-contain">
					<label for="email">Email: </label>
					<input type="email" name="email" id="email" placeholder="doejohn@example.com" data-theme="a" data-clear-btn="true" value="<?php echo $_POST['email']; ?>"/>
				</div>
				-->
				<div class="ui-field-contain">
					<label for="street"> Street: </label>
					<input type="text" name="street" id="street" placeholder="e.g. 123 Center St." data-theme="a" data-clear-btn="true" value="<?php echo $_POST['street']; ?>"/>
				</div>
				
				<div class="ui-field-contain">
					<label for="city"> City: </label>
					<input type="text" name="city" id="city" placeholder="e.g. Milwaukee" data-theme="a" data-clear-btn="true" value="<?php echo $_POST['city']; ?>"/>
				</div>
				
				<div class="ui-field-contain">
					<label for="state"> State: </label>
					<input type="text" name="state" id="state" placeholder="e.g. Wisconsin" data-theme="a" data-clear-btn="true" value="<?php echo $_POST['state']; ?>"/>
				</div>
				
				<div class="ui-field-contain">
					<label for="zip"> Zipcode: </label>
					<input type="number" name="zip" id="un" placeholder="53204" data-theme="a" data-clear-btn="true" pattern="\d*" value="<?php echo $_POST['zip']; ?>"/>
				</div>
				<?php } else { ?>
								<div class="ui-field-contain">
					<label for="firstname">First Name:</label>
					<input type="text" name="firstname" id="firstname" placeholder="John" data-theme="a" data-clear-btn="true" size="10" value="<?php echo $row['firstname']; ?>" />
				</div>
				
				<div class="ui-field-contain">
					<label for="lastname">Last Name:</label>
					<input type="text" name="lastname" id="lastname" placeholder="Doe" data-theme="a" data-clear-btn="true" value="<?php echo $row['lastname']; ?>"/>			
				</div>
				
				<div class="ui-field-contain">
					<label for="phone">Phone: </label>
					<input type="tel" name="phonenumber" id="phonenumber" placeholder="eg 555-555-5555" data-theme="a" data-clear-btn="true" value="<?php echo $row['phonenumber']; ?>"/>				
				</div>
				<!--
				<div class="ui-field-contain">
					<label for="email">Email: </label>
					<input type="email" name="email" id="email" placeholder="doejohn@example.com" data-theme="a" data-clear-btn="true" value="<?php echo $row['email']; ?>"/>
				</div>
				-->
				<div class="ui-field-contain">
					<label for="street"> Street: </label>
					<input type="text" name="street" id="street" placeholder="e.g. 123 Center St." data-theme="a" data-clear-btn="true" value="<?php echo $row['street']; ?>"/>
				</div>
				
				<div class="ui-field-contain">
					<label for="city"> City: </label>
					<input type="text" name="city" id="city" placeholder="e.g. Milwaukee" data-theme="a" data-clear-btn="true" value="<?php echo $row['city']; ?>"/>
				</div>
				
				<div class="ui-field-contain">
					<label for="state"> State: </label>
					<input type="text" name="state" id="state" placeholder="e.g. Wisconsin" data-theme="a" data-clear-btn="true" value="<?php echo $row['state']; ?>"/>
				</div>
				
				<div class="ui-field-contain">
					<label for="zip"> Zipcode: </label>
					<input type="number" name="zip" id="un" placeholder="53204" data-theme="a" data-clear-btn="true" pattern="\d*" value="<?php echo $row['zip']; ?>"/>
				</div>				
				
				<?php } ?>
				<div class="ui-field-contain">
					<label for="pw"> Password:</label>
					<input type="password" name="password" id="pw" placeholder="password" data-theme="a" data-clear-btn="true">
				</div>
				
				<center><input type="submit"  name="submit" value="Submit"/></center>
				<input type="hidden" name="submitted" value="TRUE" />
				
				
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