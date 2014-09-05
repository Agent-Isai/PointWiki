<?php
$DIR = $_SERVER['PHP_SELF'];
$DIR = explode("/", $DIR);
if ($DIR[0] == "" || $DIR[1] == "") {
	$IURL = "http://".$_SERVER['HTTP_HOST']."/";
} else {
	$IURL = "http://".$_SERVER['HTTP_HOST']."/".$DIR[1]."/";
}
$ID = getcwd()."/";
?>