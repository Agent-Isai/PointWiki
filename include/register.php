<?php
$skin = "silver";
if ($skin == "silver") {
	require $ID."skins/silver/header.php";
}
$err = $_GET['err'];
$err1 = $_GET['err1'];
?>
<div class="pagetitle">Registration</div>
<hr>
<div class="content">
Please note that while our registration is still safe, it's not the safest method of registration out there. Make sure you are cautious when registering, we also encourage you to use a password you don't use elsewhere!
<?php
echo '<form action="'.$IURL.'include/reg-connect.php" method="POST">';
?>
	<table>
	<tr>
    <td style="text-align:right">Username:</td>
	<td><input id="username" type="text" name="username" placeholder="Enter the username"></td>
	</tr>
	<tr>
	<td style="text-align:right">Email address:</td>
	<td><input id="email" type="email" name="email" placeholder="Enter email address"></td>
	<td><a href="#" class="tooltip">?<span><strong>Why email?</strong><br />We require you to enter your email because if you lose your password, you can ask for a reset. Make sure you enter a working email. We don't require you to confirm your email.</span></a>
	</tr>
	<tr>
    <td style="text-align:right">Password:</td>
	<td><input id="password" type="password" name="password" placeholder="Enter a password"></td>
<?php
if ($err == "pwlen") {
	echo '<td><div style="color:red;font-weight:bold">*An error occurred with the password: Make sure the password is at least 6 characters.</div></td>';
}
?>
	</tr>
	<tr>
    <td style="text-align:right">Confirm password:</td>
	<td><input id="password2" type="password" name="password2" placeholder="Enter password again"></td>
<?php
if ($err1 == "pwmatch") {
	echo '<td><div style="color:red;font-weight:bold">*An error occurred with the password: The passwords don\'t match.</div></td>';
}
?>
	</tr>
	</table>
    <input class="register" type="submit" name="submit" value="Register" />
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