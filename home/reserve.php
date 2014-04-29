<?php
session_start();
require_once ('../../mysqli_connect.php');

	$isbn = $_GET['isbn'];
	$user_id = $_SESSION['user_id'];
	if (isset($_GET['isbn']))
	{
		$query = "UPDATE books SET reservationid=$user_id WHERE isbn=$isbn";
		mysqli_query ($con, $query) or die(mysqli_error($con));
	}
	

	
	#if ($num > 0)
	#{
	#	$row = mysqli_fetch_array($result, MYSQL_ASSOC);
#		echo "" . $row['title'] . "<br>" . "By "$row['lastname'] . ", " . $row['authorfirst'] . "<p>"; 
#		echo "Are you sure that you want to reserve this book?<br>";
#		echo "<a href=reserve.php?isbn=" . $isbn . ">YES</a> <a href=userfeed.php>NO</a>"; 
#	}
#	else
#	{ 
#		echo '<p>There is no such book.</p>';
#	}
#	mysqli_close($con);

?>
