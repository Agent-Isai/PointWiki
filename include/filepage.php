<?php
header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<?php
$skin = "silver";
if ($skin == "silver") {
	require $ID."skins/silver/header.php";
}
require 'WikiSettings.php';
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
if (file_exists($ID."upload/".str_replace("File:", "", $title))) {
	echo '<ul class="navbuttons"><li class="navbuttons"><a class="navbuttons" href="'.$IURL.'index.php?title='.$title.'&action=edit">Edit</a></li><li class="navbuttons"><a class="navbuttons" href="'.$IURL.'index.php?title='.$title.'&action=history">History</a></li></ul><br>';
	echo '<div class="content">';
	echo '<a href="'.$IURL.'upload/'.str_replace("File:", "", $title).'"><img src="'.$IURL.'upload/'.str_replace("File:", "", $title).'" style="max-width:50%;"></a>';
	$img = get_headers($IURL.'upload/'.str_replace("File:", "", $title), 1);
	$size = getimagesize($ID.'upload/'.str_replace("File:", "", $title));
	echo '<br>';
	echo '<div style="font:grey;font-size:12px">File size: '.$img["Content-Length"].' bytes. File resolution: '.$size[0].'x'.$size[1].' pixels.</div><br>';
	echo $content;
	echo '<h2>File history</h2>';
	if (file_exists($ID.'history/file/'.str_replace("File:", "", $title).'.hist')) {
		require $ID.'history/file/'.str_replace("File:", "", $title).'.hist';
	}
	echo '<a class="navbuttons" href="'.$IURL.'index.php?title=Wiki:Upload&action=upload">Upload new version</a>';
	echo '</div>';
} else {
	echo '<ul class="navbuttons"><li class="navbuttons"><a class="navbuttons" href="'.$IURL.'index.php?title=Wiki:Upload&action=upload">Upload</a></li></ul><br>';
	echo '<div class="content">';
	echo 'This file does not exist yet, but you can <a class="navbuttons" href="'.$IURL.'index.php?title=Wiki:Upload&action=upload">upload</a> it.';
	echo '</div>';
}
if (file_exists($ID."contents/".$title.".cont")) {
	fclose($contentf);
}
if ($skin == "silver") {
	require $ID."skins/silver/footer.php";
}
echo '</div>';
if ($skin == "silver") {
	require $ID."skins/silver/sidebar.php";
}
?>