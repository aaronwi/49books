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

 <div data-role="page" class="page" id="books">
 <!-- panel menu -->
	<section data-role="panel" id="panel" data-position="right" data-display="overlay">
		<ul data-role="listview">
			<li data-role="list-divider">Browse Inventory</li>
			<!--<li><input type="search"  id="search" placeholder="Search" data-clear-btn="true" /></li>
			<li><a href="#">Filter Search</a></li>-->
			<li data-role="list-divider">General</a></li>
			<li><a href="../home/logout.php" class="ui-icon-lock">Logout</a></li>
		</ul>
	</section>
<!-- end of panel menu -->	

	<header data-role="header" data-theme="b" class="acct-header-grid ui-grid-b">
		<div class="ui-block-a">
			<a href="inventory.php"
				data-role="button" data-icon="arrow-l" data-iconpos="notext" data-inline="true"
				class="ui-nodisc-icon ui-btn-left ui-corner-all" style="background:transparent; margin: 5px 0px;">Home</a>
		</div>
		
		<div class="ui-block-b">
			<h3 class="ui-title"> Books </h3>
		</div>
		
		<div class="ui-block-c">
			<a href="#panel"  
				data-role="button" data-icon="bars" data-iconpos="notext" data-inline="true" 
				class="ui-nodisc-icon ui-btn-right ui-corner-all" style="background:transparent; margin: 5px 0px;">Menu</a>
		</div>
	</header>
	
	<section data-role="content" class="ui-content">
	<h5 style="text-align: center; font-style:italic;" >Choose item(s) to manage:</h5>
				<?php	
					$query = "SELECT * FROM books"; 
					$result = mysqli_query($con, $query) or die (mysqli_error($con));

					echo "<center><table data-role=\"table\"  data-mode=\"columntoggle\" id=\"books_table\" class=\"ui-responsive table-stripe my-custom-class\"  data-column-btn-theme=\"b\" data-column-btn-text=\"Change data display\" data-column-popup-theme=\"a\">
					
					<thead>
							<tr>							
								<th data-priority=\"1\">Author Name</th>
								<th data-priority=\"2\">Book Title</th>
								<th data-priority=\"3\">Price</th>
								<th>Delete</th>
								<th>Update</th>
							</tr>
					</thead>					
					
					</center>";
									
					while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
					{
						echo "<tr><td>".$row['authorlast'].", ".$row['authorfirst']."</td>";
						echo "<td>".$row['title']."</td>";
						echo "<td>". number_format($row['price'], 2)."</td>";
						echo "<td><a href='#delete' data-rel='popup' data-position-to='window' data-transition='pop' onclick='sessionStorage.isbn=" . $row['isbn'] . "'>Delete</a></td>";
						echo "<td><a href='updatebook.php?isbn=" .$row['isbn'] . "'>Update</a></td></tr>";
					}

					echo "</table></center>"; 
					mysqli_free_result ($result); // Free up the resources.         
					mysqli_close($con); // Close the database connection.

				?>

		<div data-role="popup" id="delete" data-overlay-theme="b" data-theme="b" data-dismissible="false" style="max-width:400px;">
		<a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a>
		<header data-role="header" data-theme="a"><h6>Fill Book</h6></header>
		
		<div role="main" class="ui-content">
			<h4 class="ui-title">Are you sure you want to fill and delete this book?</h4>

					<center><a href="#" id="deletebook" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" data-rel="back" data-transition="flow">Delete</a>
						<a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" data-rel="back">Cancel</a></center>
		</div>
    </div>

	
	<footer data-role="footer" data-position="fixed" data-theme="b" data-tap-toggle="false" class="manage-footer ui-grid-c">
	<div data-role="navbar" class="manage-footer">
            
            <ul> 
                <li><a href="addbook.php" data-icon="plus" data-iconpos="top" />add</a></li>      
            </ul>
	</div>
	</footer>
 </div>

 
  <script type="text/javascript">
	$('#deletebook').click(function(){
		var isbn = sessionStorage.getItem('isbn');
		$.post(
			"deletebook.php",
			{ isbn: isbn }, function(){
			location.reload()}
		);
	});
	
</script>
 <?php
	}
 ?>
 <!-------------------------
 END INVENTORY PAGE 
 ------------------------->
 
 </body>
 </html>
