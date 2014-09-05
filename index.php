<?php
require $ID."include/getsite.php";
if (version_compare(phpversion(), '5.2.0', '<')) {
	echo '<center style="font-family: Arial, Helvetica, sans-serif;font-size:16px;">';
	echo '<img class="sidebar" src="'.$IURL.'skins/common/PointWikiLogo.png" width="155px"><br>';
	echo '<b style="font-size:18px">Your PHP version is not compatible with PointWiki!</b><br>';
	echo 'Please either update your version or ask your provider to update it.<br>';
	echo '</center>';
} else {
	if (file_exists($ID.'WikiSettings.php')) {
	$allowed = array('history', 'view', 'edit', 'upload');
	$file = basename(__FILE__);

	if ( ! isset($_GET['action'])) {
	   $action = 'view';
	}

	$title = $_GET['title'];
	$action = $_GET['action'];

	if ( ! in_array($action, $allowed)) {
	   $action = 'view';
	}

	if (strlen($title) < 1 || $title == " ") {
		header('Location: '.$IURL.'index.php?title=Home&action=view');
	}

	if (ctype_lower($title)) {
		header('Location: '.$IURL.'index.php?title='.ucfirst($title).'&action=view');
	}

	if ($title == "Wiki:Upload" && $action != "upload") {
		$action = 'upload';
	}

	if ($action == "upload" && $title != "Wiki:Upload") {
		header('Location: '.$IURL.'index.php?title=Wiki:Upload');
	}

	if (0 === strpos($title, 'Wiki:')) {
		if ($title == "Wiki:Upload") {
			require $ID.'include/upload_index.php';
		} elseif ($title == "Wiki:LatestChanges") {
			require $ID.'include/latestchanges.php';
		} elseif ($title == "Wiki:IssueTracker") {
			require $ID.'include/issuetracker.php';
		} else {
			require $ID.'include/invalidwiki.php';
		}
	} elseif (0 === strpos($title, 'File:')) {
		if ($action == "edit") {
			require $ID.'include/'.$action . '_' . $file;
		} elseif ($action == "history") {
			require $ID.'include/'.$action . '_' . $file;
		} else {
			if ($title == "File:"){
				require $ID.'include/invalidwiki.php';
			} else {
				require $ID.'include/filepage.php';
			}
		}
	} else {
		require $ID.'include/'.$action . '_' . $file;
	}
} else {
	echo '<center style="font-family: Arial, Helvetica, sans-serif;font-size:16px;">';
	echo '<img class="sidebar" src="'.$IURL.'skins/common/PointWikiLogo.png" width="155px"><br>';
	echo '<b style="font-size:18px">Uh oh! Looks like you don\'t have PointWiki set up yet!</b><br>';
	echo '<a href="'.$IURL.'setup/setup.php">Click here to set up!</a><br>';
	echo '</center>';	
}
}	
?>