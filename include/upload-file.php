<?php
session_start();
require getcwd().'/getsite.php';
$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);

if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/jpg")
|| ($_FILES["file"]["type"] == "image/pjpeg")
|| ($_FILES["file"]["type"] == "image/x-png")
|| ($_FILES["file"]["type"] == "image/png"))
&& ($_FILES["file"]["size"] < 40000)
&& in_array($extension, $allowedExts)) {
  if ($_FILES["file"]["error"] > 0) {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
  } else {
    if (file_exists(dirname($ID)."/upload/" . $_FILES["file"]["name"])) {
      header('Location: '.$IURL.'index.php?title=Wiki:Upload&err=exist');
    } else {
      move_uploaded_file($_FILES["file"]["tmp_name"], dirname($ID)."/upload/" . $_FILES["file"]["name"]);
	  $filehist = fopen(dirname(getcwd()).'/history/file/'. $_FILES["file"]["name"] .'.hist', 'a');
	  fwrite($filehist, '<table>');
	  fwrite($filehist, '<tr>');
	  fwrite($filehist, '<td style="background:#DDDDDD;border:2px solid #bfbfbf;">'.date('H:i, F jS, Y').'</td>');
	  fwrite($filehist, '<td style="background:#DDDDDD;border:2px solid #bfbfbf;"><img src="'.$IURL.'upload/'. $_FILES["file"]["name"].'" style="max-width:150px"></td>');
	  if (isset($_SESSION['user'])) {
		fwrite($filehist, '<td style="background:#DDDDDD;border:2px solid #bfbfbf;">((User:'.addslashes($_SESSION['user']).'|'.addslashes($_SESSION['user']).'))</td>');
	  } else {
		fwrite($filehist, '<td style="background:#DDDDDD;border:2px solid #bfbfbf;">'. $_SERVER["REMOTE_ADDR"] .'</td>');
	  }
	  fwrite($filehist, '</tr>');
	  fwrite($filehist, '</table>');
	  fclose($filehist);
	  if (isset($_SESSION['user'])) {
		$cache_new = "<ul style=\"margin-top: 0; margin-bottom:0; padding-top: 0;padding-bottom: 0\"><li>((User:".addslashes($_SESSION['user'])."|".addslashes($_SESSION['user']).")) uploaded <a href=\"index.php?title=File:".$_FILES["file"]["name"]."\">".$_FILES["file"]["name"]."</a> @ ". date('H:i, F jS, Y') ."</li></ul>"; // this gets prepended
	  } else {
		$cache_new = "<ul style=\"margin-top: 0; margin-bottom:0; padding-top: 0;padding-bottom: 0\"><li>" . $_SERVER["REMOTE_ADDR"] . " uploaded <a href=\"index.php?title=File:".$_FILES["file"]["name"]."\">".$_FILES["file"]["name"]."</a> @ ". date('H:i, F jS, Y') ."</li></ul>"; // this gets prepended
	  }
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
	  header('Location: '.$IURL.'index.php?title=File:'.$_FILES["file"]["name"].'&action=view');
    }
  }
} else {
  header('Location: '.$IURL.'index.php?title=Wiki:Upload&err=invalid');
}
?>