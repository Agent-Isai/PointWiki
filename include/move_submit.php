<?php
session_start();
require getcwd()."/getsite.php";
date_default_timezone_set('UTC');

$title = $_GET['title'];

$newtitle = ucfirst($_POST['new']);
$reason = addslashes($_POST['reason']);
$detour = $_POST['detour'];

if (! file_exists(dirname(getcwd())."/contents/".$newtitle.".cont")) {
	if (!copy(dirname(getcwd())."/contents/".$title.".cont", dirname(getcwd())."/contents/".$newtitle.".cont")) {
		header('Location: '.$IURL.'index.php?title='.$title.'&action=move&error=fail');
	} else {
		if (!copy(dirname(getcwd())."/history/".$title.".hist", dirname(getcwd())."/history/".$newtitle.".hist")) {
			header('Location: '.$IURL.'index.php?title='.$title.'&action=move&error=fail');
		} else {
			if ($detour == "detour") {
				$pcontents = fopen(dirname(getcwd())."/contents/".$title.".cont", "w");
				fwrite($pcontents, ":DETOUR ".$newtitle);
				fclose($pcontents);
				$phist = fopen(dirname(getcwd())."/history/".$title.".hist", "w");
				if (strlen($reason) > 0) {
					if (isset($_SESSION['user'])) {
						fwrite($phist, "<ul style=\"margin-top: 0; margin-bottom:0; padding-top: 0;padding-bottom: 0\"><li>((User:".addslashes($_SESSION['user'])."|".addslashes($_SESSION['user']).")) moved this page to ((".addslashes($newtitle).")) @ ". date('H:i, F jS, Y') ." (<i><span style=\"color:#adadad\">".$reason."</span></i>) over detour</li></ul>");
					} else {
						fwrite($phist, "<ul style=\"margin-top: 0; margin-bottom:0; padding-top: 0;padding-bottom: 0\"><li>" . $_SERVER["REMOTE_ADDR"] . " moved this page to ((".addslashes($newtitle).")) @ ". date('H:i, F jS, Y') ." (<i><span style=\"color:#adadad\">".$reason."</span></i>) over detour</li></ul>");
					}
				} else {
					if (isset($_SESSION['user'])) {
						fwrite($phist, "<ul style=\"margin-top: 0; margin-bottom:0; padding-top: 0;padding-bottom: 0\"><li>((User:".addslashes($_SESSION['user'])."|".addslashes($_SESSION['user']).")) moved this page to ((".addslashes($newtitle).")) @ ". date('H:i, F jS, Y') ." over detour</li></ul>");
					} else {
						fwrite($phist, "<ul style=\"margin-top: 0; margin-bottom:0; padding-top: 0;padding-bottom: 0\"><li>" . $_SERVER["REMOTE_ADDR"] . "</a> moved this page to ((".addslashes($newtitle).")) @ ". date('H:i, F jS, Y') ." over detour</li></ul>");
					}
				}
				fclose($phist);
				if (strlen($reason) > 0) {
					if (isset($_SESSION['user'])) {
						$cache_new = "<ul style=\"margin-top: 0; margin-bottom:0; padding-top: 0;padding-bottom: 0\"><li>((User:".addslashes($_SESSION['user'])."|".addslashes($_SESSION['user']).")) moved ((".addslashes($title).")) to ((".addslashes($newtitle).")) @ ". date('H:i, F jS, Y') ." (<i><span style=\"color:#adadad\">".$reason."</span></i>) over detour</li></ul>";
					} else {
						$cache_new = "<ul style=\"margin-top: 0; margin-bottom:0; padding-top: 0;padding-bottom: 0\"><li>" . $_SERVER["REMOTE_ADDR"] . " moved ((".addslashes($title).")) to ((".addslashes($newtitle).")) @ ". date('H:i, F jS, Y') ." (<i><span style=\"color:#adadad\">".$reason."</span></i>) over detour</li></ul>";
					}
				} else {
					if (isset($_SESSION['user'])) {
						$cache_new = "<ul style=\"margin-top: 0; margin-bottom:0; padding-top: 0;padding-bottom: 0\"><li>((User:".addslashes($_SESSION['user'])."|".addslashes($_SESSION['user']).")) moved ((".addslashes($title).")) to ((".addslashes($newtitle).")) @ ". date('H:i, F jS, Y') ." over detour</li></ul>";
					} else {
						$cache_new = "<ul style=\"margin-top: 0; margin-bottom:0; padding-top: 0;padding-bottom: 0\"><li>" . $_SERVER["REMOTE_ADDR"] . "</a> moved ((".addslashes($title).")) to ((".addslashes($newtitle).")) @ ". date('H:i, F jS, Y') ." over detour</li></ul>";
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
			} else {
				unlink(dirname(getcwd())."/contents/".$title.".cont");
				unlink(dirname(getcwd())."/history/".$title.".hist");
				
				if (strlen($reason) > 0) {
					if (isset($_SESSION['user'])) {
						$hiscache = "<ul style=\"margin-top: 0; margin-bottom:0; padding-top: 0;padding-bottom: 0\"><li>((User:".addslashes($_SESSION['user'])."|".addslashes($_SESSION['user']).")) moved ((".addslashes($title).")) to ((".addslashes($newtitle).")) @ ". date('H:i, F jS, Y') ." (<i><span style=\"color:#adadad\">".$reason."</span></i>) without leaving a detour</li></ul>";
					} else {
						$hiscache = "<ul style=\"margin-top: 0; margin-bottom:0; padding-top: 0;padding-bottom: 0\"><li>" . $_SERVER["REMOTE_ADDR"] . " moved ((".addslashes($title).")) to ((".addslashes($newtitle).")) @ ". date('H:i, F jS, Y') ." (<i><span style=\"color:#adadad\">".$reason."</span></i>) without leaving a detour</li></ul>";
					}
				} else {
					if (isset($_SESSION['user'])) {
						$hiscache = "<ul style=\"margin-top: 0; margin-bottom:0; padding-top: 0;padding-bottom: 0\"><li>((User:".addslashes($_SESSION['user'])."|".addslashes($_SESSION['user']).")) moved ((".addslashes($title).")) to ((".addslashes($newtitle).")) @ ". date('H:i, F jS, Y') ." without leaving a detour</li></ul>";
					} else {
						$hiscache = "<ul style=\"margin-top: 0; margin-bottom:0; padding-top: 0;padding-bottom: 0\"><li>" . $_SERVER["REMOTE_ADDR"] . "</a> moved ((".addslashes($title).")) to ((".addslashes($newtitle).")) @ ". date('H:i, F jS, Y') ." without leaving a detour</li></ul>";
					}
				}
				
				$history = dirname(getcwd())."/history/RecentChanges.hist"; // the file to which $cache_new gets prepended

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
			}
			header('Location: '.$IURL.'index.php?title='.$newtitle.'&action=view');
		}
	}
} else {
	header('Location: '.$IURL.'index.php?title='.$title.'&action=move&error=exist');
}
?>