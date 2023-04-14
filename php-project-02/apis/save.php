<?php
session_start();

$mysqli = new mysqli("localhost","root","Magicjesus2000!","school_ex_09");
if ($mysqli -> connect_errno) echo $mysqli -> connect_error;

// add update
$mysqli -> query("UPDATE TABLE candidati.nome, candidati.cognome FROM candidati 
    WHERE candidati.id_candidato = '$candidate_id';") 
    -> fetch_assoc();

header('Location: reset.php');
?>