<?php
$skin = "silver";
if ($skin == "silver") {
	require $ID."skins/silver/header.php";
}
$err = $_GET['err'];
$done = $_GET['done'];
?>
<div class="pagetitle">Log in</div>
<hr>
<div class="content">
<?php
if ($done == "true") {
	echo '<div style="font-size:20px;font-weight:bold">You are now registered and you can log in!</div>';
}
?>
<?php
echo '<form action="'.$IURL.'include/log-connect.php" method="POST">';
?>
	<table>
	<tr>
    <td style="text-align:right">Username:</td>
	<td><input id="username" type="text" name="username" placeholder="Enter your username"></td>
	</tr>
	<tr>
    <td style="text-align:right">Password:</td>
	<td><input id="password" type="password" name="password" placeholder="Enter your password"></td>
	<td><a href="#">Forgot your password?</a></td>
	</tr>
	</table>
	<input type="checkbox" name="active" value="active">Keep me logged in for 30 days<br>
<?php
if ($err == "incorrect") {
	echo '<td><div style="color:red;font-weight:bold">An error occurred with the login: Username/password invalid.</div></td>';
}
?>
    <input class="register" type="submit" name="submit" value="Login" />
</form>
</div>
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