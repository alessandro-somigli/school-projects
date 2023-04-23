<?php
session_start();

$user_email = $_SESSION['user_email'] ?? null;

$community_name = $_GET['c'] ?? null;
$redirect = $_GET['r'] ?? "/community.php?c=$community_name";

if ($user_email) {
    include $_SERVER['DOCUMENT_ROOT']."/utils/connection.php";
    $community = $mysqli -> query("SELECT Communities.name, 
        CASE WHEN Communities.name IN (
            SELECT Subscriptions.community_name FROM Subscriptions
            WHERE Subscriptions.user_email = '$user_email')
        THEN 1 ELSE 0 END AS is_subscribed
        FROM Communities
            WHERE Communities.name = '$community_name';") -> fetch_assoc();

    if ($community) {
        if ($community['is_subscribed'] == 0) {
            $mysqli -> query("INSERT INTO Subscriptions (community_name, user_email)
                VALUES ('$community_name', '$user_email')");
        
            header("Location: $redirect");
        } else { echo "<h2>error: you are already subscribed</h2>"; }
    } else { echo "<h2>error: community not found.</h2>"; }
} else { echo "<h2>error: log in to subscribe</h2>"; }
?>