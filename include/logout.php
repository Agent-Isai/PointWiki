<?php
session_start();
require getcwd()."/include/getsite.php";
$return = $_GET['return'];
unset($_SESSION['user']);
session_destroy();
header('Location: '.$IURL.'index.php?title='.$return);
?>