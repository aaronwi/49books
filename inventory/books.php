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

<!-------------------------
 INVENTORY PAGE 
 ------------------------->
 
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
			<a href="#"
				data-rel="back" data-role="button" data-icon="arrow-l" data-iconpos="notext" data-inline="true"
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

							//Table header:
							echo "<center><table cellpadding=5 cellspacing=5 border=1>
							<tr><th>Last, First Name </th><th>Book Title</th><th>Price</th><th>Delete</th></tr></center>";
											
							//Fetch and Print all records ....				
							while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
								echo "<tr><td><strong>".$row['authorlast']." , ".$row['authorfirst']."</strong></td<br>";
								echo "<td>".$row['title']."</td><br>";
								echo "<td>". number_format($row['price'], 2)."</td><br>";
								echo "<td><a href=deletebook.php?isbn=".$row['isbn'].">Delete</a></td>";
								#echo "<td><a href=updateuser.php?isbn=".$row['isbn'].">Update</a></td>";
							}

							echo "</table>"; 
							mysqli_free_result ($result); // Free up the resources.         
							mysqli_close($con); // Close the database connection.

				?>	
	<footer data-role="footer" data-position="fixed" data-theme="b" data-tap-toggle="false" class="manage-footer ui-grid-c">
	<div data-role="navbar" class="manage-footer">
            
            <ul> 
                <!--<li><input type="button" data-icon="camera" data-iconpos="top" value="scan" /></li>-->
                <li><a href="addbook.php" data-icon="plus" data-iconpos="top" />add</a></li> 
     
            </ul>
	</div>
	</footer>
 </div>

 <?php
	}
 ?>
 <!-------------------------
 END INVENTORY PAGE 
 ------------------------->
 
 </body>
 </html>
