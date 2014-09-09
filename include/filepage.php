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
$nodetour = $_GET['nodetour'];
$detoured = $_GET['detoured'];
if (file_exists($ID."contents/".$title.".cont")) {
	$contentf = fopen($ID."contents/".$title.".cont", "r");
	if (filesize($ID."contents/".$title.".cont") > 0) {
	$content = fread($contentf, filesize($ID."contents/".$title.".cont"));
	//magic words
	$content = str_replace("[[PAGENAME]]", $title, $content);
	$content = str_replace("[[SITENAME]]", $name, $content);
	$content = str_replace("[[URL]]", "http://".$_SERVER['HTTP_HOST']."/", $content);
	$content = str_replace("[[VERSION]]", $version, $content);
	$content = str_replace("[[PAGENUMBER]]", $pages, $content);
	$content = str_replace("[[FILENUMBER]]", $images, $content);
	$content = str_replace("[[PAGESIZE]]", filesize($ID."/contents/".$title.".cont"), $content);
	//date
	$content = str_replace("[[DAY]]", date('d'), $content);
	$content = str_replace("[[DAYSHORT]]", date('D'), $content);
	$content = str_replace("[[DAYNAME]]", date('l'), $content);
	$content = str_replace("[[DAYSUFFIX]]", date('jS'), $content);
	$content = str_replace("[[WEEK]]", date('W'), $content);
	$content = str_replace("[[MONTHNAME]]", date('F'), $content);
	$content = str_replace("[[MONTH]]", date('m'), $content);
	$content = str_replace("[[MONTHSHORT]]", date('M'), $content);
	$content = str_replace("[[YEAR]]", date('Y'), $content);
	$content = str_replace("[[HOUR12]]", date('g A'), $content);
	$content = str_replace("[[HOUR24]]", date('H'), $content);
	$content = str_replace("[[MINUTE]]", date('i'), $content);
	$content = str_replace("[[SECOND]]", date('s'), $content);
	$content = str_replace("[[TIME]]", date('H:i'), $content);
	//disable tags
	$content = str_replace("<script>", "<!>", $content);
	$content = str_replace("</script>", "<!>", $content);
	$content = str_replace("<html>", "<!>", $content);
	$content = str_replace("</html>", "<!>", $content);
	$content = str_replace("<head>", "<!>", $content);
	$content = str_replace("</head>", "<!>", $content);
	$content = str_replace("<body>", "<!>", $content);
	$content = str_replace("</body>", "<!>", $content);
	$content = str_replace("<?php", "<!>", $content);
	$content = str_replace("?php>", "<!>", $content);
	$content = str_replace("<?", "<!>", $content);
	$content = str_replace("?>", "<!>", $content);
	$content = str_replace("<style>", "<!>", $content);
	$content = str_replace("</style>", "<!>", $content);
	$content = str_replace("<title>", "<!>", $content);
	$content = str_replace("</title>", "<!>", $content);
	$content = str_replace("<base>", "<!>", $content);
	$content = str_replace("</base>", "<!>", $content);
	$content = str_replace("<meta>", "<!>", $content);
	$content = str_replace("</meta>", "<!>", $content);
	$content = str_replace("<link>", "<!>", $content);
	$content = str_replace("</link>", "<!>", $content);
	//detour
	if (0 === strpos($content, ":DETOUR") && !$nodetour == "true") {
		$content = str_replace(":DETOUR ", "", $content);
		if ($content == $title || $content == "[[PAGENAME]]") {
			$content = "<span style=\"color:red;font-size:20px\">Error: Redirect loop.</span>";
		} else {
			header('Location: '.$IURL.'index.php?title='.$content.'&action=view&detoured='.$title);
		}
	}
	//bold
	preg_match_all('/(?<=\*\*)(.*?)(?=\*\*)/', $content, $boldmatches);
	foreach($boldmatches[0] as $boldtext){
		$content = str_replace('**'.$boldtext.'**', '<b>'.$boldtext.'</b>', $content);
	}
	//italics
	preg_match_all('/(?<=__)(.*?)(?=__)/', $content, $italicmatches);
	foreach($italicmatches[0] as $itext){
		$content = str_replace('__'.$itext.'__', '<i>'.$itext.'</i>', $content);
	}
	//code
	preg_match_all('/(?<=`)(.*?)(?=`)/', $content, $codematches);
	foreach($codematches[0] as $codet){
		$content = str_replace('`'.$codet.'`', '<pre style="border:1px dashed grey;background:#DDDDDD;padding:10px">'.str_replace('<', '&lt;', str_replace('>', '&gt;', $codet)).'</pre>', $content);
	}
	//youtube
	preg_match_all('/(?<=<youtube>)(.*?)(?=<\/youtube>)/', $content, $ytmatches);
	foreach($ytmatches[0] as $youtubevid){
		$videoid = substr($youtubevid, -11);
		$content = str_replace('<youtube>'.$youtubevid.'</youtube>', '<iframe src="http://youtube.com/embed/'.$videoid.'" width="640px" height="360px" frameBorder="0">Your browser is not compatible with the YouTube tags.</iframe>', $content);
	}
	//internal links
	preg_match_all('/(?<=\(\()(.*?)(?=\)\))/', $content, $linkmatches);
	foreach($linkmatches[0] as $links){
		if (strstr($links, "|")){
			$linkies = explode("|", $links);
			$linkpage = $linkies[0];
			$linkname = $linkies[1];
			if (ucfirst($linkpage) == $title) {
				$content = str_replace('(('.$links.'))', '<b>'.$linkname.'</b>', $content);
			} else {
				if (file_exists($ID."contents/".ucfirst($linkpage).".cont")) {
					$content = str_replace('(('.$links.'))', '<a href="index.php?title='.ucfirst($linkpage).'">'.$linkname.'</a>', $content);
				} else {
					$content = str_replace('(('.$links.'))', '<a class="noexists" href="index.php?title='.ucfirst($linkpage).'&action=edit">'.$linkname.'</a>', $content);
				}
			}
		} else {
			if (ucfirst($links) == $title) {
				$content = str_replace('(('.$links.'))', '<b>'.$links.'</b>', $content);
			} else {
				if (file_exists($ID."contents/".ucfirst($links).".cont")) {
					$content = str_replace('(('.$links.'))', '<a class="exists" href="index.php?title='.ucfirst($links).'">'.$links.'</a>', $content);
				} else {
					$content = str_replace('(('.$links.'))', '<a class="noexists" href="index.php?title='.ucfirst($links).'&action=edit">'.$links.'</a>', $content);
				}
			}
		}
	}
	} else {
	$content = '';
	}
} else {
	$content = '';
}
echo '<div class="pagetitle">'.$title.'</div>';
if (strlen($detoured) > 0) {
	echo '<span style="font-size:12px;font-family:Arial, Helvetica, sans-serif"><i>Detoured from <a href="index.php?title='.$detoured.'&action=view&nodetour=true">'.$detoured.'</a></i></span>';
}
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
		$historyf = fopen($ID.'history/file/'.str_replace("File:", "", $title).'.hist', 'r');
		if (filesize($ID.'history/file/'.str_replace("File:", "", $title).'.hist') > 0) {
			$history = fread($historyf, filesize($ID.'history/file/'.str_replace("File:", "", $title).'.hist'));
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
							$history = str_replace('(('.$links.'))', '<a class="exists" href="index.php?title='.ucfirst($links).'">'.$links.'</a>', $history);
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
		$history = 'There is nothing to display here.';
	}
	echo $history;
	echo '<br><a class="navbuttons" href="'.$IURL.'index.php?title=Wiki:Upload&action=upload">Upload new version</a>';
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