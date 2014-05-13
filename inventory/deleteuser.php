<?php
session_start(); 
//check session first
if ($_SESSION['accttype'] != "admin"){
	echo "You do not have rights to see this page, Please contact your local admin!";
	exit();

} else {
	require_once ('../../mysqli_connect.php');
	$user_id=$_POST['user_id']; 
	$query = "DELETE FROM users WHERE user_id='$user_id'"; 
	mysqli_query ($con, $query) or die(mysqli_error($con));

	mysqli_close($con);
}
?>