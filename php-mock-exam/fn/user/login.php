<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/utils/connection.php";

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

$user = $mysqli -> query("SELECT * FROM Users WHERE Users.email = '$email';") -> fetch_assoc();

if ($user && $email == $user['email'] && password_verify($password, $user['password_hash'])) {
    $_SESSION['user_email'] = $email;
    header("Location: /home.php");
} else {
    echo "<h2>error: incorrect email or password. <a href='/auth/login.php'>try again.</a></h2>";
}
?>