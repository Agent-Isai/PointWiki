<?php
$namespaces = array("File", "Wiki", "User");
$namespacemessages = array("File messages", "User messages");

if ($DIR[1] == "skins" || $DIR[1] == "include" || $DIR[1] == "setup" || $DIR[2] == "skins" || $DIR[2] == "include" || $DIR[2] == "setup") {
	$files = scandir(dirname($ID)."/contents/");
	$images = scandir(dirname($ID)."/upload/");
} else {
	$files = scandir($ID."contents/");
	$images = scandir($ID."upload/");
}
$removenamsp = 3;
$namsparray = array();
foreach ($files as $namspfile) {
	if (strstr($namspfile, ":")){
		$namspfile = explode(":", $namspfile);
		$namsp = $namspfile[0];
		if(in_array($namsp, $namespaces) || in_array($namsp, $namespacemessages)) {
			$removenamsp = $removenamsp + 1;
		}
	}
}
$pages = count($files) - $removenamsp;
$images = count($images) - 3;
?>