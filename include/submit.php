<?php
	require getcwd()."/getsite.php";
	date_default_timezone_set('UTC');
	
	$title = $_GET['title'];
	
	$temp = fopen(dirname(getcwd())."/contents/".$title.".cont", "w");
  	fwrite($temp, $_POST['wTextB']);
  	fclose($temp);
  	$pagesize = strlen($_POST['wTextB']);
		
  	if (file_exists(dirname(getcwd())."/history/".$title.".hist")) {		
		$hiscache = "<?php\necho '" . $_SERVER["REMOTE_ADDR"] . " edited this page @ ". date('H:i, F jS, Y') ." (<i>". substr(addslashes(str_replace(array("\r", "\n"), " ", strip_tags($_POST['wTextB']))), 0, 256) ."</i>) (".$pagesize.")<br>';\n?>"; // this gets prepended
		$history = dirname(getcwd())."/history/".$title.".hist"; // the file to which $cache_new gets prepended

		$handlehis = fopen($history, "r+");
		$lenhis = strlen($hiscache);
		$final_his = filesize($history) + $lenhis;
		$hiscache_old = fread($handlehis, $lenhis);
		rewind($handlehis);
		$hi = 1;
		while (ftell($handlehis) < $final_his) {
		  fwrite($handlehis, $hiscache);
		  $hiscache = $hiscache_old;
		  $hiscache_old = fread($handlehis, $lenhis);
		  fseek($handlehis, $hi * $lenhis);
		  $hi++;
		}
  	} else {
  		$history = fopen(dirname(getcwd())."/history/".$title.".hist", "w");
  		fwrite($history, "<?php\necho '" . $_SERVER["REMOTE_ADDR"] . " edited this page @ ". date('H:i, F jS, Y') ." (<i>". substr(addslashes(str_replace(array("\r", "\n"), " ", strip_tags($_POST['wTextB']))), 0, 256) ."</i>) (".$pagesize.")<br>';\n?>");
  		fclose($history);
  	}
	
	$cache_new = "<?php\necho '" . $_SERVER["REMOTE_ADDR"] . " edited <a href=\'index.php?title=".$title."\'>".$title."</a> @ ". date('H:i, F jS, Y') ." - (<i>". substr(addslashes(str_replace(array("\r", "\n"), " ", strip_tags($_POST['wTextB']))), 0, 256) ."</i>) (".$pagesize.")<br>';\n?>"; // this gets prepended
	$rcfile = dirname(getcwd())."/history/RecentChanges.hist"; // the file to which $cache_new gets prepended

	$handle = fopen($rcfile, "r+");
	$len = strlen($cache_new);
	$final_len = filesize($rcfile) + $len;
	$cache_old = fread($handle, $len);
	rewind($handle);
	$i = 1;
	while (ftell($handle) < $final_len) {
	  fwrite($handle, $cache_new);
	  $cache_new = $cache_old;
	  $cache_old = fread($handle, $len);
	  fseek($handle, $i * $len);
	  $i++;
	}
	
  	header('Location: '.$IURL.'index.php?title='.$title.'&action=view');
?>