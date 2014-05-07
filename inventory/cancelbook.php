<?php
session_start();
require_once ('../../mysqli_connect.php');

$isbn = $_POST['isbn'];

if (isset($_POST['isbn']))
{
	$query = "SELECT * FROM books WHERE isbn=$isbn";
	$result = mysqli_query ($con, $query) or die(mysqli_error($con));
	$row = mysqli_fetch_array($result, MYSQL_ASSOC);
	if ($row > 0)
	{
		$query = "UPDATE books SET reservationid=null WHERE isbn=$isbn";
		mysqli_query ($con, $query) or die(mysqli_error($con));		
	}
}

mysqli_close($con);

?>
