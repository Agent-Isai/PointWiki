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
if (file_exists($ID.'history/'.$title.'.hist')) {
	$historyf = fopen($ID.'history/'.$title.'.hist', 'r');
	if (filesize($ID."history/".$title.".hist") > 0) {
		$history = fread($historyf, filesize($ID."contents/".$title.".cont"));
		preg_match_all('/(?<=\(\()(.*?)(?=\)\))/', $history, $linkmatches);
		foreach($linkmatches[0] as $links){
			if (strstr($links, "|")){
				$linkies = explode("|", $links);
				$linkpage = $linkies[0];
				$linkname = $linkies[1];
				if (ucfirst($linkpage) == $title) {
					$history = str_replace('(('.$links.'))', '<b>'.$linkname.'</b>', $history);
				} else {
					if (file_exists($ID."contents/".ucfirst($linkpage).".cont")) {
						$history = str_replace('(('.$links.'))', '<a href="index.php?title='.ucfirst($linkpage).'">'.$linkname.'</a>', $history);
					} else {
						$history = str_replace('(('.$links.'))', '<a class="noexists" href="index.php?title='.ucfirst($linkpage).'&action=edit">'.$linkname.'</a>', $history);
					}
				}
			} else {
				if (ucfirst($links) == $title) {
					$history = str_replace('(('.$links.'))', '<b>'.$links.'</b>', $history);
				} else {
					if (file_exists($ID."contents/".ucfirst($links).".cont")) {
						$history = str_replace('(('.$links.'))', '<a href="index.php?title='.ucfirst($links).'">'.$links.'</a>', $history);
					} else {
						$history = str_replace('(('.$links.'))', '<a class="noexists" href="index.php?title='.ucfirst($links).'&action=edit">'.$links.'</a>', $history);
					}
				}
			}
		}
	} else {
		header('Location: '.$IURL.'index.php?title='.$title.'&action=view');
	}
} else {
	header('Location: '.$IURL.'index.php?title='.$title.'&action=view');
}
echo '<div class="pagetitle">History for "'.$title.'"</div>';
echo '<hr>';
echo '<ul class="navbuttons"><li class="navbuttons"><a class="navbuttons" href="'.$IURL.'index.php?title='.$title.'&action=view">Article</a></li><li class="navbuttons"><a class="navbuttons" href="'.$IURL.'index.php?title='.$title.'&action=edit">Edit</a></li></ul><br>';
echo '<div class="content">';
echo $history;
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