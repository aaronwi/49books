<?php
session_start();
require_once ('../../mysqli_connect.php');

$isbn = $_GET['isbn'];
//$isbn = $_POST['isbn'];

?>
<html>
<body>
<?php
	$query = "SELECT * FROM books WHERE isbn=$isbn";
	$result = mysqli_query ($con, $query) or die(mysqli_error($con));
	$row = mysqli_fetch_array($result, MYSQL_ASSOC);
	if ($row > 0)
	{
		$query = "UPDATE books SET reservationid=null WHERE isbn=$isbn";
		mysqli_query ($con, $query) or die(mysqli_error($con));
	}
	else
	{
		echo '<p>There is no such book.</p>';
	}

?>
</body>
</html>
<?php
mysqli_close($con);

?>
