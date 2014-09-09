<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<?php
include getcwd().'/WikiSettings.php';
$title = $_GET['title'];
echo '<title>'.$title.' | '.$name.'</title>';
?>
<?php
echo '<link rel="stylesheet" type="text/css" href="'.$IURL.'skins/silver/silver.css"/>';
?>
<style>
a.userlinks:link{
	color: #2A5DB0;
	text-decoration: none;
	font-family: Arial, Helvetica, sans-serif;
}
a.userlinks:visited{
	color: #2A5DB0;
	text-decoration: none;
	font-family: Arial, Helvetica, sans-serif;
}
a.userlinks:hover{
	text-decoration: underline;
	color: #2f6fd6;
	font-family: Arial, Helvetica, sans-serif;
}
a.userlinks:active{
	text-decoration: underline;
	color: #2f6fd6;
	font-family: Arial, Helvetica, sans-serif;
}
</style>
</head>
<body>
<div style="font-size:14px">
<?php
if (isset($_SESSION['user'])) {
	echo '<a class="userlinks" href="index.php?title=User:'.stripslashes($_SESSION['user']).'">'.stripslashes($_SESSION['user']).'</a> | <a class="userlinks" href="index.php?title=User messages:'.$_SESSION['user'].'">Messages</a> | <a class="userlinks" href="index.php?title=Wiki:AccountSettings">Settings</a> | <a class="userlinks" href="index.php?title=Wiki:Logout&return='.$title.'">Log out</a>';
} else {
	echo '<a class="userlinks" href="index.php?title=Wiki:Login">Log in</a> | <a class="userlinks" href="index.php?title=Wiki:Register">Register</a>';
}
?>
</div>
<div class="page">
<br><br>