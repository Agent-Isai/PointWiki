<?php
header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<?php
$skin = "silver";
if ($skin == "silver") {
	require $ID."skins/silver/header.php";
}
echo '<div class="pagetitle">Latest changes</div>';
echo '<hr>';
echo '<div class="content">';
require $ID.'history/RecentChanges.hist';
echo '</div>';
?>
<div class="content">
<?php
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