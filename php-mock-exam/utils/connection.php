<?php
$mysqli = new mysqli("localhost", "root", "Magicjesus2000!", "school_mock_exam");

if ($mysqli -> connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
    exit();
}
?>