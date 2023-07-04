<?php require_once('autoload.php');
$userLogout->logout();
header("location:index.php?logged_out=1");
?>