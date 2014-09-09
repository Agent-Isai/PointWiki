<?php
	session_start();
	require getcwd()."/getsite.php";
	date_default_timezone_set('UTC');
	
	$title = $_GET['title'];
	
	if (file_exists(dirname(getcwd())."/contents/".$title.".cont")) {
		$created = true;
		$pagesize = filesize(dirname(getcwd())."/contents/".$title.".cont");
	} else {
		$created = false;
		$pagesize = 0;
	}
	
	$newsize = strlen($_POST['wTextB']);
	if ($pagesize > $newsize) {
		$result = $pagesize - $newsize;
		$sizediff = "<span style=\"color:#c93c3c\">"."-".$result."</span>";
	} elseif ($pagesize < $newsize) {
		$result = $newsize - $pagesize;
		$sizediff = "<span style=\"color:#3cc94c\">"."+".$result."</span>";
	} elseif ($pagesize == $newsize) {
		$result = 0;
		$sizediff = "<span style=\"color:#adadad\">".$result."</span>";
	}
	
	$temp = fopen(dirname(getcwd())."/contents/".$title.".cont", "w");
	$content = $_POST['wTextB'];
	$content = str_replace("[[!]]", "|", $content);
  	fwrite($temp, $content);
  	fclose($temp);
		
  	if (file_exists(dirname(getcwd())."/history/".$title.".hist")) {
		if (!strlen($_POST['summary']) > 0) {
			if (! $created) {
				if (isset($_SESSION['user'])) {
					$hiscache = "<ul style=\"margin-top: 0; margin-bottom:0; padding-top: 0;padding-bottom: 0\"><li>((User:".addslashes($_SESSION['user'])."|".addslashes($_SESSION['user']).")) edited this page @ ". date('H:i, F jS, Y') ." (<i><span style=\"color:#adadad\">Page created with: ". ($newsize > 50 ? substr(addslashes(str_replace(array("\r", "\n"), " ", strip_tags($content))), 0, 50) ."..." : addslashes(str_replace(array("\r", "\n"), " ", strip_tags($content)))) ."</span></i>) (".$sizediff.")</li></ul>";
				} else {
					$hiscache = "<ul style=\"margin-top: 0; margin-bottom:0; padding-top: 0;padding-bottom: 0\"><li>" . $_SERVER["REMOTE_ADDR"] . " edited this page @ ". date('H:i, F jS, Y') ." (<i><span style=\"color:#adadad\">Page created with: ". ($newsize > 50 ? substr(addslashes(str_replace(array("\r", "\n"), " ", strip_tags($content))), 0, 50) ."..." : addslashes(str_replace(array("\r", "\n"), " ", strip_tags($content)))) ."</span></i>) (".$sizediff.")</li></ul>";
				}
			} else {
				if (isset($_SESSION['user'])) {
					$hiscache = "<ul style=\"margin-top: 0; margin-bottom:0; padding-top: 0;padding-bottom: 0\"><li>((User:".addslashes($_SESSION['user'])."|".addslashes($_SESSION['user']).")) edited this page @ ". date('H:i, F jS, Y') ." (".$sizediff.")</li></ul>";
				} else {
					$hiscache = "<ul style=\"margin-top: 0; margin-bottom:0; padding-top: 0;padding-bottom: 0\"><li>" . $_SERVER["REMOTE_ADDR"] . " edited this page @ ". date('H:i, F jS, Y') ." (".$sizediff.")</li></ul>";
				}
			}
		} else {
			if (isset($_SESSION['user'])) {
				$hiscache = "<ul style=\"margin-top: 0; margin-bottom:0; padding-top: 0;padding-bottom: 0\"><li>((User:".addslashes($_SESSION['user'])."|".addslashes($_SESSION['user']).")) edited this page @ ". date('H:i, F jS, Y') ." (<i><span style=\"color:#adadad\">".(strlen($_POST['summary']) > 50 ? substr(addslashes($_POST['summary']), 0, 50)."..." : addslashes($_POST['summary']))."</span></i>) (".$sizediff.")</li></ul>";
			} else {
				$hiscache = "<ul style=\"margin-top: 0; margin-bottom:0; padding-top: 0;padding-bottom: 0\"><li>" . $_SERVER["REMOTE_ADDR"] . " edited this page @ ". date('H:i, F jS, Y') ." (<i><span style=\"color:#adadad\">".(strlen($_POST['summary']) > 50 ? substr(addslashes($_POST['summary']), 0, 50)."..." : addslashes($_POST['summary']))."</span></i>) (".$sizediff.")</li></ul>";
			}
		}
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
		if (!strlen($_POST['summary']) > 0) {
			if (! $created) {
				if (isset($_SESSION['user'])) {
					fwrite($history, "<ul style=\"margin-top: 0; margin-bottom:0; padding-top: 0;padding-bottom: 0\"><li>((User:".addslashes($_SESSION['user'])."|".addslashes($_SESSION['user']).")) edited this page @ ". date('H:i, F jS, Y') ." (<i><span style=\"color:#adadad\">Page created with: ". ($newsize > 50 ? substr(addslashes(str_replace(array("\r", "\n"), " ", strip_tags($content))), 0, 50) ."..." : addslashes(str_replace(array("\r", "\n"), " ", strip_tags($content)))) ."</span></i>) (".$sizediff.")</li></ul>");
				} else {
					fwrite($history, "<ul style=\"margin-top: 0; margin-bottom:0; padding-top: 0;padding-bottom: 0\"><li>" . $_SERVER["REMOTE_ADDR"] . " edited this page @ ". date('H:i, F jS, Y') ." (<i><span style=\"color:#adadad\">Page created with: ". ($newsize > 50 ? substr(addslashes(str_replace(array("\r", "\n"), " ", strip_tags($content))), 0, 50) ."..." : addslashes(str_replace(array("\r", "\n"), " ", strip_tags($content)))) ."</span></i>) (".$sizediff.")</li></ul>");
				}
			} else {
				if (isset($_SESSION['user'])) {
					fwrite($history, "<ul style=\"margin-top: 0; margin-bottom:0; padding-top: 0;padding-bottom: 0\"><li>((User:".addslashes($_SESSION['user'])."|".addslashes($_SESSION['user']).")) edited this page @ ". date('H:i, F jS, Y') ." (".$sizediff.")</li></ul>");
				} else {
					fwrite($history, "<ul style=\"margin-top: 0; margin-bottom:0; padding-top: 0;padding-bottom: 0\"><li>" . $_SERVER["REMOTE_ADDR"] . " edited this page @ ". date('H:i, F jS, Y') ." (".$sizediff.")</li></ul>");
				}
			}
		} else {
			if (isset($_SESSION['user'])) {
				fwrite($history, "<ul style=\"margin-top: 0; margin-bottom:0; padding-top: 0;padding-bottom: 0\"><li>((User:".addslashes($_SESSION['user'])."|".addslashes($_SESSION['user']).")) edited this page @ ". date('H:i, F jS, Y') ." (<i><span style=\"color:#adadad\">".(strlen($_POST['summary']) > 50 ? substr(addslashes($_POST['summary']), 0, 50)."..." : addslashes($_POST['summary']))."</span></i>) (".$sizediff.")</li></ul>");
			} else {
				fwrite($history, "<ul style=\"margin-top: 0; margin-bottom:0; padding-top: 0;padding-bottom: 0\"><li>" . $_SERVER["REMOTE_ADDR"] . " edited this page @ ". date('H:i, F jS, Y') ." (<i><span style=\"color:#adadad\">".(strlen($_POST['summary']) > 50 ? substr(addslashes($_POST['summary']), 0, 50)."..." : addslashes($_POST['summary']))."</span></i>) (".$sizediff.")</li></ul>");
			}
		}
		fclose($history);
		}
	
	if (!strlen($_POST['summary']) > 0) {
		if (! $created) {
			if (isset($_SESSION['user'])) {
				$cache_new = "<ul style=\"margin-top: 0; margin-bottom:0; padding-top: 0;padding-bottom: 0\"><li>((User:".addslashes($_SESSION['user'])."|".addslashes($_SESSION['user']).")) edited ((".addslashes($title).")) @ ". date('H:i, F jS, Y') ." (<i><span style=\"color:#adadad\">Page created with: ". ($newsize > 50 ? substr(addslashes(str_replace(array("\r", "\n"), " ", strip_tags($content))), 0, 50) ."..." : addslashes(str_replace(array("\r", "\n"), " ", strip_tags($content)))) ."</span></i>) (".$sizediff.")</li></ul>"; // this gets prepended
			} else {
				$cache_new = "<ul style=\"margin-top: 0; margin-bottom:0; padding-top: 0;padding-bottom: 0\"><li>" . $_SERVER["REMOTE_ADDR"] . " edited ((".addslashes($title).")) @ ". date('H:i, F jS, Y') ." (<i><span style=\"color:#adadad\">Page created with: ". ($newsize > 50 ? substr(addslashes(str_replace(array("\r", "\n"), " ", strip_tags($content))), 0, 50) ."..." : addslashes(str_replace(array("\r", "\n"), " ", strip_tags($content)))) ."</span></i>) (".$sizediff.")</li></ul>"; // this gets prepended
			}
		} else {
			if (isset($_SESSION['user'])) {
				$cache_new = "<ul style=\"margin-top: 0; margin-bottom:0; padding-top: 0;padding-bottom: 0\"><li>((User:".addslashes($_SESSION['user'])."|".addslashes($_SESSION['user']).")) edited ((".addslashes($title).")) @ ". date('H:i, F jS, Y') ." (".$sizediff.")</li></ul>"; // this gets prepended
			} else {
				$cache_new = "<ul style=\"margin-top: 0; margin-bottom:0; padding-top: 0;padding-bottom: 0\"><li>" . $_SERVER["REMOTE_ADDR"] . " edited ((".addslashes($title).")) @ ". date('H:i, F jS, Y') ." (".$sizediff.")</li></ul>"; // this gets prepended
			}
		}
	} else {
		if (isset($_SESSION['user'])) {
			$cache_new = "<ul style=\"margin-top: 0; margin-bottom:0; padding-top: 0;padding-bottom: 0\"><li>((User:".addslashes($_SESSION['user'])."|".addslashes($_SESSION['user']).")) edited ((".addslashes($title).")) @ ". date('H:i, F jS, Y') ." (<i><span style=\"color:#adadad\">".(strlen($_POST['summary']) > 50 ? substr(addslashes($_POST['summary']), 0, 50)."..." : addslashes($_POST['summary']))."</span></i>) (".$sizediff.")</li></ul>"; // this gets prepended
		} else {
			$cache_new = "<ul style=\"margin-top: 0; margin-bottom:0; padding-top: 0;padding-bottom: 0\"><li>" . $_SERVER["REMOTE_ADDR"] . " edited ((".addslashes($title).")) @ ". date('H:i, F jS, Y') ." (<i><span style=\"color:#adadad\">".(strlen($_POST['summary']) > 50 ? substr(addslashes($_POST['summary']), 0, 50)."..." : addslashes($_POST['summary']))."</span></i>) (".$sizediff.")</li></ul>"; // this gets prepended
		}
	}
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