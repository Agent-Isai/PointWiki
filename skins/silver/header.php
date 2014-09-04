<?php
header('Content-Type: text/html; charset=utf-8');
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
</head>
<body>
<div style="background:#dddddd;">
<?php
echo '<div class="sitename"><a class="sitename" href="index.php">'.$name.'</a></div>'
?>
</div>
<div class="page">