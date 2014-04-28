<?php
session_start();
//check session first

	require_once ('../mysqli_connect.php');
	$user_id=$_GET['user_id'];  
	$query = "SELECT * FROM users WHERE user_id =$user_id"; 
	$result = mysqli_query ($con, $query) or die(mysqli_error($con));
	$num = mysqli_num_rows($result);
	if ($num > 0)
	{
		$row = mysqli_fetch_array($result, MYSQL_ASSOC);
		?>
		<html>
		<body>
		<?php
		echo "" . $row['firstname'] . "<br>" . $row['lastname'] . "<p>"; 
		echo "Are you sure that you want to delete this record?<br>";
		echo "<a href=deleteuser.php?user_id=" . $user_id . ">YES</a> <a href=regusers.php>NO</a>"; 
		?>
		</body>
		</html>
		<?php
	}
	else
	{ 
		echo '<p>There is no such record.</p>';
	}
	mysqli_close($con);

?>
