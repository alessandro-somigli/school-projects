<?php
include $_SERVER['DOCUMENT_ROOT']."/utils/connection.php";
session_start();

$user_email = $_SESSION['user_email'] ?? null;

$community = $_GET['c'] ?? null;

$event_name = $_GET['name'] ?? null;
$event_description = $_GET['description'] ?? '';
$event_location = $_GET['location'] ?? null;
$event_date = $_GET['date'] ?? null;

if ($user_email) {
if ($community) {
if ($event_name && $event_location && $event_date) {

$subscribed = $mysqli -> query("SELECT Subscriptions.user_email FROM Subscriptions WHERE 
    Subscriptions.community_name = '$community' AND Subscriptions.user_email = '$user_email';") -> num_rows > 0;
$exists = $mysqli -> query("SELECT Events.id FROM Events WHERE Events.event_name = '$event_name';") -> num_rows > 0;

if ($subscribed) {
if (!$exists) {
    $mysqli -> query("INSERT INTO Events (community_name, event_name, event_description, event_location, starting_date) 
        VALUES ('$community', '$event_name', '$event_description', '$event_location', '$event_date');");
    $event_id = $mysqli -> query("SELECT Events.id FROM Events WHERE Events.event_name = '$event_name';") -> fetch_assoc()['id'];
    header("Location: /event.php?e=$event_id");
} else { echo "<h2>error: this event already exists.</h2>"; }
} else { echo "<h2>error: subscribe to the community first.</h2>"; }

} else { echo "<h2>error: provide valid event data. </h2>"; }
} else { echo "<h2>error: this community does not exist.</h2>"; }
} else { echo "<h2>error: you are not logged in. <a href='/auth/login.php?r=/fn/create/event.php?c=$community&name=$event_name&description=$event_description&location=$event_location&date=$event_date'>log in</a></h2>"; }

?>