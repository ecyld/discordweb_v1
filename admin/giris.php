<?php
include("config.php");
session_start();
ob_start();
if(($_POST["username"]==$admin) and ($_POST["password"]==$adminpass)){
$_SESSION["login"] = "true";
$_SESSION["user"] = $admin;
$_SESSION["pass"] = $adminpass;
header("Location:admin.php");
}else{
echo "Incorrect.<br>";
echo "Try Again.";
header("Refresh: 2; url=index.php");
}
ob_end_flush();
?>