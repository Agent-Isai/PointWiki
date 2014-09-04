<?php
	require getcwd().'/getsite.php';
	$from = $_POST["name"]; // sender
    $subject = $_POST["rateissue"]." issue that ".$_POST["peopleissue"]." experience!";
    $message = $_POST["issueTxt"];
    // message lines should not exceed 70 characters (PHP rule), so wrap it
    $message = wordwrap($message, 70);
    // send mail
    mail("snowstormer@snowstormer.tk", $subject, $message, "From: $from\n");
    header("Location: ".$IURL."index.php?title=Wiki:IssueTracker&sent=true");
?>