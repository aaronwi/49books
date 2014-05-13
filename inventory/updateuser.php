<?php
session_start(); 

if ($_SESSION['accttype'] != "admin")
{
	echo "You do not have rights to see this page, Please contact your local admin!";
	exit();

}
else
{
    require_once('../../mysqli_connect.php'); 
    $errors = array(); //intialize error array.
	$user_id = $_SESSION['user_to_edit'];

	
	if(isset($_POST['submitted']))
	{
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
		#	$errors[] = 'You forgot to enter your email.';
		#}
		
		$phonenumber = mysqli_real_escape_string($con, trim($_POST['phonenumber']));
		if(empty($phonenumber))
		{
			$errors[] = 'You forgot to enter your phone number.';
		}

		if(empty($errors))
		{ 
			
			$query = "UPDATE users SET firstname='$firstname', lastname='$lastname', phonenumber='$phonenumber', street='$street', city='$city', state='$state', zip='$zip' WHERE user_id='$user_id'";
			
			$result = mysqli_query($con, $query) or die(mysqli_error($con));

			if($result)
			{
				header("Location: regusers.php");
			}
			else
			{
				echo "<p>The record could not be added due to a system error: " . mysqli_error() . "</p>";
				echo "<a href=regusers.php>Go Back</a>";
				exit();
			}
		} 
	}
	else //initial load
	{
		$user_id = $_GET["user_id"];
		$_SESSION['user_to_edit'] = $user_id;
		$query = "SELECT * FROM users WHERE user_id='$user_id'"; 
		$result = mysqli_query($con, $query);				
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	}

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


 <div data-role="page" id="updateuser" data-theme="a">
			<header data-role="header" data-theme="b">
				<a href="regusers.php" data-inline="true" data-mini="true" class="ui-btn-left">Cancel</a>
				<h3 align="center">Update User Form</h3>
			</header>
			
			<div data-role="main" class="ui-content"> 
			<form id="newuser" action="<? echo $PHP_SELF;?>" method="post" data-ajax="false">
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
			
				<center>
				<input type="hidden" name="submitted" value="TRUE" />
				<input type="submit"  name="submit" value="Submit"/>

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
 <?php
 }
 ?>