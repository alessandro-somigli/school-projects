<?php
include $_SERVER['DOCUMENT_ROOT']."/utils/connection.php";
session_start();

$user_email = $_SESSION['user_email'] ?? null;

$community = $_GET['c'] ?? null;

if ($user_email) {
if ($community) {

$res = $mysqli -> query("SELECT * FROM Communities WHERE Communities.name = '$community';");

if ($res -> num_rows > 0) {
if ($user_email == ($res -> fetch_assoc())['owner']) {
    $mysqli -> query("DELETE FROM Communities WHERE Communities.name = '$community' AND Communities.owner = '$user_email';");
    header("Location: /home.php");
} else { echo "<h2>error: you are not the owner of this community. <a href='/auth/login.php?f=true&r=/fn/delete/community.php?c=$community'>log in</a></h2>"; }
} else { echo "<h2>error: this community does not exist.</h2>"; }

} else { echo "<h2>error: provide a valid community name.</h2>"; }
} else { echo "<h2>error: you are not logged in. <a href='/auth/login.php?r=/fn/delete/community.php?c=$community'>log in</a></h2>"; }
?>