<?php
include $_SERVER['DOCUMENT_ROOT']."/utils/connection.php";
session_start();

$user_email = $_SESSION['user_email'] ?? null;

$event = $_GET['e'] ?? null;

$review_title = $_GET['title'] ?? null;
$review_text = $_GET['text'] ?? null;
$review_rating = $_GET['rating'] ?? null;

if ($user_email) {
if ($event) {
if ($review_title && $review_text && $review_rating) {
    
$community = $mysqli -> query("SELECT Communities.name FROM Communities 
    INNER JOIN Events ON Communities.name = Events.community_name
    WHERE Events.id = $event;") -> fetch_assoc()['name'];
$subscribed = $mysqli -> query("SELECT Subscriptions.user_email FROM Subscriptions WHERE 
    Subscriptions.community_name = '$community' AND Subscriptions.user_email = '$user_email';") -> num_rows > 0;
$exists = $mysqli -> query("SELECT Reviews.review_id FROM Reviews WHERE Reviews.title = '$review_title';") -> num_rows > 0;

if ($subscribed) {
if (!$exists) {
    $mysqli -> query("INSERT INTO Reviews (event_id, user_email, title, text, rating) 
        VALUES ('$event', '$user_email', '$review_title', '$review_text', '$review_rating');");
    header("Location: /event.php?e=$event");
} else { echo "<h2>error: this event already has a review with this title.</h2>"; }
} else { echo "<h2>error: subscribe to the event's community first.</h2>"; }

} else { echo "<h2>error: provide valid event data. </h2>"; }
} else { echo "<h2>error: this event does not exist.</h2>"; }
} else { echo "<h2>error: you are not logged in. <a href='/auth/login.php?r=/fn/create/community.php?e=$event&title=$review_title&text=$review_text&rating=$review_rating'>log in</a></h2>"; }

?>