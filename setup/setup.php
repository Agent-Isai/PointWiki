<?php
header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html>
<head>
<?php
include dirname(getcwd()).'/include/getsite.php';
echo '<title>Set up PointWiki</title>';
?>
<?php
echo '<link rel="stylesheet" type="text/css" href="'.$IURL.'skins/silver/silver.css"/>';
?>
</head>
<body>
<div style="background:#dddddd;">
<?php
echo '<div class="sitename"><a class="sitename" href="#">PointWiki</a></div>'
?>
</div>
<div class="page">
<?php
	echo '<div class="pagetitle">PointWiki setup</div>';
	echo '<hr>';
?>
<div class="content">
<?php
$complete = $_GET['complete'];
if ($complete == "true") {
	if (! file_exists(dirname($ID)."/WikiSettings.php")) {
		echo '<p>Thank you for choosing PointWiki!<br>Below you can find a form which will help you get your wiki up and running!</p>';
		echo '<form action="'.$IURL.'setup/generate.php" method="post" enctype="multipart/form-data">';
		echo '<label for="name"><b>Wiki name: </b></label>';
		echo '<input type="text" name="name" id="name"><br>';
		echo '<hr>';
		echo '<label for="logo"><b>Wiki logo address: </b></label>';
		echo '<input type="text" name="logo" id="logo"><br>';
		echo 'Enter path to logo. Leave empty to default to the default PointWiki logo. Can be changed later.';
		echo '<hr>';
		echo '<label for "license"><b>Wiki licensing: </b></label><br>';
		echo '<input type="radio" name="license" value="by">CC BY<br>';
		echo '<input type="radio" name="license" value="by-sa">CC BY-SA<br>';
		echo '<input type="radio" name="license" value="by-nd">CC BY-ND<br>';
		echo '<input type="radio" name="license" value="by-nc">CC BY-NC<br>';
		echo '<input type="radio" name="license" value="by-nc-sa">CC BY-NC-SA<br>';
		echo '<input type="radio" name="license" value="by-nc-nd">CC BY-NC-ND<br>';
		echo 'If you are not sure which license to use, see <a href="http://creativecommons.org/licenses/" target="_blank">the Creative Commons website.</a> (Opens in new tab)<br>';
		echo '<input type="submit" name="submit" value="Next &raquo;">';
	} else {
		echo 'Your WikiSettings file is now generated according to your input!<br>';
		echo '<a href="'.$IURL.'index.php">Visit your wiki!</a>';
		echo '<hr>';
		echo '<div style="font-size:14px">If your wiki does not work, try deleting the WikiSettings.php file from the wiki directory and try setting up again. If it still does not work, please <a href="mailto:snowstormer@snowstormer.tk">email us</a> to manually issue us!</div>';
	}
} else {
	if (! file_exists(dirname($ID)."/WikiSettings.php")) {
		echo '<p>Thank you for choosing PointWiki!<br>Below you can find a form which will help you get your wiki up and running!</p>';
		echo '<form action="'.$IURL.'setup/generate.php" method="post" enctype="multipart/form-data">';
		echo '<label for="name"><b>Wiki name: </b></label>';
		echo '<input type="text" name="name" id="name"><br>';
		echo '<hr>';
		echo '<label for="logo"><b>Wiki logo address: </b></label>';
		echo '<input type="text" name="logo" id="logo"><br>';
		echo 'Enter path to logo. Leave empty to deault to the default PointWiki logo. Can be changed later.';
		echo '<hr>';
		echo '<label for "license"><b>Wiki licensing: </b></label><br>';
		echo '<input type="radio" name="license" value="by">CC BY<br>';
		echo '<input type="radio" name="license" value="by-sa">CC BY-SA<br>';
		echo '<input type="radio" name="license" value="by-nd">CC BY-ND<br>';
		echo '<input type="radio" name="license" value="by-nc">CC BY-NC<br>';
		echo '<input type="radio" name="license" value="by-nc-sa">CC BY-NC-SA<br>';
		echo '<input type="radio" name="license" value="by-nc-nd">CC BY-NC-ND<br>';
		echo 'If you are not sure which license to use, see <a href="http://creativecommons.org/licenses/" target="_blank">the Creative Commons website.</a> (Opens in new tab)<br>';
		echo '<input type="submit" name="submit" value="Next &raquo;">';
	} else {
		echo 'We have detected a WikiSettings file, you should be good to go.<br>';
		echo '<a href="'.$IURL.'index.php">Visit your wiki!</a>';
		echo '<hr>';
		echo '<div style="font-size:14px">If your wiki does not work, try deleting the WikiSettings.php file from the wiki directory and try setting up again. If it still does not work, please <a href="mailto:snowstormer@snowstormer.tk">email us</a> to manually issue us!</div>';
	}
}
?>
<div class="footer">
<hr>
<?php
	echo '<img class="poweredby" src="http://www.snowstormer.tk/wiki/skins/common/PointWikiBanner.png" width="88px" height="31px">';
?>
</div>
</div>
</div>
<?php
echo '<a href="index.php"><img class="sidebar" src="'.$IURL.'skins/common/PointWikiLogo.png" width="155px" style="margin-left:0px"></a>';
?>
</body>
</html>