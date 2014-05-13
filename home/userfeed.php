<?php
session_start();
require_once("../../mysqli_connect.php");

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no, width=device-width" />
<title>49 Books</title>

<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.css" />
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.js"></script>

<link rel="stylesheet" href="../css/style.css" type="text/css" @media only screen and (max-width:320px)/>
<link rel="stylesheet" href="../css/small.css" type="text/css" />



</head>

<body>
<div data-role="page" class="page" id="user">
	<!-- panel menu -->
	<section data-role="panel" id="panel" data-position="right" data-display="overlay">
		<ul data-role="listview">
			<li data-role="list-divider">Browse Catalog</li>
			<li><form id="searchform" action="userfeed.php" method="post">
			<input type="search"  name="title" id="search" placeholder="Title" data-clear-btn="true" />
			<input type="search"  name="author" id="search" placeholder="Author" data-clear-btn="true" />
			<input type="search"  name="isbn" id="search" placeholder="ISBN" data-clear-btn="true" />
			<input type="submit" value="Search"></form></li>
			
			<li data-role="list-divider">Account</a></li>
			<?php if (isset($_SESSION["firstname"]))
			{ ?>
			<li><a href="../user/uacct.php" class="ui-icon-user">View My Account</a></li>
			<li><a href="../user/uacct.php">Reserved Books</a></li>
			
				<?php if ($_SESSION['accttype'] == "admin"){ ?>
				<li data-role="list-divider">Administration</a></li>
				<li><a href="../inventory/inventory.php" class="ui-icon-gear">Manage Inventory & Users</a></li>
				<?php } ?>
			<li data-role="list-divider">General</a></li>
			<li><a href="../home/logout.php" class="ui-icon-lock">Logout</a></li>
			<?php }
			else
			{
			?>
			<li><a href="index.php">Sign In</a></li>
			<li><a href="signup.php">Sign Up</a></li>
			<?php } ?>
		</ul>
	</section>
	<!-- end of panel menu -->	
	<header id="head2" data-role="header" data-theme="b" data-icon="user" class="feed-header-grid ui-grid-b">
		
		<div class="ui-block-a">
			<img src="../images/userwht.png" width="25" height="25"/>
				</div>
				
		<div class="ui-block-b">
			<article role="header"> Welcome, 
			<?php if ($_SESSION["accttype"] == "admin")
			{
				echo "Admin";
			}
			elseif (isset($_SESSION["firstname"])) 
			{
				echo $_SESSION["firstname"];
			}
			else
			{
				echo "guest";
			}
			?></article>
				</div>
			
		<div class="ui-block-b">
			<a href="#panel"  
				data-role="button" data-icon="bars" data-iconpos="notext" data-inline="true" 
				class="ui-nodisc-icon ui-btn-right ui-corner-all" style="background:transparent; margin: 5px 0px;">Menu</a>
					</div>

	</header>
	
<!-- Query and show ALL books -->
															
	<section data-role="content" class="ui-content" id="content">
		<ul data-role="listview" id="feed">
			<?php
				//formulate the search query
				
				if(!empty($_POST['title']) || !empty($_POST['author']) || !empty($_POST['isbn']))
				{
					$query="SELECT * FROM books WHERE (title LIKE '%".$_POST['title']."%')
			AND (CONCAT(authorlast, authorfirst) LIKE '%".$_POST['author']."%')
			AND (isbn LIKE '%".$_POST['isbn']."%')";
				}
				else
				{
					$query = "SELECT * FROM books"; 
				}
				
				//show results
				$result = mysqli_query($con, $query);	
				$num = mysqli_num_rows($result);

				if ($num > 0)
				{
					while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
					{
						if (($row["reservationid"]) == null)  //make sure its not reserved already
						{
						
							print "
						<li>
							<a href='#'>
							<img src='../images/small21.png'/>
							<p><strong>" . $row['title'] . "</strong></p>
							<p>by <strong>" . $row['authorlast'] . ", " . $row['authorfirst'] . "</strong></p>
							<p style='text-align:right; position: relative; bottom: 21.95px; color: #666;'><strong>$" . number_format($row['price'], 2) . "</strong></p></a>
							<a href='#" . (isset($_SESSION['firstname']) ? 'reserve' : 'guestreserve') . "' data-rel='popup' data-position-to='window' data-transition='pop' data-icon='check' onclick='sessionStorage.isbn=" . $row['isbn'] . "'>Reserve Item</a>
						</li>";
						}
				
					} //end while
				} 
				else
				{
					echo '<p>Your search hits no result.</p>';
				}
				mysqli_close($con); // Close the database connection.
				
			?>
		</ul>	
	</section>
	
<!-- Pop up dialogue when selecting an item -->
	<div data-role="popup" id="reserve" data-overlay-theme="b" data-theme="b" data-dismissible="false" style="max-width:400px;">
		<a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a>
		<header data-role="header" data-theme="a"><h6>Reserve Book</h6></header>
		
		<div role="main" class="ui-content">
			<h4 class="ui-title">Are you sure you want to reserve this book?</h4>
				<p>You can review all of the books you have reserved by clicking the "Reserved Books" option from the main menu.</p>
					<center><a href="#" id="reserveBook" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" data-rel="back" data-transition="flow">Reserve</a>
						<a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" data-rel="back">Cancel</a></center>	
		</div>
    </div>
		
	<div data-role="popup" id="guestreserve" data-overlay-theme="b" data-theme="b" data-dismissible="false" style="max-width:400px;">
		<a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a>
		<header data-role="header" data-theme="a"><h6>Please Sign Up</h6></header>
		
		<div role="main" class="ui-content">
			<h4 class="ui-title">You are not allowed to reserve this item.</h4>
				<p>Sorry, you must sign up for an account in order to reserve 49 Books &copy; items.</p>
					<center><a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" data-rel="back" data-mini="true" data-transition="flow">Ok</a></center>
		</div>
    </div>

<!-- Footer with quick access menu bar -->
	<footer data-role="footer" data-position="fixed" data-theme="b" >						
		<div data-role="navbar" class="navbar">
			<ul>
				<li><a data-ajax="false" data-role="button" href="#user" data-icon="arrow-u" data-iconpos="top">Top</a></li>
					<li><a data-ajax="false" data-role="button" href="#panel" data-icon="search" data-iconpos="top">Search</a></li>
						</ul>
		</div>
	</footer>
</div>                                                                       
<script type="text/javascript">
	$('#reserveBook').click(function(){
		var isbn = sessionStorage.getItem('isbn');
		$.post(
			"../inventory/reservebook.php",
			{ isbn: isbn }, function(){
			location.reload()}
		);
	});
</script>
</body>
</html>