<?php
session_start(); 
//check session first
if (!isset($_SESSION['accttype'])){
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
<!-----------------------
ADMIN INVENTORY PAGE 
--------------------------->
<div data-role="page" class="page" id="manage">

	<header data-role="header" id="head4" data-theme="b" class="acct-header-grid ui-grid-b">
		<div class="ui-block-a">
			<a href="#"
				data-rel="back" data-role="button" data-icon="arrow-l" data-iconpos="notext" data-inline="true"
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
			<li><a href="#request">Reserve Request <span class="ui-li-count">
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
<!-------------------------
 END ADMIN MAIN INVENTORY PAGE 
 ------------------------->
 
 
 <!-------------------------
 RESERVED BOOK REQUEST
 -------------------------->
 <div data-role="page "id="request" class="page">
	<!-- panel menu -->
	<section data-role="panel" id="panel" data-position="right" data-display="overlay">
		<ul data-role="listview">
			<li data-role="list-divider">General</a></li>
			<li><a href="../admin.php">Back to 49 Books</a></li>
		</ul>
	</section>
<!-- end of panel menu-->

	<header data-role="header" data-theme="b" class="acct-header-grid ui-grid-b">
		<div class="ui-block-a">
			<a href="#"
				data-rel="back" data-role="button" data-icon="arrow-l" data-iconpos="notext" data-inline="true"
				class="ui-nodisc-icon ui-btn-left ui-corner-all" style="background:transparent; margin: 5px 0px;"></a>
		</div>
		
		<div class="ui-block-b">
			<h3 class="ui-title"> Request </h3>
		</div>
		
		<div class="ui-block-c">
			<a href="#panel"  
				data-role="button" data-icon="bars" data-iconpos="notext" data-inline="true" 
				class="ui-nodisc-icon ui-btn-right ui-corner-all" style="background:transparent; margin: 5px 0px;"></a>
		</div>
	</header>
	
	<section data-role="content" class="ui-content">
	<h5 style="text-align: center; font-style:italic; padding: 5px auto 5px auto;" >Choose books(s) to manage:</h5>
			<fieldset data-role="controlgroup">
				<legend>Book Reserve Request</legend>
					<input type="checkbox" name="checkbox-1a" id="checkbox-1a"/>
					<label for="checkbox-1a">Book Title for Last, First</label>
					<input type="checkbox" name="checkbox-2a" id="checkbox-2a"/>
					<label for="checkbox-2a">Book Title for Last, First</label>
					<input type="checkbox" name="checkbox-3a" id="checkbox-3a"/>
					<label for="checkbox-3a">Book Title for Last, First</label>
					<input type="checkbox" name="checkbox-4a" id="checkbox-4a"/>
					<label for="checkbox-4a">Book Title for Last, First</label>
					<input type="checkbox" name="checkbox-5a" id="checkbox-5a"/>
					<label for="checkbox-5a">Book Title for Last, First</label>
					<input type="checkbox" name="checkbox-6a" id="checkbox-6a"/>
					<label for="checkbox-6a">Book Title for Last, First</label>
					<input type="checkbox" name="checkbox-7a" id="checkbox-7a"/>
					<label for="checkbox-7a">Book Title for Last, First</label>
					<input type="checkbox" name="checkbox-8a" id="checkbox-8a"/>
					<label for="checkbox-8a">Book Title for Last, First</label>
			</fieldset>
	
	<footer data-role="footer" data-position="fixed" data-theme="b" data-tap-toggle="false" class="manage-footer ui-grid-b">
	<div data-role="navbar" class="manage-footer">
            
            <ul> 
                <li><input type="button" data-icon="edit" data-iconpos="top" value="Mark Filled" /></li> 
				<li><input type="button" data-icon="forbidden" data-iconpos="top" value="delete" class="delete" /></li> 
            </ul>
	</div>
	</footer>
 </div>
 </div>
  <!-------------------------
 END RESERVED BOOK REQUEST
 -------------------------->

 
 
 
</body>
</html>
<?php
	}
?>