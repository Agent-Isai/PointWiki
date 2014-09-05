<?php
$skin = "silver";
if ($skin == "silver") {
	require $ID."skins/silver/header.php";
}
$err = $_GET['err'];
?>
<div class="pagetitle">Upload file</div>
<hr>
<div class="content">
<p>Using files:<br>
To use a file, type &lt;img src="upload/(yourfile)"&gt; on a page to make it show up.<br>
You can change the file's width/height by doing &lt;img src="upload/(yourfile)" width="(width)" height="(height)"&gt;.<br>
Width and height can be pixels (e.g. 42px) or percentages (e.g. 50%).</p>
<hr>
<?php
if (! strlen($err) < 1) {
	if ($err == "invalid") {
		echo '<div style="text-align:center;color:red;font-size:18px">Error: Invalid file.</div>';
	} elseif ($err == "exist") {
		echo '<div style="text-align:center;color:red;font-size:18px">Error: File already exists, as of now, reuploading a file is not yet supported.</div>';
	}
}
?>
<?php
echo '<form action="'.$IURL.'include/upload-file.php" method="post" enctype="multipart/form-data">';
?>
<label for="file">File:</label>
<input type="file" name="file" id="file"><br>
<input type="submit" name="submit" value="Upload file">
</form>
<hr>
<p>Allowed file types: .png, .jpg, .jpeg, .gif<br>
File size must not exceed 40 kB</p>
<?php
if ($skin == "silver") {
	require $ID."skins/silver/footer.php";
}
?>
</div>
</div>
<?php
if ($skin == "silver") {
	require $ID."skins/silver/sidebar.php";
}
?>