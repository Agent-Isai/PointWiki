<?php
require getcwd()."/getsite.php";
require dirname(getcwd())."/WikiSettings.php";
if (mb_strlen($_POST['password'], 'UTF-8') < 6) {
	if ($_POST['password'] != $_POST['password2']) {
		header('Location: '.$IURL.'index.php?title=Wiki:Register&err=pwlen&err1=pwmatch');
	} else {
		header('Location: '.$IURL.'index.php?title=Wiki:Register&err=pwlen');
	}
} elseif ($_POST['password'] != $_POST['password2']) {
	header('Location: '.$IURL.'index.php?title=Wiki:Register&err1=pwmatch');
} else {
	$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	
	$usern = mysqli_real_escape_string($con, $_POST['username']);
	$email = mysqli_real_escape_string($con, $_POST['email']);
	$password = sha1($_POST['password']);
	$password = mysqli_real_escape_string($con, $password);
	
	$sql="INSERT INTO user (username, email, password)
VALUES ('$usern', '$email', '$password')";
	
	if (!mysqli_query($con,$sql)) {
	  die('Error: ' . mysqli_error($con));
	}

	mysqli_close($con);
	
	$cache_new = "<ul style=\"margin-top: 0; margin-bottom:0; padding-top: 0;padding-bottom: 0\"><li>User account ((User:".addslashes($_POST['username'])."|".addslashes($_POST['username']).")) created @ ". date('H:i, F jS, Y') ."</li></ul>"; // this gets prepended
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
	
	header('Location: '.$IURL.'index.php?title=Wiki:Login&done=true');
}
?>