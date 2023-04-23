<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/utils/connection.php";

$email = $_POST['email'] ?? '';
$first_name = $_POST['first_name'] ?? '';
$last_name = $_POST['last_name'] ?? '';
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

if ($email != '' && 
    $first_name != '' && 
    $last_name != '' && 
    $username != '' && 
    $password != '') {
    if (strlen($password) >= 8) {
        $user = $mysqli -> query("SELECT * FROM Users WHERE Users.email = '$email';") -> fetch_assoc();

        if ($user) { echo "<h2>error: this email already has an account!. <a href='/auth/signup.php'>try again.</a></h2>"; } 
        else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $mysqli -> query("INSERT INTO Users (email, username, first_name, last_name, password_hash)
                VALUES ('$email', '$username', '$first_name', '$last_name', '$hash');");
            header("Location: /auth/login.php");
        }

    } else { echo "<h2>error: password has to be at least 8 characters long. <a href='/auth/signup.php'>try again.</a></h2>"; }
} else { echo "<h2>error: fields cannot be empty. <a href='/auth/signup.php'>try again.</a></h2>"; }
?>