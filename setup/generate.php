<?php
	require dirname(getcwd())."/include/getsite.php";
	
	if (file_exists(dirname($ID)."/WikiSettings.php")) {
		header('Location: '.$IURL.'index.php');
	} else {
		$wname = $_POST['name'];
		$wlogo = $_POST['logo'];
		$wlicense = $_POST['license'];
		$wsettings = fopen(dirname($ID)."/WikiSettings.php", "w");
  		fwrite($wsettings, '<?php'. PHP_EOL);
		fwrite($wsettings, 'require "include/getsite.php";'. PHP_EOL);
		fwrite($wsettings, '$name = "'. $wname .'";'. PHP_EOL);
		if ($wlicense == "by") {
			fwrite($wsettings, '$licensefull = "CC BY";'. PHP_EOL);
		} elseif ($wlicense == "by-sa") {
			fwrite($wsettings, '$licensefull = "CC BY-SA";'. PHP_EOL);
		} elseif ($wlicense == "by-nd") {
			fwrite($wsettings, '$licensefull = "CC BY-ND";'. PHP_EOL);
		} elseif ($wlicense == "by-nc") {
			fwrite($wsettings, '$licensefull = "CC BY-NC";'. PHP_EOL);
		} elseif ($wlicense == "by-nc-sa") {
			fwrite($wsettings, '$licensefull = "CC BY-NC-SA";'. PHP_EOL);
		} elseif ($wlicense == "by-nc-nd") {
			fwrite($wsettings, '$licensefull = "CC BY-NC-ND";'. PHP_EOL);
		} 
		fwrite($wsettings, '$licensefile = "'. $wlicense .'";'. PHP_EOL);
		if (strlen($wlogo) < 1) {
			fwrite($wsettings, '$logo = $IURL.\'skins/common/PointWikiLogo.png\';'. PHP_EOL);
		} else {
			fwrite($wsettings, '$logo = "'.$wlogo.'";'. PHP_EOL);
		}
		fwrite($wsettings, '?>');
  		fclose($wsettings);
		header('Location: '.$IURL.'setup/setup.php?complete=true');
	}
?>