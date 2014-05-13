<?php
session_start(); 

if (isset($_POST['submitted']))
{
	require_once("../../mysqli_connect.php");
	
	$errors = array(); // Initialize error array.


	// Check for an email address.
	if (empty($_POST['email'])) {
		$errors[] = 'You forgot to enter your email address.';
	} else {
		$email = mysqli_real_escape_string($con, trim($_POST['email']));
	}

	// Check for a password.
	if (empty($_POST['password'])) {
		$errors[] = 'You forgot to enter your password.';
	} else {
		$password = mysqli_real_escape_string($con, $_POST['password']);
		$password = md5($password);
	}
	if (empty($errors)) { // If everything's OK.
		$query = "SELECT * FROM users WHERE email='$email' AND password='$password'"; 
		$result = mysqli_query($con, $query); // Run the query.
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		
		if ($row) { // A record was pulled from the database.
			$_SESSION["email"] = $row["email"];
			$_SESSION["user_id"] = $row["user_id"];
			$_SESSION["firstname"] = $row["firstname"];
			$_SESSION["accttype"] = $row["accttype"];
			header("Location: userfeed.php");
			
			exit();
		} else { // No record matched the query.
			$errors[] = 'The email address and password entered do not match those on file.'; 

		}
	} 
	mysqli_close($con);
}
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
<!---------------------------------------
Main login page
-------------------------------------->
<div data-role="page" class="page" id="login">
	<header data-role="header" data-theme="b">
		<h3 class="ui-title" role="heading"> Login </h3>
			</header>
    
   	<section data-role="content" class="some ui-content">
		<div align="center" style="margin-top: 25px; margin-bottom: 20px;">
			<img src="../images/49logo.png" alt="49 Books logo" title="49 Books logo" />
				</div>
		
<!-- Begin login form -->	
		<div data-role="fieldcontain" style="margin-bottom: 50px;" >
		<form id="signin" action="index.php" method="post" data-ajax="false">
		
			<div class="ui-grid-a">
				<div class="ui-block-a" align="center">
					<label for="username"><img src="../images/user.png" width="30" height="30" id="user" style="margin-top: 10px;"/></label>
						</div>
							<div class="ui-block-b" >
								<input type="text" name="email" id="email" placeholder="Email" value="<?php echo $_POST['email']; ?>"  />
									</div>
				
				<div class="ui-block-a" align="center">
					<label for="password"><img src="../images/lock.png" width="30" height="30" id="lock" style="margin-top: 10px;"/></label>
						</div>
							<div class="ui-block-b" >
								<input type="password" name="password" id="password" placeholder="Password" />
									</div>
			</div>
			
			<div class="ui-grid-solo">
				<div class="ui-block-a" >
					<input type="hidden" name="submitted" value="TRUE" />
					<input type="submit" value="Sign In"data-inline="true"/>
						</div>
						
						<!-- display errors -->
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
						
			</div>
	
		</form>
		</div>

		<div class="ui-grid-solo" align="center">
			<div class="ui-block-a">
				<a href="signup.php" style="text-decoration:none;" data-transition="slidedown"> Sign Up </a> &nbsp;&nbsp;|&nbsp;&nbsp; <a href="userfeed.php" style="text-decoration:none;"> Continue as guest </a>
					</div> 
		</div>

    </section>
	
	<footer data-role="footer" data-theme="b">
		<h5 role="heading">&copy; 49 Books | (414) 229-1122</h5>
			</footer>
</div>

</body>
</html>