<?php
session_start();

// if user is null redirect to home page, else get data from session
$user = $_SESSION['user'] ?? header('Location: ../index.php');

$_SESSION['user'] = null;
header('Location: ../index.php');
?>
