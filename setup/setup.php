<?php
header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html>
<head>
<?php
include dirname(getcwd()).'/include/getsite.php';
echo '<title>Set up PointWiki</title>';
$err = $_GET['error'];
?>
<?php
echo '<link rel="stylesheet" type="text/css" href="'.$IURL.'skins/silver/silver.css"/>';
?>
</head>
<body>
<br><br>
<div class="page">
<?php
	echo '<div class="pagetitle">PointWiki setup</div>';
	echo '<hr>';
?>
<div class="content">
<?php
$complete = $_GET['complete'];
if ($err == 'dbconnect') {
	echo '<div style="color:red;font-weight:bold">There was an error with the database. Please check your database info.</div>';
} elseif ($err == 'passlen') {
	echo '<div style="color:red;font-weight:bold">There was an error with to owner password. Make sure it\'s at least 6 characters long.</div>';
}
if ($complete == "true") {
	if (! file_exists(dirname($ID)."/WikiSettings.php")) {
		echo '<p>Thank you for choosing PointWiki!<br>Below you can find a form which will help you get your wiki up and running!</p>';
		echo '<form action="'.$IURL.'setup/generate.php" method="post" enctype="multipart/form-data">';
		echo '<h3>Basic wiki settings</h3>';
		echo '<label for="name"><b>Wiki name: </b></label> <a href="#" class="tooltip">?<span><strong>Wiki name</strong><br />The name of your wiki, for example: "My Wiki".</span></a><br>';
		echo '<input type="text" name="name" id="name"><br>';
		echo '<label for="logo"><b>Wiki logo address: </b></label> <a href="#" class="tooltip">?<span><strong>Wiki logo</strong><br />The logo URL for your wiki, leave blank for the default PointWiki logo.</span></a><br>';
		echo '<input type="text" name="logo" id="logo"><br>';
		echo '<label for "license"><b>Wiki licensing: </b></label> <a href="#" class="tooltip">?<span><strong>Wiki licensing</strong><br />If you are not sure which license to use, see the Creative Commons website at http://creativecommons.org/licenses/.</span></a><br>';
		echo '<input type="radio" name="license" value="by">CC BY<br>';
		echo '<input type="radio" name="license" value="by-sa">CC BY-SA<br>';
		echo '<input type="radio" name="license" value="by-nd">CC BY-ND<br>';
		echo '<input type="radio" name="license" value="by-nc">CC BY-NC<br>';
		echo '<input type="radio" name="license" value="by-nc-sa">CC BY-NC-SA<br>';
		echo '<input type="radio" name="license" value="by-nc-nd">CC BY-NC-ND<br>';
		echo '<hr>';
		echo '<h3>Database</h3>';
		echo '<label for="dbhost"><b>Database host: </b></label> <a href="#" class="tooltip">?<span><strong>Database host</strong><br>The host of your MySQL database. For example: "localhost".</span></a><br>';
		echo '<input type="text" name="dbhost" id="dbhost"><br>';
		echo '<label for="dbuser"><b>Database user: </b></label> <a href="#" class="tooltip">?<span><strong>Database user</strong><br>The username of your MySQL database. For example: "root".</span></a><br>';
		echo '<input type="text" name="dbuser" id="dbuser"><br>';
		echo '<label for="dbpass"><b>Database password: </b></label> <a href="#" class="tooltip">?<span><strong>Database password</strong><br>The password for your MySQL database. For example: "password".</span></a><br>';
		echo '<input type="password" name="dbpass" id="dbpass"><br>';
		echo '<label for="dbname"><b>Database name: </b></label> <a href="#" class="tooltip">?<span><strong>Database name</strong><br>The name of the MySQL database. For example: "database".</span></a><br>';
		echo '<input type="text" name="dbname" id="dbname"><br>';
		echo '<hr>';
		echo '<h3>Owner details</h3>';
		echo '<label for="ownuser"><b>Owner username: </b></label> <a href="#" class="tooltip">?<span><strong>Owner username</strong><br>Enter an username.</span></a><br>';
		echo '<input type="text" name="ownuser" id="ownuser"><br>';
		echo '<label for="ownpass"><b>Owner password: </b></label> <a href="#" class="tooltip">?<span><strong>Owner password</strong><br>Enter a password.</span></a><br>';
		echo '<input type="password" name="ownpass" id="ownpass"><br>';
		echo '<label for="ownemail"><b>Owner email: </b></label> <a href="#" class="tooltip">?<span><strong>Owner email</strong><br>Enter your email. Email is required for when you forget your password.</span></a><br>';
		echo '<input type="email" name="ownemail" id="ownemail"><br>';
		echo '<hr>';
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
		echo '<h3>Basic wiki settings</h3>';
		echo '<label for="name"><b>Wiki name: </b></label> <a href="#" class="tooltip">?<span><strong>Wiki name</strong><br />The name of your wiki, for example: "My Wiki".</span></a><br>';
		echo '<input type="text" name="name" id="name"><br>';
		echo '<label for="logo"><b>Wiki logo address: </b></label> <a href="#" class="tooltip">?<span><strong>Wiki logo</strong><br />The logo URL for your wiki, leave blank for the default PointWiki logo.</span></a><br>';
		echo '<input type="text" name="logo" id="logo"><br>';
		echo '<label for "license"><b>Wiki licensing: </b></label> <a href="#" class="tooltip">?<span><strong>Wiki licensing</strong><br />If you are not sure which license to use, see Creative Commons website at http://creativecommons.org/licenses/.</span></a><br>';
		echo '<input type="radio" name="license" value="by">CC BY<br>';
		echo '<input type="radio" name="license" value="by-sa">CC BY-SA<br>';
		echo '<input type="radio" name="license" value="by-nd">CC BY-ND<br>';
		echo '<input type="radio" name="license" value="by-nc">CC BY-NC<br>';
		echo '<input type="radio" name="license" value="by-nc-sa">CC BY-NC-SA<br>';
		echo '<input type="radio" name="license" value="by-nc-nd">CC BY-NC-ND<br>';
		echo '<hr>';
		echo '<h3>Database</h3>';
		echo '<label for="dbhost"><b>Database host: </b></label> <a href="#" class="tooltip">?<span><strong>Database host</strong><br>The host of your MySQL database. For example: "localhost".</span></a><br>';
		echo '<input type="text" name="dbhost" id="dbhost"><br>';
		echo '<label for="dbuser"><b>Database user: </b></label> <a href="#" class="tooltip">?<span><strong>Database user</strong><br>The username of your MySQL database. For example: "root".</span></a><br>';
		echo '<input type="text" name="dbuser" id="dbuser"><br>';
		echo '<label for="dbpass"><b>Database password: </b></label> <a href="#" class="tooltip">?<span><strong>Database password</strong><br>The password for your MySQL database. For example: "password".</span></a><br>';
		echo '<input type="password" name="dbpass" id="dbpass"><br>';
		echo '<label for="dbname"><b>Database name: </b></label> <a href="#" class="tooltip">?<span><strong>Database name</strong><br>The name of the MySQL database. For example: "database".</span></a><br>';
		echo '<input type="text" name="dbname" id="dbname"><br>';
		echo '<hr>';
		echo '<h3>Owner details</h3>';
		echo '<label for="ownuser"><b>Owner username: </b></label> <a href="#" class="tooltip">?<span><strong>Owner username</strong><br>Enter an username.</span></a><br>';
		echo '<input type="text" name="ownuser" id="ownuser"><br>';
		echo '<label for="ownpass"><b>Owner password: </b></label> <a href="#" class="tooltip">?<span><strong>Owner password</strong><br>Enter a password.</span></a><br>';
		echo '<input type="password" name="ownpass" id="ownpass"><br>';
		echo '<label for="ownemail"><b>Owner email: </b></label> <a href="#" class="tooltip">?<span><strong>Owner email</strong><br>Enter your email. Email is required for when you forget your password.</span></a><br>';
		echo '<input type="email" name="ownemail" id="ownemail"><br>';
		echo '<hr>';
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