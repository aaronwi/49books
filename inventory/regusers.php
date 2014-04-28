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

<link rel="stylesheet" href="css/style.css" type="text/css"/>
<link rel="stylesheet" href="css/small.css" type="text/css" />
</head>

<body>

 <!-------------------------
USERS PAGE 
 ------------------------->
 
 <div data-role="page" class="page" id="regusers">
 <!-- panel menu -->
	<section data-role="panel" id="panel" data-position="right" data-display="overlay">
		<ul data-role="listview">
			<li data-role="list-divider">Browse Inventory</li>
			<li><input type="search"  id="search" placeholder="Search" data-clear-btn="true" /></li>
			<!--<li><a href="#">Filter Search</a></li>-->
			<li data-role="list-divider">General</a></li>
			<li><a href="../home/userfeed.php">Back to 49 Books</a></li>
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
			<h3 class="ui-title"> Users </h3>
		</div>
		
		<div class="ui-block-c">
			<a href="#panel"  
				data-role="button" data-icon="bars" data-iconpos="notext" data-inline="true" 
				class="ui-nodisc-icon ui-btn-right ui-corner-all" style="background:transparent; margin: 5px 0px;">Menu</a>
		</div>
	</header>
	
	<section data-role="content" class="ui-content">
	<h5 style="text-align: center; font-style:italic; padding: 5px auto 5px auto;" >Choose users(s) to manage:</h5>
			<fieldset data-role="controlgroup">
				<center><legend>49 Books Registered Users</legend></center>

						<?php	
							//Set the number of records to display per page
							$display = 5;
							//Check if the number of required pages has been determined
							if(isset($_GET['p'])&&is_numeric($_GET['p'])){//Already been determined
								$pages = $_GET['p'];
							}else{//Need to determine
									//Count the number of records;
									$query = "SELECT COUNT(user_id) FROM users";
									$result = @mysqli_query($con, $query); 
									$row = @mysqli_fetch_array($result, MYSQL_NUM);
									$records = $row[0]; //get the number of records
									//Calculate the number of pages ...
									if($records > $display){//More than 1 page is needed
									$pages = ceil($records/$display);
									}else{
										$pages = 1;
									}
								}// End of p IF.

							//Determine where in the database to start returning results ...
							if(isset($_GET['s'])&&is_numeric($_GET['s'])){
								$start = $_GET['s'];
							}else{
								$start = 0;
							}
							
							//Make the paginated query;
							$query = "SELECT * FROM users LIMIT $start, $display"; 
							$result = mysqli_query($con, $query) or die (mysqli_error($con));
							
							//Table header:
							echo "<center>";					
							echo "<table cellpadding=5 cellspacing=5 border=1><tr>
							<th>Last, First Name </th><th>Email</th><th>User type</th><th>Phonenumber</th><th>Delete</th><th>Update</th></tr>";
							echo "</center>";
											
							//Fetch and Print all records ....				
							while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
								echo "<tr><td><strong>".$row['lastname']." , ".$row['firstname']."</strong></td<br>";
								echo "<td>".$row['email']."</td><br>";
								echo "<td>".$row['accttype']."</td><br>";
								echo "<td>".$row['phonenumber']."</td><br>";
								echo "<td><a href=deleteuser.php?user_id=".$row['user_id'].">Delete</a></td>";
								echo "<td><a href=updateuser.php?user_id=".$row['user_id'].">Update</a></td>";
							}// End of While staement 

							echo "</table>"; 
							mysqli_free_result ($result); // Free up the resources.         
							mysqli_close($con); // Close the database connection.

							//Make the links to other pages if necessary.
							if($pages>1){
									echo '<br/><table><tr>';
									//Determine what page the script is on:
									$current_page = ($start/$display) + 1;
									//If it is not the first page, make a Previous button:
									if($current_page != 1){
										echo '<td><a href="regusers.php?s='. ($start - $display) . '&p=' . $pages. '"> Previous </a></td>';
									}
									//Make all the numbered pages:
									for($i = 1; $i <= $pages; $i++){
										if($i != $current_page){ // if not the current pages, generates links to that page
											echo '<td><a href="regusers.php?s='. (($display*($i-1))). '&p=' . $pages .'"> ' . $i . ' </a></td>';
										}else{ // if current page, print the page number
											echo '<td>'. $i. '</td>';
										}
									} //End of FOR loop
									//If it is not the last page, make a Next button:
									if($current_page != $pages){
									echo '<td><a href="regusers.php?s=' .($start + $display). '&p='. $pages. '"> Next </a></td>';
									}
		
								echo '</tr></table>';  //Close the table.
							}//End of pages links
						
						?>
					<!-- <input type="checkbox" name="checkbox-8a" id="checkbox-8a"/> -->
					<!-- <label for="checkbox-8a">Last, First</label> -->
			</fieldset>
	
	<footer data-role="footer" data-position="fixed" data-theme="b" data-tap-toggle="false" class="manage-footer ui-grid-c">
	<div data-role="navbar" class="manage-footer">
            
            <ul> 
                <li><a href="adduser.php" data-icon="plus" data-iconpos="top" />add</a></li>  
            </ul>
	</div>
	</footer>
 </div>
 <?php
	}
 ?>
 <!-------------------------
 END USERS PAGE 
 ------------------------->
 
 

 </body>
 </html>
