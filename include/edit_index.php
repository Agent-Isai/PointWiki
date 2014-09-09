<?php
header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<?php
$skin = "silver";
if ($skin == "silver") {
	require $ID.'skins/silver/header.php';
}
require $ID.'WikiSettings.php';
$file = basename(__FILE__, ".php");
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
echo '<div class="pagetitle">Editing "'.$title.'"</div>';
echo '<hr>';
if (file_exists($ID."contents/".$title.".cont")) {
	if (isset($_SESSION['user'])) {
		if (in_array($_SESSION['user'], $admin, true)) {
			echo '<ul class="navbuttons"><li class="navbuttons"><a class="navbuttons" href="'.$IURL.'index.php?title='.$title.'&action=view">Cancel editing</a></li><li class="navbuttons"><a class="navbuttons" href="'.$IURL.'index.php?title='.$title.'&action=history">History</a></li><li class="navbuttons"><a class="navbuttons" href="'.$IURL.'index.php?title='.$title.'&action=move">Move</a></li><li class="navbuttons"><a class="navbuttons" href="'.$IURL.'index.php?title='.$title.'&action=delete">Delete</a></li><li class="navbuttons"><a class="navbuttons" href="'.$IURL.'index.php?title='.$title.'&action=protect">Protect</a></li></ul><br>';
		} else {
			echo '<ul class="navbuttons"><li class="navbuttons"><a class="navbuttons" href="'.$IURL.'index.php?title='.$title.'&action=view">Cancel editing</a></li><li class="navbuttons"><a class="navbuttons" href="'.$IURL.'index.php?title='.$title.'&action=history">History</a></li></ul><br>';
		}
	} else {
		echo '<ul class="navbuttons"><li class="navbuttons"><a class="navbuttons" href="'.$IURL.'index.php?title='.$title.'&action=view">Cancel editing</a></li><li class="navbuttons"><a class="navbuttons" href="'.$IURL.'index.php?title='.$title.'&action=history">History</a></li></ul><br>';
	}
} else {
	echo '<ul class="navbuttons"><li class="navbuttons"><a class="navbuttons" href="'.$IURL.'index.php?title='.$title.'&action=view">Cancel editing</a></li></ul><br>';
}
echo '<form action="'.$IURL.'include/submit.php?title='.$title.'" method="post">'
?>
<div class="content">
<?php
if (file_exists($ID."contents/".$title.".cont")) {
	echo 'You are editing '.$title.'.';
} else {
	echo 'You are creating '.$title.'.';
}
?>
</div>
<?php
echo '<textarea tabindex="1" accesskey="," id="wTextB" cols="130" rows="30" style="" lang="en" dir="ltr" name="wTextB">';
echo $content;
echo '</textarea><br>';
?>
<label for="summary"><span style="font-family: Arial, Helvetica, sans-serif;font-size:16px;">Edit summary: </span></label>
<input type="text" name="summary" id="summary" size="70"><br>
<input type="submit" value="Save">
<?php
echo '<div class="content">';
if ($skin == "silver") {
	require $ID.'skins/silver/footer.php';
}
echo '</div>';
?>
</div>
<?php
if ($skin == "silver") {
	require $ID.'skins/silver/sidebar.php';
}
?>