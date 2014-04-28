<?php
session_start(); 
require_once("../../mysqli_connect.php");
session_destroy();

mysqli_close($con);
header("Location: index.php");
?>
