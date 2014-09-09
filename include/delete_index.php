<?php
header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set('UTC');
?>
<!DOCTYPE html>
<?php
$skin = "silver";
if ($skin == "silver") {
	require $ID."skins/silver/header.php";
}
$title = $_GET['title'];
echo '<div class="pagetitle">Delete "'.$title.'"</div>';
echo '<hr>';
echo '<div class="content">';
if (file_exists($ID."contents/".$title.".cont")) {
	if (isset($_SESSION['user'])) {
		if (in_array($_SESSION['user'], $admin, true)) {
			echo '<ul class="navbuttons"><li class="navbuttons"><a class="navbuttons" href="'.$IURL.'index.php?title='.$title.'&action=view">Cancel</a></li><li class="navbuttons"><a class="navbuttons" href="'.$IURL.'index.php?title='.$title.'&action=edit">Edit</a></li><li class="navbuttons"><a class="navbuttons" href="'.$IURL.'index.php?title='.$title.'&action=history">History</a></li><li class="navbuttons"><a class="navbuttons" href="'.$IURL.'index.php?title='.$title.'&action=move">Move</a></li><li class="navbuttons"><a class="navbuttons" href="'.$IURL.'index.php?title='.$title.'&action=protect">Protect</a></li></ul><br>';
			echo 'You are about to delete "'.$title.'", along with all the history of this page. This process cannot be reverted. Please confirm the deletion.';
			echo '<hr>';
			echo '<form action="'.$IURL.'include/delete_submit.php?title='.$title.'" method="post" enctype="multipart/form-data">';
			echo '<label for="reason">Reason: </label>';
			echo '<input type="text" name="reason" id="reason" size="50"><br>';
			echo '<input type="submit" name="submit" value="Delete">';
			echo '</form>';
		} else {
			echo '<ul class="navbuttons"><li class="navbuttons"><a class="navbuttons" href="'.$IURL.'index.php?title='.$title.'&action=view">Back</a></li></ul>';
			echo 'You do not have the permission to delete this page.';
		}
	} else {
		echo '<ul class="navbuttons"><li class="navbuttons"><a class="navbuttons" href="'.$IURL.'index.php?title='.$title.'&action=view">Back</a></li></ul>';
		echo '<br>You do not have the permission to delete this page.';
	}
} else {
	header('Location: '.$IURL.'index.php?title='.$title.'&action=view');
}
?>
</div>
<?php
if ($skin == "silver") {
	require $ID."skins/silver/footer.php";
}
?>
</div>
<?php
if ($skin == "silver") {
	require $ID."skins/silver/sidebar.php";
}
?>