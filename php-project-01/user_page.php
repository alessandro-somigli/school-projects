<?php
session_start();

// if user is null redirect to home page, else get data from session
$user = $_SESSION['user'] ?? header('Location: index.php');

echo 'welcome ' . $user['first_name'] . ' ' . $user['surname'] . '. <br>'
 . '<a href="apis/user_logout.php">logout</a>';

?>