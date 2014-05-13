<?php
session_start(); 
require_once("../../mysqli_connect.php");


$_SESSION=array(); // empty session data

session_regenerate_id(true); // assign a new session id and delete old data

session_destroy();
session_write_close();
mysqli_close($con);
header("Location: index.php");
?>
