<?php
session_start(); 

if ($_SESSION['accttype'] != "admin"){
	echo "You do not have rights to see this page, Please contact your local admin!";
	exit();

} else {
		require_once("../../mysqli_connect.php");
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

<div data-role="page" class="page" id="manage">

	<header data-role="header" id="head4" data-theme="b" class="acct-header-grid ui-grid-b">
		<div class="ui-block-a">
			<a href="../home/userfeed.php"
				data-role="button" data-icon="arrow-l" data-iconpos="notext" data-inline="true"
				class="ui-nodisc-icon ui-btn-left ui-corner-all" style="background:transparent; margin: 5px 0px;">Home</a>
		</div>
		
		<div class="ui-block-b">
			<h3 class="ui-title">Admin</h3>
		</div>
		
	</header>
	
	<div align="center" style="margin-top: 25px; margin-bottom: 20px;">
			<img src="../images/49logo.png" alt="49 Books logo" title="49 Books logo" />
				</div>
	
	<section data-role="content">
		<ul data-role="listview" data-inset="true">
			<li data-role="list-divider">Manage Items</li>
			<li><a href="books.php">Book Inventory</a></li>
			<li><a href="regusers.php">Registered Users</a></li>
			<li><a href="reserverequests.php">Reserve Request <span class="ui-li-count">
			<?php
				$query="SELECT * FROM books WHERE reservationid IS NOT NULL";
				$result = mysqli_query ($con, $query) or die (mysqli_error());
				echo mysqli_num_rows($result);
			?>			
			</span></a></li>
		</ul>
	
	</section></section>
	
	<footer data-role="footer" data-theme="b" data-position="fixed">
		<h5 role="heading">&copy; 49 Books</h5>
			</footer>
</div>

</body>
</html>
<?php
	}
?>