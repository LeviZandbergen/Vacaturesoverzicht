<?php
session_start();
DEFINE("DB_USER", "root");
DEFINE("DB_PASS", "root");

//Met een try catch block worden zo geheten exceptions of uitzonderingen opgevangen en wordt gezocht naar een catch met een code die de exception kan uitvoeren, als deze niet gevonden kan worden wordt hiervoor de global exception handler voor gebruikt.

try {
    $db = new PDO("mysql:host=localhost;dbname=vacaturesoverzicht", DB_USER, DB_PASS);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>