<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$db = "test";
$conn = mysqli_connect($servername, $username, $password, $db);
if (!$conn) {
   die("Connection Error! " . mysqli_connect_error());
}


$admin = "admin";
$adminpass = "0";

$warning = array(

	'message' => "Error! ".mysqli_error($conn)."", 
	'type' => "error"





);
?>
