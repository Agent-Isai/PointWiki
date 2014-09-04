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
echo '<div class="pagetitle">History for "'.$title.'"</div>';
echo '<hr>';
echo '<ul class="navbuttons"><li class="navbuttons"><a class="navbuttons" href="'.$IURL.'index.php?title='.$title.'&action=view">Article</a></li><li class="navbuttons"><a class="navbuttons" href="'.$IURL.'index.php?title='.$title.'&action=edit">Edit</a></li></ul><br>';
echo '<div class="content">';
if (file_exists($ID.'history/'.$title.'.hist')) {
	require $ID.'history/'.$title.'.hist';
} else {
	header('Location: '.$IURL.'index.php?title='.$title.'&action=view');
}
if ($skin == "silver") {
	require $ID."skins/silver/footer.php";
}
echo '</div>';
?>
</div>
<?php
if ($skin == "silver") {
	require $ID."skins/silver/sidebar.php";
}
?>