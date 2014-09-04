<?php
$skin = "silver";
if ($skin == "silver") {
	require $ID."skins/silver/header.php";
}
$sent = $_GET["sent"];
?>
<div class="pagetitle">Issue tracker</div>
<hr>
<?php
if (! $sent == "true") {
	echo '<div class="content">';
	echo '<p>Since this is an early release, if you have any issues with the PointWiki software, make sure you submit them here. Your response will be emailed to PointWiki for review.</p>';
	echo 'As an alternative, you can also report issues to our <a href="https://github.com/Snowstormer/PointWiki/issues">GitHub Issues Page</a>.';
	echo '<hr>';
	echo '<form action="'.$IURL.'include/sendissue.php" method="post" enctype="multipart/form-data">';
	echo '<label for="name"><b>Your name:</b></label>';
	echo '<input type="text" name="name" id="name"><br>';
	echo '<label for "issueTxt"><b>Enter your issue below, make sure that you\'re descriptive!</b></label><br>';
	echo '<textarea tabindex="1" accesskey="," id="issueTxt" cols="90" rows="10" style="" lang="en" dir="ltr" name="issueTxt"></textarea><br>';
	echo '<label for "peopleissue"><b>How many people would experience this issue?</b></label><br>';
	echo '<input type="radio" name="peopleissue" value="all people">All people<br>';
	echo '<input type="radio" name="peopleissue" value="most people">Most people<br>';
	echo '<input type="radio" name="peopleissue" value="some people">Some people<br>';
	echo '<input type="radio" name="peopleissue" value="a few people">A few people<br>';
	echo '<label for "rateissue"><b>How important would you rate this issue?</b></label><br>';
	echo '<input type="radio" name="rateissue" value="Unbearable">Unbearable<br>';
	echo '<input type="radio" name="rateissue" value="Bearable">Bearable<br>';
	echo '<input type="radio" name="rateissue" value="Noticeable">Noticeable<br>';
	echo '<input type="radio" name="rateissue" value="Unnoticeable">Unnoticeable<br>';
	echo '<input type="submit" name="submit" value="Submit issue">';
	echo '</form>';
} else {
	echo '<div style="font-family:Arial, Helvetica, sans-serif;text-align:center;font-size:18px;font-weight:bold;">Thank you for submitting the issue!</div>';
	echo '<div class="content" style="text-align:center"><a href="'.$IURL.'index.php">Return to main page.</a></div>';
}
?>
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