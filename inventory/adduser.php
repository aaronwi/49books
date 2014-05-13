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
	if(isset($_POST['submitted']))
	{
	    $errors = array(); //intialize error array.

		$firstname = mysqli_real_escape_string($con, trim($_POST['firstname']));
		if (empty($firstname)) {
			$errors[] = 'You forget to enter your first name.';
		}

		$lastname = mysqli_real_escape_string($con, trim($_POST['lastname']));
		if (empty($lastname)) {
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
		
		$street = mysqli_real_escape_string($con, trim($_POST['street']));
		if (empty($street))
		{
			$errors[] = 'You forget to enter your address.';
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
			$query = "SELECT * FROM users WHERE email='$email'"; 
			$result = mysqli_query($con, $query) or die(mysqli_error($con)); // Run the query.
			if (mysqli_num_rows($result) == 0)
			{// if there is no such email address
				//make the query
				$query = "INSERT INTO users (firstname, lastname, phonenumber, email, street, city, state, zip, password) 
				VALUES ('$firstname', '$lastname', '$phonenumber', '$email', '$street', '$city', '$state', '$zip', '$md5password')";

				$result = mysqli_query($con, $query) or die(mysqli_error($con));

				if($result)
				{
					echo "
					<html>
					<head>
					<meta charset='utf-8'>
					<meta name='viewport' content='initial-scale=1.0, maximum-scale=1.0, user-scalable=no, width=device-width' />
					<title>49 Books</title>

					<link rel='stylesheet' href='http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.css' />
					<script src='http://code.jquery.com/jquery-1.9.1.min.js'></script>
					<script src='http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.js'></script>

					<link rel='stylesheet' href='../css/style.css' type='text/css'/>
					<link rel='stylesheet' href='../css/small.css' type='text/css' />
					</head>

					<body>
					<div data-role='page' class='page' id='adduser'>
					<div role='success' class='ui-content'>
								<center><h4 class='ui-title'>Successfully Added</h4>
										<a href='regusers.php' class='ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b' data-transition='flow'>Continue</a></center>	
							</div>
						</div>
					</div>	
					</body>
					</html>
					";
					exit();
				} else { // If it did not run OK
				  echo "<p>The record could not be added due to a system error" . mysqli_error() . "</p>"; 
				}

			}
			else
			{ // Email Address is already taken.
				$errors[] = 'The email address has already been registered.';
			}
		  
		} // End of If (empty($errors)) 
	mysqli_close($con);
	}
	else
	{ // Form has not been submitted
		$errors = NULL;
	} // End of the main Submitted conditional
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
			<header data-role="header" data-theme="b">
				<a href="regusers.php" data-inline="true" data-mini="true" class="ui-btn-left">Cancel</a>
				<h3 align="center">Add User Form</h3>
			</header>
			
			<div data-role="main" class="ui-content"> 
			<form id="newuser" action="<? echo $PHP_SELF;?>" method="post" data-ajax="false">
			<div style="padding:10px 10px;">
				
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
				
				<div class="ui-field-contain">
					<label for="email">Email: </label>
					<input type="email" name="email" id="email" placeholder="doejohn@example.com" data-theme="a" data-clear-btn="true" value="<?php echo $_POST['email']; ?>"/>
				</div>
				
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

				<div class="ui-field-contain">
					<label for="password"> Password: </label>
					<input type="password" name="password" id="password" value="<?php echo $_POST['password']; ?>" placeholder="53204" data-theme="a" data-clear-btn="true">
				</div>

				<center>
				<input type="submit"  name="submit" value="Submit"/></center>
				<input type="hidden" name="submitted" value="TRUE" />

				<center>
				<?php 
					if (!empty($errors))
					{
						echo '<h1>Error!</h1>
						<p>The following error(s) occurred:<br />';
						foreach ($errors as $msg)
						{
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