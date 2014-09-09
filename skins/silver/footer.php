<div class="footer">
<hr>
<?php
	//if you remove this the sky will fall on your head
	echo '<img class="poweredby" src="'.$IURL.'skins/common/PointWikiBanner.png" width="88px" height="31px">';
	echo '<img class="license" src="http://i.creativecommons.org/l/'.$license.'/3.0/88x31.png">';
	if ($license == "by") {
		echo '<div class="content">Contributions to '.$name.' are licensed under CC BY.</div>';
	} elseif ($license == "by-sa") {
		echo '<div class="content">Contributions to '.$name.' are licensed under CC BY-SA.</div>';
	} elseif ($license == "by-nd") {
		echo '<div class="content">Contributions to '.$name.' are licensed under CC BY-ND.</div>';
	} elseif ($license == "by-nc") {
		echo '<div class="content">Contributions to '.$name.' are licensed under CC BY-NC.</div>';
	} elseif ($license == "by-nc-sa") {
		echo '<div class="content">Contributions to '.$name.' are licensed under CC BY-NC-SA.</div>';
	} elseif ($license == "by-nc-nd") {
		echo '<div class="content">Contributions to '.$name.' are licensed under CC BY-NC-ND.</div>';
	} 
?>
<br><br>
</div>
</body>
</html>