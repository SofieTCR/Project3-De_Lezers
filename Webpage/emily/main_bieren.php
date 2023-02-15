<?php

// functie: Programma overzicht v=bieren
// auteur: Wigmans

// Initialisatie
include 'functions.php';

// main

// Connect database bieren
$conn = ConnectDb();
var_dump($conn);

// Print bieren
OvzBieren($conn);

?>