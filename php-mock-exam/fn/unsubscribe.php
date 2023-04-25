<?php
session_start();

$user_email = $_SESSION['user_email'] ?? null;

$community_name = $_GET['c'] ?? null;
$redirect = $_GET['r'] ?? "/community.php?c=$community_name";

$login_redirect = "/fn/unsubscribe.php?c=$community_name&r=$redirect";

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
        if ($community['is_subscribed'] == 1) {
            $mysqli -> query("DELETE FROM Subscriptions
                WHERE Subscriptions.community_name = '$community_name' AND Subscriptions.user_email = '$user_email';");
        
            header("Location: $redirect");
        } else { echo "<h2>error: you are not subscribed yet</h2>"; }
    } else { echo "<h2>error: community not found.</h2>"; }
} else { echo "<h2>error: log in to unsubscribe. <a href='/auth/login.php?r=$login_redirect'>log in</a></h2>"; }
?>