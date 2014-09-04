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
if (file_exists($ID."contents/".$title.".cont")) {
	$contentf = fopen($ID."contents/".$title.".cont", "r");
	if (filesize($ID."contents/".$title.".cont") > 0) {
	$content = fread($contentf, filesize($ID."contents/".$title.".cont"));
	} else {
	$content = '';
	}
} else {
	$content = '';
}
echo '<div class="pagetitle">'.$title.'</div>';
echo '<hr>';
if (file_exists($ID."contents/".$title.".cont")) {
	echo '<ul class="navbuttons"><li class="navbuttons"><a class="navbuttons" href="'.$IURL.'index.php?title='.$title.'&action=edit">Edit</a></li><li class="navbuttons"><a class="navbuttons" href="'.$IURL.'index.php?title='.$title.'&action=history">History</a></li></ul><br>';
} else {
	echo '<ul class="navbuttons"><li class="navbuttons"><a class="navbuttons" href="'.$IURL.'index.php?title='.$title.'&action=edit">Create</a></li></ul>';
}
?>
<div class="content">
<?php
	echo $content;
if (file_exists($ID."contents/".$title.".cont")) {
	fclose($contentf);
}
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