<?php
session_start();
session_destroy();
$root = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';
header("Location: " . $root . "KASH/init/login.php"); 
exit();
?>