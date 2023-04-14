<?php
session_start();

$_SESSION['party_id'] = null;
$_SESSION['candidate_id'] = null;

header('Location: ../index.html');
?>