<?php
session_start(); 
//check session first
if (!isset($_SESSION['accttype'])){
	echo "You do not have rights to see this page, Please contact your local admin!";
	exit();

} else {
	require_once ('../../mysqli_connect.php');
	$isbn=$_GET['isbn']; 
	$query = "DELETE FROM books WHERE isbn=$isbn"; 
	$result = mysqli_query ($con, $query) or die(mysqli_error($con));
	?>
	<html>
	<body>
	<?php
	if ($result){
		echo "The selected book has been deleted."; 
	}else {
		echo "The selected book could not be deleted."; 
	}
	echo "<p><a href=books.php>Books</a>"; 
	?>
	</body>
	</html>
<?php	
	mysqli_close($con);
}

?>