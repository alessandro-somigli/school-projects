<?php
$title = $_GET['title'] ?? '';
$director = $_GET['director'] ?? '';
$year = $_GET['year'] ?? '';
$type = $_GET['type'] ?? '';
$genre = $_GET['genre'] ?? '';

$mysqli = new mysqli("localhost","root","Magicjesus2000!","school_ex_10");

if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}

$result = $mysqli->query("SELECT movies.id FROM movies WHERE movies.title = '$title'");
if ($result->num_rows == 0) {
    $mysqli->query("INSERT INTO movies (title, director, release_year, type, genre) VALUES ('$title', '$director', '$year', '$type', '$genre');");
}

header("Location: ../movie_form.php");
?>