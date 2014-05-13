<?php
session_start(); 
//check session first
if ($_SESSION['accttype'] != "admin"){
	echo "You do not have rights to see this page, Please contact your local admin!";
	exit();

} else {
	require_once ('../../mysqli_connect.php');
	$isbn = $_POST['isbn'];
	$query = "DELETE FROM books WHERE isbn=$isbn"; 
	mysqli_query ($con, $query) or die(mysqli_error($con));

	mysqli_close($con);
}
?>