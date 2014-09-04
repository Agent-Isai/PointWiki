<?php
header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<?php
$skin = "silver";
if ($skin == "silver") {
	require $ID."skins/silver/header.php";
}
$title = $_GET['title'];
echo '<div class="pagetitle">Invalid page</div>';
echo '<hr>';
?>
<div class="content">
<?php
	echo '<b>The page you have requested is invalid!</b><br><a href="'.$IURL.'index.php">Return to main page</a>.';
if ($skin == "silver") {
	require $ID."skins/silver/footer.php";
}
?>
</div>
</div>
<?php
if ($skin == "silver") {
	require $ID."skins/silver/sidebar.php";
}
?>