<?php
session_start();

$_SESSION['user_email'] = null;

header("Location: /home.php");
?>