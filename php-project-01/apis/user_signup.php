<?php
$email = $_GET['email'];
$password = $_GET['password'];

$first_name = $_GET['first_name'];
$surname = $_GET['surname'];

$mysqli = new mysqli('localhost', 'root', 'Magicjesus2000!', 'school_ex_08');

if ($mysqli -> connect_errno) echo 'error: ' . $mysqli -> connect_error;

$res = $mysqli-> 
    query("SELECT * from users
            INNER JOIN credentials on users.email = credentials.email 
            WHERE credentials.email = '$email';");

if ($res->fetch_assoc()['email']) {
    echo 'error: email is already in use. <br> <a href="../signup_form.html">retry</a>';
} else {
    $mysqli->query("INSERT INTO users(email, first_name, surname) VALUES ('$email', '$first_name', '$surname')");
    $mysqli->query("INSERT INTO credentials (email, user_password) VALUES ('$email', '$password')");

    header('Location: ../login_form.html');
}
?>
