<?php
header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<?php
$skin = "silver";
if ($skin == "silver") {
	require $ID."skins/silver/header.php";
}
if (file_exists($ID.'history/RecentChanges.hist')) {
	$historyf = fopen($ID.'history/RecentChanges.hist', 'r');
	if (filesize($ID.'history/RecentChanges.hist') > 0) {
		$history = fread($historyf, filesize($ID.'history/RecentChanges.hist'));
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
		$history = 'There is nothing to display here.';
	}
} else {
	$history = 'Latest changes file was not found. Maybe it has been deleted? If you have access to the server, create a new file called "RecentChanges.hist" in the "history" directory, if you don\'t, ask someone who does.';
}
echo '<div class="pagetitle">Latest changes</div>';
echo '<hr>';
echo '<div class="content">';
echo $history;
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