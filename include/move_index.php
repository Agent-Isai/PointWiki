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
$error = $_GET['error'];
echo '<div class="pagetitle">Delete "'.$title.'"</div>';
echo '<hr>';
echo '<div class="content">';
if (file_exists($ID."contents/".$title.".cont")) {
	if (isset($_SESSION['user'])) {
		if (in_array($_SESSION['user'], $admin, true)) {
			echo '<ul class="navbuttons"><li class="navbuttons"><a class="navbuttons" href="'.$IURL.'index.php?title='.$title.'&action=view">Cancel</a></li><li class="navbuttons"><a class="navbuttons" href="'.$IURL.'index.php?title='.$title.'&action=edit">Edit</a></li><li class="navbuttons"><a class="navbuttons" href="'.$IURL.'index.php?title='.$title.'&action=history">History</a></li><li class="navbuttons"><a class="navbuttons" href="'.$IURL.'index.php?title='.$title.'&action=delete">Delete</a></li><li class="navbuttons"><a class="navbuttons" href="'.$IURL.'index.php?title='.$title.'&action=protect">Protect</a></li></ul><br>';
		} else {
			echo '<ul class="navbuttons"><li class="navbuttons"><a class="navbuttons" href="'.$IURL.'index.php?title='.$title.'&action=view">Back</a></li><li class="navbuttons"><a class="navbuttons" href="'.$IURL.'index.php?title='.$title.'&action=edit">Edit</a></li></ul>';
		}
		if ($error == "fail") {
			echo '<span style=\"color:red;font-size:20px\">Error: Moving failed.</span>';
		} elseif ($error == "exist") {
			echo '<span style=\"color:red;font-size:20px\">Error: The page you are trying to move to already exists.</span>';
		}
		echo 'You are about to move "'.$title.'", along with all the history of this page.<br>This process will leave behind a detour tag by default - however you can turn that off.<br>If a page already exists, you cannot move there until it has been deleted.<br><b>Warning</b>: If this is a popular page, it may be a major change. Think through before moving.';
		echo '<hr>';
		echo '<form action="'.$IURL.'include/move_submit.php?title='.$title.'" method="post" enctype="multipart/form-data">';
		echo '<table>';
		echo '<tr>';
		echo '<td style="text-align:right"><label for="new">New name: </label></td>';
		echo '<td><input type="text" name="new" id="new" size="50"></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td style="text-align:right"><label for="new">Reason: </label></td>';
		echo '<td><input type="text" name="reason" id="reason" size="50"></td>';
		echo '</tr>';
		echo '</table>';
		echo '<input type="checkbox" name="detour" value="detour" checked>Leave a detour behind<br>';
		echo '<input type="submit" name="submit" value="Move">';
		echo '</form>';
	} else {
		echo '<ul class="navbuttons"><li class="navbuttons"><a class="navbuttons" href="'.$IURL.'index.php?title='.$title.'&action=view">Back</a></li></ul>';
		echo '<br>You do not have the permission to move this page.';
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