<?php
session_start();

$current_user = $_SESSION['user'];

$email = $_GET['email'];
$password = $_GET['password'];

$mysqli = new mysqli('localhost', 'root', 'Magicjesus2000!', 'school_ex_08');

if ($mysqli -> connect_errno) echo 'error: ' . $mysqli -> connect_error;

$res = $mysqli->
    query("SELECT * from users
            INNER JOIN credentials on users.email = credentials.email 
            WHERE users.email = '$email' and credentials.user_password = '$password';");

$user = $res->fetch_assoc();

if ($user) {
    $_SESSION['user'] = $user;

    header('Location: ../user_page.php');
} else echo 'email or password are incorrect. <br> <a href="../login_form.html">retry</a>';
?>
