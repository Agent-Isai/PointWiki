<?php
function endsWith($haystack, $needle)
{
    return $needle === "" || substr($haystack, -strlen($needle)) === $needle;
}
$DIR = $_SERVER['PHP_SELF'];
$DIR = explode("/", $DIR);
if (endsWith($DIR[1], ".php")) {
	$IURL = "http://".$_SERVER['HTTP_HOST']."/";
} else {
	$IURL = "http://".$_SERVER['HTTP_HOST']."/".$DIR[1]."/";
}
$ID = getcwd()."/";
?>