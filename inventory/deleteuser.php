<?php
session_start(); 
//check session first
if (!isset($_SESSION['accttype'])){
	echo "You do not have rights to see this page, Please contact your local admin!";
	exit();

} else {
	require_once ('../../mysqli_connect.php');
	$user_id=$_GET['user_id']; 
	$query = "DELETE FROM users WHERE user_id='$user_id'"; 
	$result = mysqli_query ($con, $query) or die(mysqli_error($con));
	?>
	<html>
	<body>
	<?php
	if ($result){
		echo "The selected record has been deleted."; 
	}else {
		echo "The selected record could not be deleted."; 
	}
	echo "<p><a href=regusers.php>Users</a>"; 
	?>
	</body>
	</html>
<?php	
	mysqli_close($con);
}

?>