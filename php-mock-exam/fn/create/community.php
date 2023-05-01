<?php
include $_SERVER['DOCUMENT_ROOT']."/utils/connection.php";
session_start();

$user_email = $_SESSION['user_email'] ?? null;

$community = $_GET['c'] ?? null;

if ($user_email) {
if ($community) {

$exists = $mysqli -> query("SELECT Communities.name FROM Communities WHERE Communities.name = '$community';") -> num_rows > 0;

if (!$exists) {
    $mysqli -> query("INSERT INTO Communities (name, owner) Values ('$community', '$user_email');");

    header("Location: /community.php?c=$community");
} else { echo "<h2>error: this community already exists.</h2>"; }

} else { echo "<h2>error: provide a valid community name.</h2>"; }
} else { echo "<h2>error: you are not logged in. <a href='/auth/login.php?r=/fn/create/community.php?c=$community'>log in</a></h2>"; }

?>