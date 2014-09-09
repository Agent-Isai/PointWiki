<?php
session_start();
require getcwd()."/getsite.php";
date_default_timezone_set('UTC');
$title = $_GET['title'];

unlink(dirname($ID)."/contents/".$title.".cont");
unlink(dirname($ID)."/history/".$title.".hist");

$reason = addslashes($_POST['reason']);

if (! strlen($reason) > 0) {
	if (isset($_SESSION['user'])) {
		$cache_new = "<ul style=\"margin-top: 0; margin-bottom:0; padding-top: 0;padding-bottom: 0\"><li>((User:".addslashes($_SESSION['user'])."|".addslashes($_SESSION['user']).")) deleted ((".addslashes($title).")) @ ". date('H:i, F jS, Y') ."</li></ul>"; // this gets prepended
	} else {
		$cache_new = "<ul style=\"margin-top: 0; margin-bottom:0; padding-top: 0;padding-bottom: 0\"><li>" . $_SERVER["REMOTE_ADDR"] . " deleted ((".addslashes($title).")) @ ". date('H:i, F jS, Y') ."</li></ul>"; // this gets prepended
	}
} else {
	if (isset($_SESSION['user'])) {
		$cache_new = "<ul style=\"margin-top: 0; margin-bottom:0; padding-top: 0;padding-bottom: 0\"><li>((User:".addslashes($_SESSION['user'])."|".addslashes($_SESSION['user']).")) deleted ((".addslashes($title).")) @ ". date('H:i, F jS, Y') ." (<i><span style=\"color:#adadad\">".substr($reason, 0, 50)."</span></i>)</li></ul>"; // this gets prepended
	} else {
		$cache_new = "<ul style=\"margin-top: 0; margin-bottom:0; padding-top: 0;padding-bottom: 0\"><li>" . $_SERVER["REMOTE_ADDR"] . " deleted ((".addslashes($title).")) @ ". date('H:i, F jS, Y') ." (<i><span style=\"color:#adadad\">".substr($reason, 0, 50)."</span></i>)</li></ul>"; // this gets prepended
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