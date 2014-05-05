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
	<h5 style="text-align: center; font-style:italic; padding: 5px auto 5px auto;" >Book Reserve Request</h5>
			<fieldset data-role="controlgroup">
					<?php	
							$query = "SELECT books.reservationid, books.authorfirst, books.authorlast, books.title, books.price, books.isbn, users.user_id, users.firstname, users.lastname
										FROM books 
										INNER JOIN users 
										ON books.reservationid=users.user_id 
										ORDER BY books.reservationid"; 


							$result = mysqli_query($con, $query) or die (mysqli_error($con));

							//Table header:
							echo "<center>";					
							echo "<table data-role=\"table\"  data-mode=\"columntoggle\" id=\"books_table\" class=\"ui-responsive table-stripe my-custom-class\"  data-column-btn-theme=\"b\" data-column-btn-text=\"Change data display\" data-column-popup-theme=\"a\">
							<thead>
							<tr>							
								<th data-priority=\"2\">Author Name</th>
								<th data-priority=\"1\">Book Title</th>
								<th data-priority=\"3\">Price</th>
								<th data-priority=\"4\">Reserved By</th>
								<th>Cancel</th>
								<th>Fill</th>
							</tr>
							</thead>";
							echo "</center>";
											
							//Fetch and Print all records ....				
							while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
							{
								echo "<tr><td><strong>".$row['authorlast'].", ".$row['authorfirst']."</strong></td>";
								echo "<td>".$row['title']."</td>";
								echo "<td>". number_format($row['price'], 2)."</td>";
								echo "<td>" . $row['lastname'] . " " .$row['firstname']."</td>";
								echo "<td><a href=cancelbook.php?isbn=".$row['isbn'].">Cancel</a></td>";
								echo "<td><a href=deletebook.php?isbn=".$row['isbn'].">Fill</a></td></tr>";
							}

							echo "</table>"; 
							mysqli_free_result ($result); // Free up the resources.         
							mysqli_close($con); // Close the database connection.

				?>	
		<!--<ul> 
            <li><input type="button" data-icon="edit" data-iconpos="top" value="Mark Filled" /></li> 
			<li><input type="button" data-icon="forbidden" data-iconpos="top" value="delete" class="delete" /></li> 
        </ul>-->
	<footer data-role="footer" data-position="fixed" data-theme="b" data-tap-toggle="false" class="manage-footer ui-grid-b">
	<div data-role="navbar" class="manage-footer">
            
            
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