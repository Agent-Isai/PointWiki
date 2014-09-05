<?php
$DIR = $_SERVER['PHP_SELF'];
$DIR = explode("/", $DIR);
if ($DIR[1] == "skins" || $DIR[1] == "include" || $DIR[1] == "setup") {
	$IURL = "http://".$_SERVER['HTTP_HOST']."/";
} else {
	$IURL = "http://".$_SERVER['HTTP_HOST']."/".$DIR[1]."/";
}
$ID = getcwd()."/";
?>