<?php
$DIR = $_SERVER['PHP_SELF'];
$DIR = explode("/", $DIR);
$IURL = "http://".$_SERVER['HTTP_HOST']."/".$DIR[1]."/";
$ID = getcwd()."/";
?>