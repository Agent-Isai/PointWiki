<?php
	require dirname(getcwd())."/include/getsite.php";
	require dirname(getcwd())."/include/rights.php";
	
	if (file_exists(dirname($ID)."/WikiSettings.php")) {
		header('Location: '.$IURL.'index.php');
	} else {
		$ownpass = $_POST['ownpass'];
		if (mb_strlen($ownpass, 'UTF-8') < 6) {
			header('Location: '.$IURL.'setup/setup.php?error=passlen');
		} else {	
			//get values
			$wname = $_POST['name'];
			$wlogo = $_POST['logo'];
			$wlicense = $_POST['license'];
			$wdbhost = $_POST['dbhost'];
			$wdbuser = $_POST['dbuser'];
			$wdbpass = $_POST['dbpass'];
			$wdbname = $_POST['dbname'];
			
			//write values
			$wsettings = fopen(dirname($ID)."/WikiSettings.php", "w");
			fwrite($wsettings, '<?php'. PHP_EOL);
			fwrite($wsettings, 'require "include/getsite.php";'. PHP_EOL);
			fwrite($wsettings, 'require "include/rights.php";'. PHP_EOL);
			fwrite($wsettings, 'require "include/DefaultNamespaces.php";'. PHP_EOL);
			fwrite($wsettings, PHP_EOL);
			fwrite($wsettings, '//Wiki name. Example: "PointWiki"'. PHP_EOL);
			fwrite($wsettings, '$name = "'. $wname .'";'. PHP_EOL);
			fwrite($wsettings, PHP_EOL);
			fwrite($wsettings, '//Wiki license. Do not put "CC", must be lowercase.'. PHP_EOL);
			fwrite($wsettings, '$license = "'. $wlicense .'";'. PHP_EOL);
			fwrite($wsettings, PHP_EOL);
			fwrite($wsettings, '//Wiki logo. Can be any address.'. PHP_EOL);
			if (strlen($wlogo) < 1) {
				fwrite($wsettings, '$logo = $IURL.\'skins/common/PointWikiLogo.png\';'. PHP_EOL);
			} else {
				fwrite($wsettings, '$logo = "'.$wlogo.'";'. PHP_EOL);
			}
			fwrite($wsettings, PHP_EOL);
			fwrite($wsettings, '//MySQL database'. PHP_EOL);
			fwrite($wsettings, '$dbhost = "'. $wdbhost .'";'. PHP_EOL);
			fwrite($wsettings, '$dbuser = "'. $wdbuser .'";'. PHP_EOL);
			fwrite($wsettings, '$dbpass = "'. $wdbpass .'";'. PHP_EOL);
			fwrite($wsettings, '$dbname = "'. $wdbname .'";'. PHP_EOL);
			fwrite($wsettings, '?>');
			fclose($wsettings);
			
			$con = mysqli_connect($wdbhost,$wdbuser,$wdbpass,$wdbname);
			if (mysqli_connect_errno()) {
				header('Location: '.$IURL.'setup/setup.php?error=dbconnect');
			}
			
			$ownuser = mysqli_real_escape_string($con, $_POST['ownuser']);
			$ownemail = mysqli_real_escape_string($con, $_POST['ownemail']);
			$ownpass = sha1($_POST['ownpass']);
			$ownpass = mysqli_real_escape_string($con, $ownpass);
			
			$sql="CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
);
INSERT INTO user (username, email, password)
VALUES ('".$ownuser."', '".$ownemail."', '".$ownpass."');";
			
			if (mysqli_multi_query($con,$sql)) {
				mysqli_close($con);
				$admin["PointWiki script"] = $_POST['ownuser'];
				$owneracc = "<ul style=\"margin-top: 0; margin-bottom:0; padding-top: 0;padding-bottom: 0\"><li>((User:Default|PointWiki script))s has promoted ((User:".addslashes($_POST['ownuser'])."|".addslashes($_POST['ownuser']).")) to administrator @ ". date('H:i, F jS, Y') ."</li></ul><ul style=\"margin-top: 0; margin-bottom:0; padding-top: 0;padding-bottom: 0\"><li>User account ((User:".addslashes($_POST['ownuser'])."|".addslashes($_POST['ownuser']).")) created @ ". date('H:i, F jS, Y') ."</li></ul>"; // this gets prepended
				$ownerrc = dirname(getcwd())."/history/RecentChanges.hist"; // the file to which $cache_new gets prepended

				$ownhandle = fopen($ownerrc, "r+");
				$ownlen = strlen($owneracc);
				$ownfinal_len = filesize($ownerrc) + $ownlen;
				$owneracc = fread($ownhandle, $ownlen);
				rewind($ownhandle);
				$owni = 1;
				while (ftell($ownhandle) < $ownfinal_len) {
				  fwrite($ownhandle, $owneracc);
				  $owneracc = $owneracc;
				  $owneracc = fread($ownhandle, $ownlen);
				  fseek($ownhandle, $owni * $ownlen);
				  $owni++;
				}
					
				if (! file_exists(dirname($ID)."/contents/Home.cont")) {
					$newhome = "Welcome to your new wiki, [[SITENAME]]!<br>Write anything about your Wiki here!<br>If you experience issues, make sure to report them at ((Wiki:IssueTracker|the issue tracker)), <a href=\"https://github.com/Snowstormer/PointWiki/issues\">the GitHub issues page</a> or <a href=\"http://webchat.freenode.net?channels=PointWiki\">ask on IRC</a>!";
					$mpcont = fopen(dirname($ID)."/contents/Home.cont", "w");
					fwrite($mpcont, $newhome);
					fclose($mpcont);
					$mphist = fopen(dirname($ID)."/history/Home.hist", "w");
					fwrite($mphist, "<ul style=\"margin-top: 0; margin-bottom:0; padding-top: 0;padding-bottom: 0\"><li>((User:Default|PointWiki script)) edited this page @ ". date('H:i, F jS, Y') ." (<i><span style=\"color:#adadad\">Default main page.</span></i>) (<span style=\"color:#3cc94c\">+".strlen($newhome)."</span>)</li></ul>");
					fclose($mphist);
					$cache_new = "<ul style=\"margin-top: 0; margin-bottom:0; padding-top: 0;padding-bottom: 0\"><li>((User:Default|PointWiki script)) edited ((Home)) @ ". date('H:i, F jS, Y') ." (<i><span style=\"color:#adadad\">Default main page.</span></i>) (<span style=\"color:#3cc94c\">+".strlen($newhome)."</span>)</li></ul>';\n?>"; // this gets prepended
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
				}
					
				header('Location: '.$IURL.'setup/setup.php?complete=true');
			} else {
				header('Location: '.$IURL.'setup/setup.php?error=dbconnect');
			}
		}
	}
?>