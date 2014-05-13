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

		$isbn = mysqli_real_escape_string($con, trim($_POST['isbn']));
		if (empty($isbn)) {
			$errors[] = 'You forget to enter the book isbn.';
		}

		$authorfirst = mysqli_real_escape_string($con, trim($_POST['authorfirst']));
		if (empty($authorfirst)) {
			$errors[] = 'You forget to enter your Author first name.';
		}

		$authorlast = mysqli_real_escape_string($con, trim($_POST['authorlast']));
		if (empty($authorlast)) {
			$errors[] = 'You forget to enter your Author last name.';
		}
		
		$title = mysqli_real_escape_string($con, trim($_POST['title']));
		if(empty($title)) {
			$errors[] = 'You forgot to enter the Title .';
		} 

		$price = mysqli_real_escape_string($con, trim($_POST['price']));
		if(empty($price)) {
			$errors[] = 'You forgot to enter Price.';
		}

		if(empty($errors))
		{ 
			$query = "SELECT * FROM books WHERE isbn='$isbn'"; 
			$result = mysqli_query($con, $query) or die(mysqli_error($con)); // Run the query.
			if (mysqli_num_rows($result) == 0)
			{
				$query = "INSERT INTO books (isbn, authorlast, authorfirst, title, price) 
				VALUES ('$isbn', '$authorlast','$authorfirst', '$title', '$price')";

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
						<div data-role='page' class='page' id='addbook'>
						<div role='success' class='ui-content'>
									<center><h4 class='ui-title'>Successfully Added Book</h4>
											<a href='books.php' class='ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b' data-transition='flow'>Continue</a></center>	
								</div>
							</div>
						</div>	
						</body>
						</html>
						";
						exit();
					
				} else {
					echo "<p>The record could not be added due to a system error" . mysqli_error() . "</p>"; 
					echo "<a href=books.php>Go Back</a>";
				}
			}
			else
			{
				$errors[] = 'This ISBN already exists in database.';
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


 <div data-role="page" id="addbook" data-theme="a">
			<header data-role="header" data-theme="b">
				<a href="books.php" data-inline="true" data-mini="true" class="ui-btn-left">Cancel</a>
				<h3 align="center">Add Book Form</h3>
			</header>
			
			<div data-role="main" class="ui-content"> 
			<form id="newuser" action="<? echo $PHP_SELF;?>" method="post" data-ajax="false">
			<div style="padding:10px 10px;">

				<div class="ui-field-contain">
					<label for="isbn">Book ISBN:</label>
					<input type="text" name="isbn" id="isbn" value="<?php echo $_POST['isbn']; ?>" placeholder="2345-987-9876" data-theme="a" data-clear-btn="true" size="10">
				</div>
				
				<div class="ui-field-contain">
					<label for="fn">First Name:</label>
					<input type="text" name="authorfirst" id="authorfirst" value="<?php echo $_POST['authorfirst']; ?>" placeholder="John" data-theme="a" data-clear-btn="true" size="10">
				</div>
				
				<div class="ui-field-contain">
					<label for="ln">Last Name:</label>
					<input type="text" name="authorlast" id="authorlast" value="<?php echo $_POST['authorlast']; ?>" placeholder="Doe" data-theme="a" data-clear-btn="true">		
				</div>
				
				<div class="ui-field-contain">
					<label for="title">Title: </label>
					<input type="text" name="title" id="title" value="<?php echo $_POST['title']; ?>" placeholder="The Wind and willows" data-theme="a" data-clear-btn="true">		
				</div>
				
				<div class="ui-field-contain">
					<label for="price">Price: </label>
					<input type="price" name="price" id="price" value="<?php echo $_POST['price']; ?>" placeholder="30.50" data-theme="a" data-clear-btn="true">
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